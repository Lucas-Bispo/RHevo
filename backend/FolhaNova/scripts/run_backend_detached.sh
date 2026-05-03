#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
mkdir -p storage/logs
rm -f storage/logs/dev-server.log storage/logs/dev-server.pid
setsid php artisan serve --host=0.0.0.0 --port=8000 > storage/logs/dev-server.log 2>&1 < /dev/null &
echo $! > storage/logs/dev-server.pid

for _ in {1..20}; do
    listener_pid="$(lsof -iTCP:8000 -sTCP:LISTEN 2>/dev/null | awk 'NR > 1 {print $2; exit}' || true)"

    if [[ -n "$listener_pid" ]]; then
        echo "$listener_pid" > storage/logs/dev-server.pid
        break
    fi

    sleep 0.5
done
