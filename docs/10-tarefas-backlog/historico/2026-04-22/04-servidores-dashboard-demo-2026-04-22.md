# Backlog 2026-04-22 - Servidores, dashboard e dados demo

Recorte tematico do backlog de `2026-04-22`.

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
