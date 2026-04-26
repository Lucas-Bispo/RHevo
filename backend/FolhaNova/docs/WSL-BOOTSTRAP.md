# Bootstrap WSL Nativo

Use este fluxo quando for testar a aplicacao na copia Linux em `~/RHevo/backend/FolhaNova`.

## Comando unico

```bash
cd ~/RHevo/backend/FolhaNova
bash scripts/bootstrap_native_wsl.sh
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
