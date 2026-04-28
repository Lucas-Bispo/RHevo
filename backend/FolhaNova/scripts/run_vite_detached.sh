#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
mkdir -p storage/logs
rm -f storage/logs/vite-dev.log storage/logs/vite-dev.pid
setsid npm run dev -- --host 0.0.0.0 > storage/logs/vite-dev.log 2>&1 < /dev/null &
echo $! > storage/logs/vite-dev.pid
