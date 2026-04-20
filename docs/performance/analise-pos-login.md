# Analise Pos Login
**Atualizado em:** 20/04/2026

## Escopo
- Fluxo analisado: submissao do login e carregamento da primeira tela autenticada.

## Confirmado
- O login real esta em `App\\Livewire\\Auth\\Login`.
- O formulario executa validacao, `Auth::attempt`, `Session::regenerate()` e redireciona para `dashboard`.
- Nao ha regra de negocio pesada evidente no fluxo de autenticacao.
- O dashboard atual e predominantemente estatico; nao ha consulta de dominio explicita na view.
- O ambiente real usa `sqlite`, `cache=database`, `session=database`, `queue=sync`, `debug=false` e `Telescope=false`.

## Leitura tecnica
- O pos-login continua mais sensivel ao ambiente do que a SQL de negocio.
- O custo percebido tende a vir do bootstrap Laravel, sessao, Livewire e filesystem local.
- A nova tela `servidores.index` ja nasceu com `with(['pessoa', 'lotacao', 'cargo'])` para evitar N+1 no primeiro modulo operacional.

## Corrigivel agora
- Manter novas telas com eager loading e filtros server-side.
- Evitar dashboards pesados antes de existir baseline com profiling.

## Corrigivel depois
- Instrumentacao por request para separar bootstrap, SQL e render.
- Revisao da navegacao autenticada, caso o layout global passe a concentrar widgets dinamicos reais.
