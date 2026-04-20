# FolhaNova - Linha do Tempo
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

### 20/04/2026 - 13:40 - Modulos Iniciais de Cargos e Funcoes

**Acao realizada:**  
- Implementados `CargoController` e `FuncaoController` com listagem, cadastro e edicao, mantendo o mesmo padrao de controllers enxutos e persistencia em services.
- Criados requests dedicados para garantir unicidade de codigo por tenant e integridade basica dos cadastros estruturais.
- Implementados os services de gravacao e atualizacao para cargos e funcoes.
- Criadas telas responsivas de listagem, cadastro e edicao para os dois modulos, no mesmo padrao visual adotado em `Servidores` e `Lotacoes`.
- Integrada a navegacao lateral aos novos modulos.
- Validada a expansao no WSL com suites focadas de `Cargo`, `Funcao`, `Servidor` e `Lotacao`, seguida por `FuncoesIndexTest`, `LotacoesIndexTest` e novo `php artisan optimize`.

**Arquivos criados / alterados:**  
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

**Decisoes tecnicas:**  
- Os modulos foram entregues juntos porque compartilham o mesmo padrao de dominio, o mesmo papel estrutural e o mesmo tipo de uso no cadastro de servidores.
- A implementacao foi mantida incremental: listagem, cadastro e edicao, sem inflar escopo com telas de detalhe ou regras mais profundas antes da hora.
- A responsividade foi preservada com a mesma linguagem visual e estrutural de `Lotacoes`, sem introduzir um novo padrao de interface.

**Status:** Concluido ✅

### 20/04/2026 - 11:44 - Modulo Inicial de Lotacoes

**Acao realizada:**  
- Implementado `LotacaoController` com listagem, cadastro e edicao de lotacoes, mantendo o mesmo padrao arquitetural adotado nos modulos anteriores.
- Criados `StoreLotacaoRequest` e `UpdateLotacaoRequest` para garantir unicidade de codigo por tenant e integridade basica do cadastro.
- Criados services dedicados para gravacao e atualizacao, preservando controllers enxutos e regras de persistencia fora da camada HTTP.
- Implementadas telas responsivas de listagem, cadastro e edicao com o mesmo padrao visual do projeto.
- Integrada a navegacao lateral para acesso direto ao novo modulo.
- Validado o modulo em WSL com `php artisan optimize:clear`, `php artisan test --filter=Lotacao`, `php artisan test --filter=LotacoesIndexTest` e `php artisan optimize`.

**Arquivos criados / alterados:**  
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

**Decisoes tecnicas:**  
- O modulo de lotacoes foi aberto antes de cargos e funcoes porque ele impacta diretamente a qualidade do cadastro de servidores e a base do `S-1005`.
- A entrega ficou restrita a listagem, cadastro e edicao para manter evolucao incremental segura, sem inflar escopo desnecessariamente.
- A responsividade foi mantida com grids e toolbars consistentes com o restante do sistema, evitando um segundo padrao de interface.

**Status:** Concluido ✅

### 20/04/2026 - 11:10 - Detalhe e Edicao de Servidor

**Acao realizada:**  
- Evoluido o modulo `Servidores` com rotas de detalhe e edicao, mantendo o controller enxuto e a regra de negocio em service dedicado.
- Criado `UpdateServidorRequest` para validar manutencao cadastral com unicidade por tenant e reaproveitamento do padrao de admissao.
- Implementada tela de detalhe responsiva com leitura de dados pessoais, vinculo funcional e rastreabilidade dos eventos eSocial associados.
- Implementada tela de edicao responsiva reutilizando os mesmos componentes de formulario do cadastro inicial.
- A atualizacao sincroniza o payload do evento `S-2200` pendente em vez de criar eventos artificiais.
- O modulo foi validado no WSL com `php artisan optimize:clear`, `php artisan test --filter=Servidor` e `php artisan optimize`, totalizando `6` testes verdes e `32` assercoes.

**Arquivos criados / alterados:**  
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
- `docs/produto/visao-geral-do-sistema.md`
- `docs/produto/modulos-do-sistema.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/produto/backlog-funcional.md`
- `docs/produto/priorizacao.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/produto/fluxos-do-usuario.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- A tela de edicao reutiliza partials para evitar divergencia visual e funcional entre cadastro e manutencao.
- A sincronizacao do `S-2200` pendente preserva a coerencia do fluxo sem antecipar a criacao de novos eventos de alteracao.
- A responsividade foi mantida com grids que colapsam bem entre mobile, tablet e desktop, sem introduzir um novo padrao visual.

**Status:** Concluido ✅

### 20/04/2026 - 10:35 - Fluxo Inicial de Admissao de Servidor

**Acao realizada:**  
- Mapeado o estagio funcional do projeto e criada a trilha `docs/produto` com visao do sistema, backlog funcional, modulos, fluxos de usuario e priorizacao.
- Escolhida como proxima entrega a admissao inicial de servidor por ser a funcionalidade de maior valor imediato e melhor aderencia ao dominio ja existente.
- Implementados `StoreServidorRequest` e `RegistrarAdmissaoService` para validar e registrar a admissao em transacao.
- Criadas as rotas e a tela `Nova admissao`, integradas ao modulo `Servidores`.
- O fluxo agora cria `Pessoa`, `Servidor` e um evento `S-2200` pendente para rastreabilidade inicial do eSocial.
- A validacao foi executada no WSL com `php artisan optimize:clear`, `php artisan test --filter=Servidor` e `php artisan optimize`.

**Arquivos criados / alterados:**  
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

**Decisoes tecnicas:**  
- A entrega ficou concentrada no modulo `Servidores` para aproveitar a modelagem ja existente e evitar espalhar implementacoes rasas em varios modulos.
- A gravacao foi encapsulada em service para manter o controller enxuto e deixar espaco para futuras regras de negocio do eSocial.
- O fluxo abre um `S-2200` pendente em vez de tentar integrar com governo antes da maturidade cadastral do sistema.

**Status:** Concluido ✅

### 19/04/2026 - 23:54 - Rebuild e Restart Local para Testes

**Ação realizada:**  
- Refeito o ciclo de build da aplicação no WSL Ubuntu 24.04 com novo `php artisan optimize:clear`, `php artisan optimize` e `npm run build`.
- Reiniciado o backend local em `0.0.0.0:8000` e reiniciado o Vite dev server após remover o processo antigo que ainda ocupava a porta `5173`.
- Validada a retomada do ambiente local com `GET /login` respondendo `200 OK` e `GET /@vite/client` servindo o payload esperado.
- Confirmado no HTML final de `/login` que a aplicação está consumindo `/build/assets`, sem depender de `public/hot` para esta rodada de testes.

**Arquivos criados / alterados:**  
- `docs/performance/metricas-validacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- O rebuild foi executado integralmente no WSL para manter coerência com o ambiente padrão do projeto.
- A validação final priorizou disponibilidade operacional antes de uma nova rodada de testes de performance.
- O Vite foi reiniciado separadamente porque um processo antigo permaneceu ativo mesmo após a primeira limpeza.

**Status:** Concluído ✅

### 19/04/2026 - 23:32 - Otimização do Runtime Local para Performance

**Ação realizada:**  
- Preparado o runtime local para operar em modo mais performático, com `APP_DEBUG=false`, Telescope desabilitado por padrão, rota raiz compatível com cache e uso de `database` para cache e sessão.
- Criada migration idempotente para a tabela `sessions` e executado novo ciclo de `optimize:clear` e `optimize` no WSL.
- Refeitas as medições de `/`, `/login`, login via Livewire e `/dashboard`, confirmando melhora concreta no pós-login.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Http/Controllers/RootRedirectController.php`
- `backend/FolhaNova/bootstrap/providers.php`
- `backend/FolhaNova/config/telescope.php`
- `backend/FolhaNova/.env`
- `backend/FolhaNova/.env.example`
- `backend/FolhaNova/database/migrations/2026_04_19_233500_create_sessions_table.php`
- `backend/FolhaNova/tests/Feature/Auth/AuthenticationTest.php`
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/metricas-validacao.md`
- `docs/performance/tarefas-performance.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- A raiz foi mantida em controller para preservar compatibilidade com `route:cache`.
- O ganho principal desta etapa veio da redução de overhead do runtime local e não de mudanças na UI.
- O ambiente local continua exibindo variância alta entre request frio e aquecido, o que mantém o filesystem montado do Windows como suspeito forte.

**Status:** Concluído ✅

### 19/04/2026 - 23:32 - Ajuste Inicial de Navegação para Performance

**Ação realizada:**  
- Alterado o comportamento da rota `/` para enviar guest diretamente a `/login` e manter usuários autenticados indo para `/dashboard`.
- Alterado o logout da navegação para redirecionar diretamente a `/login`, removendo a cascata via `/`.
- Atualizados os testes automatizados para refletir o fluxo real e corrigida a asserção da tela de login para o componente Livewire atualmente usado.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/resources/views/livewire/layout/navigation.blade.php`
- `backend/FolhaNova/tests/Feature/ExampleTest.php`
- `backend/FolhaNova/tests/Feature/Auth/AuthenticationTest.php`
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/metricas-validacao.md`
- `docs/performance/tarefas-performance.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- Esta etapa atacou apenas o desenho de navegação HTTP, sem tratar ainda o gargalo estrutural do backend.
- A mudança reduz hops artificiais e melhora a qualidade das próximas medições comparativas.
- A suíte direcionada de autenticação e navegação passou com `7` testes verdes após o ajuste.

**Status:** Concluído ✅

### 19/04/2026 - 23:24 - Teste Controlado de Performance dos Fluxos HTTP

**Ação realizada:**  
- Executada uma rodada controlada de testes de performance por HTTP para `/`, `/login`, login via `POST /livewire/update`, `/dashboard` autenticado e logout via `POST /livewire/update`.
- Reproduzido o login real com a conta local `test@example.com` usando o snapshot real do componente Livewire da tela de login.
- Confirmada uma alta variância entre requests frios e requests aquecidos, com melhora forte em `/login` após aquecimento, mas manutenção de alto custo em `/dashboard`.

**Arquivos criados / alterados:**  
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/metricas-validacao.md`
- `docs/performance/tarefas-performance.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- O fluxo de login autenticado foi validado via HTTP sem depender apenas de medições visuais do navegador.
- O logout automatizado por sessão HTTP retornou `419` no cliente de teste após invalidação de sessão, mas o tempo do `POST /livewire/update` ainda foi útil para a análise de latência.
- A próxima etapa deve priorizar instrumentação do backend e comparação entre cold start e warm run.

**Status:** Concluído ✅

### 19/04/2026 - 23:14 - Consolidação dos Logs dos Fluxos Críticos

**Ação realizada:**  
- Incorporadas ao diagnóstico de performance as novas medições de navegador para `/`, `/login`, login via Livewire, `/dashboard` após autenticação e logout via Livewire.
- Confirmado que o padrão dominante dos fluxos críticos é tempo alto de `wait`, muito acima do tempo gasto com CSS, favicon e fonte.
- Reforçada a leitura de que o gargalo principal atual está no backend, no ambiente local e no desenho do fluxo HTTP, não no download dos assets estáticos.

**Arquivos criados / alterados:**  
- `docs/performance/diagnostico-inicial.md`
- `docs/performance/analise-carregamento-inicial.md`
- `docs/performance/analise-login.md`
- `docs/performance/analise-dashboard.md`
- `docs/performance/analise-logout.md`
- `docs/performance/metricas-validacao.md`
- `docs/performance/tarefas-performance.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- O foco da próxima etapa deve ser decompor o tempo de espera do backend antes de seguir com ajustes cosméticos ou micro-otimizações de asset.
- A prioridade subiu para instrumentação do backend e remoção de redirecionamentos em cascata.

**Status:** Concluído ✅

### 19/04/2026 - 23:04 - Diagnóstico Expandido de Performance dos Fluxos Críticos

**Ação realizada:**  
- Realizada uma leitura técnica consolidada do projeto com foco em bootstrap, carregamento inicial, login, autenticação, dashboard e logout.
- Criada uma nova trilha documental em `docs/performance` para registrar stack atual, hipóteses, evidências, tarefas priorizadas, plano de ação e métricas de validação.
- Identificados como gargalos mais fortes nesta rodada o ambiente WSL sobre `/mnt/c/.../OneDrive`, o modo de desenvolvimento pleno, os redirecionamentos em cascata de `/` e do logout, e o payload inicial acima do necessário na tela de login.

**Arquivos criados / alterados:**  
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

**Decisões técnicas:**  
- Esta etapa foi mantida diagnóstica, sem correções estruturais no código de aplicação.
- A trilha nova não substitui `docs/05-performance`; ela expande o diagnóstico para fluxos além do login e consolida um plano de medição ponta a ponta.
- As próximas correções devem ser guiadas por benchmark comparativo e priorizar primeiro ambiente e navegação, antes de micro-otimizações.

**Status:** Concluído ✅

### 19/04/2026 - 17:35 - Consolidação do Backend na Main

**Ação realizada:**  
- Identificada a causa de a pasta `backend` não aparecer corretamente na `main`: o diretório `backend/FolhaNova` estava como repositório Git separado do repositório raiz.
- Definida a estratégia de consolidação apenas do backend Laravel atual, sem incorporar o backend antigo em Python vindo de `origin/develop`.
- Preparada a integração do backend atual ao repositório principal, com preservação segura do `.git` interno em backup local antes da incorporação na `main`.

**Arquivos criados / alterados:**  
- `.gitignore`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- repositório raiz `RHevo`
- `backend/FolhaNova`

**Decisões técnicas:**  
- O backend antigo de `origin/develop` foi explicitamente descartado desta consolidação para evitar regressão arquitetural e mistura de stacks.
- A integração será feita diretamente no repositório raiz, pois esse é o único caminho para fazer o backend atual existir de fato na `main` de `Lucas-Bispo/RHevo`.
- O `.git` interno do backend não será apagado cegamente: ele será removido da árvore ativa após backup local ignorado.

**Status:** Em andamento

### 19/04/2026 - 17:19 - Atualização do README Principal

**Ação realizada:**  
- Atualizado o `README.md` principal da raiz do projeto para alinhar a documentação do ambiente com o cenário real de desenvolvimento e execução.
- Removido o conteúdo antigo que ainda descrevia um contexto genérico de `PrefRH` e consolidada uma versão coerente com o FolhaNova.
- Deixado explícito que o Windows 11 é o sistema host, o VS Code é o editor e o ambiente válido de execução local e futura produção é o Ubuntu 24.04.

**Arquivos criados / alterados:**  
- `README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- O README da raiz passou a ser a referência principal para onboarding rápido do projeto.
- A documentação foi escrita priorizando Linux como ambiente operacional, sem assumir execução nativa no Windows.
- O README técnico do backend em `backend/FolhaNova/README.md` foi preservado como complemento mais específico da aplicação.

**Status:** Concluído ✅

### 19/04/2026 - 17:15 - Diagnóstico de Performance da Tela de Login

**Ação realizada:**  
- Executado um diagnóstico documental e técnico da lentidão da aplicação com foco na rota `/login`, sem aplicar novas correções no código.
- Cruzadas evidências do ambiente WSL, do build frontend, do HTML renderizado, da configuração Laravel e dos arquivos da tela de login.
- Criada uma trilha estruturada de documentos em `docs/05-performance` com diagnóstico inicial, análise da tela, backlog priorizado, plano de ação e critérios de validação.

**Arquivos criados / alterados:**  
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

**Decisões técnicas:**  
- A etapa foi mantida estritamente diagnóstica para respeitar o fluxo definido no projeto.
- A hipótese principal registrada é de gargalo estrutural no ambiente local, reforçada pelo uso de WSL sobre `/mnt/c/.../OneDrive`, build lento e TTFB muito acima da meta.
- O custo visual do login foi documentado como fator secundário relevante, mas não como causa única da lentidão observada.

**Status:** Concluído ✅

### 19/04/2026 - 16:55 - Saneamento de Commits Pendentes

**Ação realizada:**  
- Levantados os arquivos ainda sem commit no repositório raiz e separados por grupos lógicos de documentação e prompts operacionais.
- Preparada a consolidação dos commits pendentes preservando fora do escopo itens antigos e não relacionados, como a deleção de `backend/.gitignore` e o repositório interno `backend/FolhaNova`.
- Concluídos commits separados para prompts operacionais, base organizada de documentação e acervo histórico do Obsidian, mantendo o histórico legível por assunto.

**Arquivos criados / alterados:**  
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- Os commits serão agrupados por assunto para manter histórico legível: prompts operacionais, documentação estruturada e acervo histórico do Obsidian.
- O repositório interno não será comitado novamente nesta etapa porque já contém commits próprios do módulo de login e permanece separado do repositório raiz.

**Status:** Concluído ✅

### 19/04/2026 - 16:43 - Validação de Build no WSL

**Ação realizada:**  
- Executada novamente a compilação frontend da aplicação no WSL Ubuntu 24.04 com `npm run build` dentro de `backend/FolhaNova`.
- Confirmado que o build de produção conclui com sucesso após os ajustes recentes da página de login.
- Registrado o tempo observado de compilação para acompanhamento de performance do ambiente local.

**Arquivos criados / alterados:**  
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- Mantido o fluxo oficial de validação no WSL Ubuntu 24.04, conforme padrão operacional definido no projeto.
- O resultado funcional do build foi aceito, mas o tempo total de `5m 37s` indica que ainda vale uma investigação específica de performance do pipeline local.

**Status:** Concluído ✅

### 19/04/2026 - 16:26 - Correção do Botão Entrar e Performance do Login

**Ação realizada:**  
- Corrigido o botão principal da página de login para iniciar em estado normal e exibir `Entrando...` apenas durante a submissão real do formulário.
- Adicionado controle explícito de loading no componente Livewire e reduzidas sincronizações desnecessárias com `wire:model.defer`.
- Aplicado um primeiro passe de otimização visual na tela de login, com animações mais leves, blur reduzido, suporte a `prefers-reduced-motion` e documentação específica de performance.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/05-performance/PERFORMANCE-LOGIN.md`
- `docs/05-performance/README.md`
- `docs/README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- O estado de loading foi mantido com `wire:loading` para feedback imediato no clique e reforçado com `$isLoading` no componente para previsibilidade do fluxo.
- O spinner de loading passou a ficar oculto por padrão para eliminar o falso estado inicial de carregamento.
- As otimizações priorizaram redução de trabalho no frontend sem descaracterizar a identidade visual da tela.

**Status:** Concluído ✅

### 19/04/2026 - 15:34 - Página de Login V2

**Ação realizada:**  
- Refatorado o layout da página de login para uma versão mais organizada, com fundo atmosférico e ícones 3D flutuantes de baixa competição visual.
- Mantido o formulário fixo e centralizado na área principal do card, com foco em legibilidade e destaque visual.
- Ajustados textos, link de contato com administrador e hierarquia visual do módulo de autenticação.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/app/Livewire/Forms/LoginForm.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- Removida a cena mais carregada da versão anterior para reduzir ruído visual.
- Os ícones 3D agora flutuam como nuvens com opacidade baixa e animação lenta.
- O card foi mantido estático para reforçar previsibilidade, acessibilidade e foco no login.
- A validação do campo principal foi flexibilizada para acompanhar o rótulo genérico de usuário na interface.

**Status:** Concluído ✅

### 19 de abril de 2026 - 15:20 - Página de Login

**Ação realizada:**
- Implementada uma nova página de login em Livewire 3 com foco visual em gestão pública, rede colaborativa, glassmorphism e efeitos 3D em CSS.
- Substituído o apontamento da rota de login para o novo componente de classe `App\Livewire\Auth\Login`.
- Criado o registro oficial da linha do tempo da implementação para documentar o módulo atual.

**Arquivos criados/alterados:**
- `backend/FolhaNova/routes/auth.php`
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/resources/views/components/layouts/auth-login.blade.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões de design:**
- Cena lateral construída com CSS 3D puro para preservar performance e evitar dependência extra.
- Card de login com glassmorphism, profundidade, glow institucional e botões com efeito tridimensional.
- Mantido o fluxo de autenticação do formulário existente para reaproveitar rate limiting e comportamento já validado.

**Status:** Concluído ✅
# FolhaNova - Linha do Tempo
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versao:** 1.0

### 20/04/2026 - 09:26 - Diagnostico de Performance e Evolucao eSocial Inicial

**Acao realizada:**  
- Revalidada a stack real do projeto no WSL, confirmando `Laravel 11.51.0`, `PHP 8.3.6`, `debug=false`, `cache=database`, `session=database` e `sqlite`.
- Consolidada nova rodada documental em `docs/performance` com arquivos separados para primeira pagina, pos-login, performance geral e plano atualizado.
- Criada a trilha `docs/esocial` com escopo funcional, mapeamento de eventos, prioridades e plano de implementacao aderente ao portal oficial do eSocial consultado em 20/04/2026.
- Aplicada uma otimizacao segura no login, separando o bundle JS da tela publica para remover `axios` do primeiro acesso.
- Entregue o primeiro modulo funcional real de RH, com rota `servidores.index`, tela operacional de servidores, filtros, resumo e query com eager loading para evitar N+1.
- Validada a nova rota apos limpeza de cache de rotas e executados os testes focados `ServidoresIndexTest`, com `2` testes verdes e `9` assercoes.
- Refeito `php artisan optimize` ao final para devolver o runtime local ao estado otimizado.

**Arquivos criados / alterados:**  
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

**Decisoes tecnicas:**  
- O gargalo dominante continua sendo tratado como estrutural de ambiente ate prova em contrario, porque comandos simples do Artisan permaneceram na faixa de `~36s`.
- Em vez de arriscar refactors cegos, as correcoes imediatas ficaram restritas a quick wins seguros e mensuraveis.
- A evolucao funcional seguiu em paralelo com o primeiro modulo operacional orientado a `S-2200`.

**Status:** Concluido ✅
