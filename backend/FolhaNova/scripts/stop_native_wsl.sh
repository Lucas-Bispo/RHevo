#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SCRIPT_PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
NATIVE_PROJECT_DIR="$HOME/RHevo/backend/FolhaNova"
PROJECT_DIR="${1:-$NATIVE_PROJECT_DIR}"
LOG_DIR="storage/logs"
BACKEND_PID_FILE="${LOG_DIR}/dev-server.pid"
VITE_PID_FILE="${LOG_DIR}/vite-dev.pid"

if [[ ! -d "$PROJECT_DIR" ]]; then
    PROJECT_DIR="$SCRIPT_PROJECT_DIR"
fi

cd "$PROJECT_DIR"

if [[ -f "$BACKEND_PID_FILE" ]]; then
    PID=$(cat "$BACKEND_PID_FILE")
    echo "Encerrando backend Laravel (PID: $PID)..."
    kill "$PID" 2>/dev/null || true
    rm -f "$BACKEND_PID_FILE"
fi

if [[ -f "$VITE_PID_FILE" ]]; then
    PID=$(cat "$VITE_PID_FILE")
    echo "Encerrando Vite (PID: $PID)..."
    kill "$PID" 2>/dev/null || true
    rm -f "$VITE_PID_FILE"
fi

echo "Servicos de desenvolvimento encerrados."
