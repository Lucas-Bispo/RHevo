# FolhaNova - Linha do Tempo - 24/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 24/04/2026 - Cards de Status do Dia no Painel eSocial

**Acao realizada:**
- Adicionados cards operacionais para eventos `pendente` e `erro` atualizados no dia.
- Os novos cards passaram a abrir a listagem com `status` e `data` ja combinados.
- O painel ganhou uma leitura mais curta para acompanhar prioridades recentes sem depender de montagem manual dos filtros.
- O teste da listagem foi ampliado para validar a navegacao e a filtragem combinada por dia.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php` no `WSL Ubuntu 24.04`.

**Status:** Concluido


### 24/04/2026 - Filtro por Data no Painel eSocial

**Acao realizada:**
- Adicionado filtro opcional por data de atualizacao no painel eSocial.
- O resumo de filtros ativos passou a evidenciar a data operacional selecionada.
- A tela de detalhe do evento ganhou o atalho `Mesma data` para retornar ao painel pela mesma janela diaria.
- Os testes de painel e detalhe foram ampliados para validar o novo fluxo operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php` no `WSL Ubuntu 24.04`.

**Status:** Concluido


### 24/04/2026 - Filtro por Servidor no Painel eSocial

**Acao realizada:**
- Adicionado filtro opcional por servidor vinculado no painel eSocial.
- O resumo de filtros ativos passou a evidenciar nome e matricula do servidor selecionado.
- A tela de detalhe do evento ganhou o atalho `Mesmo servidor` para retornar ao painel pela mesma trilha funcional.
- Os testes de painel e detalhe foram ampliados para validar o novo fluxo operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php` no `WSL Ubuntu 24.04`.

**Status:** Concluido


### 24/04/2026 - Ambiente Local Preparado para Teste Manual no WSL

**Acao realizada:**
- Ajustado o script `ensure_local_login.php` para garantir a tabela `tenants` e montar um tenant demo local quando necessario.
- Recriada a conta `test@example.com` com `tenant_id=1` e contexto institucional minimo para navegacao manual.
- Validado o build do frontend com `npm run build` no `WSL Ubuntu 24.04`.
- Subidos backend e frontend em sessoes `tmux` destacadas (`folhanova-back` e `folhanova-vite`) para teste manual continuo.

**Arquivos criados / alterados:**
- `backend/FolhaNova/scripts/ensure_local_login.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php scripts/ensure_local_login.php`: usuario demo recriado com `tenant_id=1`.
- `npm run build`: build concluido com sucesso no `WSL Ubuntu 24.04`.
- `GET /login`: `200 OK` em `http://127.0.0.1:8000/login`.
- `GET /dashboard` sem sessao: `302` para `http://127.0.0.1:8000/login`.
- `GET http://127.0.0.1:5173/@vite/client`: resposta valida do Vite dev server.
- `tmux ls`: sessoes `folhanova-back` e `folhanova-vite` ativas.

**Status:** Concluido


### 24/04/2026 - Consistencia Operacional do S-1010 nos Formularios de Rubricas

**Acao realizada:**
- Adicionado um bloco contextual de consistencia nas telas de criacao e edicao de rubricas.
- O formulario passou a orientar explicitamente as regras locais ja ativas para `natRubr`, vigencia, status e codigo eSocial.
- Rubricas ativas agora exibem a leitura da janela atual, enquanto rubricas inativas reforcam a exigencia de `fim_validade`.
- Rubricas sem codigo eSocial seguem destacadas como pendencia operacional da trilha `S-1010`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/create.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/resources/views/rubricas/partials/consistency-guide.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/RubricaCrudTest.php` no `WSL Ubuntu 24.04`: `16` testes verdes e `115` assercoes.

**Status:** Concluido


### 24/04/2026 - Consistencia Operacional do S-1000 na Edicao do Orgao Publico

**Acao realizada:**
- Adicionado um bloco contextual de consistencia na tela de edicao do orgao publico.
- O formulario passou a orientar explicitamente os cenarios de `CNPJ` e `CPF` antes do salvamento.
- O contexto por `CNPJ` agora reforca o uso de `classTrib 85` e a obrigatoriedade de `natJurid`.
- O contexto por `CPF` agora deixa claro o uso de `classTrib 21` e o descarte de `natJurid` no payload.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php` no `WSL Ubuntu 24.04`: `15` testes verdes e `96` assercoes.

**Status:** Concluido


### 24/04/2026 - Filtro por Natureza eSocial nas Rubricas S-1010

**Acao realizada:**
- Adicionado filtro dedicado por natureza eSocial (`natRubr`) na listagem de rubricas.
- O resumo de filtros ativos agora evidencia a natureza selecionada junto da leitura operacional existente.
- A tela de edicao da rubrica passou a oferecer o atalho contextual `Mesma natureza`.
- Criados testes focados para validar o filtro novo e a navegacao contextual da edicao.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/RubricasIndexTest.php tests/Feature/RubricaCrudTest.php` no `WSL Ubuntu 24.04`: `28` testes verdes e `189` assercoes.

**Status:** Concluido


### 24/04/2026 - Leitura Operacional de Vigencia nas Rubricas S-1010

**Acao realizada:**
- Adicionados cards operacionais de vigencia `ativa`, `futura` e `encerrada` na listagem de rubricas.
- O formulario principal passou a aceitar filtro `vigencia`, integrado ao resumo de filtros ativos.
- Cada linha da tabela agora exibe badge com a situacao de vigencia da rubrica.
- Criados testes focados para validar links, filtro selecionado e leitura operacional da nova coluna.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php`: filtros e atalhos de vigencia cobertos em conjunto com a suite da listagem de rubricas.

**Status:** Concluido


### 24/04/2026 - Atalhos de Vigencia na Trilha S-1010 das Rubricas

**Acao realizada:**
- A tela de criacao de rubrica passou a oferecer atalhos para bases com vigencia `ativa`, `futura` e `encerrada`.
- A tela de edicao passou a abrir diretamente a mesma janela de vigencia da rubrica atual.
- Mantida a integracao dos atalhos novos com os links existentes de status, tipo, codigo e incidencias.
- Criados testes focados para confirmar a navegacao lateral da criacao e da edicao.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/create.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`: atalhos de vigencia cobertos junto da suite de criacao e edicao de rubricas.

**Status:** Concluido


### 24/04/2026 - Massa Demo de Rubricas com Vigencia para S-1010

**Acao realizada:**
- A massa demo de rubricas passou a armazenar datas coerentes para cenarios `ativo`, `futuro` e `encerrado`.
- O seeder foi ajustado para deixar a validacao manual alinhada com os filtros e atalhos novos da listagem.
- O teste de `DemoDataSeeder` passou a validar as janelas de vigencia da base demo.
- A base local foi preparada para navegacao manual com a conta `test@example.com`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/database/seeders/DemoDataSeeder.php`
- `backend/FolhaNova/tests/Feature/DemoDataSeederTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/DemoDataSeederTest.php`: validacao da massa demo ampliada para vigencia de rubricas.
- `php artisan db:seed`: reaplicado para deixar a base local pronta para revisao manual.

**Status:** Concluido


### 24/04/2026 - Triagem de Vigencia S-1010 no Dashboard

**Acao realizada:**
- O dashboard passou a calcular e exibir contagens de rubricas com vigencia `ativa`, `futura` e `encerrada`.
- A area de validacao manual agora aponta explicitamente para a revisao da vigencia das rubricas.
- Criado um bloco `Triagem S-1010` com atalhos diretos para abrir a listagem filtrada por vigencia.
- O teste do dashboard foi ampliado para validar os novos indicadores e links operacionais.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/DashboardTest.php`: triagem de vigencia validada junto da leitura operacional do dashboard.

**Status:** Concluido


### 24/04/2026 - Triagem S-1000 no Dashboard

**Acao realizada:**
- O dashboard passou a recuperar o resumo institucional do tenant atual para exibir a base do `S-1000`.
- A home agora mostra nome do orgao, ambiente, status de vigencia e status do ultimo evento institucional.
- Foram adicionados atalhos diretos para abrir o modulo `Orgao Publico` e o painel filtrado por `S-1000`.
- O teste do dashboard foi ampliado para validar a nova leitura institucional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/DashboardTest.php`: resumo institucional e atalhos `S-1000` validados na home.

**Status:** Concluido


### 24/04/2026 - Atalhos Contextuais do S-1000 no Orgao Publico

**Acao realizada:**
- O card do evento `S-1000` no modulo `Orgao Publico` passou a exibir atalhos `Mesmo status` e `Mesmo ambiente`.
- Os atalhos retornam ao painel eSocial mantendo a trilha `S-1000` e refinando a triagem operacional.
- O link geral para abrir o painel `S-1000` foi preservado.
- O teste do modulo institucional foi ampliado para validar a nova navegacao contextual.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: atalhos contextuais do `S-1000` validados junto do modulo institucional.

**Status:** Concluido


### 24/04/2026 - Triagem por Contexto no Painel eSocial

**Acao realizada:**
- Adicionado filtro `Contexto` no painel eSocial para separar eventos institucionais e eventos vinculados a servidor.
- O painel passou a exibir cards `Institucionais` e `Vinculados` no resumo operacional.
- O bloco de filtros ativos agora mostra quando a triagem por contexto esta aplicada.
- Criados testes focados para validar os novos links e a filtragem por contexto.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php`: triagem por contexto coberta junto do painel eSocial.

**Status:** Concluido


### 24/04/2026 - Atalho de Contexto no Detalhe do Evento eSocial

**Acao realizada:**
- O detalhe do evento eSocial passou a exibir o atalho `Mesmo contexto`.
- Eventos institucionais agora retornam ao painel com `contexto=institucional`.
- Eventos vinculados a servidor agora retornam ao painel com `contexto=vinculado`.
- O teste do detalhe foi ampliado para validar os dois cenarios.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventoEsocialShowTest.php`: atalho `Mesmo contexto` validado no detalhe institucional e no detalhe vinculado.

**Status:** Concluido
