# Fluxos do Usuario
**Atualizado em:** 20/04/2026

## Fluxo 1 - Login administrativo
1. Usuario acessa a tela de login.
2. Informa credenciais.
3. Sistema autentica e redireciona para o dashboard.

## Fluxo 2 - Consulta da base de servidores
1. Usuario abre o modulo `Servidores`.
2. Filtra por nome, matricula, CPF, categoria ou situacao.
3. Analisa a base ativa e as pendencias operacionais.

## Fluxo 3 - Admissao inicial
1. Usuario abre `Nova admissao`.
2. Preenche dados civis da pessoa.
3. Preenche dados do vinculo funcional.
4. Sistema cria `Pessoa`, `Servidor` e evento `S-2200` pendente.
5. Usuario retorna para a lista com confirmacao visual.

## Fluxo 4 - Evolucao futura
1. Usuario acessa o detalhe do servidor.
2. Consulta dados pessoais, vinculo funcional e eventos associados.
3. Abre a tela de edicao quando precisa corrigir ou atualizar o cadastro.
4. Sistema persiste a mudanca e sincroniza o payload do `S-2200` pendente quando aplicavel.

## Fluxo 5 - Parametros do orgao publico
1. Usuario autenticado abre o modulo `Orgao Publico`.
2. Consulta a identificacao institucional do tenant atual e o status do `S-1000`.
3. Acessa a tela de edicao para atualizar inscricao, validade, classificacao e contato.
4. Sistema persiste os parametros no tenant atual.
5. Sistema gera ou sincroniza um evento `S-1000` pendente para rastreabilidade.

## Fluxo 6 - Cadastro de rubricas
1. Usuario abre o modulo `Rubricas`.
2. Consulta a base remuneratoria e aplica filtros por busca ou status.
3. Abre `Nova rubrica` para informar codigo, natureza, tipo, incidencias e referencia eSocial.
4. Sistema salva a rubrica vinculada ao tenant atual.
5. Usuario pode editar a configuracao para amadurecer a trilha do `S-1010`.

## Fluxo 7 - Painel de eventos eSocial
1. Usuario abre o modulo `Eventos eSocial`.
2. Filtra por evento, status, ambiente ou busca textual.
3. Consulta quais eventos estao pendentes, processados ou com mensagem de retorno.
4. Abre o detalhe para visualizar payload, protocolo, recibo e relacionamento com servidor quando existir.
5. Quando um evento esta com `status = erro`, usuario pode reenfileirar o registro para reprocessamento local, preservando o payload e limpando metadados de retorno anteriores.
