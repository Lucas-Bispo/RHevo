# Backlog 2026-04-23 - Rubricas e S-1010

Recorte tematico do backlog de `2026-04-23`.

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
