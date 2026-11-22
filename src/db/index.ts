import { drizzle } from "drizzle-orm/node-postgres";
import { Pool } from "pg";

/**
 * Sandbox guard.
 *
 * The hosting container exports a placeholder DATABASE_URL pointing at a
 * removed SQLite file (`file:…/db/custom.db`). That string is not a valid
 * PostgreSQL connection string and must never reach the pool. When we see it
 * (or nothing at all) we fall back to the local PostgreSQL service — the same
 * default drizzle.config.ts already uses.
 */
function resolveDatabaseUrl(): string {
  const url = process.env.DATABASE_URL;
  if (!url || url.startsWith("file:")) {
    return "postgresql://postgres:postgres@127.0.0.1:5432/app_db";
  }
  return url;
}

const databaseUrl = resolveDatabaseUrl();

/**
 * Managed Postgres providers (Neon, Supabase, Vercel Postgres) require TLS,
 * while the local sandbox database does not. We enable SSL automatically for
 * any non-local host, and accept their certificate chain — these providers
 * terminate TLS with certs that Node does not bundle by default.
 *
 * Set DATABASE_SSL="disable" to force it off (e.g. a self-hosted DB on a
 * private network), or "require" to force it on.
 */
function sslConfig() {
  const mode = process.env.DATABASE_SSL;
  if (mode === "disable") return false;
  if (mode === "require") return { rejectUnauthorized: false };
  const isLocal = /@(localhost|127\.0\.0\.1|::1)[:/]/.test(databaseUrl ?? "");
  return isLocal ? false : { rejectUnauthorized: false };
}

const globalForDb = globalThis as typeof globalThis & {
  __arenaNextJsPostgresqlPool?: Pool;
};

export const pool =
  globalForDb.__arenaNextJsPostgresqlPool ??
  new Pool({
    connectionString: databaseUrl,
    ssl: sslConfig(),
    // Serverless platforms open many short-lived connections; a small ceiling
    // keeps us within managed-Postgres connection limits.
    max: Number(process.env.DATABASE_POOL_MAX ?? 10),
  });

if (process.env.NODE_ENV !== "production") {
  globalForDb.__arenaNextJsPostgresqlPool = pool;
}

export const db = drizzle(pool);
