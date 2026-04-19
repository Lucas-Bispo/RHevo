$scriptRoot = Split-Path -Parent $MyInvocation.MyCommand.Path
$backendScript = Join-Path $scriptRoot "run-backend-wsl.ps1"
$viteScript = Join-Path $scriptRoot "run-vite-wsl.ps1"

Start-Process -FilePath "powershell.exe" -ArgumentList @("-NoExit", "-ExecutionPolicy", "Bypass", "-File", $backendScript)
Start-Process -FilePath "powershell.exe" -ArgumentList @("-NoExit", "-ExecutionPolicy", "Bypass", "-File", $viteScript)

Write-Host "Backend e Vite iniciados em novas janelas."
Write-Host "Abra http://127.0.0.1:8000/login"
