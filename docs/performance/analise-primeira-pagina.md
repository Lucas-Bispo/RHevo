# Analise da Primeira Pagina
**Atualizado em:** 20/04/2026

## Escopo
- Fluxo analisado: `GET /` para guest ate a tela de login.
- Objetivo: separar o que ja foi corrigido do que ainda pesa no primeiro contato com a aplicacao.

## Confirmado
- A rota raiz usa `RootRedirectController` e manda guest direto para `login`, sem a cascata antiga por `dashboard`.
- O layout de login ainda carrega `resources/css/app.css`, scripts Livewire e fontes externas do Bunny Fonts.
- O login usava o mesmo bundle JS da area autenticada. Nesta rodada isso foi segmentado para `resources/js/auth-login.js`, removendo `axios` e `bootstrap.js` do primeiro acesso.
- No runtime real, comandos simples do Laravel em WSL continuam lentos:
  - `php artisan about --only=environment,drivers`: ~35.8s
  - `php artisan route:list --path=login`: ~37.0s

## Hipoteses fortes
- O principal gargalo da primeira pagina continua sendo bootstrap e I/O do ambiente local, nao download de assets.
- Mesmo assim, havia uma otimizacao segura e imediata na camada web: parar de enviar JS autenticado para a tela de login.

## O que foi corrigido agora
- Bundle de login separado do bundle autenticado.
- Tema claro/escuro preservado no login sem carregar `axios`.

## O que fica para depois
- Medir waterfall real de `GET /login` com servidor aquecido e frio apos o split de JS.
- Avaliar se vale substituir fontes externas por stack local ou preload controlado.
- Medir se o CSS global deve ser quebrado em bundles menores.
