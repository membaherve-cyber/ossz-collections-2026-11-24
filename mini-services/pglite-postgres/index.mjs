/**
 * OSSZ Collections — embedded PostgreSQL server.
 *
 * The upstream repository targets a standard PostgreSQL server over the
 * wire protocol (Drizzle ORM `pg-core` schema, `node-postgres` Pool,
 * bootstrap + seed scripts that connect with `pg`).
 *
 * This sandbox has no system PostgreSQL, so we run PGlite — a genuine
 * PostgreSQL compiled to WASM — behind `@electric-sql/pglite-socket`,
 * which speaks the real Postgres wire protocol on 127.0.0.1:5432.
 *
 * Result: the application's database layer is byte-for-byte identical to
 * the upstream repository (no source changes), while data persists on disk
 * in ../../db/pglite-data across restarts.
 *
 * Note: intentionally NOT run with `bun --hot` — hot module reload would
 * re-open the PGlite data directory while the previous instance still
 * holds its lock. A stateful database service must stay single-instance.
 */
import { PGlite } from "@electric-sql/pglite";
import { PGLiteSocketServer } from "@electric-sql/pglite-socket";
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const here = path.dirname(fileURLToPath(import.meta.url));
const dataDir = path.resolve(here, "../../db/pglite-data");

// Self-heal: PGlite's nodefs mkdirs the data dir non-recursively, so the
// parent (../../db) must already exist. Environment restores can wipe the
// ignored /db folder entirely — recreate it (and any lost empty dirs) here.
fs.mkdirSync(dataDir, { recursive: true });

const db = new PGlite(dataDir);

const server = new PGLiteSocketServer({
  db,
  port: Number(process.env.PGLITE_PORT ?? 5432),
  host: "127.0.0.1",
  maxConnections: 24,
});

await server.start();
console.log(`[pglite-postgres] PostgreSQL 18 (PGlite) ready on 127.0.0.1:5432`);
console.log(`[pglite-postgres] data dir: ${dataDir}`);
console.log(`[pglite-postgres] connect with: postgresql://postgres:postgres@127.0.0.1:5432/app_db`);
