# FolhaNova - Backlog Geral - 29/04/2026

Entradas historicas de backlog separadas para leitura rapida.

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
