#!/usr/bin/env python3
"""cPanel UAPI client that pins ALL requests to one keep-alive connection
(needed because this sandbox rotates egress IPs per connection and cPanel
binds sessions to the client IP)."""
import http.client, ssl, sys, json, re

HOST = "osszcollection.com"
PORT = 2083
USER = "osszakze"
PASS = "nUYAJz8vCe10"
UA = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36"

ctx = ssl._create_unverified_context()


class CpanelSession:
    def __init__(self):
        self.conn = None
        self.cookies = {}
        self.token = ""
        self._connect()

    def _connect(self):
        if self.conn is not None:
            try:
                self.conn.close()
            except Exception:
                pass
        self.conn = http.client.HTTPSConnection(HOST, PORT, context=ctx, timeout=120)

    def request(self, method, path, body=None, headers=None, retry=True):
        hdrs = {"User-Agent": UA, "Accept": "*/*", "Connection": "keep-alive"}
        if self.cookies:
            hdrs["Cookie"] = "; ".join(f"{k}={v}" for k, v in self.cookies.items())
        if headers:
            hdrs.update(headers)
        payload = None
        if body is not None:
            hdrs["Content-Type"] = "application/x-www-form-urlencoded"
            payload = body.encode()
        try:
            self.conn.request(method, path, payload, hdrs)
            resp = self.conn.getresponse()
            data = resp.read()
            status = resp.status
            raw_headers = resp.getheaders()
        except (http.client.HTTPException, ConnectionError, OSError):
            if retry:
                self._connect()
                return self.request(method, path, body, headers, retry=False)
            raise
        for hname, hval in raw_headers:
            if hname.lower() != "set-cookie":
                continue
            first = hval.split(";")[0]
            m = re.match(r"\s*([^=\s]+)=([^\s;]+)", first)
            if not m:
                continue
            name, val = m.group(1), m.group(2)
            if name in ("cprelogin", "PPA_ID", "roundcube_sessid", "roundcube_sessauth", "login_theme", "login_lang"):
                continue
            if val in ("expired", ""):
                self.cookies.pop(name, None)
                continue
            self.cookies[name] = val
        return status, data.decode("utf-8", "replace"), raw_headers

    def login(self):
        body = f"user={USER}&pass={PASS}&login_only=1"
        status, data, _ = self.request("POST", "/login", body)
        m = re.search(r"cpsess[0-9a-zA-Z]+", data)
        if m:
            self.token = m.group(0)
        if "cpsession" not in self.cookies or not self.token:
            raise RuntimeError(f"login failed: status={status} {data[:200]}")
        return self.token

    def uapi(self, module, func, params=""):
        path = f"/{self.token}/execute/{module}/{func}" + (f"?{params}" if params else "")
        status, data, _ = self.request("GET", path)
        return json.loads(data)


def main():
    s = CpanelSession()
    token = s.login()
    print(f"# login OK token={token}")
    out = {}
    for arg in sys.argv[1:]:
        module, func = arg.split(".", 1)
        params = ""
        if "?" in func:
            func, params = func.split("?", 1)
        try:
            res = s.uapi(module, func, params)
        except Exception as e:
            res = {"error": str(e)}
        out[f"{module}.{func}"] = res
        print(f"## {module}.{func} -> {json.dumps(res)[:600]}")
    with open("/home/z/my-project/.deploy/cpapi_out.json", "w") as f:
        json.dump(out, f, indent=1)


if __name__ == "__main__":
    main()

# ─── v2 additions (POST + Fileman helpers) ───────────────────────────
def uapi_post(self, module, func, params):
    """POST-based UAPI call (for large payloads like save_file_content)."""
    path = f"/{self.token}/execute/{module}/{func}"
    body = "&".join(f"{k}={urllib.parse.quote(str(v))}" for k, v in params.items())
    status, data, _ = self.request("POST", path, body)
    return json.loads(data)

def fileman_save(self, dirpath, filename, content):
    return self.uapi_post("Fileman", "save_file_content", {
        "dir": dirpath, "file": filename, "content": content, "charset": "UTF-8",
    })

def fileman_list(self, dirpath):
    return self.uapi("Fileman", "listfiles", f"dir={urllib.parse.quote(dirpath)}&show_hidden=1")

def fileman_stat(self, dirpath, files):
    q = "&".join(f"files%5B%5D={urllib.parse.quote(f)}" for f in files)
    return self.uapi("Fileman", "stat", f"dir={urllib.parse.quote(dirpath)}&{q}")

def fileman_rename(self, dirpath, fromname, toname):
    return self.uapi("Fileman", "rename", f"dir={urllib.parse.quote(dirpath)}&from={urllib.parse.quote(fromname)}&to={urllib.parse.quote(toname)}")

def fileman_mkdir(self, dirpath, path):
    return self.uapi_post("Fileman", "mkdir", {"dir": dirpath, "path": path})

def fileman_delete(self, dirpath, files):
    q = "&".join(f"files%5B%5D={urllib.parse.quote(f)}" for f in files)
    return self.uapi("Fileman", "delete", f"dir={urllib.parse.quote(dirpath)}&{q}")

CpanelSession.uapi_post = uapi_post
CpanelSession.fileman_save = fileman_save
CpanelSession.fileman_list = fileman_list
CpanelSession.fileman_stat = fileman_stat
CpanelSession.fileman_rename = fileman_rename
CpanelSession.fileman_mkdir = fileman_mkdir
CpanelSession.fileman_delete = fileman_delete

import urllib.parse  # noqa: E402
