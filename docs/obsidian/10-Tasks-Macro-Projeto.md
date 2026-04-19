# FolhaNova · Tasks Macro do Projeto

> Objetivo: organizar o projeto inteiro com base em todos os markdowns autorais lidos no repositório, antes de avançar com novas implementações.

## Base documental considerada

Este plano foi consolidado a partir destes grupos de documentos:

### Estratégia e produto

- `README.md`
- `docs/obsidian/projeto.md`
- `docs/obsidian/01-Visao-Produto.md`
- `docs/obsidian/02-Stack-Tecnologica-2026.md`
- `docs/obsidian/03-eSocial-S-1.3-Requisitos.md`
- `docs/obsidian/04-Arquitetura-Proposta-Laravel.md`
- `docs/obsidian/05-Roadmap-Implementacao.md`

### Diretrizes operacionais e de qualidade

- `CONTRIBUTING.md`
- `docs/obsidian/06-Prompt-Base-Codex.md`
- `docs/obsidian/BUG-TRACKING.md`
- `docs/obsidian/FOLHANOVA-ENGENHARIA.md`
- `docs/obsidian/FOLHANOVA-PERFORMANCE.md`
- `docs/obsidian/FOLHANOVA-CYBERSECURITY.md`

### Estado real da aplicação e ambiente

- `backend/FolhaNova/README.md`
- `backend/FolhaNova/docs/AMBIENTE-WSL.md`
- `backend/FolhaNova/docs/ARQUITETURA.md`
- `backend/FolhaNova/docs/CHECKUP-APLICACAO.md`
- `backend/FolhaNova/docs/ESOCIAL-INTEGRACAO.md`
- `backend/FolhaNova/docs/FASE-01.md`
- `backend/FolhaNova/docs/FLUXO-DE-TRABALHO.md`
- `backend/FolhaNova/docs/SEGURANCA.md`
- `docs/obsidian/07-Ambiente-WSL-Ubuntu.md`
- `docs/obsidian/08-Linha-do-Tempo-Projeto.md`
- `docs/obsidian/09-Tasks-Login-Local.md`

## Princípios que viraram regra de execução

- Trabalhar módulo por módulo.
- Atualizar documentação a cada etapa relevante.
- Preservar a stack oficial do projeto.
- Priorizar WSL Ubuntu 24.04 como ambiente padrão.
- Não avançar para módulos de negócio enquanto a fundação local estiver instável.
- Tratar segurança, performance e qualidade como requisitos transversais.
- Registrar causa raiz, não só sintoma, sempre que houver bug.

## Ordem macro recomendada

### TRACK-00 · Fundação e alinhamento do projeto

- Status: `in_progress`
- Objetivo:
  - alinhar documentação, ambiente real e direção técnica do projeto.
- Motivo:
  - os documentos já definem Laravel 11 como base oficial, mas ainda existem traços de scaffold padrão e instabilidade local.

#### TASK-00-01 · Consolidar baseline documental

- Status: `done`
- Entrega:
  - linha do tempo do projeto criada;
  - task do login criada;
  - índice do Obsidian atualizado.

#### TASK-00-02 · Organizar tasks macro por trilha

- Status: `done`
- Entrega:
  - este arquivo.

#### TASK-00-03 · Definir fonte de verdade por tema

- Status: `pending`
- Critério de aceite:
  - ficar explícito qual arquivo manda em produto, arquitetura, ambiente, segurança e roadmap.

### TRACK-01 · Estabilização local da aplicação

- Status: `pending`
- Objetivo:
  - deixar backend, frontend, login e fluxo de subida local previsíveis.
- Justificativa documental:
  - `FASE-01.md` e `CHECKUP-APLICACAO.md` apontam estabilização do layout e do pós-login como pendência.

#### TASK-01-01 · Recuperar a tela de login local

- Status: `pending`
- Referência:
  - `docs/obsidian/09-Tasks-Login-Local.md`

#### TASK-01-02 · Estabilizar backend + frontend no WSL

- Status: `pending`
- Objetivo:
  - garantir um comando ou script reproduzível para subir Laravel e Vite.

#### TASK-01-03 · Alinhar `.env` local com o projeto

- Status: `pending`
- Objetivo:
  - remover restos do scaffold padrão;
  - alinhar `APP_NAME`, locale, timezone e defaults locais.

#### TASK-01-04 · Registrar procedimento oficial de ambiente local

- Status: `pending`
- Objetivo:
  - consolidar um fluxo único entre os guias `AMBIENTE-WSL.md` e `07-Ambiente-WSL-Ubuntu.md`.

### TRACK-02 · Fundação técnica e arquitetura

- Status: `pending`
- Objetivo:
  - alinhar o código com a arquitetura prometida nos documentos.

#### TASK-02-01 · Revisar aderência à arquitetura modular

- Status: `pending`
- Objetivo:
  - comparar estrutura real com `ARQUITETURA.md` e `FOLHANOVA-ENGENHARIA.md`.

#### TASK-02-02 · Definir backlog de refatoração arquitetural

- Status: `pending`
- Objetivo:
  - mapear o que ainda está no scaffold e o que precisa migrar para domínios, actions, repositories e requests.

#### TASK-02-03 · Consolidar migrations e models centrais

- Status: `pending`
- Objetivo:
  - validar o núcleo `users`, `tenants`, `pessoas`, `servidores`, `lotacoes`, `cargos`, `rubricas`, `eventos_esocial`.

### TRACK-03 · Segurança, conformidade e auditoria

- Status: `pending`
- Objetivo:
  - garantir que a base atenda o nível mínimo pedido pelos documentos de segurança e LGPD.

#### TASK-03-01 · Validar autenticação e autorização base

- Status: `pending`
- Objetivo:
  - revisar login, policies, roles, permissões e isolamento por tenant.

#### TASK-03-02 · Revisar exposição de dados sensíveis

- Status: `pending`
- Objetivo:
  - garantir que logs, exceptions e responses não exponham dados proibidos.

#### TASK-03-03 · Revisar certificados eSocial e segredos

- Status: `pending`
- Objetivo:
  - validar fluxo de armazenamento seguro e variáveis de ambiente.

#### TASK-03-04 · Planejar trilha de auditoria

- Status: `pending`
- Objetivo:
  - preparar logs estruturados e ações críticas rastreáveis.

### TRACK-04 · Qualidade, testes e observabilidade

- Status: `pending`
- Objetivo:
  - elevar a base para o padrão definido em engenharia, bug tracking e performance.

#### TASK-04-01 · Fechar lacunas da Fase 01

- Status: `pending`
- Objetivo:
  - revisar itens pendentes em `FASE-01.md`.

#### TASK-04-02 · Revisar suite de testes

- Status: `pending`
- Objetivo:
  - decidir a migração planejada para Pest ou formalizar a permanência temporária em PHPUnit.

#### TASK-04-03 · Definir baseline de observabilidade local

- Status: `pending`
- Objetivo:
  - padronizar uso de Telescope, logs e check-up técnico.

#### TASK-04-04 · Formalizar checklist de pronto por task

- Status: `pending`
- Objetivo:
  - incluir segurança, performance, bug prevention, docs e testes em toda entrega.

### TRACK-05 · Multi-tenancy e persistência real

- Status: `pending`
- Objetivo:
  - sair do ambiente provisório e preparar a estrutura operacional correta.

#### TASK-05-01 · Provisionar MySQL ou MariaDB local

- Status: `pending`
- Justificativa:
  - SQLite está útil para validação, mas os documentos oficiais apontam MySQL/MariaDB como base principal.

#### TASK-05-02 · Estruturar landlord e tenant

- Status: `pending`
- Objetivo:
  - alinhar banco landlord, bancos tenant e estratégia de migrations.

#### TASK-05-03 · Validar isolamento por tenant

- Status: `pending`
- Objetivo:
  - confirmar regras de segurança e escopo de dados.

### TRACK-06 · Módulo de autenticação e administração

- Status: `pending`
- Objetivo:
  - consolidar a base administrativa antes de entrar no cadastro funcional.

#### TASK-06-01 · Fechar fluxo de autenticação

- Status: `pending`
- Objetivo:
  - login, logout, perfil, reset de senha e feedback visual coerente.

#### TASK-06-02 · Preparar usuários, grupos e permissões

- Status: `pending`
- Objetivo:
  - implementar a base de ACL prometida nos documentos.

#### TASK-06-03 · Preparar dashboard administrativo estável

- Status: `pending`
- Objetivo:
  - transformar o layout inicial em base confiável de navegação.

### TRACK-07 · Cadastro de Servidor e domínio de Pessoas

- Status: `pending`
- Objetivo:
  - iniciar o primeiro módulo funcional prioritário.

#### TASK-07-01 · Modelar fluxo de cadastro de pessoa e servidor

- Status: `pending`

#### TASK-07-02 · Implementar formulário inicial de servidor

- Status: `pending`

#### TASK-07-03 · Preparar base do evento S-2200

- Status: `pending`

### TRACK-08 · Folha, eSocial e módulos seguintes

- Status: `pending`
- Objetivo:
  - seguir o roadmap por fases após a fundação estar sólida.

#### TASK-08-01 · Tabelas eSocial

- Status: `pending`

#### TASK-08-02 · Geração e fila de eventos

- Status: `pending`

#### TASK-08-03 · Cálculo mensal da folha

- Status: `pending`

#### TASK-08-04 · Relatórios, portal do servidor e ciclos avançados

- Status: `pending`

## Fonte de verdade por tema

- Produto:
  - `docs/obsidian/projeto.md`
  - `docs/obsidian/01-Visao-Produto.md`
- Stack:
  - `docs/obsidian/02-Stack-Tecnologica-2026.md`
  - `backend/FolhaNova/README.md`
- Arquitetura:
  - `docs/obsidian/04-Arquitetura-Proposta-Laravel.md`
  - `backend/FolhaNova/docs/ARQUITETURA.md`
- Roadmap:
  - `docs/obsidian/05-Roadmap-Implementacao.md`
  - `backend/FolhaNova/docs/FASE-01.md`
- Segurança:
  - `docs/obsidian/FOLHANOVA-CYBERSECURITY.md`
  - `backend/FolhaNova/docs/SEGURANCA.md`
- Performance:
  - `docs/obsidian/FOLHANOVA-PERFORMANCE.md`
- Engenharia:
  - `docs/obsidian/FOLHANOVA-ENGENHARIA.md`
- Bugs e depuração:
  - `docs/obsidian/BUG-TRACKING.md`
  - `backend/FolhaNova/docs/CHECKUP-APLICACAO.md`
- Ambiente local:
  - `docs/obsidian/07-Ambiente-WSL-Ubuntu.md`
  - `backend/FolhaNova/docs/AMBIENTE-WSL.md`

## Ordem prática recomendada a partir de agora

1. Fechar `TRACK-01` para estabilizar a base local.
2. Endereçar os itens críticos de `TRACK-02`, `TRACK-03` e `TRACK-04`.
3. Preparar `TRACK-05` para sair do modo provisório.
4. Consolidar `TRACK-06` como base administrativa.
5. Só então avançar em `TRACK-07` e `TRACK-08`.
