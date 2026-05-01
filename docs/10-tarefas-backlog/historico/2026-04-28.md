# FolhaNova - Backlog Geral - 28/04/2026

Entradas historicas de backlog separadas para leitura rapida.

### PRODUTO-S1040-PRONTIDAO-FUNCOES - 28/04/2026

**Descricao:**
Adicionar leitura operacional de prontidao `S-1040` na listagem de funcoes, separando funcoes prontas de pendencias funcionais.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/FuncaoController.php`
- `backend/FolhaNova/resources/views/funcoes/index.blade.php`
- `backend/FolhaNova/tests/Feature/FuncoesIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aplicar nas funcoes o mesmo padrao de prontidao usado em cargos;
- calcular funcoes prontas como ativas e com codigo eSocial informado;
- calcular pendencias como complemento operacional dessa regra;
- adicionar cards e filtro de prontidao na listagem;
- exibir a prontidao ativa no resumo visual de filtros;
- cobrir a leitura com teste focado da listagem.

**Resultado:**
- a listagem de funcoes passou a exibir cards `Prontas S-1040` e `Pendencias S-1040`;
- o formulario principal ganhou o filtro `Prontidao`;
- funcoes prontas sao as ativas com codigo eSocial informado;
- o resumo de filtros ativos mostra `Prontidao S-1040`;
- teste focado cobre cards, filtro e escopo da base pronta.


### PRODUTO-S1030-PRONTIDAO-CARGOS - 28/04/2026

**Descricao:**
Adicionar leitura operacional de prontidao `S-1030` na listagem de cargos, separando cargos prontos de pendencias ocupacionais.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/CargoController.php`
- `backend/FolhaNova/resources/views/cargos/index.blade.php`
- `backend/FolhaNova/tests/Feature/CargosIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aplicar nos cargos o mesmo padrao de prontidao usado em lotacoes e rubricas;
- calcular cargos prontos como ativos e com codigo eSocial informado;
- calcular pendencias como complemento operacional dessa regra;
- adicionar cards e filtro de prontidao na listagem;
- exibir a prontidao ativa no resumo visual de filtros;
- cobrir a leitura com teste focado da listagem.

**Resultado:**
- a listagem de cargos passou a exibir cards `Prontos S-1030` e `Pendencias S-1030`;
- o formulario principal ganhou o filtro `Prontidao`;
- cargos prontos sao os ativos com codigo eSocial informado;
- o resumo de filtros ativos mostra `Prontidao S-1030`;
- teste focado cobre cards, filtro e escopo da base pronta.


### PRODUTO-DASHBOARD-PRONTIDAO-S1005-S1020 - 28/04/2026

**Descricao:**
Levar para o dashboard a leitura de prontidao `S-1005/S-1020`, exibindo atalhos para lotacoes prontas e pendencias estruturais.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- reutilizar o criterio da listagem de lotacoes para prontidao `S-1005/S-1020`;
- calcular lotacoes prontas e pendentes no dashboard;
- exibir atalhos de triagem para abrir lotacoes prontas, pendentes e ativas;
- cobrir a leitura com teste focado do dashboard.

**Resultado:**
- o dashboard passou a calcular lotacoes prontas e pendentes para `S-1005/S-1020`;
- a leitura demo exibe os totais de prontidao de lotacoes;
- a triagem `S-1005/S-1020` ganhou atalhos para `Lotacoes prontas` e `Pendencias estruturais`;
- teste focado do dashboard cobre os novos atalhos e contadores.


### PRODUTO-S1005-S1020-PRONTIDAO-LOTACOES - 28/04/2026

**Descricao:**
Adicionar leitura operacional de prontidao `S-1005/S-1020` na listagem de lotacoes, separando lotacoes prontas de pendencias estruturais.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/LotacaoController.php`
- `backend/FolhaNova/resources/views/lotacoes/index.blade.php`
- `backend/FolhaNova/tests/Feature/LotacoesIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- consultar os MDs de produto/eSocial e os PDFs locais do eSocial por `S-1005`, `S-1020`, `codLotacao` e `tpLotacao`;
- calcular lotacoes prontas como ativas e com codigo eSocial informado;
- calcular pendencias como complemento operacional dessa regra;
- adicionar cards e filtro de prontidao na listagem;
- exibir a prontidao ativa no resumo visual de filtros;
- cobrir a leitura com teste focado da listagem.

**Resultado:**
- a listagem de lotacoes passou a exibir cards `Prontas S-1005/S-1020` e `Pendencias S-1005/S-1020`;
- o formulario principal ganhou o filtro `Prontidao`;
- lotacoes prontas sao as ativas com codigo eSocial informado;
- o resumo de filtros ativos mostra `Prontidao S-1005/S-1020`;
- teste focado cobre cards, filtro e escopo da base pronta.


### PRODUTO-DASHBOARD-PRONTIDAO-S1000 - 28/04/2026

**Descricao:**
Levar para o dashboard a leitura de prontidao operacional da base `S-1000`, aproximando a home da triagem institucional.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular a prontidao `S-1000` no resumo institucional do dashboard;
- exibir status e quantidade de pendencias na triagem `S-1000`;
- apontar a correcao para o modulo de orgao publico;
- cobrir a leitura no teste focado do dashboard.

**Resultado:**
- o dashboard passou a exibir a prontidao operacional da base `S-1000`;
- a triagem institucional mostra status, detalhe e quantidade de pendencias;
- a correcao segue apontando para o modulo de orgao publico;
- teste focado do dashboard cobre a leitura de prontidao `S-1000`.


### PRODUTO-DASHBOARD-PRONTIDAO-S1010 - 28/04/2026

**Descricao:**
Levar para o dashboard a leitura de prontidao `S-1010`, exibindo atalhos para rubricas prontas e pendentes de parametrizacao.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular rubricas prontas e pendentes para `S-1010` no dashboard;
- exibir atalhos na triagem `S-1010`;
- manter os atalhos de vigencia existentes;
- cobrir a leitura com teste focado do dashboard.

**Resultado:**
- o dashboard passou a calcular rubricas prontas e pendentes para `S-1010`;
- a triagem `S-1010` ganhou atalhos para `Prontas S-1010` e `Pendencias S-1010`;
- a leitura demo tambem exibe os totais de prontidao;
- teste focado do dashboard cobre os novos atalhos e contadores.


### PRODUTO-S1010-PRONTIDAO-RUBRICAS - 28/04/2026

**Descricao:**
Adicionar leitura operacional de prontidao `S-1010` na listagem de rubricas, separando rubricas prontas de pendencias de parametrizacao.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular rubricas prontas para `S-1010` como ativas, com codigo eSocial e vigencia ativa;
- calcular pendencias como o complemento operacional dessa regra;
- adicionar cards e filtro `prontidao`;
- exibir a prontidao ativa no resumo visual de filtros;
- cobrir a leitura com teste focado da listagem.

**Resultado:**
- a listagem de rubricas passou a exibir cards `Prontas S-1010` e `Pendencias S-1010`;
- o formulario principal ganhou o filtro `Prontidao`;
- rubricas prontas sao as ativas, vigentes na data atual e com codigo eSocial informado;
- o resumo de filtros ativos mostra `Prontidao S-1010`;
- teste focado cobre cards, filtro e escopo da base pronta.


### PRODUTO-S1000-PRONTIDAO-OPERACIONAL - 28/04/2026

**Descricao:**
Evidenciar no modulo de orgao publico se a base institucional do `S-1000` esta pronta para futura transmissao ou bloqueada por pendencias locais.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/OrgaoPublicoController.php`
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular a prontidao local do `S-1000` a partir de inscricao, classificacao tributaria, natureza juridica, inicio de validade, vigencia e evento local;
- exibir um card de prontidao no modulo de orgao publico;
- listar pendencias objetivas para orientar correcao antes da integracao futura;
- cobrir cenario pronto e cenario com pendencias em teste focado.

**Resultado:**
- o modulo de orgao publico passou a exibir a prontidao local da base `S-1000`;
- o sistema lista pendencias objetivas de inscricao, classificacao, natureza juridica, vigencia e evento local;
- quando os parametros minimos estao consistentes, a tela informa que a base `S-1000` esta pronta para a proxima etapa de integracao;
- testes focados cobrem os cenarios de base pronta e base com pendencias.


### PRODUTO-PAINEL-ESOCIAL-REPROCESSAMENTO-LOCAL - 28/04/2026

**Descricao:**
Evidenciar no painel eSocial uma leitura operacional dedicada aos eventos disponiveis para reprocessamento local.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar um filtro operacional `acao=reprocessamento` no painel de eventos;
- calcular o total de eventos reprocessaveis a partir dos eventos com `status=erro`;
- criar card dedicado para abrir a fila de reprocessamento local;
- exibir o filtro ativo no resumo visual do painel;
- cobrir o fluxo com teste focado da listagem.

**Resultado:**
- o painel eSocial passou a ter card dedicado de `Reprocessamento`;
- o formulario principal ganhou o filtro operacional `Acao`;
- `acao=reprocessamento` lista apenas eventos com `status=erro`;
- o resumo visual de filtros ativos exibe `Acao: Reprocessamento local`;
- teste focado cobre o card, o filtro e o escopo da fila.


### AMBIENTE-WSL-NATIVO-PERFORMANCE - 28/04/2026

**Descricao:**
Restaurar o fluxo local rapido no `WSL Ubuntu 24.04`, recriando a copia nativa do projeto, corrigindo o bootstrap e registrando as medicoes comparativas contra o mount `/mnt/c`.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/scripts/bootstrap_native_wsl.sh`
- `backend/FolhaNova/scripts/stop_native_wsl.sh`
- `backend/FolhaNova/docs/WSL-BOOTSTRAP.md`
- `docs/performance/diagnostico-inicial.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- ler os documentos de workflow, ambiente e performance antes de continuar desenvolvimento;
- verificar o historico de commits para identificar o ponto em que o bootstrap nativo deixou a aplicacao rapida;
- recriar a copia nativa em `~/RHevo/backend/FolhaNova`;
- ajustar o `.env` da copia nativa para usar o SQLite dentro de `/home/predador/RHevo`;
- corrigir a validacao do Vite no bootstrap para checar um asset real em vez da raiz `/`;
- medir `/login`, `/` e o bootstrap CLI no caminho `/mnt/c` e no filesystem nativo do WSL.

**Resultado:**
- a aplicacao ficou rodando em `http://127.0.0.1:8000/login` a partir de `/home/predador/RHevo/backend/FolhaNova`;
- o bootstrap nativo voltou a concluir corretamente backend e Vite;
- `GET /login` no WSL nativo ficou em aproximadamente `0.03s`;
- `php artisan about --only=environment,drivers` no WSL nativo ficou em `0.58s`;
- testes focados de autenticacao passaram com sucesso;
- a recomendacao operacional ficou registrada: usar `~/RHevo/backend/FolhaNova` para execucao e performance, evitando `/mnt/c/...` para benchmark.
