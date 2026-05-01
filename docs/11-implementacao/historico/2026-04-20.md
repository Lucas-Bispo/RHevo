# FolhaNova - Linha do Tempo - 20/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 20/04/2026 - 22:55 - Formalizacao do Fluxo de Producao e Seguranca

**Acao realizada:**  
- Consolidado um fluxo mais seguro para evolucao do projeto, com gates obrigatorios antes de considerar qualquer rodada estavel.
- O workflow principal passou a exigir validacao minima de ambiente, login, build, modulo alterado, testes e registro.
- Foi criado um documento proprio para separar desenvolvimento, homologacao local e producao futura.
- Ficou formalizada a politica de incidente: sem login, build, backend ou teste focado funcionando, nao se abre nova feature.

**Arquivos criados / alterados:**  
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/workflow/fluxo-de-producao-e-seguranca.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- O projeto passa a operar explicitamente em microetapas, com validacao e commit por escopo.
- A homologacao local no `WSL Ubuntu 24.04` vira gate obrigatorio antes de considerar qualquer rodada pronta.
- Incidente aberto bloqueia continuidade funcional ate a restauracao da previsibilidade do ambiente.

**Status:** Concluido


### 20/04/2026 - 22:10 - Saneamento do Payload Institucional do S-1000

**Acao realizada:**  
- Ajustado o builder do evento `S-1000` para evitar serializacao de blocos vazios no `infoCadastro`.
- O bloco `contato` deixou de ser enviado quando nenhum dado operacional foi informado.
- `natJurid` passou a ser omitido no payload quando a inscricao institucional e por `CPF`.
- Criado teste de feature cobrindo o fluxo por `CPF` e validando a estrutura final do payload.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- A rodada permaneceu restrita ao saneamento estrutural do payload, sem ampliar a superficie de validacoes oficiais ainda nao sustentadas por parser local dos PDFs.
- A prioridade foi reduzir risco de integracao futura sem alterar rotas, banco ou layout.

**Status:** Concluido


### 20/04/2026 - 22:35 - Leitura Operacional da Tela do Orgao Publico

**Acao realizada:**  
- Ajustada a tela de `OrgaoPublico` para explicitar que `natureza juridica` nao se aplica quando a inscricao institucional e por `CPF`.
- Melhorada a leitura da vigencia para diferenciar cadastro em aberto de janela delimitada.
- Criado teste de feature cobrindo a exibicao do contexto por `CPF` e a leitura da vigencia em aberto.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- A rodada ficou restrita a leitura operacional da tela, sem mexer no service, no request ou no payload do evento.
- A prioridade foi reduzir ambiguidade visual e funcional para o usuario sem abrir uma frente nova de implementacao.

**Status:** Concluido


### 20/04/2026 - 21:45 - Reforco das Validacoes Institucionais do S-1000

**Acao realizada:**  
- Reforcada a validacao do modulo `OrgaoPublico` para exigir `classificacao tributaria` no cadastro institucional.
- Passou a ser obrigatoria a `natureza juridica` quando a inscricao do ente for por `CNPJ`.
- Normalizados os campos numericos de `classificacao tributaria` e `natureza juridica` antes da persistencia.
- Ajustada a tela de edicao para sinalizar melhor os campos obrigatorios do bloco institucional.
- Criado teste de feature cobrindo a rejeicao da atualizacao invalida sem gerar evento `S-1000` inconsistente.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- A rodada ficou restrita a validacoes bem sustentadas pela documentacao ja consolidada no projeto, sem abrir uma ampliacao grande do payload do `S-1000`.
- A exigencia de `natureza juridica` foi aplicada apenas para inscricoes por `CNPJ`, evitando endurecer indevidamente cenarios por `CPF`.
- O teste foi incluido para impedir regressao silenciosa na geracao do evento institucional pendente.

**Status:** Concluido ✅


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

### 20/04/2026 - 21:20 - Alinhamento do Workflow e dos Planos de Continuidade

**Acao realizada:**  
- Atualizado o `FOLHANOVA-WORKFLOW.md` para refletir um fluxo de desenvolvimento mais cuidadoso, com leitura previa, diagnostico, plano antes da mudanca, validacao, documentacao e commit com escopo coerente.
- Reforcadas as regras oficiais de ambiente com `WSL Ubuntu 24.04` e proibicao explicita de `XAMPP`.
- Registrada a regra de precedencia entre workflow, planos de produto e plano eSocial para evitar novas divergencias na escolha da proxima frente.
- Alinhada a documentacao para deixar claro que a prioridade macro atual permanece estrutural (`S-1000`, `S-1010` e painel de eventos), enquanto `S-2205` segue como proxima etapa natural dentro da trilha eSocial do trabalhador quando essa frente for retomada.

**Arquivos criados / alterados:**  
- `FOLHANOVA-WORKFLOW.md`
- `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/produto/priorizacao.md`
- `docs/esocial/plano-implementacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- O workflow passou a explicitar o formato de resposta antes e depois de cada implementacao para reduzir mudancas cegas.
- A divergencia entre `produto` e `esocial` nao foi mascarada; ela foi resolvida com uma regra clara de precedencia documental.
- A continuidade do projeto fica protegida sem apagar a importancia da trilha `S-2205`.

**Status:** Concluido ✅
