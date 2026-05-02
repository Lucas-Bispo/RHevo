# FolhaNova - Backlog Geral - 20/04/2026

Entradas historicas de backlog separadas para leitura rapida.

### PRODUTO-FLUXO-SEGURANCA-OPERACIONAL - 20/04/2026

**Descricao:**  
Formalizar um fluxo seguro de evolucao e liberacao local para evitar regressao recorrente de login, ambiente, build e modulo quebrado durante o desenvolvimento.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/workflow/fluxo-de-producao-e-seguranca.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- fluxo oficial passou a exigir gates minimos de ambiente, login, build e testes
- ficou explicita a politica de incidente
- o projeto passou a diferenciar desenvolvimento, homologacao local e producao futura


### PRODUTO-S1000-PAYLOAD-CONSISTENTE - 20/04/2026

**Descricao:**  
Sanear o payload institucional do `S-1000` para evitar serializacao de blocos vazios e remover `natJurid` quando a inscricao institucional for por `CPF`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- payload do `S-1000` ficou mais consistente para a futura camada de integracao
- bloco `contato` deixou de ser enviado quando vazio
- `natJurid` deixou de ser serializado em inscricoes institucionais por `CPF`


### PRODUTO-S1000-LEITURA-OPERACIONAL - 20/04/2026

**Descricao:**  
Ajustar a leitura operacional da tela de `OrgaoPublico` para refletir corretamente cenarios por `CPF` e deixar a vigencia institucional mais clara para o usuario.

**Status:** Concluido  
**Prioridade:** Media  
**Arquivos envolvidos:**  
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- a tela passou a informar quando `natureza juridica` nao se aplica ao contexto por `CPF`
- a vigencia passou a ficar mais legivel para leitura operacional
- o comportamento ficou coberto por teste de feature


### PRODUTO-S1000-VALIDACOES-INSTITUCIONAIS - 20/04/2026

**Descricao:**  
Reforcar o modulo de parametros do orgao publico com validacoes mais consistentes para a trilha `S-1000`, exigindo `classificacao tributaria` e `natureza juridica` quando a inscricao institucional for por `CNPJ`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- validacao institucional do `S-1000` ficou mais aderente a base documental do projeto
- atualizacao invalida deixou de gerar evento pendente inconsistente
- tela passou a sinalizar melhor os campos estruturais essenciais


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

### DOCS-ALINHAMENTO-WORKFLOW-E-PLANOS - 20/04/2026

**Descricao:**  
Consolidar o fluxo oficial de desenvolvimento do projeto, incorporando regras mais fortes de leitura previa, diagnostico, plano antes da alteracao, validacao e documentacao, alem de alinhar a precedencia entre `docs/produto/` e `docs/esocial/`.

**Status:** Concluido  
**Prioridade:** Alta  
**Arquivos envolvidos:**  
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/produto/priorizacao.md`
- `docs/esocial/plano-implementacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Resultado:**  
- workflow do projeto reforcado com protocolo explicito antes e depois de cada implementacao
- regra de precedencia entre planos documentada
- proxima frente do produto alinhada com a trilha estrutural antes do retorno ao historico funcional
