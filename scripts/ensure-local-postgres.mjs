/**
 * Sandbox helper: make sure a PostgreSQL server is reachable on 127.0.0.1:5432
 * before `next dev` starts.
 *
 * The repository targets a standard PostgreSQL server (DATABASE_URL). In this
 * sandbox the server is the embedded PGlite wire-protocol service in
 * mini-services/pglite-postgres. If it is already running (or a real
 * PostgreSQL is listening on 5432) this script is a no-op, so the upstream
 * development flow is untouched everywhere else.
 */
import net from "node:net";
import { spawn } from "node:child_process";
import fs from "node:fs";
import path from "node:path";

const PORT = Number(process.env.PGLITE_PORT ?? 5432);

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

if (await probe(PORT)) process.exit(0);

const serviceDir = path.join(process.cwd(), "mini-services", "pglite-postgres");
if (!fs.existsSync(path.join(serviceDir, "index.mjs"))) {
  // Not the sandbox layout (no embedded service present) — nothing to start.
  process.exit(0);
}

console.log("[ossz] PostgreSQL not reachable on 127.0.0.1:5432 — starting embedded PGlite service");

// First boot compiles the WASM postgres and initializes the data directory,
// which can take well over 15s — give it a generous window.
fs.mkdirSync(path.join(process.cwd(), "db", "pglite-data"), { recursive: true });

const child = spawn(process.execPath, ["index.mjs"], {
  cwd: serviceDir,
  detached: true,
  stdio: "ignore",
});
child.unref();

for (let i = 0; i < 480; i++) {
  if (await probe(PORT)) {
    console.log("[ossz] PostgreSQL ready on 127.0.0.1:5432");
    process.exit(0);
  }
  await new Promise((resolve) => setTimeout(resolve, 250));
}
console.warn("[ossz] embedded PostgreSQL did not become ready in time (continuing anyway)");
