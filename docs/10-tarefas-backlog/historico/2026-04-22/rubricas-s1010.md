# Backlog 2026-04-22 - Rubricas e S-1010

Recorte tematico do backlog de `2026-04-22`.

### PRODUTO-RUBRICAS-ATALHOS-REVISAO-S1010 - 22/04/2026

**Descricao:**
Adicionar atalhos de revisao S-1010 na tela de edicao de rubrica para retornar rapidamente ao painel eSocial filtrado e as pendencias de rubricas sem codigo.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- adicionar bloco de revisao S-1010 na edicao de rubrica;
- incluir atalho para painel eSocial filtrado por `S-1010`;
- incluir atalho para rubricas sem codigo eSocial;
- cobrir os links com teste de feature.

**Resultado:**
- edicao de rubrica ganhou bloco `Revisao S-1010`;
- tela passou a abrir o painel eSocial filtrado por `S-1010`;
- tela tambem leva direto as pendencias de rubricas sem codigo eSocial;
- testes focados de rubricas e painel eSocial ficaram verdes.



### PRODUTO-S1010-ATALHO-PAINEL-EVENTOS - 22/04/2026

**Descricao:**
Adicionar atalho operacional da tela de rubricas para o painel eSocial filtrado por `S-1010`, facilitando a validacao manual da trilha de rubricas.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- incluir acao para abrir painel de eventos filtrado por `S-1010`;
- manter os filtros existentes de rubricas por codigo eSocial;
- cobrir o atalho com teste de feature;
- registrar a entrega na documentacao.

**Resultado:**
- tela de rubricas passou a ter atalho direto para o painel eSocial filtrado por `S-1010`;
- filtros existentes de rubricas foram preservados;
- teste focado confirmou o link para a trilha de eventos de rubricas;
- suite adjacente do painel eSocial seguiu verde.



### PRODUTO-S1010-FILTRO-SEM-CODIGO-ESOCIAL - 22/04/2026

**Descricao:**
Adicionar filtro operacional para listar rubricas sem codigo eSocial, evidenciando pendencias de parametrizacao para preparacao do `S-1010`.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- aceitar filtro `esocial=sem_codigo`;
- listar apenas rubricas sem `codigo_esocial`;
- adicionar leitura de pendencias no resumo e no select da tela;
- cobrir comportamento com teste de feature;
- registrar a funcionalidade na documentacao.

**Resultado:**
- listagem de rubricas passou a aceitar filtro `esocial=sem_codigo`;
- tela ganhou card operacional de rubricas sem codigo eSocial;
- select de eSocial passou a permitir alternar entre todas, com codigo e sem codigo;
- teste focado confirmou que rubricas parametrizadas ficam fora da listagem de pendencias.
