#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SCRIPT_PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
NATIVE_PROJECT_DIR="$HOME/RHevo/backend/FolhaNova"
PROJECT_DIR="${1:-$NATIVE_PROJECT_DIR}"
LOG_DIR="storage/logs"
BACKEND_PID_FILE="${LOG_DIR}/dev-server.pid"
VITE_PID_FILE="${LOG_DIR}/vite-dev.pid"
BACKEND_PORT="${BACKEND_PORT:-8000}"
VITE_PORT="${VITE_PORT:-5173}"

stop_pid_file() {
    local label="$1"
    local pid_file="$2"

    if [[ -f "$pid_file" ]]; then
        local pid
        pid=$(cat "$pid_file")
        echo "Encerrando ${label} (PID: ${pid})..."
        kill "$pid" 2>/dev/null || true
        rm -f "$pid_file"
    fi
}

stop_port() {
    local label="$1"
    local port="$2"
    local pids

    pids=$(lsof -iTCP:"${port}" -sTCP:LISTEN 2>/dev/null | awk 'NR > 1 {print $2}' || true)
    if [[ -n "$pids" ]]; then
        echo "Liberando porta ${port} (${label})..."
        kill $pids 2>/dev/null || true
        return
    fi

    if fuser "${port}/tcp" >/dev/null 2>&1; then
        echo "Liberando porta ${port} (${label})..."
        fuser -k "${port}/tcp" >/dev/null 2>&1 || true
    fi
}

if [[ ! -d "$PROJECT_DIR" ]]; then
    PROJECT_DIR="$SCRIPT_PROJECT_DIR"
fi

cd "$PROJECT_DIR"

stop_pid_file "backend Laravel" "$BACKEND_PID_FILE"
stop_pid_file "Vite" "$VITE_PID_FILE"
stop_port "backend Laravel" "$BACKEND_PORT"
stop_port "Vite" "$VITE_PORT"

echo "Servicos de desenvolvimento encerrados."
