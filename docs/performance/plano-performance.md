# Plano de Performance
**Atualizado em:** 20/04/2026

## Trilha A - Diagnostico e quick wins
1. Repetir medicoes de `GET /login`, login submit e primeira tela autenticada apos o split do JS do login.
2. Instrumentar request principal com tempo total, queries e tempo SQL.
3. Rodar comparativo do projeto em filesystem Linux nativo do WSL.

## Trilha B - Correcoes imediatas seguras
1. Continuar separando assets da area publica e da area autenticada.
2. Exigir eager loading nas listas iniciais de RH.
3. Evitar componentes dinamicos pesados enquanto nao houver baseline confiavel.

## Trilha C - Otimizacao posterior
1. Revisar fontes externas e CSS global.
2. Avaliar cache de consultas e fragmentos apenas apos medir uso real.
3. Considerar fila assincrona para integracoes eSocial quando os eventos deixarem de ser apenas modelagem.
