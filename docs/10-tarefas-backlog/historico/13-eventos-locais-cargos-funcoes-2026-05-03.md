# 13 - Eventos locais para cargos e funcoes - 03/05/2026

## Contexto

Rodada maior, mas ainda coerente, seguindo a frente estrutural definida em `docs/produto/priorizacao.md` e `docs/produto/plano-de-implementacao.md`.

## Tarefas

### PRODUTO-S1030-EVENTO-LOCAL-CARGO-PRONTO

- Status: concluido.
- Prioridade: alta.
- Objetivo: gerar ou atualizar evento local `S-1030` pendente quando um cargo ativo possuir codigo eSocial.
- Arquivos previstos: services de cargos, novo service de sincronizacao, testes de cargo e documentacao.

### PRODUTO-S1040-EVENTO-LOCAL-FUNCAO-PRONTA

- Status: concluido.
- Prioridade: alta.
- Objetivo: gerar ou atualizar evento local `S-1040` pendente quando uma funcao ativa possuir codigo eSocial.
- Arquivos previstos: services de funcoes, novo service de sincronizacao, testes de funcao e documentacao.

### PRODUTO-PAINEL-EVENTOS-TABELA-ESTRUTURAL

- Status: concluido.
- Prioridade: media.
- Objetivo: consolidar a leitura operacional no painel e na documentacao para eventos estruturais `S-1030` e `S-1040`.
- Arquivos previstos: testes do painel, `docs/produto/funcionalidades-existentes.md`, `docs/esocial/regras-negocio.md` e linha do tempo.

## Resultado

- Cargos ativos com codigo eSocial passaram a gerar evento local `S-1030` pendente.
- Edicoes de cargos prontos reaproveitam o evento `S-1030` pendente da propria chave logica.
- Funcoes ativas com codigo eSocial passaram a gerar evento local `S-1040` pendente.
- Edicoes de funcoes prontas reaproveitam o evento `S-1040` pendente da propria chave logica.
- O painel eSocial passou a ter cobertura automatizada para leitura e filtro dos eventos estruturais por origem `cargos` e `funcoes`.

## Validacao executada

- `php artisan test tests/Feature/CargoCrudTest.php tests/Feature/FuncaoCrudTest.php`: 12 testes passaram.
- `php artisan test tests/Feature/EventosEsocialIndexTest.php`: 23 testes passaram.
- `./vendor/bin/pint app/Services/Cargos app/Services/Funcoes tests/Feature/CargoCrudTest.php tests/Feature/FuncaoCrudTest.php tests/Feature/EventosEsocialIndexTest.php --dirty`: passou.
- `php artisan test`: 159 testes passaram.
- `npm run build`: build Vite concluido.
- `php scripts/ensure_local_login.php`: usuario local `test@example.com` recriado apos a suite com `RefreshDatabase`.
