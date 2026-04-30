### PRODUTO-PAINEL-ESOCIAL-GRUPOS-OPERACIONAIS - 30/04/2026

**Descricao:**
Adicionar leitura por grupo operacional no painel eSocial para separar eventos de tabela, nao periodicos e periodicos antes da futura montagem de lotes.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- classificar eventos locais em grupos de tabela, nao periodicos e periodicos;
- adicionar contadores e cards dedicados no painel;
- incluir filtro `grupo` no formulario principal e no resumo de filtros ativos;
- cobrir o filtro com teste focado.

**Resultado:**
- o painel eSocial passou a exibir cards `Eventos de tabela`, `Nao periodicos` e `Periodicos`;
- o formulario principal ganhou o filtro `Grupo`;
- a listagem pode ser aberta por `grupo=tabelas`, `grupo=nao_periodicos` ou `grupo=periodicos`;
- o teste focado do painel cobre links, filtros e escopo por grupo.

### DOCS-ESOCIAL-INTEGRACAO-API - 30/04/2026

**Descricao:**
Criar uma explicacao humana e tecnica sobre como a futura integracao do FolhaNova com os Web Services oficiais do eSocial devera funcionar.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `docs/esocial/integracao-api-esocial.md`
- `docs/esocial/README.md`
- `docs/08-esocial/ESOCIAL-DOCUMENTACAO-OFICIAL.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- ler a documentacao interna de eSocial do projeto;
- consultar a documentacao oficial vigente em `gov.br`;
- explicar o fluxo de eventos, XML, certificado, assinatura, lotes, envio, consulta de retorno, recibos e rejeicoes;
- registrar a integracao como ultima etapa, dependente da maturidade dos cadastros e regras locais.

**Resultado:**
- criado o guia `integracao-api-esocial.md`;
- atualizada a referencia oficial para MOS S-1.3 consolidado ate NO 10/2026 e leiautes NT 06/2026 rev. 09/04/2026;
- documentado que a "API" do eSocial e, na pratica, uma integracao SOAP/XML assincrona com certificado digital e validacao por XSD.

### PRODUTO-S2200-PRONTIDAO-SERVIDORES - 30/04/2026

**Descricao:**
Adicionar leitura operacional de prontidao `S-2200` na listagem de servidores e no dashboard, separando admissoes prontas de pendencias cadastrais e de evento local.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular servidores prontos para `S-2200` como ativos, com dados funcionais essenciais, CPF e nascimento informados, lotacao, cargo e evento local `S-2200`;
- calcular pendencias como complemento operacional dessa regra;
- adicionar cards, filtro e resumo de filtros na listagem de servidores;
- levar contadores e atalhos para o dashboard;
- cobrir a leitura com testes focados.

**Resultado:**
- a listagem de servidores passou a exibir cards `Prontos S-2200` e `Pendencias S-2200`;
- o formulario principal ganhou o filtro `Prontidao`;
- o dashboard passou a exibir a triagem `S-2200` com atalhos para servidores prontos, pendentes e eventos `S-2200`;
- testes focados cobrem listagem, filtros, contadores e atalhos do dashboard.

### PRODUTO-PAINEL-ESOCIAL-ATALHOS-S1030-S1040 - 29/04/2026

**Descricao:**
Ampliar os atalhos de eventos prioritarios no painel eSocial para incluir as trilhas `S-1030` e `S-1040`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar contadores de eventos `S-1030` e `S-1040` no resumo do painel;
- exibir cards dedicados para cargos e funcoes;
- preservar os cards atuais de `S-1000`, `S-1010` e `S-2200`;
- cobrir os novos atalhos e o filtro por evento com teste focado.

**Resultado:**
- o painel eSocial passou a destacar `S-1030` e `S-1040` como eventos prioritarios;
- os cards abrem a listagem filtrada pela respectiva trilha;
- teste focado cobre links, contadores e filtragem por `S-1040`.

### PRODUTO-DASHBOARD-PRONTIDAO-S1030-S1040 - 29/04/2026

**Descricao:**
Levar para o dashboard a leitura de prontidao `S-1030/S-1040`, exibindo atalhos para cargos e funcoes prontos ou pendentes de parametrizacao.

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
- reutilizar os criterios das listagens de cargos e funcoes;
- calcular cargos prontos como ativos e com codigo eSocial informado;
- calcular funcoes prontas como ativas e com codigo eSocial informado;
- exibir os totais na leitura demo do dashboard;
- adicionar uma triagem dedicada com atalhos para cargos e funcoes prontos ou pendentes;
- cobrir a leitura com teste focado do dashboard.

**Resultado:**
- o dashboard passou a calcular cargos prontos e pendentes para `S-1030`;
- o dashboard passou a calcular funcoes prontas e pendentes para `S-1040`;
- a leitura demo exibe os totais de prontidao ocupacional;
- a triagem `S-1030/S-1040` ganhou atalhos para revisar cargos e funcoes por prontidao;
- teste focado do dashboard cobre os novos atalhos e contadores.

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

### PRODUTO-PAINEL-ESOCIAL-STATUS-DO-DIA - 24/04/2026

**Descricao:**
Expandir a leitura operacional do painel eSocial com cards dedicados para eventos pendentes e com erro atualizados no dia.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular no painel os eventos `pendente` e `erro` atualizados hoje;
- criar cards operacionais para abrir o painel com `status` e `data` do dia ja combinados;
- manter o painel principal sem alterar o comportamento dos filtros existentes;
- cobrir a navegacao com testes focados da listagem.

**Resultado:**
- o painel eSocial agora destaca pendencias e erros atualizados no dia;
- os cards novos abrem a listagem ja combinando `status` e `data`;
- a leitura operacional do que exige atencao no mesmo dia ficou mais direta;
- testes focados cobrem os atalhos e a filtragem combinada.

### PRODUTO-PAINEL-ESOCIAL-FILTRO-DATA - 24/04/2026

**Descricao:**
Expandir a leitura operacional do painel eSocial com filtro por data de atualizacao e atalho contextual no detalhe do evento.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar filtro opcional de `data` no painel eSocial usando a trilha de `updated_at`;
- exibir a data ativa no resumo visual de filtros;
- incluir no detalhe do evento o atalho `Mesma data`;
- cobrir filtro e navegacao com testes focados do painel e do detalhe.

**Resultado:**
- o painel eSocial agora aceita filtrar eventos pela data de atualizacao do registro;
- o resumo de filtros ativos evidencia a data operacional selecionada;
- o detalhe do evento ganhou o atalho `Mesma data` para voltar ao painel pela mesma janela diaria;
- testes focados cobrem a filtragem e a navegacao contextual por data.

### PRODUTO-PAINEL-ESOCIAL-FILTRO-SERVIDOR - 24/04/2026

**Descricao:**
Expandir a leitura operacional do painel eSocial com filtro dedicado por servidor vinculado e atalho contextual no detalhe do evento.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar filtro opcional de `servidor` no painel eSocial sem impactar os filtros ja existentes;
- exibir o servidor ativo no resumo visual de filtros;
- incluir no detalhe do evento o atalho `Mesmo servidor` quando houver vinculo funcional;
- cobrir filtro e navegacao com testes focados do painel e do detalhe.

**Resultado:**
- o painel eSocial agora aceita filtrar eventos por servidor vinculado;
- o resumo de filtros ativos evidencia o nome e a matricula do servidor selecionado;
- o detalhe do evento ganhou o atalho `Mesmo servidor` para voltar ao painel pela mesma trilha funcional;
- testes focados cobrem a filtragem e a navegacao contextual por servidor.

### AMBIENTE-LOCAL-LOGIN-DEMO-WSL - 24/04/2026

**Descricao:**
Garantir que o bootstrap local de teste manual no `WSL Ubuntu 24.04` crie tenant demo, usuario local e permita subir backend e frontend de forma previsivel.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/scripts/ensure_local_login.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- corrigir o script de login local para criar a tabela `tenants` quando necessario;
- garantir tenant demo com metadados institucionais minimos para navegacao manual;
- recriar o usuario `test@example.com` vinculado ao tenant demo;
- subir backend e frontend em sessoes destacadas no `WSL` e validar as rotas principais.

**Resultado:**
- o script local passou a garantir a existencia da tabela `tenants` no banco sqlite de desenvolvimento;
- a conta `test@example.com` agora fica vinculada ao tenant demo com metadados minimos do orgao publico;
- backend e Vite foram deixados ativos em sessoes `tmux` no `WSL Ubuntu 24.04`;
- `/login` respondeu `200`, `/dashboard` sem sessao redirecionou para `/login` e o Vite respondeu em `127.0.0.1:5173`.

### PRODUTO-S1010-CONSISTENCIA-FORMULARIO - 24/04/2026

**Descricao:**
Evidenciar nas telas de criacao e edicao das rubricas as regras operacionais ja adotadas para `natRubr`, vigencia, status e pendencia de codigo eSocial no `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/create.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/resources/views/rubricas/partials/consistency-guide.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- criar um bloco contextual de consistencia para o `S-1010` reaproveitavel nas telas de criacao e edicao;
- orientar o comportamento esperado para `natRubr`, vigencia ativa/inativa e codigo eSocial;
- sinalizar quando a combinacao atual pede ajuste antes do salvamento;
- cobrir a leitura com testes focados de CRUD.

**Resultado:**
- as telas de criacao e edicao de rubricas passaram a exibir um bloco contextual de consistencia para o `S-1010`;
- o formulario agora orienta explicitamente `natRubr`, status, vigencia e pendencia de codigo eSocial;
- a leitura muda conforme a rubrica esteja ativa, inativa ou ainda sem codigo eSocial;
- testes focados de CRUD cobrem a nova orientacao visual.

### PRODUTO-S1000-CONSISTENCIA-EDIT - 24/04/2026

**Descricao:**
Evidenciar na tela de edicao do orgao publico as regras de consistencia entre tipo de inscricao, classificacao tributaria e natureza juridica para reduzir erro operacional no `S-1000`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- montar um bloco contextual de consistencia dentro da tela de edicao do `S-1000`;
- explicar o comportamento esperado para inscricoes por `CNPJ` e `CPF`;
- sinalizar quando a combinacao atual pede ajuste antes do salvamento;
- cobrir a leitura com testes focados do modulo institucional.

**Resultado:**
- a tela de edicao do orgao publico passou a exibir um bloco contextual de consistencia para o `S-1000`;
- inscricoes por `CNPJ` agora recebem orientacao visual sobre `classTrib 85` e obrigatoriedade de `natJurid`;
- inscricoes por `CPF` agora deixam explicito que `classTrib 21` e o recorte atual e que `natJurid` sera descartada;
- testes focados do modulo institucional cobrem os dois contextos.

### PRODUTO-S1010-FILTRO-NATUREZA-RUBRICAS - 24/04/2026

**Descricao:**
Expandir a leitura operacional do `S-1010` com filtro dedicado por natureza eSocial (`natRubr`) na listagem de rubricas e atalho contextual na edicao.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar filtro dedicado de `natureza` no controller e no formulario principal da listagem;
- exibir a natureza ativa no resumo de filtros para leitura operacional;
- incluir atalho `Mesma natureza` na tela de edicao da rubrica;
- cobrir o filtro e o atalho com testes focados.

**Resultado:**
- a listagem de rubricas passou a aceitar filtro dedicado por `natureza` eSocial (`natRubr`);
- o resumo de filtros ativos agora mostra a natureza selecionada junto dos demais filtros operacionais;
- a tela de edicao ganhou atalho `Mesma natureza` para revisar rapidamente a base da mesma classificacao;
- testes focados de listagem e edicao cobrem o novo filtro e a navegacao contextual.

### PRODUTO-DETALHE-ESOCIAL-ATALHO-CONTEXTO - 24/04/2026

**Descricao:**
Adicionar no detalhe do evento eSocial um atalho para retornar ao painel pelo mesmo contexto operacional do registro atual.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- identificar no detalhe se o evento eSocial e institucional ou vinculado a servidor;
- adicionar atalho `Mesmo contexto` apontando para o filtro correspondente do painel;
- preservar os atalhos existentes por evento, status, ambiente, origem e retorno;
- cobrir a nova navegacao com teste focado.

**Resultado:**
- o detalhe do evento eSocial passou a oferecer retorno rapido para o mesmo contexto operacional;
- eventos institucionais agora voltam ao painel com `contexto=institucional`;
- eventos vinculados a servidor agora voltam ao painel com `contexto=vinculado`;
- teste focado cobre os dois cenarios.

### PRODUTO-PAINEL-ESOCIAL-CONTEXTO-INSTITUCIONAL-VINCULADO - 24/04/2026

**Descricao:**
Adicionar ao painel eSocial a leitura operacional por contexto, separando eventos institucionais de eventos vinculados a servidor.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir filtro `contexto` no painel de eventos;
- calcular contagens para eventos `institucionais` e `vinculados`;
- expor cards e select de filtro para essa triagem;
- cobrir a nova leitura com testes focados do painel.

**Resultado:**
- o painel eSocial passou a separar eventos institucionais dos eventos ligados a servidor;
- a triagem operacional ficou mais direta para revisar `S-1000` e eventos funcionais sem misturar os dois contextos;
- o resumo de filtros ativos agora exibe o contexto selecionado;
- testes focados cobrem os links e a filtragem por contexto.

### PRODUTO-S1000-ATALHOS-CONTEXTUAIS-ORGAO - 24/04/2026

**Descricao:**
Adicionar atalhos contextuais no modulo `Orgao Publico` para retornar ao painel eSocial do `S-1000` pelo mesmo status ou ambiente do evento atual.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- reaproveitar o evento `S-1000` ja exibido no modulo institucional;
- adicionar atalhos `Mesmo status` e `Mesmo ambiente` no card do evento atual;
- manter o link geral para o painel `S-1000`;
- cobrir a navegacao com teste focado do modulo.

**Resultado:**
- o modulo `Orgao Publico` agora abre o painel `S-1000` pelo mesmo status do evento atual;
- o card institucional tambem consegue filtrar o painel pelo mesmo ambiente do evento;
- a leitura operacional do `S-1000` ficou mais proxima do padrao do detalhe eSocial;
- teste focado passou a cobrir os atalhos contextuais.

### PRODUTO-DASHBOARD-TRIAGEM-S1000 - 24/04/2026

**Descricao:**
Adicionar ao dashboard um resumo operacional do `S-1000`, aproximando a leitura institucional da home do projeto.

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
- recuperar no dashboard o tenant atual, os parametros institucionais e o ultimo evento `S-1000`;
- exibir nome do orgao, ambiente, status de vigencia e status do evento na home;
- adicionar atalhos para `orgao publico` e para o painel filtrado em `S-1000`;
- cobrir a nova leitura com teste focado do dashboard.

**Resultado:**
- o dashboard passou a exibir um bloco `Triagem S-1000` com leitura institucional resumida;
- a navegacao manual para revisar o orgao publico e o painel `S-1000` ficou mais curta;
- a home agora concentra leitura operacional das frentes `S-1000`, `S-1010` e painel eSocial;
- teste focado do dashboard cobre o novo resumo institucional.

### PRODUTO-DASHBOARD-TRIAGEM-VIGENCIA-S1010 - 24/04/2026

**Descricao:**
Levar a triagem de vigencia das rubricas para o dashboard operacional, aproximando a validacao manual inicial da trilha `S-1010`.

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
- calcular contagens de vigencia ativa, futura e encerrada das rubricas no dashboard;
- expor essas leituras na area de validacao manual e em um bloco de triagem `S-1010`;
- adicionar atalhos para abrir a listagem de rubricas ja filtrada por vigencia;
- cobrir a nova leitura com teste focado do dashboard.

**Resultado:**
- o dashboard passou a mostrar a distribuicao de vigencia das rubricas;
- a massa demo pode ser triada a partir da home sem entrar primeiro no modulo de rubricas;
- a tabela de validacao manual agora cita explicitamente a leitura de vigencia;
- teste focado do dashboard cobre os novos atalhos e indicadores.

### PRODUTO-DEMO-RUBRICAS-VIGENCIA-S1010 - 24/04/2026

**Descricao:**
Atualizar a massa demo de rubricas para refletir os novos cenarios de vigencia `ativa`, `futura` e `encerrada`, facilitando a validacao manual da trilha `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/database/seeders/DemoDataSeeder.php`
- `backend/FolhaNova/tests/Feature/DemoDataSeederTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir datas de vigencia coerentes nas rubricas demo;
- garantir ao menos um exemplo ativo, um futuro e um encerrado;
- ampliar o teste do seeder para validar as janelas de vigencia;
- reaplicar a massa demo no banco local para revisao manual.

**Resultado:**
- a massa demo passou a cobrir rubricas com vigencia ativa, futura e encerrada;
- o teste do seeder agora confirma a distribuicao dessas janelas;
- a base local fica mais alinhada com os filtros e atalhos novos da trilha `S-1010`;
- a validacao manual pode ser feita com a conta demo existente.

### PRODUTO-S1010-ATALHOS-VIGENCIA-RUBRICAS - 24/04/2026

**Descricao:**
Levar a leitura operacional de vigencia das rubricas para os atalhos laterais de criacao e edicao, encurtando a navegacao da trilha `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/create.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar atalhos de vigencia ativa, futura e encerrada na tela de criacao;
- adaptar a tela de edicao para abrir a mesma janela de vigencia da rubrica atual;
- cobrir a navegacao contextual com testes focados de CRUD;
- registrar a rodada na documentacao operacional.

**Resultado:**
- a tela de criacao passou a oferecer atalhos diretos para rubricas com vigencia ativa, futura e encerrada;
- a tela de edicao agora aponta para a mesma janela de vigencia da rubrica aberta;
- os atalhos contextuais seguem integrados aos links de status, tipo, incidencias e codigo eSocial;
- testes focados de CRUD passaram a cobrir a nova navegacao lateral.

### PRODUTO-S1010-VIGENCIA-OPERACIONAL-RUBRICAS - 24/04/2026

**Descricao:**
Expandir a leitura operacional das rubricas com filtro e atalhos por status de vigencia para acelerar a revisao manual da base `S-1010`.

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
- calcular status de vigencia `ativa`, `futura` e `encerrada` na listagem de rubricas;
- adicionar cards operacionais para cada janela de vigencia;
- incluir filtro `vigencia` no formulario principal e no resumo de filtros ativos;
- cobrir a nova leitura com testes focados.

**Resultado:**
- a listagem de rubricas passou a exibir atalhos por vigencia `ativa`, `futura` e `encerrada`;
- o formulario principal agora permite filtrar a base por janela de vigencia;
- a tabela mostra badge operacional de vigencia para cada rubrica;
- testes focados cobrem links, filtro selecionado e resumo de filtros ativos.

### PRODUTO-RUBRICAS-ATALHOS-REVISAO-S1010 - 22/04/2026

**Descricao:**
Adicionar atalhos de revisao S-1010 na tela de edicao de rubrica para retornar rapidamente ao painel eSocial filtrado e as pendencias de rubricas sem codigo.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar bloco de revisao S-1010 na edicao de rubrica;
- incluir atalho para painel eSocial filtrado por `S-1010`;
- incluir atalho para rubricas sem codigo eSocial;
- cobrir os links com teste de feature.

**Resultado:**
- edicao de rubrica ganhou bloco `Revisao S-1010`;
- tela passou a abrir o painel eSocial filtrado por `S-1010`;
- tela tambem leva direto as pendencias de rubricas sem codigo eSocial;
- testes focados de rubricas e painel eSocial ficaram verdes.

### PRODUTO-DETALHE-ESOCIAL-ATALHO-SERVIDOR - 22/04/2026

**Descricao:**
Adicionar no detalhe do evento eSocial um atalho para abrir o detalhe do servidor vinculado quando o evento estiver relacionado a um vinculo funcional.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- exibir acao `Abrir servidor` apenas quando o evento possuir servidor vinculado;
- apontar para `servidores.show`;
- preservar eventos institucionais sem botao inaplicavel;
- cobrir o atalho com teste de feature.

**Resultado:**
- detalhe eSocial passou a exibir `Abrir servidor` quando o evento tem vinculo funcional;
- eventos institucionais continuam sem acao de servidor;
- navegacao eSocial -> RH ficou direta para validacao manual;
- testes focados confirmaram o link e o detalhe do servidor.

### PRODUTO-SERVIDOR-ATALHO-DETALHE-EVENTO - 22/04/2026

**Descricao:**
Adicionar no detalhe do servidor um atalho para abrir o detalhe de cada evento eSocial vinculado, melhorando a rastreabilidade entre RH e painel eSocial.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/servidores/show.blade.php`
- `backend/FolhaNova/tests/Feature/ServidorDetailTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir link `Detalhar evento` em cada evento vinculado ao servidor;
- apontar para `eventos-esocial.show`;
- preservar a leitura atual de status, ambiente e data;
- cobrir o link com teste de feature.

**Resultado:**
- detalhe do servidor passou a abrir diretamente o detalhe de eventos eSocial vinculados;
- leitura de status, ambiente e data dos eventos foi preservada;
- rastreabilidade RH -> eSocial ficou mais direta para validacao manual;
- testes focados confirmaram o link e a tela de detalhe eSocial.

### PRODUTO-DETALHE-ESOCIAL-ATALHO-AMBIENTE - 22/04/2026

**Descricao:**
Adicionar atalho no detalhe de evento eSocial para retornar ao painel filtrado pelo mesmo ambiente do evento atual.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar link `Mesmo ambiente` no detalhe eSocial;
- apontar para o painel com filtro `ambiente`;
- preservar atalhos existentes de evento e status;
- cobrir o link com teste de feature.

**Resultado:**
- detalhe do evento eSocial ganhou atalho `Mesmo ambiente`;
- link retorna ao painel filtrado por `homologacao` ou `producao`;
- atalhos existentes por evento e status foram preservados;
- testes focados confirmaram a navegacao entre detalhe e painel.

### PRODUTO-PAINEL-ESOCIAL-ATALHOS-AMBIENTE - 22/04/2026

**Descricao:**
Adicionar atalhos e contagens por ambiente no painel eSocial para separar rapidamente eventos de `homologacao` e `producao`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular contagens por ambiente no resumo do painel;
- exibir cards para `Homologacao` e `Producao`;
- apontar os cards para o filtro `ambiente`;
- cobrir os links e a filtragem com teste de feature.

**Resultado:**
- painel eSocial passou a exibir cards para ambientes `Homologacao` e `Producao`;
- cada card mostra a contagem do tenant atual e abre a listagem filtrada;
- resumo de filtros ativos exibe o ambiente selecionado;
- teste focado confirmou os links e a filtragem por ambiente.

### PRODUTO-DASHBOARD-TRIAGEM-ESOCIAL - 22/04/2026

**Descricao:**
Adicionar no dashboard um bloco de triagem eSocial com atalhos diretos para eventos com erro, pendentes e com retorno, aproveitando os filtros operacionais do painel.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir bloco compacto de triagem eSocial no dashboard;
- apontar atalhos para filtros `erro`, `pendente` e `retorno=com_mensagem`;
- preservar os cards e atalhos existentes;
- cobrir os links com teste de feature.

**Resultado:**
- dashboard ganhou bloco `Triagem eSocial` com leitura da fila operacional;
- atalhos apontam para eventos com erro, pendentes e com retorno;
- contagens existentes foram reaproveitadas sem alterar controller ou banco;
- teste focado confirmou os links e a permanencia dos atalhos existentes.

### PRODUTO-PAINEL-ESOCIAL-FILTROS-ATIVOS - 22/04/2026

**Descricao:**
Exibir resumo dos filtros ativos no painel eSocial para facilitar validacao manual e evitar confusao ao navegar por atalhos de status, evento, ambiente ou retorno.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- montar resumo visual dos filtros ativos na view;
- incluir busca, evento, status, ambiente e retorno quando preenchidos;
- manter o link `Limpar` apontando para a listagem sem query string;
- cobrir o comportamento com teste de feature.

**Resultado:**
- painel eSocial passou a exibir bloco `Filtros ativos` quando ha filtros aplicados;
- busca, evento, status, ambiente e retorno aparecem como badges operacionais;
- bloco inclui acao `Limpar filtros` para voltar a listagem completa;
- teste focado confirmou filtros combinados e link de limpeza.

### PRODUTO-PAINEL-ESOCIAL-RETORNO-NA-LISTA - 22/04/2026

**Descricao:**
Exibir resumo da mensagem de retorno diretamente na listagem do painel eSocial para acelerar a triagem de eventos com erro ou retorno registrado.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar coluna/resumo de retorno na tabela do painel;
- truncar mensagens longas para manter a leitura da listagem;
- manter o detalhe como local do retorno completo;
- cobrir a exibicao com teste de feature.

**Resultado:**
- painel eSocial passou a exibir uma coluna `Retorno` na listagem;
- eventos com mensagem mostram resumo truncado para triagem rapida;
- eventos sem retorno exibem `Sem retorno registrado`;
- detalhe do evento permanece como local para auditoria completa do retorno e payload.

### PRODUTO-PAINEL-ESOCIAL-REPROCESSAR-NA-LISTA - 22/04/2026

**Descricao:**
Adicionar acao de reprocessamento local diretamente na listagem do painel eSocial para eventos com erro, mantendo o detalhe como tela de auditoria completa.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- exibir botao `Reprocessar` apenas em eventos com status `erro`;
- reutilizar a rota e o service de reprocessamento existentes;
- cobrir a acao visivel na listagem com teste de feature;
- validar a suite adjacente de detalhe e reprocessamento.

**Resultado:**
- painel eSocial passou a exibir `Reprocessar` diretamente na listagem para eventos com erro;
- eventos pendentes ou processados continuam sem acao de reprocessamento na lista;
- rota e service existentes foram reaproveitados sem alterar contrato de backend;
- testes focados confirmaram a visibilidade da acao e o fluxo de reprocessamento local.

### PRODUTO-S1010-ATALHO-PAINEL-EVENTOS - 22/04/2026

**Descricao:**
Adicionar atalho operacional da tela de rubricas para o painel eSocial filtrado por `S-1010`, facilitando a validacao manual da trilha de rubricas.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir acao para abrir painel de eventos filtrado por `S-1010`;
- manter os filtros existentes de rubricas por codigo eSocial;
- cobrir o atalho com teste de feature;
- registrar a entrega na documentacao.

**Resultado:**
- tela de rubricas passou a ter atalho direto para o painel eSocial filtrado por `S-1010`;
- filtros existentes de rubricas foram preservados;
- teste focado confirmou o link para a trilha de eventos de rubricas;
- suite adjacente do painel eSocial seguiu verde.

### PRODUTO-S1000-ATALHO-PAINEL-EVENTOS - 22/04/2026

**Descricao:**
Adicionar atalho operacional da tela de orgao publico para o painel eSocial filtrado por `S-1000`, facilitando a validacao manual da trilha institucional.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir acao para abrir o painel de eventos filtrado por `S-1000`;
- manter o link de detalhe do evento atual quando existir;
- cobrir o atalho com teste de feature;
- registrar a entrega na documentacao.

**Resultado:**
- tela de orgao publico passou a ter atalho direto para o painel eSocial filtrado por `S-1000`;
- card do evento atual tambem permite abrir a lista filtrada da trilha institucional;
- link de detalhe do evento `S-1000` foi preservado;
- teste focado confirmou o atalho e a integracao visual com o painel de eventos.

### PRODUTO-SERVIDORES-REMOVE-ATALHO-S2205-QUEBRADO - 22/04/2026

**Descricao:**
Corrigir links quebrados para a rota futura de `S-2205` nas telas de servidores, preservando a indicacao operacional sem gerar erro em runtime.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/resources/views/servidores/edit.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/contract-form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- remover chamadas a rota inexistente `servidores.edit-cadastral`;
- exibir `S-2205` como trilha planejada, sem link acionavel;
- validar a listagem de servidores e tela de edicao contratual;
- registrar a correcao na documentacao.

**Resultado:**
- listagem de servidores deixou de renderizar link para rota futura inexistente;
- tela S-2206 passou a exibir `S-2205` como trilha planejada;
- criado partial contratual para a tela de alteracao, preservando dados civis atuais sem exibi-los no fluxo S-2206;
- controller passou a carregar historico eSocial na edicao contratual;
- testes focados de servidores ficaram verdes.

### PRODUTO-DASHBOARD-DEMO-ATALHOS-REAIS - 22/04/2026

**Descricao:**
Conectar o dashboard operacional aos dados reais do tenant e exibir atalhos para validacao manual da massa demo.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- substituir dashboard estatico por controller com resumo por tenant;
- exibir contagens reais de servidores, eventos e rubricas;
- adicionar atalhos para orgao publico, rubricas e eventos eSocial;
- cobrir dashboard com teste de feature;
- registrar a entrega na documentacao.

**Resultado:**
- dashboard passou a usar contagens reais do tenant autenticado;
- cards principais apontam para filtros operacionais;
- tela ganhou atalhos para validar orgao publico, rubricas e painel eSocial;
- teste focado confirmou a leitura e os links do dashboard.

### PRODUTO-DADOS-DEMO-VALIDACAO-MANUAL - 22/04/2026

**Descricao:**
Criar massa de dados demo para validacao manual local dos fluxos de login, cadastros de RH, rubricas e painel eSocial.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/database/seeders/DatabaseSeeder.php`
- `backend/FolhaNova/database/seeders/DemoDataSeeder.php`
- `backend/FolhaNova/tests/Feature/DemoDataSeederTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- criar seeder demo idempotente;
- vincular `test@example.com` a um tenant demo;
- popular orgao publico, lotacoes, cargos, funcoes, servidores, rubricas e eventos eSocial;
- cobrir o seeder com teste automatizado;
- executar `php artisan db:seed` no banco local para teste manual.

**Resultado:**
- criado tenant `Prefeitura Demonstracao`;
- login demo `test@example.com` preservado com senha `password`;
- criados dados para servidores, rubricas e eventos `S-1000`, `S-1010` e `S-2200`;
- `php artisan db:seed` executado com sucesso no banco local.

### PRODUTO-PAINEL-ESOCIAL-FILTRO-COM-RETORNO - 22/04/2026

**Descricao:**
Adicionar atalho e filtro operacional para eventos eSocial com mensagem de retorno registrada.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar filtro `retorno=com_mensagem`;
- listar apenas eventos com `mensagem_retorno`;
- exibir card operacional `Com retorno`;
- cobrir comportamento com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- painel eSocial passou a aceitar filtro `retorno=com_mensagem`;
- card `Com retorno` exibe a contagem de eventos com mensagem registrada;
- listagem filtrada oculta eventos sem `mensagem_retorno`;
- teste focado confirmou o link e o filtro operacional.

### PRODUTO-DETALHE-ESOCIAL-ATALHOS-CONTEXTO - 22/04/2026

**Descricao:**
Adicionar atalhos contextuais na tela de detalhe do evento eSocial para retornar ao painel filtrado pelo mesmo evento ou pelo mesmo status.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- preservar o botao geral de retorno ao painel;
- adicionar atalhos para `evento` e `status` atuais;
- cobrir os links com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- detalhe do evento passou a oferecer atalhos `Mesmo evento` e `Mesmo status`;
- links retornam ao painel com filtros preservados por query string;
- fluxo de reprocessamento local foi preservado;
- teste focado confirmou os links contextuais no detalhe.

### PRODUTO-PAINEL-ESOCIAL-ATALHOS-EVENTOS-PRIORITARIOS - 22/04/2026

**Descricao:**
Adicionar atalhos operacionais por tipo de evento prioritario no painel eSocial, facilitando a leitura de `S-1000`, `S-1010` e `S-2200`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular contagem dos eventos prioritarios no resumo do painel;
- exibir atalhos para `S-1000`, `S-1010` e `S-2200`;
- apontar cada atalho para a listagem filtrada por `evento`;
- cobrir o comportamento com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- painel eSocial passou a exibir atalhos por evento prioritario;
- cards de `S-1000`, `S-1010` e `S-2200` apontam para a listagem filtrada;
- contagens respeitam o tenant atual;
- teste focado confirmou links e filtragem por `evento`.

### PRODUTO-S1010-FILTRO-SEM-CODIGO-ESOCIAL - 22/04/2026

**Descricao:**
Adicionar filtro operacional para listar rubricas sem codigo eSocial, evidenciando pendencias de parametrizacao para preparacao do `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar filtro `esocial=sem_codigo`;
- listar apenas rubricas sem `codigo_esocial`;
- adicionar leitura de pendencias no resumo e no select da tela;
- cobrir comportamento com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- listagem de rubricas passou a aceitar filtro `esocial=sem_codigo`;
- tela ganhou card operacional de rubricas sem codigo eSocial;
- select de eSocial passou a permitir alternar entre todas, com codigo e sem codigo;
- teste focado confirmou que rubricas parametrizadas ficam fora da listagem de pendencias.

### PRODUTO-S1000-STATUS-VIGENCIA-INSTITUCIONAL - 22/04/2026

**Descricao:**
Melhorar o controle operacional da vigencia do `S-1000` exibindo status claro da janela institucional no modulo de orgao publico.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/OrgaoPublicoController.php`
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular status da vigencia a partir de `inicio_validade` e `fim_validade`;
- exibir o status no resumo e na configuracao eSocial do orgao publico;
- cobrir vigencia futura e encerrada com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- tela de orgao publico passou a exibir status de vigencia do `S-1000`;
- status diferencia vigencia ativa, futura, encerrada e nao definida;
- resumo e bloco de configuracao eSocial foram alinhados para a leitura operacional;
- teste focado confirmou vigencia ativa, futura e encerrada.

### PRODUTO-S1000-VALIDACAO-DOCUMENTO-EMPREGADOR - 22/04/2026

**Descricao:**
Aprofundar a validacao institucional do `S-1000`, rejeitando CPF/CNPJ invalidos por digito verificador no cadastro do orgao publico antes da geracao de evento pendente.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- manter a normalizacao e formatacao atuais de inscricao institucional;
- validar CPF/CNPJ por digito verificador conforme `tipo_inscricao`;
- validar CPF do contato quando informado;
- cobrir rejeicoes com teste de feature;
- validar orgao publico, login e frontend antes de concluir.

**Resultado:**
- CPF e CNPJ completos informados no cadastro do orgao publico passaram a ser validados por digito verificador;
- CPF do contato responsavel tambem passou a ser rejeitado quando invalido;
- CNPJ raiz de 8 digitos continua aceito para o contexto ja suportado pelo fluxo do `S-1000`;
- teste focado confirmou rejeicao de documento institucional e CPF de contato invalidos.

### PRODUTO-PAINEL-ESOCIAL-ATALHO-PROCESSADOS - 21/04/2026

**Descricao:**
Transformar o indicador `Processados` do painel eSocial em atalho operacional para a listagem filtrada por eventos processados.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- preservar a leitura visual do card `Processados`;
- adicionar link para `eventos-esocial.index?status=processado`;
- cobrir o atalho com teste de feature;
- validar painel, login e frontend antes de concluir.

**Resultado:**
- card `Processados` passou a funcionar como atalho para a listagem filtrada por `status=processado`;
- leitura visual do resumo foi preservada;
- teste focado confirma o link operacional para eventos processados;
- validacao focada do painel passou com `10` testes e `37` assercoes.

### PRODUTO-PAINEL-ESOCIAL-ATALHO-PENDENTES - 21/04/2026

**Descricao:**
Transformar o indicador `Pendentes` do painel eSocial em atalho operacional para a listagem filtrada por eventos pendentes.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- preservar a leitura visual do card `Pendentes`;
- adicionar link para `eventos-esocial.index?status=pendente`;
- cobrir o atalho com teste de feature;
- validar painel, login e frontend antes de concluir.

**Resultado:**
- card `Pendentes` passou a funcionar como atalho para a listagem filtrada por `status=pendente`;
- leitura visual do resumo foi preservada;
- teste focado confirma o link operacional para eventos pendentes;
- validacao focada do painel passou com `9` testes e `33` assercoes.

### PRODUTO-S1010-FILTRO-CODIGO-ESOCIAL - 21/04/2026

**Descricao:**
Adicionar filtro operacional para listar rubricas que ja possuem codigo eSocial, facilitando a preparacao gradual do `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar filtro `esocial` somente para rubricas com codigo eSocial;
- aplicar o filtro usando o campo `codigo_esocial` existente;
- transformar o card `Com codigo eSocial` em atalho para o filtro;
- cobrir o comportamento com teste de feature;
- validar rubricas, login e frontend antes de concluir.

**Resultado:**
- listagem de rubricas passou a filtrar registros com `codigo_esocial`;
- card `Com codigo eSocial` passou a abrir a listagem filtrada;
- tela ganhou filtro dedicado de eSocial sem mudanca de banco;
- validacao focada de rubricas passou com `9` testes e `35` assercoes.

### PRODUTO-S1000-ATALHO-DETALHE-EVENTO - 21/04/2026

**Descricao:**
Adicionar atalho da tela de parametros do orgao publico para o detalhe do evento `S-1000` no painel eSocial.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- exibir o atalho apenas quando existir evento `S-1000`;
- preservar o card atual da trilha do S-1000;
- cobrir o link com teste de feature;
- validar orgao publico, login e frontend antes de concluir.

**Resultado:**
- tela de parametros do orgao publico passou a exibir atalho para detalhar o evento `S-1000`;
- o link aparece apenas quando existe evento preparado;
- card da trilha do S-1000 foi preservado;
- validacao focada de `OrgaoPublicoTest` passou com `9` testes e `43` assercoes.

### PRODUTO-PAINEL-ESOCIAL-ATALHO-ERROS - 21/04/2026

**Descricao:**
Transformar o indicador `Com erro` do painel eSocial em atalho operacional para a listagem filtrada por eventos com erro.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- preservar a leitura visual do card `Com erro`;
- adicionar link para `eventos-esocial.index?status=erro`;
- cobrir o atalho com teste de feature;
- validar painel, login e frontend antes de concluir.

**Resultado:**
- card `Com erro` passou a funcionar como atalho para a listagem filtrada por `status=erro`;
- leitura visual do resumo foi preservada;
- teste focado confirma o link operacional para eventos com erro;
- validacao focada do painel passou com `8` testes e `29` assercoes.

### PRODUTO-S1010-FILTRO-INCIDENCIA-RUBRICA - 21/04/2026

**Descricao:**
Adicionar filtro por incidencia na listagem de rubricas para facilitar a auditoria operacional de IRRF, INSS e FGTS na preparacao do `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar filtro `incidencia` somente para `irrf`, `inss` e `fgts`;
- aplicar o filtro na listagem usando os campos booleanos existentes;
- adicionar select visual no bloco de filtros;
- cobrir comportamento com teste de feature;
- validar rubricas, login e frontend antes de concluir.

**Resultado:**
- listagem de rubricas passou a filtrar por incidencias de IRRF, INSS e FGTS;
- o filtro usa apenas os campos booleanos existentes, sem mudanca de banco;
- tela ganhou select dedicado para incidencia;
- teste focado confirmou que `incidencia=irrf` exibe somente rubricas com IRRF;
- validacao focada de rubricas passou com `8` testes e `30` assercoes.

### PRODUTO-S1000-CLASSIFICACAO-TRIBUTARIA-CONTROLADA - 21/04/2026

**Descricao:**
Evoluir o modulo de parametros do orgao publico para deixar `classTrib` menos livre, usando uma lista inicial controlada de classificacoes tributarias suportadas nesta etapa do `S-1000`.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- restringir `classificacao_tributaria` aos codigos atualmente suportados pelo produto;
- trocar o campo livre da tela por select;
- cobrir rejeicao de codigo nao mapeado por teste;
- validar login, frontend e suite focada antes de concluir.

**Resultado:**
- `classificacao_tributaria` passou a aceitar apenas a lista inicial controlada pelo produto;
- a tela de parametros do orgao publico passou a usar select para `classTrib`;
- codigo nao mapeado deixa de gerar evento `S-1000` pendente;
- validacao focada de `OrgaoPublicoTest` passou com `7` testes e `38` assercoes.

### PRODUTO-S1010-NORMALIZACAO-RUBRICAS - 21/04/2026

**Descricao:**
Normalizar entradas do cadastro de rubricas antes da validacao para evitar duplicidade mascarada por espacos e manter `natRubr` como codigo limpo no fluxo do `S-1010`.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aplicar `trim` nos campos principais antes da validacao;
- converter `codigo_esocial` vazio em `null`;
- impedir que `codigo` com espacos burle a unicidade por tenant;
- validar rubricas, login e frontend antes de concluir.

**Resultado:**
- requests de criacao e edicao de rubricas passaram a normalizar campos antes da validacao;
- duplicidade de codigo por tenant com espacos ao redor passou a ser barrada pela validacao;
- validacao focada de rubricas passou com `6` testes e `22` assercoes;
- login e assets compilados permaneceram operacionais.

### PRODUTO-S1010-FILTRO-TIPO-RUBRICA - 21/04/2026

**Descricao:**
Adicionar filtro por tipo na listagem de rubricas para facilitar a operacao de proventos, descontos e verbas informativas na preparacao do `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar filtro `tipo` somente para valores conhecidos;
- aplicar filtro na query de listagem;
- adicionar select visual na tela;
- cobrir comportamento com teste de feature;
- validar rubricas, login e frontend antes de concluir.

**Resultado:**
- listagem de rubricas passou a filtrar por `provento`, `desconto` e `informativa`;
- tela ganhou select dedicado para tipo de rubrica;
- teste focado confirmou que `tipo=desconto` oculta rubricas de provento;
- validação de rubricas passou com `7` testes e `26` assercoes.

### PRODUTO-PAINEL-ESOCIAL-RESUMO-ERROS - 21/04/2026

**Descricao:**
Evoluir o painel operacional de eventos eSocial com um indicador de eventos com erro para orientar o reprocessamento local.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar contagem de eventos com `status = erro` ao resumo;
- exibir card dedicado no painel;
- validar isolamento por tenant;
- rodar testes focados do painel, login e assets compilados.

**Resultado:**
- painel eSocial passou a exibir card `Com erro`;
- contagem considera apenas eventos do tenant atual;
- teste focado confirmou o resumo de erros;
- validação do painel passou com `7` testes e `25` assercoes.

### PRODUTO-PAINEL-ESOCIAL-ORIENTACAO-REPROCESSAMENTO - 21/04/2026

**Descricao:**
Melhorar a tela de detalhe de eventos eSocial com uma orientacao direta para eventos com erro que podem ser reenfileirados para reprocessamento local.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- exibir orientacao apenas quando `status = erro`;
- manter a acao de reprocessamento existente;
- cobrir a leitura operacional com teste de feature;
- validar painel, login e frontend antes de concluir.

**Resultado:**
- detalhe do evento com erro passou a explicar o reprocessamento local;
- acao de reprocessamento existente foi preservada sem mudanca de regra;
- validacao focada do painel passou com `8` testes e `28` assercoes;
- login e assets compilados permaneceram operacionais.

### PRODUTO-S1000-LEITURA-CLASSIFICACAO-TRIBUTARIA - 21/04/2026

**Descricao:**
Melhorar a leitura operacional da tela de orgao publico exibindo a descricao da classificacao tributaria junto ao codigo do `S-1000`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- mapear os codigos atualmente suportados para labels legiveis;
- manter fallback para codigo nao mapeado;
- cobrir a exibicao por teste de feature;
- validar login, frontend e suite focada antes de concluir.

**Resultado:**
- tela de orgao publico passou a exibir codigo e descricao da classificacao tributaria;
- fallback para codigo nao mapeado foi preservado;
- validacao focada de `OrgaoPublicoTest` passou com `8` testes e `40` assercoes;
- autenticacao permaneceu validada com `5` testes e `15` assercoes.

# FolhaNova - Backlog Geral
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

### RETOMADA-OPERACIONAL-AMBIENTE-LOCAL - 21/04/2026

**Descricao:**
Retomar o contexto do projeto pela documentacao vigente, colocar backend e Vite no ar no `WSL Ubuntu 24.04` e validar a disponibilidade basica da tela de login.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/workflow/fluxo-de-producao-e-seguranca.md`
- `docs/performance/metricas-validacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- `backend/FolhaNova/scripts/run_backend_detached.sh`
- `backend/FolhaNova/scripts/run_vite_detached.sh`
- `backend/FolhaNova/scripts/ensure_local_login.php`

**Resultado:**
- backend Laravel iniciado em `http://127.0.0.1:8000`
- Vite iniciado em `http://127.0.0.1:5173`
- `/login` respondeu `200 OK`
- conta local `test@example.com` garantida para validacao manual
- registrada divergencia operacional: ambiente atual reportou `cache=file` e `session=file`, enquanto registros anteriores citavam `database`

### INCIDENTE-FRONTEND-HOT-VITE - 21/04/2026

**Descricao:**
Corrigir quebra visual do frontend causada pela presenca de `public/hot`, que fazia o Laravel priorizar o Vite dev server em vez dos assets compilados estaveis em `public/build`.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/public/hot`
- `backend/FolhaNova/public/build/manifest.json`
- `backend/FolhaNova/resources/views/components/layouts/auth-login.blade.php`
- `backend/FolhaNova/vite.config.js`
- `docs/frontend/recuperacao-login-layout.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**  
- manter build de producao como fonte estavel para validacao local;
- parar o Vite dev server nesta rodada;
- remover `public/hot`;
- validar que `/login` referencia `/build/assets`;
- registrar a decisao operacional antes de retomar novas features.

**Resultado:**
- `npm run build` executado com sucesso no WSL Ubuntu 24.04;
- `public/hot` removido para impedir que o Laravel priorize o Vite dev server;
- `/login` voltou a referenciar `public/build/assets`;
- CSS compilado respondeu `200` com `110503` bytes;
- JS compilado respondeu `200` com `37977` bytes;
- suite focada de autenticacao e navegacao passou com `7` testes e `19` assercoes.

### PRODUTO-S1010-NATUREZA-RUBRICA - 21/04/2026

**Descricao:**  
Aproximar o cadastro de rubricas do `S-1010`, tratando a natureza da rubrica como codigo oficial `natRubr` de 4 digitos, sem abrir mudanca estrutural de banco nesta rodada.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/app/Services/Rubricas/RegistrarRubricaService.php`
- `backend/FolhaNova/app/Services/Rubricas/AtualizarRubricaService.php`
- `backend/FolhaNova/resources/views/rubricas/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- `natureza` passou a aceitar apenas codigo numerico de 4 digitos;
- tela passou a rotular o campo como `Natureza eSocial (natRubr)`;
- listagem passou a explicitar a leitura operacional da natureza eSocial;
- teste focado cobre rejeicao de natureza textual;
- validacao focada de rubricas passou com `5` testes e `17` assercoes.

### PRODUTO-PAINEL-ESOCIAL-REPROCESSAMENTO-LOCAL - 21/04/2026

**Descricao:**
Evoluir o painel operacional de eventos eSocial com uma primeira acao segura de reprocessamento local para eventos com erro, sem implementar transmissao governamental nesta rodada.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/app/Services/EventosEsocial/ReprocessarEventoEsocialService.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/fluxos-do-usuario.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/esocial/mapeamento-esocial.md`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**
- eventos com `status = erro` podem voltar para `pendente` pela tela de detalhe;
- payload original e vinculos operacionais sao preservados;
- protocolo, recibo, mensagem de retorno e timestamps de envio/processamento sao limpos;
- eventos processados nao sao reenfileirados nesta etapa para evitar perda indevida de recibo.

### PRODUTO-FLUXO-SEGURANCA-OPERACIONAL - 20/04/2026

**Descricao:**  
Formalizar um fluxo seguro de evolucao e liberacao local para evitar regressao recorrente de login, ambiente, build e modulo quebrado durante o desenvolvimento.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/workflow/fluxo-de-producao-e-seguranca.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- fluxo oficial passou a exigir gates minimos de ambiente, login, build e testes
- ficou explicita a politica de incidente
- o projeto passou a diferenciar desenvolvimento, homologacao local e producao futura

### PRODUTO-S1000-PAYLOAD-CONSISTENTE - 20/04/2026

**Descricao:**  
Sanear o payload institucional do `S-1000` para evitar serializacao de blocos vazios e remover `natJurid` quando a inscricao institucional for por `CPF`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- payload do `S-1000` ficou mais consistente para a futura camada de integracao
- bloco `contato` deixou de ser enviado quando vazio
- `natJurid` deixou de ser serializado em inscricoes institucionais por `CPF`

### PRODUTO-S1000-LEITURA-OPERACIONAL - 20/04/2026

**Descricao:**  
Ajustar a leitura operacional da tela de `OrgaoPublico` para refletir corretamente cenarios por `CPF` e deixar a vigencia institucional mais clara para o usuario.

**Status:** Concluido  
**Prioridade:** Media  
**Arquivos envolvidos:**  
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- a tela passou a informar quando `natureza juridica` nao se aplica ao contexto por `CPF`
- a vigencia passou a ficar mais legivel para leitura operacional
- o comportamento ficou coberto por teste de feature

### PRODUTO-S1000-VALIDACOES-INSTITUCIONAIS - 20/04/2026

**Descricao:**  
Reforcar o modulo de parametros do orgao publico com validacoes mais consistentes para a trilha `S-1000`, exigindo `classificacao tributaria` e `natureza juridica` quando a inscricao institucional for por `CNPJ`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- validacao institucional do `S-1000` ficou mais aderente a base documental do projeto
- atualizacao invalida deixou de gerar evento pendente inconsistente
- tela passou a sinalizar melhor os campos estruturais essenciais

### PRODUTO-MODULO-CARGOS-E-FUNCOES-INICIAL - 20/04/2026

**Descricao:**  
Abrir os modulos `Cargos` e `Funcoes` com listagem, cadastro e edicao responsivos, seguindo o mesmo padrao arquitetural de `Lotacoes` e reforcando a base estrutural do RH e dos eventos `S-1030` e `S-1040`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Controllers/CargoController.php`
- `backend/FolhaNova/app/Http/Controllers/FuncaoController.php`
- `backend/FolhaNova/app/Http/Requests/StoreCargoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateCargoRequest.php`
- `backend/FolhaNova/app/Http/Requests/StoreFuncaoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateFuncaoRequest.php`
- `backend/FolhaNova/app/Services/Cargos/RegistrarCargoService.php`
- `backend/FolhaNova/app/Services/Cargos/AtualizarCargoService.php`
- `backend/FolhaNova/app/Services/Funcoes/RegistrarFuncaoService.php`
- `backend/FolhaNova/app/Services/Funcoes/AtualizarFuncaoService.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/livewire/layout/navigation.blade.php`
- `backend/FolhaNova/resources/views/cargos/*`
- `backend/FolhaNova/resources/views/funcoes/*`
- `backend/FolhaNova/tests/Feature/CargoCrudTest.php`
- `backend/FolhaNova/tests/Feature/CargosIndexTest.php`
- `backend/FolhaNova/tests/Feature/FuncaoCrudTest.php`
- `backend/FolhaNova/tests/Feature/FuncoesIndexTest.php`
- `docs/produto/visao-geral-do-sistema.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/produto/modulos-do-sistema.md`
- `docs/produto/backlog-funcional.md`
- `docs/produto/priorizacao.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- modulos `Cargos` e `Funcoes` entregues com operacao inicial real
- navegacao lateral conectada aos novos modulos
- validacao executada em WSL com `8` testes verdes e `28` assercoes nos novos modulos

### PRODUTO-MODULO-LOTACOES-INICIAL - 20/04/2026

**Descricao:**  
Abrir o modulo `Lotacoes` com listagem, cadastro e edicao responsivos, alinhando a estrutura organizacional do sistema com o dominio existente e com a necessidade de base para o `S-1005`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Controllers/LotacaoController.php`
- `backend/FolhaNova/app/Http/Requests/StoreLotacaoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateLotacaoRequest.php`
- `backend/FolhaNova/app/Services/Lotacoes/RegistrarLotacaoService.php`
- `backend/FolhaNova/app/Services/Lotacoes/AtualizarLotacaoService.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/livewire/layout/navigation.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/index.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/create.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/edit.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/partials/field.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/partials/select.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/LotacaoCrudTest.php`
- `backend/FolhaNova/tests/Feature/LotacoesIndexTest.php`
- `docs/produto/visao-geral-do-sistema.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/produto/modulos-do-sistema.md`
- `docs/produto/backlog-funcional.md`
- `docs/produto/priorizacao.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- modulo `Lotacoes` entregue com operacao inicial real
- navegacao lateral conectada ao novo modulo
- validacao executada em WSL com `5` testes verdes e `17` assercoes para o modulo

### PRODUTO-DETALHE-EDICAO-SERVIDOR - 20/04/2026

**Descricao:**  
Evoluir o modulo `Servidores` com tela de detalhe, edicao cadastral responsiva e sincronizacao segura do payload do `S-2200` pendente, mantendo o padrao arquitetural ja adotado no fluxo de admissao.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Requests/UpdateServidorRequest.php`
- `backend/FolhaNova/app/Services/Servidores/AtualizarServidorService.php`
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/resources/views/servidores/show.blade.php`
- `backend/FolhaNova/resources/views/servidores/edit.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/field.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/select.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/select-model.blade.php`
- `backend/FolhaNova/tests/Feature/ServidorDetailTest.php`
- `backend/FolhaNova/tests/Feature/ServidorAdmissaoTest.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `docs/produto/visao-geral-do-sistema.md`
- `docs/produto/modulos-do-sistema.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/produto/backlog-funcional.md`
- `docs/produto/priorizacao.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/produto/fluxos-do-usuario.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- modulo `Servidores` passou a ter leitura detalhada e manutencao cadastral
- payload do `S-2200` pendente agora pode ser sincronizado apos correcao de cadastro
- validacao executada em WSL com `6` testes verdes e `32` assercoes no modulo

### PRODUTO-FLUXO-ADMISSAO-SERVIDOR - 20/04/2026

**Descricao:**  
Mapear o estado funcional do produto, organizar a nova trilha `docs/produto` e implementar a proxima etapa operacional do sistema com um fluxo inicial de admissao de servidor alinhado ao `S-2200`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Requests/StoreServidorRequest.php`
- `backend/FolhaNova/app/Services/Servidores/RegistrarAdmissaoService.php`
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/resources/views/servidores/create.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/field.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/select.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/select-model.blade.php`
- `backend/FolhaNova/tests/Feature/ServidorAdmissaoTest.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `docs/produto/README.md`
- `docs/produto/visao-geral-do-sistema.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/produto/funcionalidades-planejadas.md`
- `docs/produto/backlog-funcional.md`
- `docs/produto/modulos-do-sistema.md`
- `docs/produto/priorizacao.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/produto/fluxos-do-usuario.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- nova trilha de produto criada para guiar a evolucao funcional do sistema
- fluxo inicial de admissao entregue com criacao de `Pessoa`, `Servidor` e evento `S-2200` pendente
- modulo `Servidores` passou a ter listagem e cadastro inicial real
- validacao executada em WSL com `4` testes verdes e `20` assercoes

### REBUILD-RESTART-LOCAL-PARA-TESTES - 19/04/2026

**Descrição:**  
Refazer o build da aplicação no WSL Ubuntu 24.04, recolocar backend e frontend no ar em `localhost` e validar a disponibilidade local para uma nova rodada de testes de performance.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- `docs/performance/metricas-validacao.md`
- `backend/FolhaNova/scripts/run_backend_detached.sh`
- `backend/FolhaNova/scripts/run_vite_detached.sh`

**Resultado:**  
- build frontend refeito com sucesso no WSL
- backend e Vite recolocados no ar em `127.0.0.1`
- `/login` validado com `200 OK`
- HTML final da tela de login apontando para `/build/assets`, sem dependência de `public/hot`

## Objetivo
Consolidar as tarefas macro do projeto em uma visão única de backlog priorizado, alinhada ao estado real da aplicação e à documentação estratégica já produzida.

### DIAGNOSTICO-PERFORMANCE-FLUXOS-CRITICOS - 19/04/2026

**Descrição:**  
Investigar a performance fim a fim dos fluxos de carregamento inicial, login, autenticação, dashboard e logout, consolidando diagnóstico técnico, stack atual, evidências, métricas e prioridades em uma nova trilha documental dedicada.

**Status:** Em andamento  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `docs/performance/README.md`
- `docs/performance/tecnologias-atuais.md`
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/analise-carregamento-inicial.md`
- `docs/performance/analise-login.md`
- `docs/performance/analise-dashboard.md`
- `docs/performance/analise-logout.md`
- `docs/performance/tarefas-performance.md`
- `docs/performance/plano-de-acao.md`
- `docs/performance/metricas-validacao.md`
- `docs/README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Evidência adicional consolidada:**  
- `GET /`: ~6,45s com wait dominante
- `GET /dashboard`: ~7,02s com wait dominante
- `GET /login`: ~3,29s com wait dominante
- `POST /livewire/update` no login: ~3,42s com wait dominante
- `POST /livewire/update` no logout: ~2,58s com wait dominante
- CSS, favicon e fonte rápidos em comparação, reduzindo a suspeita sobre assets como causa principal
- rodada controlada por HTTP confirmou alta variância entre requests frios e aquecidos
- `GET /dashboard` autenticado permaneceu caro mesmo após o login reproduzido via sessão HTTP
- cascata de `/` removida para guest
- logout alinhado para redirecionar direto a `/login`

### AJUSTE-NAVEGACAO-PERFORMANCE-INICIAL - 19/04/2026

**Descrição:**  
Reduzir hops desnecessários no fluxo HTTP inicial, fazendo guest em `/` ir direto para `/login` e fazendo logout redirecionar diretamente para `/login`, além de alinhar os testes automatizados ao comportamento atual.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/livewire/layout/navigation.blade.php`
- `backend/FolhaNova/tests/Feature/ExampleTest.php`
- `backend/FolhaNova/tests/Feature/Auth/AuthenticationTest.php`
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/metricas-validacao.md`
- `docs/performance/tarefas-performance.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

### OTIMIZACAO-BACKEND-LOCAL-PERFORMANCE - 19/04/2026

**Descrição:**  
Preparar a aplicação para operar melhor em modo otimizado local, removendo entraves evitáveis ao cache do Laravel, desabilitando Telescope por padrão e validando ganho de performance no login e no pós-login.

**Status:** Em andamento  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Controllers/RootRedirectController.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/bootstrap/providers.php`
- `backend/FolhaNova/config/telescope.php`
- `backend/FolhaNova/tests/Feature/ExampleTest.php`
- `backend/FolhaNova/tests/Feature/Auth/AuthenticationTest.php`
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/metricas-validacao.md`
- `docs/performance/tarefas-performance.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado parcial:**  
- runtime local otimizado com `APP_DEBUG=false`
- Telescope desabilitado por padrão
- cache e sessão validados em `database`
- dashboard com melhora relevante no pós-login

### CONSOLIDAR-BACKEND-NA-MAIN - 19/04/2026

**Descrição:**  
Integrar o conteúdo do repositório interno `backend/FolhaNova` na `main` do repositório raiz, preservando o histórico útil e fazendo a pasta backend passar a existir de fato no branch principal.

**Status:** Em andamento  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- `backend/FolhaNova`
- repositório raiz `RHevo`

### INTEGRAR-BRANCHES-NA-MAIN - 19/04/2026

**Descrição:**  
Investigar todas as branches relacionadas ao projeto e integrar na `main` as alterações necessárias para que o conteúdo do backend também passe a aparecer corretamente no branch principal.

**Status:** Em andamento  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- repositório raiz `RHevo`
- repositório interno `backend/FolhaNova`

### README-AMBIENTE-PRINCIPAL - 19/04/2026

**Descrição:**  
Atualizar o `README.md` principal do projeto para explicar com clareza o ambiente de desenvolvimento em Windows 11 com VS Code e o ambiente real de execução local e futura produção em Linux Ubuntu 24.04.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

### DIAGNOSTICO-PERFORMANCE-LOGIN - 19/04/2026

**Descrição:**  
Investigar e documentar a lentidão de carregamento da aplicação com foco inicial na tela de login, separando evidências, hipóteses, prioridades e plano de ação antes de qualquer nova correção no código.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `docs/05-performance/README.md`
- `docs/05-performance/PERFORMANCE-LOGIN.md`
- `docs/05-performance/DIAGNOSTICO-INICIAL.md`
- `docs/05-performance/ANALISE-TELA-LOGIN.md`
- `docs/05-performance/TAREFAS-PERFORMANCE.md`
- `docs/05-performance/PLANO-DE-ACAO.md`
- `docs/05-performance/METRICAS-E-VALIDACOES.md`
- `docs/README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

### COMMIT-PENDENCIAS-DOCUMENTAIS - 19/04/2026

**Descrição:**  
Realizar os commits pendentes dos arquivos de documentação e prompts já criados, agrupando-os por assunto e preservando fora do commit os itens não relacionados.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `FOLHANOVA-WORKFLOW.md`
- `FOLHANOVA-LOGIN-BOTAO-FIX.md`
- `docs/01-visao-projeto/README.md`
- `docs/02-requisitos/README.md`
- `docs/02-requisitos/REQUISITOS-FUNCIONAIS.md`
- `docs/03-arquitetura/README.md`
- `docs/04-ciberseguranca/README.md`
- `docs/04-ciberseguranca/CYBERSECURITY-BIBLE.md`
- `docs/05-performance/PERFORMANCE-BIBLE.md`
- `docs/06-engenharia-software/README.md`
- `docs/06-engenharia-software/ENGENHARIA-BIBLE.md`
- `docs/07-bug-prevention/README.md`
- `docs/07-bug-prevention/BUG-PREVENTION-BIBLE.md`
- `docs/08-esocial/README.md`
- `docs/08-esocial/ESOCIAL-DOCUMENTACAO-OFICIAL.md`
- `docs/09-project-organization/README.md`
- `docs/09-project-organization/PROJECT-ORGANIZER.md`
- `docs/09-project-organization/FOLHANOVA-DOCUMENTATION-STRUCTURE.md`
- `docs/10-tarefas-backlog/README.md`
- `docs/11-implementacao/README.md`
- `docs/11-implementacao/ROADMAP-FASES.md`
- `docs/obsidian/00-Index.md`
- `docs/obsidian/07-Ambiente-WSL-Ubuntu.md`
- `docs/obsidian/08-Linha-do-Tempo-Projeto.md`
- `docs/obsidian/09-Tasks-Login-Local.md`
- `docs/obsidian/10-Tasks-Macro-Projeto.md`
- `docs/obsidian/BUG-TRACKING.md`
- `docs/obsidian/FOLHANOVA-CYBERSECURITY.md`
- `docs/obsidian/FOLHANOVA-ENGENHARIA.md`
- `docs/obsidian/FOLHANOVA-PERFORMANCE.md`
- `docs/obsidian/FOLHANOVA-PROJECT-ORGANIZER.md`
- `docs/obsidian/projeto.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

### BUILD-WSL-VALIDACAO-LOGIN - 19/04/2026

**Descrição:**  
Refazer a validação de build da aplicação no WSL Ubuntu 24.04 para confirmar se o frontend do módulo de login compila corretamente após os ajustes recentes.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

### LOGIN-BOTAO-PERFORMANCE-FIX - 19/04/2026

**Descrição:**  
Corrigir o estado inicial do botão "Entrar" na página de login, garantir loading apenas após clique real e aplicar otimizações iniciais de performance no módulo de autenticação.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/05-performance/PERFORMANCE-LOGIN.md`
- `docs/05-performance/README.md`
- `docs/README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

### LOGIN-V2-ORGANIZADO - 19/04/2026

**Descrição:**  
Refazer a página de login com layout limpo e organizado, mantendo o formulário fixo em destaque e movendo os ícones 3D para um fundo sutil com animação flutuante.

**Status:** Concluído  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/app/Livewire/Forms/LoginForm.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

## Prioridade Atual
### 1. Estabilização local
- Fechar fluxo de subida local do backend e frontend.
- Garantir login, logout e navegação pós-login previsíveis.
- Consolidar procedimento oficial de ambiente WSL.

### 2. Fundação técnica
- Revisar aderência à arquitetura modular prometida.
- Organizar backlog de refatoração arquitetural.
- Consolidar models, migrations e relacionamentos centrais.

### 3. Segurança e conformidade
- Validar autenticação, autorização e isolamento por tenant.
- Revisar tratamento de dados sensíveis.
- Formalizar trilha de auditoria e gestão de segredos.

### 4. Qualidade e observabilidade
- Fechar lacunas da fase inicial.
- Revisar estratégia de testes.
- Definir baseline de logs, Telescope e check-up técnico.

### 5. Evolução funcional
- Preparar módulo de administração.
- Iniciar cadastro de servidor e base S-2200.
- Avançar depois para folha, tabelas eSocial e relatórios.

## Referência de Origem
Documento consolidado a partir de `docs/obsidian/10-Tasks-Macro-Projeto.md` e materiais correlatos de ambiente e arquitetura.
# FolhaNova - Backlog Geral
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versao:** 1.0

### PRODUTO-RUBRICAS-ATALHOS-INCIDENCIA - 23/04/2026

**Descricao:**
Adicionar cards operacionais por incidencia na listagem de rubricas para abrir rapidamente as bases com `IRRF`, `INSS` e `FGTS`.

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
- calcular contagem de rubricas por incidencia no resumo;
- exibir cards `IRRF`, `INSS` e `FGTS`;
- apontar cada card para o filtro `incidencia`;
- cobrir o comportamento com teste focado.

**Resultado:**
- listagem de rubricas passou a exibir cards por incidencia;
- cards `IRRF`, `INSS` e `FGTS` abrem a listagem filtrada;
- controller passou a calcular as contagens por incidencia no resumo;
- teste focado cobre os links e a filtragem por incidencia.

### PRODUTO-RUBRICAS-ATALHOS-TIPO - 23/04/2026

**Descricao:**
Adicionar cards operacionais por tipo na listagem de rubricas para abrir rapidamente `provento`, `desconto` e `informativa`.

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
- calcular contagem de rubricas por tipo no resumo;
- exibir cards `Provento`, `Desconto` e `Informativa`;
- apontar cada card para o filtro `tipo`;
- cobrir o comportamento com teste focado.

**Resultado:**
- listagem de rubricas passou a exibir cards por tipo;
- cards `Provento`, `Desconto` e `Informativa` abrem a listagem filtrada;
- controller passou a calcular as contagens por tipo no resumo;
- teste focado cobre os links e a filtragem por tipo.

### PRODUTO-DETALHE-ESOCIAL-ATALHO-RETORNO - 23/04/2026

**Descricao:**
Adicionar no detalhe do evento eSocial um atalho para retornar ao painel filtrado por eventos com o mesmo contexto de retorno do registro atual.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar atalho contextual de retorno no detalhe;
- apontar para `retorno=com_mensagem` ou `retorno=sem_mensagem`;
- preservar os atalhos existentes por evento, status e ambiente;
- cobrir o comportamento com teste focado.

**Resultado:**
- detalhe do evento eSocial passou a exibir atalho de retorno contextual;
- eventos com mensagem usam `retorno=com_mensagem`;
- eventos sem mensagem usam `retorno=sem_mensagem`;
- teste focado cobre os dois cenarios.

### PRODUTO-PAINEL-ESOCIAL-ATALHO-SEM-RETORNO - 23/04/2026

**Descricao:**
Adicionar card operacional para eventos eSocial sem mensagem de retorno registrada, alinhando o resumo do painel ao novo filtro `retorno=sem_mensagem`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular contagem de eventos sem retorno no resumo do painel;
- exibir card `Sem retorno`;
- apontar o card para `retorno=sem_mensagem`;
- cobrir o atalho com teste focado.

**Resultado:**
- painel eSocial passou a exibir card `Sem retorno`;
- card mostra a contagem de eventos sem mensagem registrada;
- atalho aponta para `retorno=sem_mensagem`;
- teste focado cobre o link operacional.

### PRODUTO-RUBRICAS-ATALHOS-STATUS - 23/04/2026

**Descricao:**
Transformar os indicadores `Ativas` e `Inativas` da listagem de rubricas em atalhos operacionais para os filtros de status.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- transformar os cards `Ativas` e `Inativas` em links;
- apontar para `status=ativos` e `status=inativos`;
- preservar a leitura visual da tela;
- cobrir os atalhos com teste focado.

**Resultado:**
- os cards `Ativas` e `Inativas` passaram a funcionar como atalhos;
- os links apontam para `status=ativos` e `status=inativos`;
- a leitura visual da listagem foi preservada;
- teste focado cobre os links e a filtragem por status.

### PRODUTO-RUBRICAS-FILTROS-ATIVOS - 23/04/2026

**Descricao:**
Exibir resumo dos filtros ativos na listagem de rubricas para facilitar revisao manual da base `S-1010`, especialmente pendencias sem codigo eSocial.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- montar resumo visual dos filtros ativos na view;
- incluir busca, status, tipo, incidencia e situacao eSocial;
- adicionar acao `Limpar filtros`;
- cobrir o comportamento com teste focado.

**Resultado:**
- listagem de rubricas passou a exibir bloco `Filtros ativos`;
- busca, status, tipo, incidencia e situacao eSocial aparecem como badges;
- bloco inclui acao `Limpar filtros`;
- teste focado cobre filtros combinados e link de limpeza.

### PRODUTO-PAINEL-ESOCIAL-FILTRO-SEM-RETORNO - 23/04/2026

**Descricao:**
Adicionar filtro operacional para eventos eSocial sem mensagem de retorno registrada, complementando o filtro existente de eventos com retorno.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar `retorno=sem_mensagem` no controller;
- listar apenas eventos sem `mensagem_retorno`;
- exibir opcao `Sem mensagem` no formulario;
- mostrar resumo de filtro ativo;
- cobrir o comportamento com teste focado.

**Resultado:**
- painel eSocial passou a aceitar `retorno=sem_mensagem`;
- listagem filtra eventos sem mensagem de retorno registrada;
- formulario exibe as opcoes `Com mensagem` e `Sem mensagem`;
- resumo de filtros ativos mostra `Retorno: Sem mensagem`;
- teste focado cobre a nova filtragem.

### PRODUTO-PAINEL-ESOCIAL-FILTRO-RETORNO-FORMULARIO - 23/04/2026

**Descricao:**
Adicionar o filtro de retorno diretamente no formulario do painel eSocial para permitir selecionar eventos com mensagem sem depender apenas do card de atalho.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir select `Retorno` no formulario de filtros do painel;
- reaproveitar o parametro existente `retorno=com_mensagem`;
- preservar o resumo de filtros ativos ja implementado;
- cobrir a opcao selecionada com teste focado.

**Resultado:**
- formulario do painel eSocial passou a exibir filtro `Retorno`;
- opcao `Com mensagem` reaproveita `retorno=com_mensagem`;
- resumo de filtros ativos continua exibindo `Retorno: Com mensagem`;
- teste focado passou a confirmar a opcao selecionada.

### PRODUTO-S1010-CODIGO-ESOCIAL-UNICO - 23/04/2026

**Descricao:**
Normalizar e validar a unicidade do codigo eSocial das rubricas no tenant para evitar parametrizacao duplicada na preparacao do `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/app/Services/Rubricas/RegistrarRubricaService.php`
- `backend/FolhaNova/app/Services/Rubricas/AtualizarRubricaService.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- normalizar `codigo_esocial` para caixa alta quando informado;
- rejeitar duplicidade de `codigo_esocial` dentro do mesmo tenant;
- preservar `null` para rubricas ainda sem parametrizacao;
- cobrir criacao duplicada com teste focado.

**Resultado:**
- `codigo_esocial` passou a ser normalizado em caixa alta na criacao e edicao de rubricas;
- duplicidade de codigo eSocial no mesmo tenant passou a ser bloqueada;
- rubricas sem codigo continuam permitidas como pendencia de parametrizacao;
- teste focado cobre duplicidade com variacao de caixa e espacos.

### PRODUTO-S1000-NATUREZA-JURIDICA-CPF - 23/04/2026

**Descricao:**
Normalizar a natureza juridica do `S-1000` para que inscricoes institucionais por CPF nao persistam `natJurid` no metadata nem no payload do evento.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- descartar `natureza_juridica` no service quando `tipo_inscricao = 2`;
- garantir que metadata e payload fiquem sem natureza juridica para CPF;
- cobrir o comportamento com teste focado do `S-1000`;
- registrar a regra na documentacao.

**Resultado:**
- inscricoes por CPF passaram a persistir `natureza_juridica = null` no metadata institucional;
- payload do `S-1000` segue sem `natJurid` para CPF;
- teste focado cobre envio indevido de natureza juridica em contexto CPF;
- regra registrada na documentacao funcional e eSocial.

### DIAGNOSTICO-PERFORMANCE-E-EVOLUCAO-ESOCIAL-INICIAL - 20/04/2026

**Descricao:**  
Revalidar a stack e o estado real de performance no runtime atual, consolidar a trilha documental de `docs/performance` e `docs/esocial`, aplicar uma otimizacao segura na primeira tela e abrir o primeiro modulo funcional de RH alinhado ao eSocial.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/resources/views/components/layouts/auth-login.blade.php`
- `backend/FolhaNova/resources/views/livewire/layout/navigation.blade.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/resources/js/auth-login.js`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `docs/performance/README.md`
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/tecnologias-atuais.md`
- `docs/performance/analise-primeira-pagina.md`
- `docs/performance/analise-pos-login.md`
- `docs/performance/analise-performance-geral.md`
- `docs/performance/plano-performance.md`
- `docs/performance/tarefas-performance.md`
- `docs/performance/metricas-validacao.md`
- `docs/esocial/README.md`
- `docs/esocial/escopo-funcional-rh.md`
- `docs/esocial/mapeamento-esocial.md`
- `docs/esocial/eventos-prioritarios.md`
- `docs/esocial/plano-de-implementacao.md`
- `docs/esocial/modelagem-funcional.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- runtime real revalidado com `debug=false`, `cache=database`, `session=database` e `sqlite`
- confirmado gargalo estrutural forte no bootstrap local do Laravel
- login passou a usar bundle JS dedicado, sem `axios` no primeiro acesso
- modulo inicial de `Servidores` entregue com filtros, resumo operacional e eager loading
- nova suite `ServidoresIndexTest` aprovada em WSL
### DOCS-ALINHAMENTO-WORKFLOW-E-PLANOS - 20/04/2026

**Descricao:**  
Consolidar o fluxo oficial de desenvolvimento do projeto, incorporando regras mais fortes de leitura previa, diagnostico, plano antes da alteracao, validacao e documentacao, alem de alinhar a precedencia entre `docs/produto/` e `docs/esocial/`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/produto/priorizacao.md`
- `docs/esocial/plano-implementacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- workflow do projeto reforcado com protocolo explicito antes e depois de cada implementacao
- regra de precedencia entre planos documentada
- proxima frente do produto alinhada com a trilha estrutural antes do retorno ao historico funcional
### PRODUTO-S1010-ATALHOS-CRIACAO-RUBRICA - 23/04/2026

**Descricao:**
Adicionar uma caixa de apoio `S-1010` na tela de criacao de rubrica para encurtar a navegacao operacional durante a parametrizacao.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/create.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- criar um bloco lateral de apoio ao `S-1010` na tela de cadastro;
- reaproveitar filtros operacionais ja existentes da listagem e do painel;
- manter a tela de criacao enxuta, sem competir com o formulario;
- validar os links com teste focado de CRUD.

**Resultado:**
- a tela de criacao passou a exibir atalhos para painel `S-1010`, pendencias sem codigo, rubricas com codigo e rubricas ativas;
- o cadastro ficou mais alinhado com a trilha operacional ja presente na listagem e na edicao;
- a navegacao de ida e volta durante a parametrizacao ficou mais curta;
- teste focado de CRUD de rubricas ficou verde.

### PRODUTO-ESOCIAL-FILTRO-ORIGEM - 23/04/2026

**Descricao:**
Adicionar leitura e filtragem por `origem` no painel operacional de eventos eSocial, incluindo atalho contextual no detalhe.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir `origem` como filtro operacional no painel;
- reaproveitar o campo `payload.origem` sem alterar o modelo de dados;
- evidenciar a origem no resumo de filtros ativos;
- adicionar atalho `Mesma origem` no detalhe do evento e validar a navegacao com testes focados.

**Resultado:**
- o painel eSocial passou a filtrar eventos por `origem`;
- o formulario principal agora oferece select de origem com opcoes derivadas da base do tenant;
- o resumo de filtros ativos passou a exibir a origem selecionada;
- o detalhe do evento ganhou atalho para retornar ao painel pela mesma origem;
- testes focados do painel e do detalhe ficaram verdes.

### PRODUTO-S1010-ENCERRAMENTO-RUBRICA - 23/04/2026

**Descricao:**
Amarrar a inativacao de rubricas a um `fim_validade` obrigatorio para reforcar a coerencia de vigencia na trilha `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- exigir `fim_validade` quando a rubrica estiver sendo salva como inativa;
- preservar a regra existente de fim maior ou igual ao inicio;
- cobrir criacao e edicao com testes focados;
- registrar a regra na documentacao funcional e eSocial.

**Resultado:**
- rubricas inativas passaram a exigir `fim_validade` na criacao e na edicao;
- a trilha de encerramento ficou mais coerente com o uso de vigencia em eventos de tabela;
- testes focados de CRUD validaram os cenarios de bloqueio;
- documentacao do produto e das regras eSocial foi atualizada.

### PRODUTO-S1010-VIGENCIA-ATIVA-COERENTE - 23/04/2026

**Descricao:**
Impedir que rubricas marcadas como ativas sejam salvas com `fim_validade` ja encerrado, reforcando consistencia de vigencia no `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- bloquear `fim_validade` passado quando a rubrica estiver ativa;
- preservar a possibilidade de rubrica ativa sem fim de validade;
- cobrir criacao e edicao com testes focados;
- registrar a regra nas documentacoes da trilha funcional.

**Resultado:**
- rubricas ativas passaram a rejeitar `fim_validade` anterior a data atual;
- a leitura de vigencia ficou coerente com o status operacional da rubrica;
- testes focados de CRUD validaram criacao e edicao com bloqueio do encerramento passado;
- documentacao funcional e eSocial foi atualizada.

### PRODUTO-S1010-INICIO-ATIVO-COERENTE - 23/04/2026

**Descricao:**
Impedir que rubricas marcadas como ativas sejam salvas com `inicio_validade` futuro, reforcando coerencia operacional da vigencia no `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- bloquear `inicio_validade` futuro quando a rubrica estiver ativa;
- preservar a possibilidade de vigencia futura para rubricas ainda nao ativas;
- cobrir criacao e edicao com testes focados;
- registrar a regra nas documentacoes funcionais.

**Resultado:**
- rubricas ativas passaram a rejeitar `inicio_validade` posterior a data atual;
- a leitura de vigencia ativa ficou coerente com o estado operacional da rubrica;
- testes focados de CRUD validaram criacao e edicao com bloqueio do inicio futuro;
- documentacao funcional e eSocial foi atualizada.

### PRODUTO-S1010-ATALHOS-CONTEXTUAIS-EDICAO - 23/04/2026

**Descricao:**
Expandir a caixa de revisao `S-1010` na edicao de rubrica com atalhos contextuais coerentes com o cadastro aberto.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- reaproveitar os filtros operacionais ja existentes na listagem de rubricas;
- adaptar os atalhos ao contexto atual de status, tipo, codigo eSocial e incidencias;
- evitar links inaplicaveis para incidencias nao marcadas;
- validar a leitura da tela com teste focado de edicao.

**Resultado:**
- a edicao de rubrica passou a oferecer atalhos contextuais para `status`, `tipo`, `codigo eSocial` e incidencias ativas;
- rubricas com codigo agora apontam para a base parametrizada, enquanto pendencias continuam apontando para `sem codigo`;
- incidencias nao marcadas deixaram de gerar atalhos desnecessarios;
- teste focado de CRUD de rubricas ficou verde.

### PRODUTO-S1010-VIGENCIA-RUBRICAS - 23/04/2026

**Descricao:**
Adicionar controle inicial de vigencia nas rubricas para preparar a evolucao do `S-1010`, com inicio obrigatorio, fim opcional e validacao temporal simples.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/database/migrations/*_add_vigencia_to_rubricas_table.php`
- `backend/FolhaNova/app/Models/Rubrica.php`
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/app/Services/Rubricas/RegistrarRubricaService.php`
- `backend/FolhaNova/app/Services/Rubricas/AtualizarRubricaService.php`
- `backend/FolhaNova/resources/views/rubricas/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- criar campos de vigencia inicial/final nas rubricas;
- validar inicio obrigatorio e fim posterior ou igual ao inicio;
- exibir vigencia na lista e na edicao;
- cobrir cadastro, edicao e listagem com testes focados.

**Resultado:**
- rubricas passaram a armazenar `inicio_validade` e `fim_validade`;
- cadastro e edicao exigem inicio de validade e rejeitam fim anterior ao inicio;
- listagem e edicao exibem a vigencia da rubrica;
- testes focados de rubricas ficaram verdes.
### PRODUTO-S1000-COMPATIBILIDADE-CLASSIFICACAO - 23/04/2026

**Descricao:**
Validar a compatibilidade entre tipo de inscricao institucional e classificacao tributaria suportada no recorte atual do `S-1000`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- rejeitar CPF com classificacao tributaria reservada ao contexto CNPJ suportado;
- rejeitar CNPJ com classificacao tributaria reservada ao contexto CPF suportado;
- preservar os fluxos validos ja cobertos;
- registrar a regra na documentacao.

**Resultado:**
- `S-1000` passou a rejeitar CNPJ com `classificacao_tributaria = 21`;
- `S-1000` passou a rejeitar CPF com `classificacao_tributaria = 85`;
- atualizacoes invalidas continuam sem gerar evento pendente;
- teste focado do modulo institucional ficou verde.
