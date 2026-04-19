#!/usr/bin/env bash
set -euo pipefail

cd /mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova
mkdir -p storage/logs
rm -f storage/logs/dev-server.log storage/logs/dev-server.pid
setsid php artisan serve --host=0.0.0.0 --port=8000 > storage/logs/dev-server.log 2>&1 < /dev/null &
echo $! > storage/logs/dev-server.pid
