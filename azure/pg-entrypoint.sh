#!/bin/sh
set -e

# Crear y asegurar que el subdirectorio PGDATA existe con permisos correctos
# Esto es necesario para que PostgreSQL funcione con Azure File Share (SMB)
mkdir -p "$PGDATA"
chmod 700 "$PGDATA" || true  # Azure File Share ignora esto pero no falla
chown -R postgres:postgres "$(dirname $PGDATA)" || true

# Ejecutar el entrypoint original de PostgreSQL
exec docker-entrypoint.sh "$@"
