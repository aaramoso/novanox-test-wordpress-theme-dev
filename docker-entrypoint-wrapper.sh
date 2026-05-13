#!/bin/bash
set -e

# Map Railway MySQL plugin env vars → WordPress env vars
[ -n "$MYSQLHOST" ]     && export WORDPRESS_DB_HOST="${MYSQLHOST}:${MYSQLPORT:-3306}"
[ -n "$MYSQLUSER" ]     && export WORDPRESS_DB_USER="$MYSQLUSER"
[ -n "$MYSQLPASSWORD" ] && export WORDPRESS_DB_PASSWORD="$MYSQLPASSWORD"
[ -n "$MYSQLDATABASE" ] && export WORDPRESS_DB_NAME="$MYSQLDATABASE"

# Fallback: parse DATABASE_URL (mysql://user:pass@host:port/db)
if [ -z "$WORDPRESS_DB_HOST" ] && [ -n "$DATABASE_URL" ]; then
    export WORDPRESS_DB_HOST=$(echo "$DATABASE_URL" | sed -E 's|mysql://[^:]+:[^@]+@([^/:]+):([0-9]+)/.*|\1:\2|')
    export WORDPRESS_DB_USER=$(echo "$DATABASE_URL" | sed -E 's|mysql://([^:]+):.*|\1|')
    export WORDPRESS_DB_PASSWORD=$(echo "$DATABASE_URL" | sed -E 's|mysql://[^:]+:([^@]+)@.*|\1|')
    export WORDPRESS_DB_NAME=$(echo "$DATABASE_URL" | sed -E 's|.*/([^?]+).*|\1|')
fi

exec /usr/local/bin/docker-entrypoint.sh "$@"
