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
