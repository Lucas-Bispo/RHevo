$scriptRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$projectWindowsPath = Resolve-Path (Join-Path $scriptRoot "..")
$projectPath = (& wsl.exe -d Ubuntu-24.04 -e wslpath -a $projectWindowsPath.Path).Trim()

wsl.exe -d Ubuntu-24.04 -e bash -lc "cd $projectPath && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=8000"
