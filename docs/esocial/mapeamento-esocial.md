# Mapeamento eSocial
**Atualizado em:** 20/04/2026

## Base oficial
- Fonte principal: portal de Documentacao Tecnica do eSocial em `gov.br`.
- Consulta desta rodada: 20/04/2026.

## Mapeamento inicial do dominio
| Dominio do sistema | Evento/tabela eSocial | Situacao atual |
| --- | --- | --- |
| Tenant / orgao publico | S-1000 | modulo inicial entregue |
| Lotacao / unidade | S-1005 | modelagem inicial |
| Rubrica | S-1010 | modulo inicial entregue |
| Cargo | S-1030 | modelagem inicial |
| Funcao | S-1040 | modelagem inicial |
| Pessoa + Servidor | S-2200 | modelagem inicial com primeira tela operacional |
| EventoEsocial | trilha de envio/retorno | painel inicial entregue |

## Observacoes
- A modelagem atual do projeto esta mais madura para `S-2200` do que para transmissao real.
- `Lotacao`, `Cargo`, `Funcao` e `Rubrica` ainda precisam evoluir de cadastro estrutural para tabela governada por regra.
- `Rubrica` agora possui modulo inicial com incidencias e codigo eSocial, mas ainda sem geracao formal do `S-1010`.
- `Tenant` agora possui modulo inicial de parametros institucionais e payload pendente de `S-1000`.
- `EventoEsocial` agora possui painel operacional e reprocessamento local de eventos com erro, mas ainda sem fila real, assinatura ou transmissao.
- A cobertura do `S-1000` ainda e parcial e precisa evoluir para regras mais completas de validacao.
