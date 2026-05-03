# 13 - Eventos locais para cargos e funcoes - 03/05/2026

## Acao realizada

Rodada com tres microetapas coerentes da frente estrutural eSocial local:

- sincronizacao de evento local `S-1030` para cargos prontos;
- sincronizacao de evento local `S-1040` para funcoes prontas;
- cobertura do painel eSocial para leitura e filtro desses eventos estruturais.

## Arquivos criados / alterados

- `backend/FolhaNova/app/Services/Cargos/SincronizarEventoCargoService.php`
- `backend/FolhaNova/app/Services/Cargos/RegistrarCargoService.php`
- `backend/FolhaNova/app/Services/Cargos/AtualizarCargoService.php`
- `backend/FolhaNova/app/Services/Funcoes/SincronizarEventoFuncaoService.php`
- `backend/FolhaNova/app/Services/Funcoes/RegistrarFuncaoService.php`
- `backend/FolhaNova/app/Services/Funcoes/AtualizarFuncaoService.php`
- `backend/FolhaNova/tests/Feature/CargoCrudTest.php`
- `backend/FolhaNova/tests/Feature/FuncaoCrudTest.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/historico/13-eventos-locais-cargos-funcoes-2026-05-03.md`
- `docs/11-implementacao/historico/13-eventos-locais-cargos-funcoes-2026-05-03.md`

## Impacto

- Cargos ativos com codigo eSocial agora criam ou atualizam evento local `S-1030` pendente.
- Funcoes ativas com codigo eSocial agora criam ou atualizam evento local `S-1040` pendente.
- Cargos/funcoes inativos ou sem codigo eSocial continuam sem gerar evento local.
- O painel eSocial permanece a tela de leitura operacional dos eventos preparados localmente.

## Validacao

- `php artisan test tests/Feature/CargoCrudTest.php tests/Feature/FuncaoCrudTest.php`: 12 testes passaram.
- `php artisan test tests/Feature/EventosEsocialIndexTest.php`: 23 testes passaram.
- `./vendor/bin/pint app/Services/Cargos app/Services/Funcoes tests/Feature/CargoCrudTest.php tests/Feature/FuncaoCrudTest.php tests/Feature/EventosEsocialIndexTest.php --dirty`: passou.
- `php artisan test`: 159 testes passaram.
- `npm run build`: build Vite concluido.
- `php scripts/ensure_local_login.php`: usuario local `test@example.com` recriado apos a suite com `RefreshDatabase`.

## Observacao operacional

Uma tentativa inicial de rodar `CargoCrudTest` e `FuncaoCrudTest` em paralelo corrompeu o SQLite local compartilhado. O banco local foi recriado e os testes passaram quando executados de forma sequencial.
