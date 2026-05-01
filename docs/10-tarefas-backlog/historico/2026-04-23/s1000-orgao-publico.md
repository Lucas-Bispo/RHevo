# Backlog 2026-04-23 - Orgao publico e S-1000

Recorte tematico do backlog de `2026-04-23`.

### PRODUTO-S1000-NATUREZA-JURIDICA-CPF - 23/04/2026

**Descricao:**
Normalizar a natureza juridica do `S-1000` para que inscricoes institucionais por CPF nao persistam `natJurid` no metadata nem no payload do evento.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- descartar `natureza_juridica` no service quando `tipo_inscricao = 2`;
- garantir que metadata e payload fiquem sem natureza juridica para CPF;
- cobrir o comportamento com teste focado do `S-1000`;
- registrar a regra na documentacao.

**Resultado:**
- inscricoes por CPF passaram a persistir `natureza_juridica = null` no metadata institucional;
- payload do `S-1000` segue sem `natJurid` para CPF;
- teste focado cobre envio indevido de natureza juridica em contexto CPF;
- regra registrada na documentacao funcional e eSocial.



### PRODUTO-S1000-COMPATIBILIDADE-CLASSIFICACAO - 23/04/2026

**Descricao:**
Validar a compatibilidade entre tipo de inscricao institucional e classificacao tributaria suportada no recorte atual do `S-1000`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- rejeitar CPF com classificacao tributaria reservada ao contexto CNPJ suportado;
- rejeitar CNPJ com classificacao tributaria reservada ao contexto CPF suportado;
- preservar os fluxos validos ja cobertos;
- registrar a regra na documentacao.

**Resultado:**
- `S-1000` passou a rejeitar CNPJ com `classificacao_tributaria = 21`;
- `S-1000` passou a rejeitar CPF com `classificacao_tributaria = 85`;
- atualizacoes invalidas continuam sem gerar evento pendente;
- teste focado do modulo institucional ficou verde.
