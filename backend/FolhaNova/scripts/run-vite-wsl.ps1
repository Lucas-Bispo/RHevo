$projectPath = "/mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova"

wsl.exe -d Ubuntu-24.04 -e bash -lc "cd $projectPath && npm run dev -- --host 0.0.0.0"
