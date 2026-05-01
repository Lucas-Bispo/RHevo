# Funcionalidades Existentes
**Atualizado em:** 30/04/2026

## Plataforma administrativa
- Login customizado com Livewire.
- Rotas de autenticacao auxiliares via Volt.
- Dashboard inicial.
- Triagem `S-1000` no dashboard com resumo do orgao, ambiente, vigencia e status do evento institucional.
- Triagem `S-1000` no dashboard com leitura de prontidao operacional e quantidade de pendencias.
- Triagem `S-2200` no dashboard com contadores e atalhos de prontidao das admissoes.
- Triagem eSocial no dashboard com atalhos para eventos com erro, pendentes e com retorno.
- Triagem `S-1010` no dashboard com atalhos para rubricas de vigencia ativa, futura e encerrada.
- Triagem `S-1010` no dashboard com contadores e atalhos de prontidao das rubricas.
- Triagem `S-1005/S-1020` no dashboard com contadores e atalhos de prontidao das lotacoes.
- Triagem `S-1030/S-1040` no dashboard com contadores e atalhos de prontidao de cargos e funcoes.
- Perfil do usuario autenticado.
- Navegacao lateral para modulos principais.
- Modulo de parametros do orgao publico para o tenant atual.
- Painel operacional de eventos eSocial com filtros e detalhe.

## Cadastros e dominio
- Modelos e migracoes para `Tenant`, `Pessoa`, `Servidor`, `Lotacao`, `Cargo`, `Funcao`, `Rubrica` e `EventoEsocial`.
- Controle de usuarios e papeis com `spatie/laravel-permission`.
- Estrutura de tenant landlord preparada, ainda sem finder operacional.
- Edicao operacional do tenant atual com dados institucionais e parametros iniciais do `S-1000`.
- Classificacao tributaria do `S-1000` controlada por lista inicial de codigos suportados pelo produto.
- Catalogo local inicial de classificacoes tributarias suportadas para `S-1000`, reutilizado por validacao, formulario e leitura do orgao publico.
- Compatibilidade inicial entre tipo de inscricao institucional e classificacao tributaria no `S-1000`.
- Validacao de CPF/CNPJ institucional por digito verificador no fluxo do `S-1000`.
- Tela de edicao do orgao publico agora exibe orientacao contextual de consistencia para `CPF`/`CNPJ`, `classTrib` e `natJurid`.
- Leitura operacional do status de vigencia institucional do `S-1000`.
- Leitura de prontidao operacional da base `S-1000`, com pendencias locais antes da integracao futura.
- Prontidao `S-1000` considera evento local com erro como pendencia de correcao ou reprocessamento.
- Normalizacao da natureza juridica do `S-1000`, evitando persistencia de `natJurid` em inscricoes por CPF.
- Atalho do orgao publico para abrir o painel eSocial filtrado pela trilha `S-1000`.
- Atalhos contextuais no orgao publico para abrir o painel `S-1000` pelo mesmo status ou ambiente do evento institucional atual.
- Acao direta no orgao publico para reenfileirar o evento `S-1000` quando ele estiver com erro.
- Modulo inicial de lotacoes com listagem, cadastro e edicao.
- Filtro de prontidao `S-1005/S-1020` na listagem de lotacoes, separando lotacoes ativas com codigo eSocial das pendencias estruturais.
- Cards `Prontas S-1005/S-1020` e `Pendencias S-1005/S-1020` na listagem de lotacoes.
- Resumo visual de filtros ativos na listagem de lotacoes com acao para limpar filtros.
- Modulo inicial de cargos com listagem, cadastro e edicao.
- Filtro de prontidao `S-1030` na listagem de cargos, separando cargos ativos com codigo eSocial das pendencias ocupacionais.
- Cards `Prontos S-1030` e `Pendencias S-1030` na listagem de cargos.
- Resumo visual de filtros ativos na listagem de cargos com acao para limpar filtros.
- Modulo inicial de funcoes com listagem, cadastro e edicao.
- Filtro de prontidao `S-1040` na listagem de funcoes, separando funcoes ativas com codigo eSocial das pendencias funcionais.
- Cards `Prontas S-1040` e `Pendencias S-1040` na listagem de funcoes.
- Resumo visual de filtros ativos na listagem de funcoes com acao para limpar filtros.
- Modulo inicial de rubricas com listagem, cadastro e edicao.
- Validacao inicial de rubricas para `S-1010`, exigindo natureza eSocial (`natRubr`) numerica de 4 digitos.
- Catalogo local inicial de naturezas de rubrica suportadas para `S-1010`, bloqueando `natRubr` fora do recorte preparado pelo produto.
- Normalizacao previa dos campos de rubrica para preservar unicidade por tenant mesmo com espacos no preenchimento.
- Normalizacao e unicidade do codigo eSocial da rubrica por tenant para evitar parametrizacao duplicada do `S-1010`.
- Filtros de rubricas por tipo, incidencia e situacao de codigo eSocial, incluindo pendencias sem codigo.
- Filtro dedicado de rubricas por natureza eSocial (`natRubr`) com leitura no resumo de filtros ativos.
- Filtro de prontidao `S-1010` para separar rubricas prontas de pendencias de parametrizacao.
- Cards de rubricas para abrir rapidamente a listagem filtrada por tipo `Provento`, `Desconto` e `Informativa`.
- Cards de rubricas para abrir rapidamente a listagem filtrada por incidencia `IRRF`, `INSS` e `FGTS`.
- Cards de rubricas para abrir rapidamente a listagem filtrada por status `Ativas` e `Inativas`.
- Resumo visual de filtros ativos na listagem de rubricas com acao para limpar filtros.
- Atalho de rubricas para abrir o painel eSocial filtrado pela trilha `S-1010`.
- Atalhos de apoio `S-1010` na criacao de rubrica para painel, pendencias sem codigo, base parametrizada e rubricas ativas.
- Atalhos de apoio `S-1010` na criacao de rubrica agora tambem cobrem janelas de vigencia ativa, futura e encerrada.
- Formularios de criacao e edicao de rubricas agora exibem um bloco de consistencia operacional do `S-1010`.
- Atalhos de revisao S-1010 na edicao de rubrica para painel eSocial e pendencias sem codigo.
- Atalhos contextuais na edicao de rubrica para revisar status, tipo, codigo e incidencias da mesma trilha `S-1010`.
- Atalho contextual na edicao de rubrica para revisar rapidamente a base da mesma natureza eSocial.
- Atalhos contextuais na edicao de rubrica agora tambem acompanham a janela de vigencia atual da rubrica aberta.
- Controle inicial de vigencia das rubricas para preparar `S-1010`, com inicio obrigatorio e fim opcional validado.
- Leitura operacional de vigencia das rubricas com badges, filtro dedicado e atalhos para janelas ativa, futura e encerrada.
- Cards `Prontas S-1010` e `Pendencias S-1010` na listagem de rubricas.
- Massa demo local de rubricas agora inclui exemplos navegaveis de vigencia ativa, futura e encerrada para validacao manual.
- Inativacao de rubrica agora exige `fim_validade`, reforcando encerramento coerente para a trilha `S-1010`.
- Rubricas ativas agora bloqueiam `fim_validade` passado para evitar vigencia encerrada incoerente no `S-1010`.
- Rubricas ativas agora bloqueiam `inicio_validade` futuro para manter vigencia operacional coerente no `S-1010`.

## RH operacional
- Listagem de servidores com filtros por busca e situacao.
- Resumo operacional de base ativa, pendencias de `S-2200` e vinculos sem lotacao.
- Filtro de prontidao `S-2200` na listagem de servidores, separando admissoes prontas de pendencias cadastrais e de evento local.
- Cards `Prontos S-2200` e `Pendencias S-2200` na listagem de servidores.
- Resumo visual de filtros ativos na listagem de servidores com acao para limpar filtros.
- Cadastro inicial de admissao com criacao de pessoa, vinculo funcional e evento eSocial pendente.
- Tela de detalhe do servidor com leitura consolidada do cadastro e dos eventos vinculados.
- Atalho do detalhe do servidor para abrir o detalhe de cada evento eSocial vinculado.
- Edicao do cadastro do servidor com sincronizacao do payload do `S-2200` pendente.

## eSocial
- Dependencia `nfephp-org/sped-esocial` instalada.
- Modelo `EventoEsocial` para recibo, protocolo, retorno e payload.
- Registro inicial de evento `S-1000` pendente no fluxo de configuracao do orgao publico.
- Reprocessamento local de evento eSocial com erro, retornando o registro para `pendente` sem alterar o payload.
- Registro inicial de evento `S-2200` pendente no fluxo de admissao.
- Painel para leitura de eventos institucionais e eventos vinculados a servidores.
- Painel eSocial com triagem por contexto para separar eventos institucionais de eventos vinculados a servidor.
- Painel eSocial com fila operacional de reprocessamento local para eventos com erro.
- Acao de reprocessamento local direto na listagem do painel para eventos com erro.
- Resumo da mensagem de retorno exibido diretamente na listagem do painel eSocial.
- Resumo visual de filtros ativos no painel eSocial com acao para limpar filtros.
- Filtro do painel eSocial por grupo operacional, separando eventos de tabela, nao periodicos e periodicos.
- Cards do painel eSocial para abrir eventos de tabela, eventos nao periodicos e eventos periodicos.
- Cards do painel eSocial para filtrar eventos por ambiente de homologacao ou producao.
- Cards do painel eSocial para filtrar pendencias e erros atualizados no dia.
- Atalhos do painel eSocial para eventos prioritarios `S-1000`, `S-1005`, `S-1010`, `S-1020`, `S-1030`, `S-1040` e `S-2200`.
- Card do painel eSocial para filtrar eventos sem mensagem de retorno registrada.
- Filtro do painel eSocial por `origem` do payload, com leitura da origem ativa no resumo de filtros.
- Filtro do painel eSocial para eventos com ou sem mensagem de retorno registrada, disponivel no card e no formulario principal.
- Filtro do painel eSocial por servidor vinculado, com leitura do servidor ativo no resumo de filtros.
- Filtro do painel eSocial por data de atualizacao, com leitura da data ativa no resumo de filtros.
- Tela de detalhe do evento eSocial com atalhos para retornar ao painel filtrado por evento, status, ambiente, origem ou contexto de retorno.
- Tela de detalhe do evento eSocial com atalho para retornar ao painel pelo mesmo contexto institucional ou vinculado.
- Tela de detalhe do evento eSocial com atalho para retornar ao painel pelo mesmo servidor vinculado.
- Tela de detalhe do evento eSocial com atalho para retornar ao painel pela mesma data de atualizacao do registro.
- Atalho do detalhe eSocial para abrir o servidor vinculado quando o evento possuir vinculo funcional.

## O que ainda nao existe em operacao real
- Atualizacoes cadastrais, afastamentos e desligamentos.
- Geracao real de XML, assinatura, envio e consulta ao governo.
