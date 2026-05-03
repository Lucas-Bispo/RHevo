# 14 - QA local com Vitest, dados demo e responsividade - 03/05/2026

## Contexto

Preparacao do ambiente para teste manual da interface web com Vite ativo, dados de demonstracao e checagem geral de layout.

## Tarefas

### QA-VITEST-FRONTEND

- Status: concluido.
- Prioridade: alta.
- Objetivo: instalar Vitest no projeto Vite/Laravel e adicionar teste frontend inicial.
- Resultado: `vitest` e `jsdom` instalados; scripts `test:ui` e `test:ui:run` criados; helper de tema extraido para `resources/js/theme.js` com teste em `resources/js/theme.test.js`.

### QA-RESPONSIVIDADE-FORMULARIOS

- Status: concluido.
- Prioridade: media.
- Objetivo: reduzir risco de campos desalinhados em formularios durante teste manual.
- Resultado: inputs, selects e textareas compartilhados de servidores, cargos, funcoes e lotacoes passaram a usar `w-full` explicitamente.

### QA-AMBIENTE-MANUAL

- Status: concluido.
- Prioridade: alta.
- Objetivo: subir a aplicacao local e inserir dados para navegacao manual.
- Resultado: backend em `http://127.0.0.1:8000`, Vite em `http://127.0.0.1:5173` e massa demo carregada com `DemoDataSeeder`.

## Validacao executada

- `npm run test:ui:run`: 1 arquivo, 2 testes passaram.
- `npm run build`: build Vite concluido.
- `php artisan test`: 159 testes passaram.
- `php artisan db:seed --class=DemoDataSeeder --force`: massa demo carregada.
- `curl -Is http://127.0.0.1:8000/login`: HTTP 200.
- `curl -Is http://127.0.0.1:5173/resources/js/app.js`: HTTP 200.
