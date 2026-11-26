/**
 * Sandbox helper: start `next dev` as a fully detached daemon so it survives
 * the current shell session (same pattern as ensure-local-postgres.mjs).
 *
 * - If something is already serving on the dev port, this is a no-op.
 * - Logs are appended to dev.log.
 */
import net from "node:net";
import { spawn } from "node:child_process";
import fs from "node:fs";
import path from "node:path";

const PORT = Number(process.env.DEV_PORT ?? 3000);
const ROOT = process.cwd();
const LOG = path.join(ROOT, "dev.log");

function probe(port) {
  return new Promise((resolve) => {
    const socket = net.connect({ port, host: "127.0.0.1", timeout: 800 });
    socket.once("connect", () => {
      socket.destroy();
      resolve(true);
    });
    socket.once("error", () => resolve(false));
    socket.once("timeout", () => {
      socket.destroy();
      resolve(false);
    });
  });
}

if (await probe(PORT)) {
  console.log(`[ossz] dev server already serving on 127.0.0.1:${PORT}`);
  process.exit(0);
}

const nextBin = path.join(ROOT, "node_modules", "next", "dist", "bin", "next");
if (!fs.existsSync(nextBin)) {
  console.error("[ossz] next binary not found — run `bun install` first");
  process.exit(1);
}

const logFd = fs.openSync(LOG, "a");
const child = spawn(process.execPath, [nextBin, "dev"], {
  cwd: ROOT,
  detached: true,
  stdio: ["ignore", logFd, logFd],
});
child.unref();

for (let i = 0; i < 240; i++) {
  if (await probe(PORT)) {
    console.log(`[ossz] next dev ready on 127.0.0.1:${PORT} (pid ${child.pid})`);
    process.exit(0);
  }
  await new Promise((resolve) => setTimeout(resolve, 250));
}
console.warn("[ossz] next dev did not become ready in time (continuing anyway)");
