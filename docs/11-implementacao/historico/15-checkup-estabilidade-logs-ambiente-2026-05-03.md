# 15 - Checkup de estabilidade, logs e ambiente local - 03/05/2026

## Acao realizada

- Revisar documentacao principal, fluxo de trabalho, backlog, linha do tempo, arquitetura, seguranca, produto e eSocial.
- Confirmar comandos reais de backend, frontend, banco e testes.
- Validar migrations, rotas, dependencias, Vite, Vitest, auditorias e suite PHP.
- Corrigir mascaramento de logs para funcionar no canal real do Laravel/Monolog.
- Adicionar teste automatizado para redacao de dados sensiveis em log.
- Ajustar script local do backend para armazenar o PID listener real da porta 8000.
- Recarregar massa demo e deixar backend, Vite e Vitest UI no ar.

## Arquivos criados / alterados

- `backend/FolhaNova/app/Logging/RedactSensitiveData.php`
- `backend/FolhaNova/tests/Feature/LoggingRedactionTest.php`
- `backend/FolhaNova/scripts/run_backend_detached.sh`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/10-tarefas-backlog/historico/15-checkup-estabilidade-logs-ambiente-2026-05-03.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- `docs/11-implementacao/historico/15-checkup-estabilidade-logs-ambiente-2026-05-03.md`

## Validacao

- `composer install`: dependencias PHP ja instaladas.
- `npm install`: dependencias JS ja instaladas, 0 vulnerabilidades.
- `php artisan about --only=environment`: FolhaNova local, Laravel 11.51.0, PHP 8.3.6, `pt_BR`, `America/Sao_Paulo`.
- `php artisan migrate:status`: todas as migrations aplicadas.
- `php artisan migrate`: nada pendente.
- `php artisan route:list --except-vendor`: 38 rotas da aplicacao listadas.
- `npm run test:ui:run`: 1 arquivo, 2 testes passaram.
- `npm run build`: build Vite concluido.
- `npm audit --audit-level=high`: 0 vulnerabilidades.
- `composer audit`: sem advisories.
- `php artisan test`: 160 testes passaram apos a correcao de log.
- `php artisan test tests/Unit/RedactSensitiveDataTest.php tests/Feature/LoggingRedactionTest.php`: 2 testes passaram apos a correcao.
- `php scripts/ensure_local_login.php`: usuario local garantido.
- `php artisan db:seed --class=DemoDataSeeder --force`: massa demo recarregada.
- `curl -Is http://127.0.0.1:8000/login`: HTTP 200.
- `curl -Is http://127.0.0.1:5173/resources/js/app.js`: HTTP 200.
- `curl -Is http://127.0.0.1:51204/__vitest__/`: HTTP 200.

## Estado do ambiente local

- Aplicacao: `http://127.0.0.1:8000/login`
- Vite: `http://127.0.0.1:5173`
- Vitest UI: `http://127.0.0.1:51204/__vitest__/`
- Usuario demo: `test@example.com`
- Massa demo: recarregada para navegacao manual.

## Pendencias confirmadas

- Docker Compose da raiz parece legado e nao representa a stack Laravel atual.
- Banco local padronizado em MySQL/MariaDB ainda esta pendente; a validacao atual segue com SQLite local.
- Pest segue pendente; a suite atual esta em PHPUnit.
- Integracao eSocial real ainda depende de XSD final com assinatura, certificado A1 seguro, fila, envio SOAP, consulta de retorno e parser de rejeicoes.
