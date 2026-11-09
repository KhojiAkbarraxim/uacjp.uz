#!/bin/bash
# Manual deploy for uacjp.uz, run ON THE SERVER over SSH.
#
# The automated path is .github/workflows/deploy.yml, which builds assets on
# GitHub and uploads them. Use this script when deploying by hand, or to
# finish an FTP deploy (migrations and caches, which FTP cannot do).
#
# Usage: ./deploy.sh

set -euo pipefail

APP_DIR="${APP_DIR:-/home/uacjpuz/laravel_app}"
PHP_BIN="${PHP_BIN:-php}"
BRANCH="${BRANCH:-main}"

echo "==> Deploying ${BRANCH} into ${APP_DIR}"
cd "$APP_DIR"

echo "==> Pulling latest code"
git pull origin "$BRANCH"

echo "==> Installing PHP dependencies"
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> Running migrations"
"$PHP_BIN" artisan migrate --force

# public/build is gitignored, so git pull never updates CSS/JS. Either the
# GitHub Actions deploy uploaded them, or they must be built here. A missing
# manifest means every page would break on Blade's @vite directive, so this
# must fail loudly instead of being skipped.
echo "==> Checking frontend assets"
if [ -f public/build/manifest.json ]; then
    echo "    manifest.json present, assets already deployed"
elif command -v npm >/dev/null 2>&1; then
    echo "    building assets locally"
    npm ci --omit=dev || npm install
    npm run build
else
    echo "!!! public/build/manifest.json is missing and npm is not available here."
    echo "!!! The site cannot render without it. Let the GitHub Actions deploy"
    echo "!!! upload public/build, or build it on your machine and copy it over."
    exit 1
fi

echo "==> Refreshing caches"
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan config:cache
"$PHP_BIN" artisan route:cache
"$PHP_BIN" artisan view:cache

echo "==> Done"
