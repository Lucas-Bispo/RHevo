# FolhaNova - Backlog Geral - 02/05/2026

Entradas historicas de backlog separadas para leitura rapida.

### ESOCIAL-S1000-RAIZ-CNPJ-NRINSC - 02/05/2026

**Descricao:**
Normalizar o `nrInsc` do `S-1000` para usar a raiz de 8 digitos quando o empregador estiver identificado por CNPJ, mantendo CPF com 11 digitos e preservando a exibicao cadastral do documento completo.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Services/Esocial/Payloads/S1000PayloadBuilder.php`
- `backend/FolhaNova/database/seeders/DemoDataSeeder.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Plano:**
- centralizar a normalizacao do `nrInsc` do `S-1000` no builder de payload;
- usar raiz de CNPJ com 8 digitos e CPF com 11 digitos em payload/config;
- explicar a regra de raiz CNPJ na tela de parametros do orgao;
- cobrir a montagem do payload com teste focado.

**Resultado:**
- o builder `S-1000` passou a normalizar `nrInsc` conforme o tipo de inscricao;
- eventos e XMLs locais por CNPJ usam raiz de 8 digitos;
- inscricoes por CPF continuam usando 11 digitos;
- a tela de parametros do orgao explica a diferenca entre cadastro completo e identificacao usada no payload;
- a massa demo foi ajustada para manter o `S-1000` coerente com a regra.

### PRODUTO-S1010-REGRAS-INCIDENCIA-LOCAL - 02/05/2026

**Descricao:**
Vincular as naturezas de rubrica suportadas no recorte local do `S-1010` a regras iniciais de tipo e incidencias, evitando combinacoes incoerentes antes da integracao real com o governo.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Support/Esocial/RegrasIncidenciaRubrica.php`
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/resources/views/rubricas/partials/consistency-guide.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Plano:**
- criar regras locais de compatibilidade para as naturezas `1000`, `9201` e `9219`;
- bloquear tipo/incidencias incoerentes nas requests de criacao e edicao;
- exibir no guia de consistencia se a combinacao atual esta aderente ao recorte local;
- cobrir criacao e edicao invalidas com testes focados.

**Resultado:**
- as naturezas `1000`, `9201` e `9219` passaram a ter regras locais de tipo e incidencia;
- criacao e edicao de rubricas bloqueiam combinacoes incoerentes antes de salvar;
- o guia de consistencia `S-1010` passou a explicar se a combinacao atual esta aderente ou precisa de ajuste;
- a trilha `S-1010` avancou sem introduzir integracao real com governo nesta etapa.

### PRODUTO-PAINEL-ESOCIAL-PENDENCIAS-ANTERIORES - 02/05/2026

**Descricao:**
Evoluir a operacao local do painel de eventos eSocial com leitura separada de pendencias e erros anteriores ao dia atual, ajudando a priorizar itens envelhecidos da fila local.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Plano:**
- adicionar contadores de eventos pendentes e com erro atualizados antes de hoje;
- exibir cards de atalho para itens anteriores;
- conectar os cards aos filtros existentes de status e data;
- cobrir os links e a filtragem com teste focado.

**Resultado:**
- o painel eSocial passou a separar `Pendentes anteriores` e `Erros anteriores`;
- os novos cards apontam para a listagem com `periodo=anteriores`;
- o formulario de filtros passou a permitir selecionar eventos anteriores ao dia atual;
- o teste focado cobre os links e garante que o filtro nao mistura eventos de hoje.

### ESOCIAL-S1000-XML-LOCAL - 02/05/2026

**Descricao:**
Iniciar o Marco 1 da integracao com o governo, permitindo gerar localmente o XML oficial `S-1000` a partir do evento institucional antes da etapa de certificado, assinatura e envio SOAP.

**Status:** Concluido
**Prioridade:** Alta
**Arquivos envolvidos:**
- `backend/FolhaNova/database/migrations/2026_05_02_153200_add_xml_generation_to_evento_esocials_table.php`
- `backend/FolhaNova/app/Services/Esocial/Payloads/S1000PayloadBuilder.php`
- `backend/FolhaNova/app/Services/Esocial/Xml/EsocialXmlFactory.php`
- `backend/FolhaNova/app/Services/Esocial/Xml/EsocialXsdValidator.php`
- `backend/FolhaNova/app/Services/EventosEsocial/GerarXmlEventoEsocialService.php`
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/integracao-api-esocial/05-plano-implementacao-governo.md`
- `docs/produto/funcionalidades-existentes.md`

**Plano:**
- criar campos para XML gerado, hash, status e mensagem de validacao;
- extrair builder de payload `S-1000` reutilizavel;
- gerar XML `S-1000` via biblioteca `nfephp-org/sped-esocial`;
- expor acao no detalhe do evento eSocial;
- registrar que a validacao XSD final fica pendente ate a assinatura digital.

**Resultado:**
- o detalhe do evento `S-1000` passou a ter acao `Gerar XML local`;
- o sistema grava XML oficial, hash SHA-256 e data de geracao;
- a validacao informa `pendente_assinatura` quando o XSD exige `Signature`;
- a proxima frente fica pronta para certificado A1 e assinatura do XML.
