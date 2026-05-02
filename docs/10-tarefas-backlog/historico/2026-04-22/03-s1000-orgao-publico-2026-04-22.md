# Backlog 2026-04-22 - Orgao publico e S-1000

Recorte tematico do backlog de `2026-04-22`.

### PRODUTO-S1000-ATALHO-PAINEL-EVENTOS - 22/04/2026

**Descricao:**
Adicionar atalho operacional da tela de orgao publico para o painel eSocial filtrado por `S-1000`, facilitando a validacao manual da trilha institucional.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir acao para abrir o painel de eventos filtrado por `S-1000`;
- manter o link de detalhe do evento atual quando existir;
- cobrir o atalho com teste de feature;
- registrar a entrega na documentacao.

**Resultado:**
- tela de orgao publico passou a ter atalho direto para o painel eSocial filtrado por `S-1000`;
- card do evento atual tambem permite abrir a lista filtrada da trilha institucional;
- link de detalhe do evento `S-1000` foi preservado;
- teste focado confirmou o atalho e a integracao visual com o painel de eventos.



### PRODUTO-S1000-STATUS-VIGENCIA-INSTITUCIONAL - 22/04/2026

**Descricao:**
Melhorar o controle operacional da vigencia do `S-1000` exibindo status claro da janela institucional no modulo de orgao publico.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/OrgaoPublicoController.php`
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular status da vigencia a partir de `inicio_validade` e `fim_validade`;
- exibir o status no resumo e na configuracao eSocial do orgao publico;
- cobrir vigencia futura e encerrada com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- tela de orgao publico passou a exibir status de vigencia do `S-1000`;
- status diferencia vigencia ativa, futura, encerrada e nao definida;
- resumo e bloco de configuracao eSocial foram alinhados para a leitura operacional;
- teste focado confirmou vigencia ativa, futura e encerrada.



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
