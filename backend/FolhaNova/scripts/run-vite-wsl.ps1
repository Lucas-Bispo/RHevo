$scriptRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$projectWindowsPath = Resolve-Path (Join-Path $scriptRoot "..")
$projectPath = (& wsl.exe -d Ubuntu-24.04 -e wslpath -a $projectWindowsPath.Path).Trim()

wsl.exe -d Ubuntu-24.04 -e bash -lc "cd $projectPath && npm run dev -- --host 0.0.0.0"
