#!/usr/bin/env python3
"""Robust FTP upload for Namecheap (cPanel pure-ftpd).

Retries with both passive modes, verifies with SIZE, and can rename
(remote rename via RNFR/RNTO) after a verified upload.
"""
import ftplib
import os
import sys
import time

HOST = "198.177.120.128"
USER = "osszakze"
PASS = "nUYAJz8vCe10"


def connect(passive_mode: bool) -> ftplib.FTP:
    ftp = ftplib.FTP(host=HOST, timeout=40)
    ftp.set_pasv(passive_mode)
    ftp.login(USER, PASS)
    return ftp


def upload(local_path: str, remote_path: str, tries: int = 6) -> int:
    """Upload local file to remote_path, return remote size (raises on fail)."""
    size = os.path.getsize(local_path)
    last_err = None
    for attempt in range(tries):
        passive = (attempt % 2 == 0)
        try:
            ftp = connect(passive)
            try:
                with open(local_path, "rb") as fh:
                    cmd = f"STOR {remote_path}"
                    try:
                        ftp.storbinary(cmd, fh, blocksize=32768)
                    except ftplib.error_temp as e:
                        # Some servers drop the control reply after STOR;
                        # verify by SIZE instead of failing.
                        last_err = e
                # Verify size (fresh connection if needed)
                try:
                    rsize = ftp.size(remote_path)
                except Exception:
                    ftp.quit()
                    ftp = connect(passive)
                    rsize = ftp.size(remote_path)
                if rsize == size:
                    try:
                        ftp.quit()
                    except Exception:
                        pass
                    return rsize
                last_err = RuntimeError(f"size mismatch local={size} remote={rsize}")
            finally:
                try:
                    ftp.quit()
                except Exception:
                    try:
                        ftp.close()
                    except Exception:
                        pass
        except Exception as e:
            last_err = e
        time.sleep(1.5)
    raise RuntimeError(f"upload failed after {tries} tries: {last_err}")


def main() -> None:
    if len(sys.argv) < 3:
        print("usage: ftp_upload.py <local> <remote> [--rename <new_remote>]")
        sys.exit(2)
    local, remote = sys.argv[1], sys.argv[2]
    n = upload(local, remote)
    print(f"UPLOADED {local} -> {remote} ({n} bytes)")
    if len(sys.argv) >= 4 and sys.argv[3] == "--rename":
        new_remote = sys.argv[4]
        ftp = connect(True)
        ftp.rename(remote, new_remote)
        print(f"RENAMED {remote} -> {new_remote}")
        ftp.quit()


if __name__ == "__main__":
    main()
