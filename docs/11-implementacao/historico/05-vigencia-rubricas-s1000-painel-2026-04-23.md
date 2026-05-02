# FolhaNova - Linha do Tempo - 23/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 23/04/2026 - Inicio de Vigencia Coerente para Rubrica Ativa

**Acao realizada:**
- Ajustada a validacao de rubricas para bloquear `inicio_validade` futuro quando a rubrica estiver ativa.
- Preservada a possibilidade de vigencia futura para rubricas ainda nao ativas.
- Criados testes focados para impedir criacao e edicao de rubricas ativas com inicio posterior a data atual.
- Documentada a regra nas trilhas funcional e eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`: `15` testes verdes e `84` assercoes.

**Status:** Concluido


### 23/04/2026 - Vigencia Coerente para Rubrica Ativa

**Acao realizada:**
- Ajustada a validacao de rubricas para bloquear `fim_validade` passado quando a rubrica estiver ativa.
- Preservada a possibilidade de rubrica ativa sem data final informada.
- Criados testes focados para impedir criacao e edicao de rubricas ativas com vigencia ja encerrada.
- Documentada a regra nas trilhas funcional e eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`: `13` testes verdes e `76` assercoes.

**Status:** Concluido


### 23/04/2026 - Encerramento de Rubrica com Fim de Validade Obrigatorio

**Acao realizada:**
- Ajustada a validacao de rubricas para exigir `fim_validade` quando a rubrica for salva como inativa.
- Preservada a regra existente que impede `fim_validade` anterior ao `inicio_validade`.
- Criados testes focados para bloquear criacao e edicao de rubricas inativas sem data de encerramento.
- Documentada a regra na trilha funcional e nas regras eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`: `11` testes verdes e `68` assercoes.

**Status:** Concluido


### 23/04/2026 - Filtro por Origem no Painel eSocial

**Acao realizada:**
- Adicionado filtro `Origem` no formulario principal do painel eSocial.
- O painel passou a filtrar pelo campo `payload.origem` e exibir a origem ativa no resumo de filtros.
- A tela de detalhe do evento ganhou o atalho `Mesma origem`.
- Ajustados testes focados do painel e do detalhe para validar a nova navegacao operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php` e `tests/Feature/EventoEsocialShowTest.php`: `20` testes verdes e `108` assercoes.

**Status:** Concluido


### 23/04/2026 - Atalhos de Apoio S-1010 na Criacao de Rubrica

**Acao realizada:**
- Adicionado bloco lateral `Apoio S-1010` na tela de criacao de rubrica.
- Incluidos atalhos para o painel `S-1010`, pendencias sem codigo, rubricas com codigo e rubricas ativas.
- Mantida a tela de cadastro enxuta, reaproveitando filtros e navegacoes ja existentes no produto.
- Ajustado teste focado para validar os links operacionais da nova caixa.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/create.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`: `9` testes verdes e `60` assercoes.

**Status:** Concluido


### 23/04/2026 - Atalhos Contextuais na Edicao de Rubrica

**Acao realizada:**
- Expandida a caixa `Revisao S-1010` na tela de edicao de rubrica.
- Adicionados atalhos contextuais para `status`, `tipo`, `codigo eSocial` e incidencias marcadas na rubrica atual.
- Rubricas com codigo passaram a apontar para a base parametrizada, enquanto pendencias continuam levando para `sem codigo`.
- Criado teste focado cobrindo a adaptacao dos atalhos conforme o cadastro aberto.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php`: `9` testes verdes e `51` assercoes.

**Status:** Concluido


### 23/04/2026 - Atalhos por Incidencia na Listagem de Rubricas

**Acao realizada:**
- Adicionados cards por incidencia na listagem de rubricas.
- Os cards `IRRF`, `INSS` e `FGTS` agora funcionam como atalhos operacionais.
- Controller passou a calcular as contagens por incidencia no resumo da tela.
- Criado teste focado cobrindo os links e a filtragem por incidencia.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php`: `9` testes verdes e `62` assercoes.

**Status:** Concluido


### 23/04/2026 - Atalhos por Tipo na Listagem de Rubricas

**Acao realizada:**
- Adicionados cards por tipo na listagem de rubricas.
- Os cards `Provento`, `Desconto` e `Informativa` agora funcionam como atalhos operacionais.
- Controller passou a calcular as contagens por tipo no resumo da tela.
- Criado teste focado cobrindo os links e a filtragem por tipo.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/RubricaController.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php`: `8` testes verdes e `53` assercoes.

**Status:** Concluido


### 23/04/2026 - Atalho de Retorno no Detalhe do Evento eSocial

**Acao realizada:**
- Adicionado atalho contextual de retorno no detalhe do evento eSocial.
- Eventos com mensagem registrada agora oferecem o link `Com retorno`.
- Eventos sem mensagem registrada agora oferecem o link `Sem retorno`.
- O atalho reaproveita os filtros `retorno=com_mensagem` e `retorno=sem_mensagem` ja existentes no painel.
- Criado teste focado cobrindo os dois cenarios.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/tests/Feature/EventoEsocialShowTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventoEsocialShowTest.php`: `6` testes verdes e `30` assercoes.

**Status:** Concluido


### 23/04/2026 - Card de Eventos Sem Retorno no Painel eSocial

**Acao realizada:**
- Adicionado card `Sem retorno` no resumo do painel eSocial.
- O card mostra a contagem de eventos sem `mensagem_retorno`.
- O atalho abre a listagem filtrada por `retorno=sem_mensagem`.
- Criado teste focado para validar o link operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php`: `13` testes verdes e `71` assercoes.

**Status:** Concluido


### 23/04/2026 - Atalhos por Status na Listagem de Rubricas

**Acao realizada:**
- Transformados os cards `Ativas` e `Inativas` da listagem de rubricas em atalhos operacionais.
- Os cards agora apontam para a mesma tela com filtro `status=ativos` ou `status=inativos`.
- A leitura visual da tela foi preservada.
- Criado teste focado cobrindo os links e a filtragem resultante.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php`: `7` testes verdes e `44` assercoes.

**Status:** Concluido


### 23/04/2026 - Filtros Ativos na Listagem de Rubricas S-1010

**Acao realizada:**
- Adicionado bloco `Filtros ativos` na listagem de rubricas.
- O bloco passa a exibir busca, status, tipo, incidencia e situacao eSocial quando aplicados.
- Incluida acao `Limpar filtros` para retornar a listagem completa.
- Criado teste focado com filtros combinados para validar a leitura operacional.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricasIndexTest.php`: `6` testes verdes e `37` assercoes.

**Status:** Concluido


### 23/04/2026 - Filtro de Eventos Sem Retorno no Painel eSocial

**Acao realizada:**
- Adicionado suporte a `retorno=sem_mensagem` no painel eSocial.
- A listagem passou a filtrar eventos sem `mensagem_retorno`.
- O formulario de filtros agora permite selecionar `Com mensagem` ou `Sem mensagem`.
- O resumo de filtros ativos exibe `Retorno: Sem mensagem`.
- Criado teste focado para validar a nova filtragem.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php`: `12` testes verdes e `67` assercoes.

**Status:** Concluido


### 23/04/2026 - Filtro de Retorno no Formulario do Painel eSocial

**Acao realizada:**
- Adicionado select `Retorno` no formulario principal do painel eSocial.
- Reaproveitado o filtro existente `retorno=com_mensagem`.
- Preservados o card `Com retorno` e o resumo visual de filtros ativos.
- Ajustado teste focado para confirmar a opcao selecionada no formulario.

**Arquivos criados / alterados:**
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/EventosEsocialIndexTest.php`: `11` testes verdes e `62` assercoes.

**Status:** Concluido


### 23/04/2026 - Codigo eSocial Unico nas Rubricas S-1010

**Acao realizada:**
- Normalizado `codigo_esocial` de rubricas para caixa alta na criacao e edicao.
- Adicionada validacao de unicidade de `codigo_esocial` por tenant quando informado.
- Preservadas rubricas sem codigo eSocial como pendencias validas de parametrizacao.
- Criado teste focado para bloquear duplicidade com variacao de caixa e espacos.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/app/Services/Rubricas/RegistrarRubricaService.php`
- `backend/FolhaNova/app/Services/Rubricas/AtualizarRubricaService.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php` e `tests/Feature/RubricasIndexTest.php`: `13` testes verdes e `61` assercoes.

**Status:** Concluido


### 23/04/2026 - Normalizacao de Natureza Juridica por CPF no S-1000

**Acao realizada:**
- Ajustada a sincronizacao dos parametros institucionais para descartar `natureza_juridica` quando o `S-1000` usa inscricao por CPF.
- Preservado o envio de `natJurid` apenas para inscricoes por CNPJ.
- Ampliado teste focado para garantir que um valor enviado indevidamente em contexto CPF nao seja persistido no metadata nem serializado no payload.
- Documentada a regra na trilha funcional e nas regras eSocial.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `13` testes verdes e `79` assercoes.

**Status:** Concluido


### 23/04/2026 - Compatibilidade de Classificacao no S-1000

**Acao realizada:**
- Adicionada validacao entre tipo de inscricao institucional e classificacao tributaria suportada no `S-1000`.
- Inscricoes por CNPJ deixam de aceitar a classificacao `21`, reservada ao contexto por CPF nesta etapa.
- Inscricoes por CPF deixam de aceitar a classificacao `85`, reservada ao contexto CNPJ de administracao publica nesta etapa.
- Criado teste para impedir que combinacoes incompativeis gerem evento `S-1000` pendente.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Requests/UpdateOrgaoPublicoRequest.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/OrgaoPublicoTest.php`: `13` testes verdes e `78` assercoes.

**Status:** Concluido


### 23/04/2026 - Vigencia Inicial das Rubricas S-1010

**Acao realizada:**
- Adicionados campos de inicio e fim de validade na tabela de rubricas.
- Cadastro e edicao de rubricas passaram a exigir inicio de validade.
- Fim de validade passou a ser opcional, mas nao pode ser anterior ao inicio.
- Listagem e tela de edicao agora exibem a vigencia da rubrica para revisao do `S-1010`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/database/migrations/2026_04_23_000000_add_vigencia_to_rubricas_table.php`
- `backend/FolhaNova/app/Models/Rubrica.php`
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/app/Services/Rubricas/RegistrarRubricaService.php`
- `backend/FolhaNova/app/Services/Rubricas/AtualizarRubricaService.php`
- `backend/FolhaNova/resources/views/rubricas/partials/form-fields.blade.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/resources/views/rubricas/edit.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `backend/FolhaNova/tests/Feature/RubricasIndexTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `tests/Feature/RubricaCrudTest.php` e `tests/Feature/RubricasIndexTest.php`: `12` testes verdes e `56` assercoes.

**Status:** Concluido
