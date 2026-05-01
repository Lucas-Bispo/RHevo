#!/usr/bin/env bash
set -euo pipefail

# --- Configuracao ---
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SCRIPT_PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
NATIVE_PROJECT_DIR="$HOME/RHevo/backend/FolhaNova"
PROJECT_DIR="${1:-$NATIVE_PROJECT_DIR}"
BACKEND_PORT="${BACKEND_PORT:-8000}"
VITE_PORT="${VITE_PORT:-5173}"
LOG_DIR="storage/logs"
BACKEND_LOG="${LOG_DIR}/dev-server.log"
BACKEND_PID_FILE="${LOG_DIR}/dev-server.pid"
VITE_LOG="${LOG_DIR}/vite-dev.log"
VITE_PID_FILE="${LOG_DIR}/vite-dev.pid"

listener_pid() {
    lsof -iTCP:"$1" -sTCP:LISTEN 2>/dev/null | awk 'NR > 1 {print $2; exit}' || true
}

# --- Validacoes iniciais ---
if [[ ! -d "$PROJECT_DIR" ]]; then
    echo "Projeto nativo nao encontrado em: $PROJECT_DIR"
    echo "Usando projeto do diretorio do script: $SCRIPT_PROJECT_DIR"
    PROJECT_DIR="$SCRIPT_PROJECT_DIR"
fi

cd "$PROJECT_DIR"

if [[ ! -f "artisan" ]]; then
    echo "ERRO: Arquivo 'artisan' nao encontrado em: $PROJECT_DIR" >&2
    exit 1
fi

mkdir -p "$LOG_DIR"

case "$PROJECT_DIR" in
    /mnt/*)
        echo "AVISO: o projeto esta rodando em $PROJECT_DIR"
        echo "Para melhor desempenho, mantenha uma copia em $NATIVE_PROJECT_DIR"
        ;;
esac

# --- Limpeza e preparacao ---
echo "[1/7] Encerrando instancias anteriores nas portas ${BACKEND_PORT} e ${VITE_PORT}..."
fuser -k "${BACKEND_PORT}/tcp" >/dev/null 2>&1 || true
fuser -k "${VITE_PORT}/tcp" >/dev/null 2>&1 || true
rm -f "$BACKEND_PID_FILE" "$VITE_PID_FILE"

echo "[2/7] Limpando cache da aplicacao..."
php artisan optimize:clear >/dev/null

echo "[3/7] Garantindo usuario local de teste..."
php scripts/ensure_local_login.php

echo "[4/7] Validando dependencias minimas..."
php -v | head -n 1
node -v
npm -v

# --- Inicializacao dos servicos ---
echo "[5/7] Subindo backend Laravel em background..."
rm -f "$BACKEND_LOG"
setsid php artisan serve --host=0.0.0.0 --port="${BACKEND_PORT}" > "$BACKEND_LOG" 2>&1 < /dev/null &
echo $! > "$BACKEND_PID_FILE"

echo "Aguardando backend responder em http://127.0.0.1:${BACKEND_PORT}..."
if ! timeout 60s bash -c "until curl -s --head http://127.0.0.1:${BACKEND_PORT}/login | grep '200 OK' > /dev/null; do sleep 1; done"; then
    echo "ERRO: Backend Laravel nao iniciou a tempo. Verifique o log: ${BACKEND_LOG}" >&2
    exit 1
fi
BACKEND_LISTENER_PID="$(listener_pid "$BACKEND_PORT")"
if [[ -n "$BACKEND_LISTENER_PID" ]]; then
    echo "$BACKEND_LISTENER_PID" > "$BACKEND_PID_FILE"
fi
echo "Backend OK."

echo "[6/7] Subindo Vite em background..."
rm -f "$VITE_LOG"
setsid npm run dev -- --host 0.0.0.0 --port="${VITE_PORT}" > "$VITE_LOG" 2>&1 < /dev/null &
echo $! > "$VITE_PID_FILE"

echo "Aguardando Vite responder em http://127.0.0.1:${VITE_PORT}..."
if ! timeout 60s bash -c "until curl -s --head http://127.0.0.1:${VITE_PORT}/resources/js/app.js | grep '200 OK' > /dev/null; do sleep 1; done"; then
    echo "ERRO: Vite nao iniciou a tempo. Verifique o log: ${VITE_LOG}" >&2
    exit 1
fi
VITE_LISTENER_PID="$(listener_pid "$VITE_PORT")"
if [[ -n "$VITE_LISTENER_PID" ]]; then
    echo "$VITE_LISTENER_PID" > "$VITE_PID_FILE"
fi
echo "Vite OK."

echo "[7/7] Verificacao final..."
curl -Is "http://127.0.0.1:${BACKEND_PORT}/login" | head -n 1

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

Para parar os servicos, execute:
./scripts/stop_native_wsl.sh
EOF
