# Backlog 2026-04-23 - Painel eSocial

Recorte tematico do backlog de `2026-04-23`.

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
