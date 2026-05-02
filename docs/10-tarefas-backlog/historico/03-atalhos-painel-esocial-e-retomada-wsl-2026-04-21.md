# FolhaNova - Backlog Geral - 21/04/2026

Entradas historicas de backlog separadas para leitura rapida.

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
