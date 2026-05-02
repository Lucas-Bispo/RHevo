# FolhaNova - Linha do Tempo - 22/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 22/04/2026 - Atalhos de Revisao S-1010 na Rubrica

**Acao realizada:**
- Adicionado bloco `Revisao S-1010` na tela de edicao de rubrica.
- Incluido atalho para o painel eSocial filtrado por `S-1010`.
- Incluido atalho para a listagem de rubricas sem codigo eSocial.
- Teste de CRUD de rubricas passou a validar os links de revisao.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`, `tests/Feature/RubricasIndexTest.php` e `tests/Feature/EventosEsocialIndexTest.php`: `22` testes verdes e `110` assercoes.

**Status:** Concluido


### 22/04/2026 - Atalho de Servidor no Detalhe eSocial

**Acao realizada:**
- Adicionado botao `Abrir servidor` no detalhe do evento eSocial quando ha servidor vinculado.
- Eventos institucionais seguem sem link inaplicavel para servidor.
- Fechada a navegacao de ida e volta entre detalhe do servidor e detalhe do evento eSocial.
- Teste de detalhe eSocial passou a validar o link para o servidor.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventoEsocialShowTest.php` e `tests/Feature/ServidorDetailTest.php`: `7` testes verdes e `37` assercoes.

**Status:** Concluido


### 22/04/2026 - Atalho de Evento no Detalhe do Servidor

**Acao realizada:**
- Adicionado link `Detalhar evento` em cada evento eSocial listado no detalhe do servidor.
- O link leva diretamente para a tela de detalhe do evento eSocial.
- Preservada a leitura atual de status, ambiente e data no card do evento.
- Teste do detalhe do servidor passou a validar a navegacao para o evento vinculado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/servidores/show.blade.php`
- `backend/FolhaNova/tests/Feature/ServidorDetailTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/ServidorDetailTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `7` testes verdes e `35` assercoes.

**Status:** Concluido


### 22/04/2026 - Atalho de Ambiente no Detalhe eSocial

**Acao realizada:**
- Adicionado link `Mesmo ambiente` na tela de detalhe de evento eSocial.
- O link retorna ao painel com filtro `ambiente` do evento atual.
- Mantidos os atalhos `Mesmo evento` e `Mesmo status`.
- Teste de detalhe passou a validar o novo link e a suite do painel confirmou a filtragem.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventoEsocialShowTest.php` e `tests/Feature/EventosEsocialIndexTest.php`: `16` testes verdes e `82` assercoes.

**Status:** Concluido


### 22/04/2026 - Atalhos por Ambiente no Painel eSocial

**Acao realizada:**
- Adicionadas contagens de eventos por ambiente no controller do painel eSocial.
- Criados cards `Homologacao` e `Producao` com links para o filtro `ambiente`.
- O resumo de filtros ativos passa a evidenciar o ambiente selecionado quando usado.
- Teste de painel cobre links e filtragem por ambiente.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `16` testes verdes e `80` assercoes.

**Status:** Concluido


### 22/04/2026 - Triagem eSocial no Dashboard

**Acao realizada:**
- Adicionado bloco `Triagem eSocial` no dashboard operacional.
- Incluidos atalhos para eventos com erro, pendentes e com retorno.
- As contagens existentes do dashboard foram reaproveitadas sem mudar controller ou banco.
- Teste do dashboard passou a validar os novos links para filtros do painel eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/DashboardTest.php` e `tests/Feature/EventosEsocialIndexTest.php`: `11` testes verdes e `63` assercoes.

**Status:** Concluido


### 22/04/2026 - Filtros Ativos no Painel eSocial

**Acao realizada:**
- Adicionado resumo `Filtros ativos` no painel eSocial.
- Busca, evento, status, ambiente e retorno passam a ser exibidos como badges quando preenchidos.
- Incluido atalho `Limpar filtros` para retornar a listagem completa.
- Teste de painel passou a cobrir filtros combinados e o link de limpeza.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `15` testes verdes e `70` assercoes.

**Status:** Concluido


### 22/04/2026 - Retorno Resumido no Painel eSocial

**Acao realizada:**
- Adicionada coluna `Retorno` na listagem do painel eSocial.
- Mensagens de retorno passaram a aparecer de forma resumida para triagem operacional.
- Eventos sem mensagem exibem `Sem retorno registrado`.
- A tela de detalhe continua sendo a referencia para retorno completo, payload e auditoria.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `14` testes verdes e `62` assercoes.

**Status:** Concluido


### 22/04/2026 - Reprocessamento no Painel eSocial

**Acao realizada:**
- Adicionada acao `Reprocessar` diretamente na listagem do painel eSocial para eventos com status `erro`.
- A acao reutiliza a rota existente de reprocessamento local e mantem a tela de detalhe como auditoria completa.
- Eventos pendentes e processados nao exibem a acao na listagem.
- Teste de painel passou a validar que somente eventos com erro recebem o formulario de reprocessamento.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `13` testes verdes e `58` assercoes.

**Status:** Concluido


### 22/04/2026 - Atalho S-1010 no Painel eSocial

**Acao realizada:**
- Adicionado atalho na tela de rubricas para abrir o painel eSocial filtrado por `S-1010`.
- Mantidos os filtros operacionais de rubricas por tipo, incidencia e codigo eSocial.
- Teste de rubricas passou a validar o link de navegacao para a trilha `S-1010`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php` e `tests/Feature/EventosEsocialIndexTest.php`: `12` testes verdes e `61` assercoes.

**Status:** Concluido


### 22/04/2026 - Atalho S-1000 no Painel eSocial

**Acao realizada:**
- Adicionado atalho na tela de orgao publico para abrir o painel eSocial filtrado por `S-1000`.
- Card do evento institucional atual passou a oferecer acao para detalhar o evento ou abrir a lista filtrada.
- Mantida a leitura existente de vigencia, classificacao tributaria e status do evento.
- Teste de orgao publico passou a validar o link para o painel filtrado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php` e `tests/Feature/EventosEsocialIndexTest.php`: `19` testes verdes e `104` assercoes.

**Status:** Concluido


### 22/04/2026 - Correcao da Tela Contratual de Servidores

**Acao realizada:**
- Removidos atalhos quebrados para a rota futura `servidores.edit-cadastral`.
- Listagem e edicao contratual passaram a indicar `S-2205` como trilha planejada, sem link acionavel.
- Criado partial `contract-form-fields` para reabrir a tela `S-2206`.
- O formulario contratual preserva os dados civis atuais em campos ocultos e exibe apenas campos de vinculo.
- Controller de servidores passou a carregar o historico eSocial na tela de edicao.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/resources/views/servidores/edit.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/contract-form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/ServidoresIndexTest.php` e `tests/Feature/ServidorDetailTest.php`: `5` testes verdes e `27` assercoes.

**Status:** Concluido


### 22/04/2026 - Dashboard com Dados Reais e Atalhos Demo

**Acao realizada:**
- Criado `DashboardController` para calcular indicadores reais por tenant.
- Rota `/dashboard` passou a usar controller em vez de view estatica.
- Dashboard passou a exibir contagens reais de servidores, eventos e rubricas.
- Adicionados atalhos para validar orgao publico, rubricas e painel eSocial com a massa demo.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/DashboardTest.php`, `tests/Feature/Auth/AuthenticationTest.php` e `tests/Feature/ExampleTest.php`: `8` testes verdes e `27` assercoes.

**Status:** Concluido


### 22/04/2026 - Massa Demo para Validacao Manual Local

**Acao realizada:**
- Criado `DemoDataSeeder` idempotente para popular o sistema com dados navegaveis.
- `DatabaseSeeder` passou a chamar a massa demo por padrao.
- Login `test@example.com` foi vinculado ao tenant `Prefeitura Demonstracao` com senha `password`.
- Populados orgao publico, lotacoes, cargos, funcoes, servidores, rubricas e eventos eSocial.
- Executado `php artisan db:seed` no banco local para disponibilizar os dados ao teste manual.

**Dados principais criados:**
- `3` servidores demo.
- `5` rubricas, incluindo rubricas com e sem codigo eSocial.
- `4` eventos eSocial com `S-1000`, `S-1010` e `S-2200`, incluindo pendente, processado e erro com retorno.

**Arquivos criados / alterados:**
- `backend/FolhaNova/database/seeders/DatabaseSeeder.php`
- `backend/FolhaNova/database/seeders/DemoDataSeeder.php`
- `backend/FolhaNova/tests/Feature/DemoDataSeederTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/DemoDataSeederTest.php`: `1` teste verde e `8` assercoes.
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/RubricasIndexTest.php`: `12` testes verdes e `59` assercoes.
- `php artisan db:seed`: executado com sucesso no ambiente local WSL.

**Status:** Concluido


### 22/04/2026 - Filtro de Eventos com Retorno no Painel eSocial

**Acao realizada:**
- Adicionado filtro `retorno=com_mensagem` no painel eSocial.
- Exibido card operacional `Com retorno` com contagem de eventos que possuem mensagem de retorno.
- A listagem filtrada passa a mostrar apenas eventos com `mensagem_retorno`.
- Criado teste cobrindo o link e o filtro operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `12` testes verdes e `54` assercoes.
- Validacao manual em `localhost` deixada para a rodada do usuario, conforme orientacao.

**Status:** Concluido


### 22/04/2026 - Atalhos Contextuais no Detalhe eSocial

**Acao realizada:**
- Adicionados atalhos `Mesmo evento` e `Mesmo status` na tela de detalhe de eventos eSocial.
- Os links retornam ao painel operacional ja filtrado pelo evento ou status atual.
- Mantido o botao geral `Voltar para painel` e preservada a acao de reprocessamento local.
- Teste focado passou a cobrir os links contextuais.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventoEsocialShowTest.php` e `tests/Feature/EventosEsocialIndexTest.php`: `11` testes verdes e `48` assercoes.
- Validacao manual em `localhost` deixada para a rodada do usuario, conforme orientacao.

**Status:** Concluido


### 22/04/2026 - Atalhos de Eventos Prioritarios no Painel eSocial

**Acao realizada:**
- Adicionadas contagens dedicadas para `S-1000`, `S-1010` e `S-2200` no resumo do painel eSocial.
- Criados cards operacionais para abrir a listagem filtrada por tipo de evento.
- Mantidos os filtros existentes por busca, status, ambiente e evento.
- Criado teste cobrindo links e filtragem por `evento`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `11` testes verdes e `46` assercoes.
- Validacao manual em `localhost` deixada para a rodada do usuario, conforme orientacao.

**Status:** Concluido


### 22/04/2026 - Filtro de Rubricas sem Codigo eSocial

**Acao realizada:**
- Adicionado filtro `esocial=sem_codigo` na listagem de rubricas.
- Criado card operacional `Sem codigo eSocial` como atalho para pendencias de parametrizacao.
- Select de eSocial passou a alternar entre todas, com codigo e sem codigo.
- Criado teste cobrindo a listagem de rubricas pendentes de codigo eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php` e `tests/Feature/RubricaCrudTest.php`: `10` testes verdes e `41` assercoes.
- Validacao manual em `localhost` deixada para a rodada do usuario, conforme orientacao.

**Status:** Concluido


### 22/04/2026 - Status de Vigencia Institucional no S-1000

**Acao realizada:**
- Adicionado calculo de status de vigencia institucional para o modulo de orgao publico.
- A tela passa a diferenciar vigencia ativa, futura, encerrada e nao definida.
- O status foi exibido no resumo superior e no bloco de configuracao eSocial.
- Criados testes para preservar a leitura operacional das janelas ativa, futura e encerrada.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/OrgaoPublicoController.php`
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `12` testes verdes e `66` assercoes.
- Validacao manual em `localhost` deixada para a rodada do usuario, conforme orientacao.

**Status:** Concluido


### 22/04/2026 - Validacao de Documento Institucional no S-1000

**Acao realizada:**
- Aprofundada a validacao do cadastro de orgao publico para rejeitar CPF/CNPJ completos com digito verificador invalido.
- Mantida a normalizacao e formatacao existentes para `numero_inscricao` e `contato_cpf`.
- Preservado o suporte a CNPJ raiz de 8 digitos no contexto ja aceito pelo fluxo institucional.
- Criado teste cobrindo rejeicao de CNPJ invalido, CPF institucional invalido e CPF de contato invalido.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `10` testes verdes e `56` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `npm run build` no WSL atualizou `public/build/manifest.json` e assets em `public/build/assets`, mas o comando nao retornou saida antes do timeout operacional.
- `GET /login` por `curl` nao foi validado porque o servidor local nao permaneceu ativo em `127.0.0.1:8000` nesta rodada.

**Status:** Concluido
