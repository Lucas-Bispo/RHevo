# FolhaNova - Backlog Geral - 24/04/2026

Entradas historicas de backlog separadas para leitura rapida.

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
