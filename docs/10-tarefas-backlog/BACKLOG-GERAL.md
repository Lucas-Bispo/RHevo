# FolhaNova - Backlog Geral
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

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
