# Plano de Implementacao
**Atualizado em:** 20/04/2026

## Trilha B - Evolucao do sistema RH/eSocial
1. Modulo do orgao publico
   - Parametros do ente, classificacao e dados necessarios para S-1000.
   - Status atual: entrega inicial operacional com edicao do tenant atual e geracao de `S-1000` pendente.
2. Modulo de estruturas
   - Lotacoes, cargos, funcoes e rubricas com codigos internos e referencia eSocial.
   - Status atual: lotacoes, cargos, funcoes e rubricas com entrega inicial operacional.
3. Modulo de servidores
   - Lista, cadastro e validacoes para admissao S-2200.
4. Modulo de eventos
   - Preparacao de payload, fila de processamento, status e historico.
   - Status atual: painel inicial entregue para leitura operacional e rastreabilidade.
5. Integracao futura
   - Assinatura, transmissao, consulta de retorno e reprocessamento.

## Entrega iniciada nesta rodada
- Modulo `orgao-publico.show` para leitura da base institucional do tenant atual.
- Tela de edicao dos parametros do orgao com geracao ou sincronizacao de `S-1000` pendente.
- Modulo `rubricas.index` com cadastro e edicao da base remuneratoria.
- Painel `eventos-esocial.index` com filtros e tela de detalhe do payload.

## Dependencias
- Validar estrategia de tenant corrente.
- Definir padrao de services para montagem de payloads eSocial.
- Planejar factories/seeders de dominio para acelerar testes.
