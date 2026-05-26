#!/bin/sh
set -e

# Se não houver .env local, copie de .env.docker antes de qualquer passo que precise de env
if [ ! -f .env ] && [ -f .env.docker ]; then
  cp .env.docker .env
fi

if [ ! -d "vendor" ]; then
  composer install --no-interaction --prefer-dist
fi

# Gera APP_KEY se estiver ausente ou em branco
if [ -f .env ] && ! grep -qE '^APP_KEY=.+$' .env; then
  php artisan key:generate --force || true
fi

exec php artisan serve --host=0.0.0.0 --port=8000
