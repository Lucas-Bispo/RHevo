# FolhaNova - Backlog Geral - 30/04/2026

Entradas historicas de backlog separadas para leitura rapida.

### PRODUTO-PAINEL-ESOCIAL-GRUPOS-OPERACIONAIS - 30/04/2026

**Descricao:**
Adicionar leitura por grupo operacional no painel eSocial para separar eventos de tabela, nao periodicos e periodicos antes da futura montagem de lotes.

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
- classificar eventos locais em grupos de tabela, nao periodicos e periodicos;
- adicionar contadores e cards dedicados no painel;
- incluir filtro `grupo` no formulario principal e no resumo de filtros ativos;
- cobrir o filtro com teste focado.

**Resultado:**
- o painel eSocial passou a exibir cards `Eventos de tabela`, `Nao periodicos` e `Periodicos`;
- o formulario principal ganhou o filtro `Grupo`;
- a listagem pode ser aberta por `grupo=tabelas`, `grupo=nao_periodicos` ou `grupo=periodicos`;
- o teste focado do painel cobre links, filtros e escopo por grupo.


### DOCS-ESOCIAL-INTEGRACAO-API - 30/04/2026

**Descricao:**
Criar uma explicacao humana e tecnica sobre como a futura integracao do FolhaNova com os Web Services oficiais do eSocial devera funcionar.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `docs/esocial/integracao-api-esocial.md`
- `docs/esocial/README.md`
- `docs/08-esocial/ESOCIAL-DOCUMENTACAO-OFICIAL.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- ler a documentacao interna de eSocial do projeto;
- consultar a documentacao oficial vigente em `gov.br`;
- explicar o fluxo de eventos, XML, certificado, assinatura, lotes, envio, consulta de retorno, recibos e rejeicoes;
- registrar a integracao como ultima etapa, dependente da maturidade dos cadastros e regras locais.

**Resultado:**
- criado o guia `integracao-api-esocial.md`;
- atualizada a referencia oficial para MOS S-1.3 consolidado ate NO 10/2026 e leiautes NT 06/2026 rev. 09/04/2026;
- documentado que a "API" do eSocial e, na pratica, uma integracao SOAP/XML assincrona com certificado digital e validacao por XSD.


### PRODUTO-S2200-PRONTIDAO-SERVIDORES - 30/04/2026

**Descricao:**
Adicionar leitura operacional de prontidao `S-2200` na listagem de servidores e no dashboard, separando admissoes prontas de pendencias cadastrais e de evento local.

**Status:** Concluido
**Prioridade:** Media
**Arquivos envolvidos:**
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Plano:**
- calcular servidores prontos para `S-2200` como ativos, com dados funcionais essenciais, CPF e nascimento informados, lotacao, cargo e evento local `S-2200`;
- calcular pendencias como complemento operacional dessa regra;
- adicionar cards, filtro e resumo de filtros na listagem de servidores;
- levar contadores e atalhos para o dashboard;
- cobrir a leitura com testes focados.

**Resultado:**
- a listagem de servidores passou a exibir cards `Prontos S-2200` e `Pendencias S-2200`;
- o formulario principal ganhou o filtro `Prontidao`;
- o dashboard passou a exibir a triagem `S-2200` com atalhos para servidores prontos, pendentes e eventos `S-2200`;
- testes focados cobrem listagem, filtros, contadores e atalhos do dashboard.
