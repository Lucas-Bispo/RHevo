# FolhaNova - Linha do Tempo - 01/05/2026

Registros historicos de implementacao separados para leitura rapida.

### 01/05/2026 - Catalogo Local de Categorias S-2200

**Acao realizada:**
- Criar catalogo local inicial de categorias de trabalhador suportadas.
- Reutilizar o catalogo na validacao de criacao e edicao de servidor.
- Reutilizar o catalogo nos formularios de admissao e alteracao contratual.
- Bloquear categoria eSocial fora do recorte local preparado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Support/Esocial/CategoriasTrabalhador.php`
- `backend/FolhaNova/app/Http/Requests/StoreServidorRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateServidorRequest.php`
- `backend/FolhaNova/resources/views/servidores/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/servidores/partials/contract-form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/ServidorAdmissaoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Support/Esocial/CategoriasTrabalhador.php app/Http/Requests/StoreServidorRequest.php app/Http/Requests/UpdateServidorRequest.php tests/Feature/ServidorAdmissaoTest.php`: sem pendencias.
- `php artisan test tests/Feature/ServidorAdmissaoTest.php tests/Feature/ServidorDetailTest.php tests/Feature/ServidoresIndexTest.php`: `12` testes verdes e `66` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `144` testes verdes e `878` assercoes.

**Status:** Concluido

### 01/05/2026 - Matricula Normalizada para S-2200

**Acao realizada:**
- Normalizar `matricula` de servidores antes da validacao.
- Aparar `categoria_esocial` antes da validacao.
- Cobrir duplicidade de matricula com entrada em caixa baixa e espacos nas bordas.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreServidorRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateServidorRequest.php`
- `backend/FolhaNova/tests/Feature/ServidorAdmissaoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Http/Requests/StoreServidorRequest.php app/Http/Requests/UpdateServidorRequest.php tests/Feature/ServidorAdmissaoTest.php`: sem pendencias apos limpeza automatica de import.
- `php artisan test tests/Feature/ServidorAdmissaoTest.php tests/Feature/ServidorDetailTest.php tests/Feature/ServidoresIndexTest.php`: `11` testes verdes e `59` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `143` testes verdes e `871` assercoes.

**Status:** Concluido

### 01/05/2026 - Unicidade Local de Codigos S-1005/S-1020

**Acao realizada:**
- Normalizar `codigo_esocial` de lotacoes antes da validacao.
- Impedir duplicidade de codigo eSocial de lotacoes por tenant.
- Cobrir duplicidade com entrada em caixa baixa e espacos nas bordas.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreLotacaoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateLotacaoRequest.php`
- `backend/FolhaNova/tests/Feature/LotacaoCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Http/Requests/StoreLotacaoRequest.php app/Http/Requests/UpdateLotacaoRequest.php tests/Feature/LotacaoCrudTest.php`: sem pendencias.
- `php artisan test tests/Feature/LotacaoCrudTest.php tests/Feature/LotacoesIndexTest.php`: `9` testes verdes e `47` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `142` testes verdes e `865` assercoes.

**Status:** Concluido

### 01/05/2026 - Unicidade Local de Codigos S-1030/S-1040

**Acao realizada:**
- Normalizar `codigo_esocial` de cargos e funcoes antes da validacao.
- Impedir duplicidade de codigo eSocial de cargos por tenant.
- Impedir duplicidade de codigo eSocial de funcoes por tenant.
- Cobrir duplicidade com entradas em caixa baixa e espacos nas bordas.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreCargoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateCargoRequest.php`
- `backend/FolhaNova/app/Http/Requests/StoreFuncaoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateFuncaoRequest.php`
- `backend/FolhaNova/tests/Feature/CargoCrudTest.php`
- `backend/FolhaNova/tests/Feature/FuncaoCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Http/Requests/StoreCargoRequest.php app/Http/Requests/UpdateCargoRequest.php app/Http/Requests/StoreFuncaoRequest.php app/Http/Requests/UpdateFuncaoRequest.php tests/Feature/CargoCrudTest.php tests/Feature/FuncaoCrudTest.php`: sem pendencias.
- `php artisan test tests/Feature/CargoCrudTest.php tests/Feature/FuncaoCrudTest.php tests/Feature/CargosIndexTest.php tests/Feature/FuncoesIndexTest.php`: `14` testes verdes e `68` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `141` testes verdes e `860` assercoes.

**Status:** Concluido

### 01/05/2026 - Catalogo Local de Tipos de Lotacao S-1005/S-1020

**Acao realizada:**
- Criar catalogo local inicial de tipos de lotacao suportados.
- Reutilizar o catalogo na validacao de criacao e edicao.
- Reutilizar o catalogo nas opcoes do formulario.
- Reutilizar o catalogo na leitura da listagem de lotacoes.
- Bloquear tipo de lotacao fora do recorte local preparado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Support/Esocial/TiposLotacao.php`
- `backend/FolhaNova/app/Http/Requests/StoreLotacaoRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateLotacaoRequest.php`
- `backend/FolhaNova/resources/views/lotacoes/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/index.blade.php`
- `backend/FolhaNova/tests/Feature/LotacaoCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Support/Esocial/TiposLotacao.php app/Http/Requests/StoreLotacaoRequest.php app/Http/Requests/UpdateLotacaoRequest.php tests/Feature/LotacaoCrudTest.php`: sem pendencias.
- `php artisan test tests/Feature/LotacaoCrudTest.php tests/Feature/LotacoesIndexTest.php`: `8` testes verdes e `42` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `139` testes verdes e `850` assercoes.

**Status:** Concluido

### 01/05/2026 - Catalogo Local de Classificacoes S-1000

**Acao realizada:**
- Criar catalogo local inicial de classificacoes tributarias suportadas para `S-1000`.
- Reutilizar o catalogo na validacao do orgao publico.
- Reutilizar o catalogo nas opcoes do formulario.
- Reutilizar o catalogo na tela de leitura dos parametros institucionais.
- Manter a regra de compatibilidade entre tipo de inscricao e classificacao tributaria.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Support/Esocial/ClassificacoesTributarias.php`
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Support/Esocial/ClassificacoesTributarias.php app/Http/Requests/UpdateOrgaoPublicoRequest.php`: sem pendencias.
- `php artisan test tests/Feature/OrgaoPublicoTest.php`: `20` testes verdes e `117` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `138` testes verdes e `840` assercoes.

**Status:** Concluido

### 01/05/2026 - Catalogo Local de Naturezas S-1010

**Acao realizada:**
- Registrar a decisao de deixar integracao real com governo para a ultima macroetapa.
- Criar catalogo local inicial de naturezas de rubrica suportadas para `S-1010`.
- Substituir entrada livre de `natRubr` por selecao controlada no formulario.
- Validar criacao e edicao de rubricas contra o catalogo local.
- Atualizar o guia de consistencia para mostrar a natureza reconhecida.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Support/Esocial/NaturezasRubrica.php`
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/resources/views/rubricas/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/rubricas/partials/consistency-guide.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/priorizacao.md`
- `docs/produto/plano-de-implementacao.md`
- `docs/esocial/plano-implementacao.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `./vendor/bin/pint app/Support/Esocial/NaturezasRubrica.php app/Http/Requests/StoreRubricaRequest.php app/Http/Requests/UpdateRubricaRequest.php tests/Feature/RubricaCrudTest.php`: sem pendencias.
- `php artisan test tests/Feature/RubricaCrudTest.php`: `18` testes verdes e `127` assercoes.
- `npm run build`: build Vite concluido.
- `php artisan test`: `138` testes verdes e `840` assercoes.

**Status:** Concluido

### 01/05/2026 - Diagnostico de Maturidade 0-100

**Acao realizada:**
- Revisar o fluxo oficial de desenvolvimento.
- Conferir roadmap, priorizacao de produto, plano eSocial, backlog e funcionalidades existentes.
- Confrontar a documentacao com o estado tecnico da aplicacao Laravel.
- Validar ambiente local, rotas, migrations, login e Vite.
- Estimar a maturidade atual do projeto em escala de `0` a `100`.

**Arquivos criados / alterados:**
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `bash scripts/bootstrap_native_wsl.sh .`: backend e Vite iniciados.
- `curl http://127.0.0.1:8000/login`: `200 OK`.
- `curl http://127.0.0.1:5173/resources/js/app.js`: `200 OK`.
- `php artisan route:list --except-vendor`: `37` rotas registradas.
- `php artisan migrate:status`: todas as migrations locais executadas.
- `npm run build`: build Vite concluido.
- `php artisan test`: `137` testes verdes e `830` assercoes.

**Leitura de maturidade:**
- Ambiente local e fluxo WSL: `85/100`.
- Fundacao tecnica Laravel, auth, rotas, services e testes: `70/100`.
- Produto administrativo e cadastros base: `55/100`.
- eSocial operacional local: `35/100`.
- Integracao eSocial real com governo: `10/100`.
- Prontidao de producao: `20/100`.
- Maturidade global estimada: `42/100`.

**Status:** Concluido

### 01/05/2026 - Atalhos S-1005/S-1020 no Painel eSocial

**Acao realizada:**
- Adicionar cards dedicados para `S-1005` e `S-1020` no painel eSocial.
- Conectar esses cards ao filtro existente por evento.
- Manter a leitura por grupo operacional de eventos de tabela.
- Validar com teste focado do painel.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php`: `21` testes verdes e `146` assercoes.
- `./vendor/bin/pint app/Http/Controllers/EventoEsocialController.php tests/Feature/EventosEsocialIndexTest.php`: sem alteracoes pendentes.
- `npm run build`: build Vite concluido com sucesso.

**Status:** Concluido

### 01/05/2026 - Reprocessamento S-1000 no Orgao Publico

**Acao realizada:**
- Exibir acao direta de reprocessamento local no orgao publico quando o `S-1000` atual estiver com erro.
- Reaproveitar a rota existente `eventos-esocial.reprocessar`.
- Validar a renderizacao com teste focado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php`: `20` testes verdes e `117` assercoes.
- `./vendor/bin/pint tests/Feature/OrgaoPublicoTest.php`: sem alteracoes pendentes.

**Status:** Concluido

### 01/05/2026 - Prontidao S-1000 com Evento em Erro

**Acao realizada:**
- Ajustar a prontidao `S-1000` para considerar evento local com `erro` como pendencia.
- Exibir a pendencia na tela do orgao publico.
- Refletir a contagem de pendencias no dashboard.
- Validar com testes focados.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/OrgaoPublicoController.php`
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`
- `docs/11-implementacao/historico/10-consolidacao-cadastros-esocial-2026-05-01.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php tests/Feature/DashboardTest.php`: `22` testes verdes e `184` assercoes.
- `./vendor/bin/pint app/Http/Controllers/OrgaoPublicoController.php app/Http/Controllers/DashboardController.php tests/Feature/OrgaoPublicoTest.php tests/Feature/DashboardTest.php`: sem alteracoes pendentes.

**Status:** Concluido
