#!/bin/bash
# Custom boot flow for the OSSZ project (executed by /start.sh at sandbox boot,
# preferred over the generic bun+mini-services flow).
#
# Why this exists: the generic flow clobbers .env with a file: DATABASE_URL and
# then dies at `bun run db:push` under set -e, so `next dev` never starts and
# the preview panel stays stuck after every sandbox reboot. This script brings
# up the full stack deterministically instead.
#
# Steps:
#   1. Restore the correct PostgreSQL DATABASE_URL in .env.
#   2. Ensure the embedded PGlite wire-protocol service is listening on
#      127.0.0.1:5432 (probe, spawn if missing, wait until ready).
#   3. Start the Next.js dev server (its own predev hook re-checks PGlite).
#
# The app self-initialises its schema and seed data on first connection, so
# no migration step is needed here.

set -u

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$PROJECT_DIR"

GOOD_URL="postgresql://postgres:postgres@127.0.0.1:5432/app_db"

# --- 1. .env guard: boot scripts may have clobbered DATABASE_URL -------------
if [ ! -f .env ] || ! grep -q "postgresql://postgres:postgres@127.0.0.1:5432/app_db" .env; then
  echo "[ossz-boot] fixing DATABASE_URL in .env"
  {
    echo "DATABASE_URL=$GOOD_URL"
    grep -v '^DATABASE_URL=' .env 2>/dev/null || true
  } > .env.tmp && mv .env.tmp .env
fi

# --- 2. Ensure PGlite is up ---------------------------------------------------
pg_probe() {
  (exec 3<>/dev/tcp/127.0.0.1/5432) 2>/dev/null
}

if ! pg_probe; then
  echo "[ossz-boot] PostgreSQL not reachable — starting embedded PGlite service"
  mkdir -p db/pglite-data
  setsid nohup node mini-services/pglite-postgres/index.mjs \
    > /tmp/pglite-boot.log 2>&1 < /dev/null &
fi

for i in $(seq 1 120); do
  if pg_probe; then
    echo "[ossz-boot] PostgreSQL ready on 127.0.0.1:5432 (after ${i}s)"
    break
  fi
  sleep 1
done

if ! pg_probe; then
  echo "[ossz-boot] WARNING: PostgreSQL still not reachable; starting dev server anyway"
fi

# --- 3. Start the dev server -------------------------------------------------
echo "[ossz-boot] starting next dev on port 3000"
exec bun run dev
