#!/bin/bash
set -e

WP="/var/www/html"
SITE_URL="${WORDPRESS_URL:-http://localhost}"
SITE_TITLE="${WP_TITLE:-Novanox Demo}"
ADMIN_USER="${WP_ADMIN_USER:-admin}"
ADMIN_PASS="${WP_ADMIN_PASSWORD:-NovanoxDemo2024!}"
ADMIN_EMAIL="${WP_ADMIN_EMAIL:-admin@example.com}"

echo "[novanox] Starting Apache..."
apache2-foreground &
APACHE_PID=$!

echo "[novanox] Waiting for database connection..."
until wp --allow-root --path="$WP" db check 2>/dev/null; do
    sleep 3
done
echo "[novanox] Database ready."

if ! wp --allow-root --path="$WP" core is-installed 2>/dev/null; then
    echo "[novanox] Installing WordPress..."
    wp --allow-root --path="$WP" core install \
        --url="$SITE_URL" \
        --title="$SITE_TITLE" \
        --admin_user="$ADMIN_USER" \
        --admin_password="$ADMIN_PASS" \
        --admin_email="$ADMIN_EMAIL" \
        --skip-email
    echo "[novanox] WordPress installed."

    # Set permalink structure to /%postname%/ for pretty URLs
    wp --allow-root --path="$WP" option update permalink_structure '/%postname%/'
    wp --allow-root --path="$WP" rewrite flush
fi

echo "[novanox] Activating theme..."
wp --allow-root --path="$WP" theme activate novanox-wt
echo "[novanox] Theme active. Site is live at $SITE_URL"

wait $APACHE_PID
