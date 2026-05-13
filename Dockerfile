FROM wordpress:6.5-php8.2-apache

# Install WP-CLI + mysql client for DB readiness checks
RUN curl -sS -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x /usr/local/bin/wp \
    && apt-get update \
    && apt-get install -y --no-install-recommends default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Copy theme into WordPress themes directory
COPY --chown=www-data:www-data . /var/www/html/wp-content/themes/novanox-wt/

# Remove files that don't belong in a theme directory
RUN rm -rf /var/www/html/wp-content/themes/novanox-wt/node_modules \
           /var/www/html/wp-content/themes/novanox-wt/package.json \
           /var/www/html/wp-content/themes/novanox-wt/package-lock.json \
           /var/www/html/wp-content/themes/novanox-wt/Dockerfile \
           /var/www/html/wp-content/themes/novanox-wt/docker-entrypoint-wrapper.sh \
           /var/www/html/wp-content/themes/novanox-wt/docker-setup.sh \
           /var/www/html/wp-content/themes/novanox-wt/railway.toml \
           /var/www/html/wp-content/themes/novanox-wt/.dockerignore \
           /var/www/html/wp-content/themes/novanox-wt/.git \
           /var/www/html/wp-content/themes/novanox-wt/.claude

COPY docker-entrypoint-wrapper.sh /usr/local/bin/docker-entrypoint-wrapper.sh
COPY docker-setup.sh /usr/local/bin/docker-setup.sh
RUN chmod +x /usr/local/bin/docker-entrypoint-wrapper.sh \
             /usr/local/bin/docker-setup.sh

ENTRYPOINT ["docker-entrypoint-wrapper.sh"]
CMD ["docker-setup.sh"]
