# FolhaNova - Linha do Tempo - 28/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 28/04/2026 - Prontidao S-1040 na Listagem de Funcoes

**Acao realizada:**
- Adicionado filtro operacional `prontidao` na listagem de funcoes.
- Criados cards `Prontas S-1040` e `Pendencias S-1040`.
- Funcoes prontas foram definidas, nesta etapa, como ativas e com codigo eSocial informado.
- O resumo visual de filtros passou a exibir `Prontidao S-1040`.
- A leitura lateral do modulo passou a explicar o criterio de prontidao usado nesta etapa.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/FuncaoController.php`
- `backend/FolhaNova/resources/views/funcoes/index.blade.php`
- `backend/FolhaNova/tests/Feature/FuncoesIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/FuncoesIndexTest.php`: `2` testes verdes e `17` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao S-1030 na Listagem de Cargos

**Acao realizada:**
- Adicionado filtro operacional `prontidao` na listagem de cargos.
- Criados cards `Prontos S-1030` e `Pendencias S-1030`.
- Cargos prontos foram definidos, nesta etapa, como ativos e com codigo eSocial informado.
- O resumo visual de filtros passou a exibir `Prontidao S-1030`.
- A leitura lateral do modulo passou a explicar o criterio de prontidao usado nesta etapa.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/CargoController.php`
- `backend/FolhaNova/resources/views/cargos/index.blade.php`
- `backend/FolhaNova/tests/Feature/CargosIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/CargosIndexTest.php`: `2` testes verdes e `17` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao S-1005/S-1020 no Dashboard

**Acao realizada:**
- O dashboard passou a calcular lotacoes prontas e pendentes para a trilha `S-1005/S-1020`.
- A leitura demo passou a exibir os totais de `Prontas S-1005/S-1020` e `Pendencias S-1005/S-1020`.
- A triagem `S-1005/S-1020` ganhou atalhos para abrir lotacoes prontas, pendencias estruturais e lotacoes ativas.
- O criterio reutiliza a regra entregue na listagem: lotacao ativa com codigo eSocial informado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/DashboardTest.php`: `1` teste verde e `45` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao S-1005/S-1020 na Listagem de Lotacoes

**Acao realizada:**
- Conferidos os documentos de produto/eSocial e os PDFs locais do eSocial por termos ligados a `S-1005`, `S-1020`, `codLotacao`, `tpLotacao` e `infoLotacao`.
- Adicionado filtro operacional `prontidao` na listagem de lotacoes.
- Criados cards `Prontas S-1005/S-1020` e `Pendencias S-1005/S-1020`.
- Lotacoes prontas foram definidas, nesta etapa, como ativas e com codigo eSocial informado.
- O resumo visual de filtros passou a exibir `Prontidao S-1005/S-1020`.
- A leitura lateral do modulo passou a explicar o criterio de prontidao usado nesta etapa.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/LotacaoController.php`
- `backend/FolhaNova/resources/views/lotacoes/index.blade.php`
- `backend/FolhaNova/tests/Feature/LotacoesIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/LotacoesIndexTest.php`: `3` testes verdes e `20` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao S-1000 no Dashboard

**Acao realizada:**
- O dashboard passou a calcular a prontidao operacional da base `S-1000`.
- A triagem institucional passou a mostrar status de prontidao, detalhe e quantidade de pendencias.
- A navegacao de correcao continua apontando para o modulo de orgao publico.
- O criterio reutiliza os campos institucionais ja controlados: inscricao, classificacao tributaria, natureza juridica, vigencia e evento local.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/DashboardTest.php` no WSL nativo: `1` teste verde e `36` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao S-1010 no Dashboard

**Acao realizada:**
- O dashboard passou a calcular rubricas prontas e pendentes para a trilha `S-1010`.
- A triagem `S-1010` ganhou atalhos para abrir rubricas prontas e pendencias de parametrizacao.
- A leitura demo passou a exibir os totais de `Prontas S-1010` e `Pendencias S-1010`.
- Os atalhos de vigencia existentes foram preservados.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/DashboardTest.php` no WSL nativo: `1` teste verde e `32` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao S-1010 na Listagem de Rubricas

**Acao realizada:**
- Adicionado filtro operacional `prontidao` na listagem de rubricas.
- Criados cards `Prontas S-1010` e `Pendencias S-1010`.
- Rubricas prontas foram definidas como ativas, vigentes na data atual e com codigo eSocial informado.
- O resumo visual de filtros passou a exibir `Prontidao S-1010`.
- A leitura lateral do modulo passou a explicar o criterio de prontidao usado nesta etapa.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/RubricasIndexTest.php tests/Feature/RubricaCrudTest.php` no WSL nativo: `30` testes verdes e `220` assercoes.

**Status:** Concluido


### 28/04/2026 - Prontidao Operacional da Base S-1000

**Acao realizada:**
- Conferidos os documentos de produto/eSocial e os PDFs locais do eSocial por termos ligados a `S-1000`, `classTrib`, `natJurid`, `iniValid`, `fimValid` e `S-1010`.
- Adicionado calculo de prontidao local da base `S-1000` no controller de orgao publico.
- A tela do orgao publico passou a exibir se a base `S-1000` esta pronta ou com pendencias.
- Pendencias objetivas agora orientam correcao de inscricao, classificacao tributaria, natureza juridica, vigencia e evento local.
- O fluxo nao altera banco, payload ou transmissao; ele apenas melhora a leitura operacional antes da integracao futura.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/OrgaoPublicoController.php`
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php` no WSL nativo: `19` testes verdes e `110` assercoes.

**Status:** Concluido


### 28/04/2026 - Fila de Reprocessamento Local no Painel eSocial

**Acao realizada:**
- Adicionado o filtro operacional `acao=reprocessamento` no painel eSocial.
- Criado card dedicado de `Reprocessamento` apontando para os eventos com `status=erro`.
- O formulario principal passou a exibir o campo `Acao` com a opcao `Reprocessamento local`.
- O resumo de filtros ativos passou a mostrar `Acao: Reprocessamento local`.
- A listagem manteve a acao direta de `Reprocessar` apenas para eventos com erro.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php` no WSL nativo: `27` testes verdes e `165` assercoes.

**Status:** Concluido


### 28/04/2026 - Restauracao do Ambiente Rapido no WSL Nativo

**Acao realizada:**
- Lidos os documentos de workflow, ambiente e performance antes de retomar qualquer feature.
- Verificado o historico de commits para localizar a rodada que tornou o ambiente local mais rapido com bootstrap nativo no WSL.
- Recriada a copia nativa do projeto em `~/RHevo/backend/FolhaNova`.
- Ajustado o `.env` da copia nativa para apontar o SQLite para `/home/predador/RHevo/backend/FolhaNova/database/database.sqlite`.
- Corrigido o bootstrap para preferir a copia nativa, avisar quando estiver rodando em `/mnt/c` e validar o Vite por `/resources/js/app.js`.
- Registrada a comparacao de performance entre `/mnt/c/...` e o filesystem nativo do WSL.

**Arquivos criados / alterados:**
- `backend/FolhaNova/scripts/bootstrap_native_wsl.sh`
- `backend/FolhaNova/scripts/stop_native_wsl.sh`
- `backend/FolhaNova/docs/WSL-BOOTSTRAP.md`
- `docs/performance/diagnostico-inicial.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `bash scripts/bootstrap_native_wsl.sh` em `~/RHevo/backend/FolhaNova`: backend e Vite subiram com sucesso.
- `GET /login`: aproximadamente `0.03s` no WSL nativo.
- `GET /` seguindo redirect para login: aproximadamente `0.045s` no WSL nativo.
- `php artisan about --only=environment,drivers`: `0.58s` no WSL nativo.
- `php artisan test tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.

**Status:** Concluido
