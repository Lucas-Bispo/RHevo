# FolhaNova - Backlog Geral
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Consolidar as tarefas macro do projeto em uma visão única de backlog priorizado, alinhada ao estado real da aplicação e à documentação estratégica já produzida.

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
