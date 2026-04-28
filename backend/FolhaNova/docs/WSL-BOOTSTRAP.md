# Bootstrap WSL Nativo

Use este fluxo quando for testar a aplicacao na copia Linux em `~/RHevo/backend/FolhaNova`.

## Comando unico

```bash
cd ~/RHevo/backend/FolhaNova
bash scripts/bootstrap_native_wsl.sh
```

## Regra de desempenho

O caminho preferencial para executar a aplicacao e `~/RHevo/backend/FolhaNova`, dentro do filesystem nativo do WSL.

Evite rodar a aplicacao a partir de `/mnt/c/...` para validacoes de performance. O Laravel, Composer, Vite, SQLite, sessoes, cache, views compiladas e `node_modules` fazem muitas leituras e escritas pequenas; esse padrao fica muito mais lento no mount do Windows.

Em `28/04/2026`, a comparacao local mostrou:

- `/mnt/c/.../RHevo/backend/FolhaNova`: `php artisan about` entre `8s` e `11s`, `/login` variando acima de `1s` e com picos maiores;
- `~/RHevo/backend/FolhaNova`: `php artisan about` em `0.58s`, `/login` em aproximadamente `0.03s`, `/` seguindo redirect em aproximadamente `0.045s`.

Se a copia nativa ainda nao existir, copie o projeto para o WSL e ajuste o `.env` da copia nativa para apontar o SQLite para:

```env
DB_DATABASE=/home/predador/RHevo/backend/FolhaNova/database/database.sqlite
LANDLORD_DB_DATABASE=/home/predador/RHevo/backend/FolhaNova/database/database.sqlite
```

## O que o script faz

- limpa cache da aplicacao;
- garante a conta local `test@example.com`;
- encerra processos antigos nas portas `8000` e `5173`;
- sobe o backend Laravel;
- sobe o Vite;
- informa logs e URLs para validacao manual.

## Credenciais locais

- email: `test@example.com`
- senha: `password`

## Logs

- `storage/logs/dev-server.log`
- `storage/logs/vite-dev.log`
