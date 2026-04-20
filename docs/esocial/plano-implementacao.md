# Plano de Implementacao eSocial
**Atualizado em:** 20/04/2026

## Trilha 1 - Fundacao institucional
1. Fechar `S-1000`
   - completar classificacao tributaria oficial;
   - validar `tpInsc` e `nrInsc`;
   - controlar vigencia.
2. Implementar `S-1005`
   - criar `Estabelecimento`;
   - preparar unidade de orgao publico;
   - ligar com lotacoes.

## Trilha 2 - Fundacao do trabalhador
3. Evoluir `S-2200`
   - separar contrato do cadastro pessoal;
   - ampliar campos obrigatorios;
   - validar categoria, admissao e unicidade.
4. Implementar `S-2205`
   - criar historico cadastral;
   - gerar evento de alteracao.
5. Implementar `S-2206`
   - criar historico contratual;
   - versionar alteracoes do vinculo.

## Trilha 3 - Estrutura remuneratoria e tributaria
6. Evoluir `S-1010`
   - oficializar natureza de rubrica;
   - vincular incidencias a regras;
   - preparar vigencia.
7. Implementar `S-1020`
   - diferenciar lotacao administrativa e lotacao tributaria;
   - validar compatibilidades das tabelas 10, 11 e 12.

## Trilha 4 - Operacao de RH
8. Implementar `S-2230`
   - motivo oficial;
   - validacao de sobreposicao;
   - impacto sobre situacao do servidor.
9. Implementar `S-2299`
   - desligamento;
   - encerramento do contrato;
   - bloqueios de alteracao posterior.

## Trilha 5 - Integracao governamental futura
10. Expandir `EventoEsocial`
   - fila local;
   - status de processamento;
   - reprocessamento.
11. Criar camada de transmissao
   - assinatura;
   - envio;
   - consulta de retorno.

## Proxima implementacao sugerida
- `S-2205 - Alteracao cadastral do trabalhador`

## Justificativa
- aproveita o modulo de `Servidor` ja existente;
- transforma o sistema em manutencao real, nao apenas admissao;
- reutiliza `Pessoa`, `Servidor` e `EventoEsocial`;
- abre caminho direto para `S-2206`, `S-2230` e `S-2299`.
