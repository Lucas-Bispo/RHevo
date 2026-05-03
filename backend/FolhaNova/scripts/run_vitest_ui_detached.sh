#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
mkdir -p storage/logs
rm -f storage/logs/vitest-ui.log storage/logs/vitest-ui.pid
setsid npm run test:ui:web > storage/logs/vitest-ui.log 2>&1 < /dev/null &
echo $! > storage/logs/vitest-ui.pid
