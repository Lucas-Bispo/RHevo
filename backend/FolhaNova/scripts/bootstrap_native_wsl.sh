#!/usr/bin/env bash
set -euo pipefail

PROJECT_DIR="${1:-$HOME/RHevo/backend/FolhaNova}"
BACKEND_PORT="${BACKEND_PORT:-8000}"
VITE_PORT="${VITE_PORT:-5173}"

if [[ ! -d "$PROJECT_DIR" ]]; then
    echo "Projeto nao encontrado em: $PROJECT_DIR" >&2
    exit 1
fi

cd "$PROJECT_DIR"

if [[ ! -f artisan ]]; then
    echo "Arquivo artisan nao encontrado em: $PROJECT_DIR" >&2
    exit 1
fi

mkdir -p storage/logs

echo "[1/6] Limpando cache da aplicacao..."
php artisan optimize:clear >/dev/null

echo "[2/6] Garantindo usuario local de teste..."
php scripts/ensure_local_login.php

echo "[3/6] Validando dependencias minimas..."
php -v | head -n 1
node -v
npm -v

echo "[4/6] Encerrando instancias anteriores nas portas ${BACKEND_PORT} e ${VITE_PORT}..."
fuser -k "${BACKEND_PORT}/tcp" >/dev/null 2>&1 || true
fuser -k "${VITE_PORT}/tcp" >/dev/null 2>&1 || true

echo "[5/6] Subindo backend Laravel..."
: > storage/logs/dev-server.log
setsid -f php artisan serve --host=0.0.0.0 --port="${BACKEND_PORT}" >> storage/logs/dev-server.log 2>&1
sleep 3
curl -Is "http://127.0.0.1:${BACKEND_PORT}/login" | head -n 1

echo "[6/6] Subindo Vite..."
: > storage/logs/vite-dev.log
setsid -f npm run dev -- --host=0.0.0.0 --port="${VITE_PORT}" >> storage/logs/vite-dev.log 2>&1
sleep 4
curl -Is "http://127.0.0.1:${VITE_PORT}/" | head -n 1 || true

cat <<EOF

Bootstrap concluido.

Projeto: $PROJECT_DIR
Login:   http://127.0.0.1:${BACKEND_PORT}/login
Vite:    http://127.0.0.1:${VITE_PORT}

Credenciais locais:
- email: test@example.com
- senha: password

Logs:
- backend: $PROJECT_DIR/storage/logs/dev-server.log
- vite:    $PROJECT_DIR/storage/logs/vite-dev.log
EOF
