$projectPath = "/mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova"

wsl.exe -d Ubuntu-24.04 -e bash -lc "cd $projectPath && php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=8000"
