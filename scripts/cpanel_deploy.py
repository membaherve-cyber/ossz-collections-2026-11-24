#!/usr/bin/env python3
"""
OSSZ — cPanel (Namecheap) deployment helper.

Logs into cPanel over HTTPS (port 2083), then talks to the UAPI to read,
upload and list files on the live site. Used to push the Laravel cookie
fix without FTP (which is rejected on this account).
"""
import http.cookiejar
import json
import os
import ssl
import sys
import urllib.parse
import urllib.request

HOST = "osszcollection.com:2083"
BASE = f"https://{HOST}"
USER = "osszakze"
PASS = "nUYAJz8vCe10"
HOME = f"/home/{USER}"
WEBROOT = f"{HOME}/public_html"

CTX = ssl.create_default_context()
CTX.check_hostname = False
CTX.verify_mode = ssl.CERT_NONE


class _NoRedirect(urllib.request.HTTPRedirectHandler):
    """Handle cPanel's 302/307 dance manually (urllib + 307 don't mix)."""

    def redirect_request(self, req, fp, code, msg, headers, newurl):
        return None


_jar = http.cookiejar.CookieJar()
_opener = urllib.request.build_opener(
    urllib.request.HTTPCookieProcessor(_jar),
    _NoRedirect(),
    urllib.request.HTTPSHandler(context=CTX),
)
_token = None  # cpsessNNNNN


def _open(req):
    req.add_header("User-Agent", "ossz-deployer/1.0")
    try:
        return _opener.open(req, timeout=60)
    except urllib.error.HTTPError as e:
        if e.status in (301, 302, 303, 307, 308, 401):
            return e  # caller inspects .status / .headers
        raise


def login():
    global _token
    import re

    # 1) POST credentials (accept the 307 without following)
    data = urllib.parse.urlencode({"user": USER, "pass": PASS}).encode()
    req = urllib.request.Request(f"{BASE}/login/", data=data)
    resp = _open(req)
    loc = resp.headers.get("Location", "")
    if not loc:
        raise SystemExit("login failed: no Location header")

    # 2) GET the token URL to activate the session (up to 3 hops)
    for _ in range(3):
        nxt = urllib.request.Request(f"{BASE}{loc}")
        resp = _open(nxt)
        loc = resp.headers.get("Location", "")
        if not loc:
            break

    m = re.search(r"cpsess\d+", getattr(resp, "url", "") or "")
    if not m:
        body = resp.read().decode("utf-8", "ignore")
        m = re.search(r"cpsess\d+", body)
        if not m:
            raise SystemExit("login failed: no security token found")
    _token = m.group(0)
    print(f"[login] ok — token {_token}")


def _relogin():
    login()


def api(module, fn, params=None):
    """Call UAPI: GET /{token}/execute/Module/function?params"""
    qs = urllib.parse.urlencode(params or {})
    url = f"{BASE}/{_token}/execute/{module}/{fn}" + (f"?{qs}" if qs else "")
    for attempt in (1, 2):
        with _open(urllib.request.Request(url)) as r:
            if getattr(r, "status", 200) == 401:
                _relogin()
                url = f"{BASE}/{_token}/execute/{module}/{fn}" + (f"?{qs}" if qs else "")
                continue
            return json.loads(r.read().decode())
    raise RuntimeError(f"api {module}/{fn}: unauthorized after retry")


def api_post(module, fn, form):
    """Call UAPI with POST form (for large payloads)."""
    url = f"{BASE}/{_token}/execute/{module}/{fn}"
    data = urllib.parse.urlencode(form).encode()
    req = urllib.request.Request(url, data=data)
    req.add_header("Content-Type", "application/x-www-form-urlencoded")
    for attempt in (1, 2):
        with _open(req) as r:
            if getattr(r, "status", 200) == 401:
                _relogin()
                url = f"{BASE}/{_token}/execute/{module}/{fn}"
                req = urllib.request.Request(url, data=data)
                req.add_header("Content-Type", "application/x-www-form-urlencoded")
                continue
            return json.loads(r.read().decode())
    raise RuntimeError(f"api_post {module}/{fn}: unauthorized after retry")


def read_file(path):
    r = api("Fileman", "get_file_content", {"path": path})
    if r.get("status") == 1:
        return r["data"].get("content") or r["data"].get("filecontent") or ""
    raise RuntimeError(f"read {path}: {r.get('errors')}")


def write_file(path, content):
    r = api_post("Fileman", "save_file_content", {
        "path": path,
        "content": content,
        "utf8": 1,
    })
    if r.get("status") == 1:
        return True
    raise RuntimeError(f"write {path}: {r.get('errors')}")


def list_dir(path):
    r = api("Fileman", "list_files", {"path": path, "show_hidden": 1})
    if r.get("status") == 1:
        return r["data"]["entries"]
    raise RuntimeError(f"list {path}: {r.get('errors')}")


def main():
    cmd = sys.argv[1] if len(sys.argv) > 1 else "help"
    login()

    if cmd == "ls":
        path = sys.argv[2] if len(sys.argv) > 2 else WEBROOT
        for e in list_dir(path):
            kind = "d" if e["filetype"][0] == "dir" else "-"
            size = e.get("size", 0) or 0
            print(f"{kind} {size:>10} {e['file']}")
    elif cmd == "cat":
        path = sys.argv[2]
        sys.stdout.write(read_file(path))
    elif cmd == "put":
        local, remote = sys.argv[2], sys.argv[3]
        with open(local, "r", encoding="utf-8") as f:
            content = f.read()
        write_file(remote, content)
        print(f"[put] {local} -> {remote} ({len(content)} bytes)")
    elif cmd == "backup":
        remote, local = sys.argv[2], sys.argv[3]
        content = read_file(remote)
        os.makedirs(os.path.dirname(local) or ".", exist_ok=True)
        with open(local, "w", encoding="utf-8") as f:
            f.write(content)
        print(f"[backup] {remote} -> {local} ({len(content)} bytes)")
    else:
        print("usage: cpanel_deploy.py ls|cat|put|backup ...")


if __name__ == "__main__":
    main()
