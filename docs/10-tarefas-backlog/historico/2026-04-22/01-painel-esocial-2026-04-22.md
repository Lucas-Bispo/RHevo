# Backlog 2026-04-22 - Painel eSocial

Recorte tematico do backlog de `2026-04-22`.

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
