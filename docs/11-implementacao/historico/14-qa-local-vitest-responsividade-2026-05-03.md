# 14 - QA local com Vitest, dados demo e responsividade - 03/05/2026

## Acao realizada

- Instalar Vitest no frontend Vite/Laravel.
- Extrair helper de tema para modulo testavel.
- Adicionar teste Vitest para tema inicial e alternancia de tema.
- Reforcar proporcionalidade de campos compartilhados com `w-full`.
- Subir backend e Vite localmente.
- Recarregar massa demo para teste manual.

## Arquivos criados / alterados

- `backend/FolhaNova/package.json`
- `backend/FolhaNova/package-lock.json`
- `backend/FolhaNova/vite.config.js`
- `backend/FolhaNova/resources/js/theme.js`
- `backend/FolhaNova/resources/js/theme.test.js`
- `backend/FolhaNova/resources/js/app.js`
- `backend/FolhaNova/resources/js/auth-login.js`
- `backend/FolhaNova/resources/views/servidores/partials/field.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/select.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/select-model.blade.php`
- `backend/FolhaNova/resources/views/cargos/partials/field.blade.php`
- `backend/FolhaNova/resources/views/cargos/partials/select.blade.php`
- `backend/FolhaNova/resources/views/funcoes/partials/field.blade.php`
- `backend/FolhaNova/resources/views/funcoes/partials/select.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/partials/field.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/partials/select.blade.php`

## Validacao

- `npm run test:ui:run`: 1 arquivo, 2 testes passaram.
- `npm run build`: build Vite concluido.
- `php artisan test tests/Feature/Auth/AuthenticationTest.php tests/Feature/DashboardTest.php tests/Feature/EventosEsocialIndexTest.php`: 30 testes passaram.
- `php artisan test tests/Feature/Auth/AuthenticationTest.php tests/Feature/DashboardTest.php tests/Feature/ServidoresIndexTest.php tests/Feature/LotacoesIndexTest.php tests/Feature/CargosIndexTest.php tests/Feature/FuncoesIndexTest.php tests/Feature/RubricasIndexTest.php tests/Feature/EventosEsocialIndexTest.php`: 54 testes passaram.
- `php artisan test`: 159 testes passaram.
- `php artisan db:seed --class=DemoDataSeeder --force`: massa demo carregada apos testes.
- `curl -Is http://127.0.0.1:8000/login`: HTTP 200.
- `curl -Is http://127.0.0.1:5173/resources/js/app.js`: HTTP 200.

## Ambiente para teste manual

- URL: `http://127.0.0.1:8000/login`
- Usuario: `test@example.com`
- Senha: `password`
- Dados: 1 tenant, 3 servidores, 4 eventos, 3 cargos, 2 funcoes e 5 rubricas.

## Observacao

Nao havia Playwright ou navegador headless instalado no ambiente local, entao a validacao visual automatizada ficou limitada a varredura de layout, testes HTTP/feature e build Vite. A navegacao manual deve confirmar proporcao visual fina em breakpoints reais.
