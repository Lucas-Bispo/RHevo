# FolhaNova - Linha do Tempo - 21/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 21/04/2026 - 22:50 - Atalho para Eventos Processados no Painel eSocial

**Acao realizada:**
- Transformado o card `Processados` em atalho para a listagem filtrada por eventos processados.
- Preservada a leitura visual do resumo operacional.
- Criado teste cobrindo o link para `status=processado`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `10` testes verdes e `37` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 22:40 - Atalho para Eventos Pendentes no Painel eSocial

**Acao realizada:**
- Transformado o card `Pendentes` em atalho para a listagem filtrada por eventos pendentes.
- Preservada a leitura visual do resumo operacional.
- Criado teste cobrindo o link para `status=pendente`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `9` testes verdes e `33` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 22:30 - Filtro por Codigo eSocial em Rubricas S-1010

**Acao realizada:**
- Adicionado filtro de rubricas com `codigo_esocial`.
- Transformado o card `Com codigo eSocial` em atalho para a listagem filtrada.
- Criado teste cobrindo o filtro e o link operacional do card.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php` e `tests/Feature/RubricasIndexTest.php`: `9` testes verdes e `35` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 22:20 - Atalho do S-1000 para Detalhe do Evento

**Acao realizada:**
- Adicionado atalho na tela de parametros do orgao publico para o detalhe do evento `S-1000`.
- O botao aparece somente quando ha evento preparado para o tenant atual.
- Criado teste cobrindo o link para o detalhe do evento eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `9` testes verdes e `43` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 22:10 - Atalho para Eventos com Erro no Painel eSocial

**Acao realizada:**
- Transformado o card `Com erro` em atalho para a listagem filtrada por eventos com erro.
- Preservada a leitura visual do resumo operacional.
- Criado teste cobrindo o link para `status=erro`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `8` testes verdes e `29` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 22:00 - Filtro por Incidencia na Listagem de Rubricas S-1010

**Acao realizada:**
- Adicionado filtro de incidencia na listagem de rubricas.
- O filtro aceita apenas `irrf`, `inss` e `fgts`.
- A tela passou a exibir um select dedicado para auditoria das incidencias.
- Criado teste cobrindo a filtragem por `incidencia=irrf`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php` e `tests/Feature/RubricasIndexTest.php`: `8` testes verdes e `30` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 21:45 - Orientacao de Reprocessamento no Detalhe eSocial

**Acao realizada:**
- Adicionada orientacao visual no detalhe de eventos com `status = erro`.
- A tela passa a explicar que o evento pode ser reenfileirado para reprocessamento local.
- Criado teste focado para preservar a leitura operacional da acao.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `8` testes verdes e `28` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 21:35 - Resumo de Eventos com Erro no Painel eSocial

**Acao realizada:**
- Adicionado indicador de eventos com `status = erro` ao resumo do painel eSocial.
- O card passa a orientar prioridade de reprocessamento local.
- Criado teste para confirmar que a contagem de erros respeita o tenant atual.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `7` testes verdes e `25` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 21:25 - Filtro por Tipo na Listagem de Rubricas S-1010

**Acao realizada:**
- Adicionado filtro por tipo na listagem de rubricas.
- O filtro aceita somente `provento`, `desconto` e `informativa`.
- A tela passou a exibir um select dedicado para tipo de rubrica.
- Criado teste cobrindo a filtragem por `desconto`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php` e `tests/Feature/RubricasIndexTest.php`: `7` testes verdes e `26` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 21:15 - Normalizacao de Entradas de Rubricas S-1010

**Acao realizada:**
- Adicionada normalizacao previa nos requests de criacao e edicao de rubricas.
- Campos `codigo`, `nome` e `natureza` passam por `trim` antes da validacao.
- `codigo_esocial` vazio passa a ser tratado como `null`.
- Criado teste para impedir duplicidade de `codigo` mascarada por espacos no mesmo tenant.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php` e `tests/Feature/RubricasIndexTest.php`: `6` testes verdes e `22` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- CSS e JS compilados em `/build/assets`: `200 OK`.

**Status:** Concluido


### 21/04/2026 - 21:05 - Leitura da Classificacao Tributaria no S-1000

**Acao realizada:**
- Melhorada a tela de orgao publico para exibir a classificacao tributaria com codigo e descricao.
- Mantido fallback para classificacao ainda nao mapeada, preservando a leitura do codigo existente.
- Criado teste focado para garantir que o codigo `85` aparece com descricao operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/orgao-publico/show.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `8` testes verdes e `40` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- Vite serviu `resources/js/app.js`.

**Status:** Concluido


### 21/04/2026 - 20:55 - Classificacao Tributaria Controlada no S-1000

**Acao realizada:**
- Evoluido o modulo de parametros do orgao publico para deixar `classTrib` menos livre na edicao do `S-1000`.
- Restringida `classificacao_tributaria` a uma lista inicial controlada de codigos suportados nesta etapa do produto.
- Substituido o campo livre da tela por um select com os codigos atualmente tratados pelo sistema.
- Criado teste focado garantindo que codigo nao mapeado e rejeitado sem gerar evento `S-1000` pendente.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `7` testes verdes e `38` assercoes.
- `tests/Feature/Auth/AuthenticationTest.php`: `5` testes verdes e `15` assercoes.
- `GET /login`: `200 OK`.
- Vite serviu `resources/js/app.js`.
- `GET /orgao-publico` sem sessao redirecionou corretamente para `/login`.

**Status:** Concluido


### 21/04/2026 - 10:05 - Retomada Operacional do Ambiente Local

**Acao realizada:**
- Reconsultada a documentacao de workflow, recuperacao, performance, backlog, linha do tempo e ambiente WSL antes de qualquer nova evolucao.
- Validado o runtime oficial no `WSL Ubuntu 24.04`, com `PHP 8.3.6`, `Laravel 11.51.0`, `APP_DEBUG=false`, locale `pt_BR` e timezone `America/Sao_Paulo`.
- Garantida a conta local `test@example.com` pelo script `scripts/ensure_local_login.php`.
- Iniciado o backend Laravel pelo script `scripts/run_backend_detached.sh`.
- Iniciado o Vite pelo script `scripts/run_vite_detached.sh`.
- Validado `GET /login` com `200 OK` e confirmado no snapshot Livewire que `isLoading=false` no estado inicial do botao de login.

**Arquivos criados / alterados:**
- `docs/performance/metricas-validacao.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**
- A rodada foi tratada como retomada operacional, sem alteracao de codigo.
- Foi preservado o fluxo oficial em WSL e evitada abertura de feature com o ambiente ainda nao validado.
- Foi registrada divergencia entre documentacao anterior e ambiente atual: `cache` e `session` aparecem como `file`, embora registros anteriores apontassem `database`.

**Validacao:**
- `GET /login`: `200 OK`
- Vite ativo em `0.0.0.0:5173`
- Backend ativo em `0.0.0.0:8000`
- `GET /@vite/client`: `200 OK`

**Status:** Concluido


### 21/04/2026 - 12:20 - Reprocessamento Local de Eventos eSocial com Erro

**Acao realizada:**
- Evoluido o painel de eventos eSocial com uma acao de reprocessamento local.
- A acao foi limitada a eventos com `status = erro`.
- O registro volta para `pendente`, preservando o payload e limpando protocolo, recibo, mensagem de retorno e timestamps de envio/processamento.
- Eventos processados permanecem protegidos contra reenfileiramento nesta etapa.

**Arquivos criados / alterados:**
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/app/Services/EventosEsocial/ReprocessarEventoEsocialService.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/fluxos-do-usuario.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/esocial/mapeamento-esocial.md`
- `docs/esocial/regras-negocio.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**
- A rodada ficou restrita a operacao local do painel, sem fila real, assinatura, transmissao ou consulta de retorno.
- Foi criada uma service dedicada para manter a regra de reprocessamento fora da view e concentrada fora do controller.
- A limpeza de recibo/protocolo foi bloqueada para eventos processados, evitando perda operacional indevida.

**Validacao:**
- `php artisan test tests/Feature/EventoEsocialShowTest.php tests/Feature/EventosEsocialIndexTest.php`
- `GET /login`: deve permanecer `200 OK` com assets compilados.

**Status:** Concluido


### 21/04/2026 - 11:55 - Validacao Inicial da Natureza de Rubrica S-1010

**Acao realizada:**  
- Evoluido o modulo de rubricas com uma validacao incremental para o `S-1010`.
- O campo `natureza` passou a representar explicitamente o codigo `natRubr`, com 4 digitos numericos.
- Atualizada a leitura da tela para exibir `Natureza eSocial`.
- Adicionado teste cobrindo rejeicao de natureza textual, evitando regressao para preenchimento livre.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/app/Services/Rubricas/RegistrarRubricaService.php`
- `backend/FolhaNova/app/Services/Rubricas/AtualizarRubricaService.php`
- `backend/FolhaNova/resources/views/rubricas/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- A rodada ficou restrita a validacao local e leitura operacional, sem migration.
- A lista fechada de naturezas oficiais nao foi implementada porque os PDFs locais nao puderam ser extraidos de forma confiavel nesta sessao.
- A mudanca prepara uma futura tabela/enum oficial de naturezas sem bloquear o CRUD atual alem do formato numerico minimo.

**Validacao:**  
- `php artisan test tests/Feature/RubricaCrudTest.php tests/Feature/RubricasIndexTest.php`: `5` testes verdes e `17` assercoes.
- `GET /login`: `200`.
- `GET /rubricas` como guest: `302` para `/login`.

**Status:** Concluido


### 21/04/2026 - 11:30 - Subida Estavel do Projeto no WSL

**Acao realizada:**  
- Revalidada a orientacao documental antes da operacao local.
- Confirmado que `public/hot` esta ausente, evitando que o Laravel use o Vite dev server durante a homologacao local.
- Confirmado que o backend Laravel esta ouvindo em `0.0.0.0:8000`.
- Confirmado que `public/build/manifest.json` existe e que `/login` referencia os assets compilados.
- Garantida a conta local `test@example.com` pelo script `scripts/ensure_local_login.php`.

**Arquivos criados / alterados:**  
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- `docs/performance/metricas-validacao.md`

**Decisoes tecnicas:**  
- A subida foi mantida em modo estavel: backend Laravel ativo e Vite desligado.
- Nenhum codigo de aplicacao foi alterado.
- A validacao priorizou login, assets compilados e previsibilidade visual.

**Validacao:**  
- `GET /login`: `200`.
- CSS compilado: `200`, `110503` bytes.
- JS compilado: `200`, `37977` bytes.
- HTML final de `/login` apontando para `/build/assets`.

**Status:** Concluido


### 21/04/2026 - 10:25 - Recuperacao do Frontend por Assets Compilados

**Acao realizada:**  
- Investigada a quebra visual do frontend apos a retomada do ambiente local.
- Confirmado que o build de producao do Vite conclui com sucesso no `WSL Ubuntu 24.04`.
- Identificado que a presenca de `public/hot` fazia o Laravel priorizar o Vite dev server na tela de login.
- Removido `public/hot` e encerrado o Vite dev server para restaurar o uso dos assets compilados em `public/build`.
- Validado no HTML de `/login` que a tela voltou a referenciar `/build/assets/app-BKPuZS5v.css` e `/build/assets/app-BBasPo4V.js`.

**Arquivos criados / alterados:**  
- `docs/frontend/recuperacao-login-layout.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisoes tecnicas:**  
- A correcao foi mantida operacional e documental, sem alterar codigo de layout, rota ou autenticacao.
- Para validacao estavel local, o projeto deve usar `npm run build` e backend Laravel sem `public/hot`.
- O Vite dev server deve ser usado com cautela ate uma rodada especifica diagnosticar sua lentidao/inconsistencia no ambiente atual.

**Validacao:**  
- `npm run build`: sucesso, CSS `110.50 kB` e JS `37.98 kB`.
- `GET /login`: `200`.
- CSS compilado: `200`, `110503` bytes.
- JS compilado: `200`, `37977` bytes.
- `php artisan test tests/Feature/Auth/AuthenticationTest.php tests/Feature/ExampleTest.php`: `7` testes verdes e `19` assercoes.

**Status:** Concluido


### 21/04/2026 - 20:40 - Subida Controlada do Ambiente Local

**Acao realizada:**  
- Consultado o workflow oficial e a documentacao de ambiente antes de iniciar a operacao.
- Verificadas dependencias no `WSL Ubuntu 24.04`: `PHP 8.3.6`, `Composer 2.7.1`, `Node 20.20.2`, `npm 10.8.2`, `vendor` e `node_modules`.
- Identificado que `php artisan serve` nao abriu porta neste ambiente durante os testes controlados.
- Subido o backend de forma operacional com `php -S 0.0.0.0:8000 -t public public/index.php`.
- Subido o frontend com `npm run dev -- --host 0.0.0.0 --port 5173`.
- Garantido o usuario local de teste com `scripts/ensure_local_login.php`.

**Validacoes realizadas:**  
- `GET /login` respondeu `200 OK`.
- `GET /` redirecionou para `/login`.
- `GET /dashboard` sem sessao redirecionou corretamente para `/login`.
- Vite serviu `@vite/client` e `resources/js/app.js`.
- Rotas focadas `login` e `dashboard` confirmadas via `php artisan route:list --path=...`.
- Teste focado `tests/Feature/Auth/AuthenticationTest.php` passou com `5` testes e `15` assercoes.

**Observacoes:**  
- O ambiente continua lento por estar em WSL sobre caminho `/mnt/c/.../OneDrive`; comandos Artisan focados ficaram na faixa de dezenas de segundos.
- O unico erro novo registrado no log durante a rodada foi a tentativa invalida de usar `php artisan route:list --compact`, opcao inexistente nesta versao, sem impacto funcional.

**Status:** Ambiente local no ar.
