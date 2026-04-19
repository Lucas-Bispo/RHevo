# FolhaNova · Como rodar no WSL Ubuntu

> Guia pratico para subir o projeto localmente no WSL e repetir o processo sempre que precisar.

## Objetivo

Executar o backend Laravel e o frontend Vite do projeto `FolhaNova` no `WSL Ubuntu`, mesmo com o repositorio armazenado no Windows.

## Caminho atual do projeto

Neste repositorio, a aplicacao esta em:

```bash
/mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova
```

## Resumo rapido

Quando quiser apenas colocar o projeto para rodar:

```powershell
wsl -d Ubuntu-24.04
```

```bash
cd /mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova
composer install
npm install
php artisan optimize:clear
php artisan migrate
```

Terminal 1:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Terminal 2:

```bash
npm run dev -- --host 0.0.0.0
```

Abrir no Windows:

```text
http://127.0.0.1:8000
```

Se nao estiver autenticado, acesse:

```text
http://127.0.0.1:8000/login
```

Se preferir subir tudo pelo Windows sem digitar os comandos manualmente:

```powershell
powershell -ExecutionPolicy Bypass -File C:\Users\lukao\OneDrive\Documents\RHevo\backend\FolhaNova\scripts\start-local-wsl.ps1
```

Esse script abre duas janelas novas:

- Laravel em `http://127.0.0.1:8000`
- Vite para assets do frontend

## Pre-requisitos no Ubuntu

Confirme que o WSL possui:

- `git`
- `php` 8.2 ou superior
- `composer`
- `node` 20 ou superior
- `npm`
- extensoes PHP `mbstring`, `xml`, `curl`, `sqlite3`, `intl`, `zip`, `gd`, `soap`

## 1. Abrir o Ubuntu no WSL

No Windows:

```powershell
wsl -d Ubuntu-24.04
```

Se precisar descobrir o nome da distro:

```powershell
wsl -l -v
```

## 2. Entrar na pasta da aplicacao

Dentro do Ubuntu:

```bash
cd /mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova
```

## 3. Validar versoes

```bash
php -v
composer --version
node -v
npm -v
```

Se algum comando falhar, instale as dependencias antes de continuar.

## 4. Instalar dependencias do projeto

```bash
composer install
npm install
```

## 5. Configurar o ambiente Laravel

Se o arquivo `.env` ainda nao existir:

```bash
cp .env.example .env
php artisan key:generate
```

## 6. Configuracao recomendada para rodar localmente

O projeto ja possui `database/database.sqlite`. Para desenvolvimento local, SQLite e o caminho mais simples e previsivel.

No `.env`, ajuste pelo menos estes valores:

```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=/mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Se o arquivo SQLite ainda nao existir:

```bash
touch database/database.sqlite
```

## 7. Limpar cache antes de subir

Sempre que trocar `.env`, dependencias ou configuracao:

```bash
php artisan optimize:clear
```

## 8. Rodar migrations

```bash
php artisan migrate
```

Se quiser recriar tudo do zero:

```bash
php artisan migrate:fresh --seed
```

## 9. Subir o backend Laravel

Em um terminal do WSL:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Isso permite acessar no Windows em:

```text
http://127.0.0.1:8000
```

## 10. Subir o frontend com Vite

Em outro terminal, na mesma pasta:

```bash
npm run dev -- --host 0.0.0.0
```

Se quiser fixar uma porta:

```bash
npm run dev -- --host 0.0.0.0 --port 5173
```

## 11. Opcao com um comando so

O projeto possui um script Composer para desenvolvimento:

```bash
composer run dev
```

Esse comando sobe:

- servidor Laravel
- fila
- logs com `pail`
- Vite

Use essa opcao quando quiser tudo junto em um unico terminal.

## 12. Validar que funcionou

Checklist rapido:

- `php artisan serve` iniciou sem erro
- `npm run dev -- --host 0.0.0.0` iniciou sem erro
- `http://127.0.0.1:8000` abriu no navegador
- CSS e JavaScript carregaram normalmente
- se `/` redirecionar para `/dashboard`, use `/login` para entrar primeiro

## Credenciais locais

Se voce rodar:

```bash
php artisan db:seed
```

o projeto cria o usuario padrao:

```text
email: test@example.com
senha: password
```

## Fluxo recomendado no dia a dia

Sempre que precisar voltar ao projeto:

1. abrir o WSL
2. entrar na pasta da aplicacao
3. rodar `composer install` se houver mudancas de backend
4. rodar `npm install` se houver mudancas de frontend
5. rodar `php artisan optimize:clear`
6. rodar `php artisan migrate`
7. subir Laravel
8. subir Vite
9. abrir `http://127.0.0.1:8000`

## Comandos uteis

```bash
php artisan optimize:clear
php artisan migrate
php artisan test
./vendor/bin/pint
./vendor/bin/phpstan analyse
npm run dev -- --host 0.0.0.0
npm run build
composer run dev
```

## Problemas comuns

### `composer: command not found`

Instale o Composer no Ubuntu e valide:

```bash
composer --version
```

### `php: command not found`

Instale PHP no Ubuntu com as extensoes exigidas pelo projeto.

### erro de extensao PHP ausente

As mais provaveis neste projeto sao:

- `sqlite3`
- `soap`
- `xml`
- `mbstring`
- `curl`
- `intl`
- `zip`
- `gd`

### erro ao conectar no banco

Confira se o `.env` esta realmente apontando para:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova/database/database.sqlite
```

Depois rode:

```bash
php artisan optimize:clear
php artisan migrate
```

### Vite nao carrega no navegador

Suba o Vite com host explicito:

```bash
npm run dev -- --host 0.0.0.0
```

Se ainda falhar, force a porta:

```bash
npm run dev -- --host 0.0.0.0 --port 5173
```

### a pagina abre, mas redireciona para dashboard

Isso e esperado. A rota `/` redireciona para `/dashboard`, e o dashboard exige autenticacao.

Entre por:

```text
http://127.0.0.1:8000/login
```

## Observacao importante

O projeto esta dentro do `OneDrive`. Isso funciona, mas pode causar lentidao ou sincronizacao ruim em `vendor`, `node_modules` e arquivos temporarios.

Se o ambiente ficar instavel no futuro, considere mover a aplicacao para um caminho interno do Linux, por exemplo:

```bash
~/projects/FolhaNova
```

Nao e obrigatorio para comecar, mas costuma deixar o ambiente mais estavel e mais rapido.
