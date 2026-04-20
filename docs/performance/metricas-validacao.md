# Métricas de Validação
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Fluxos a medir
- `GET /`
- `GET /login`
- submissão do login
- `GET /dashboard` autenticado
- logout

## Métricas obrigatórias
- tempo total da requisição
- TTFB
- quantidade de redirects
- quantidade de queries
- tempo total em SQL
- tempo de renderização da resposta
- tamanho dos assets críticos
- FCP
- LCP

## Metas iniciais de referência
- `GET /`: ideal `< 500ms`
- `GET /login`: ideal `< 500ms`, aceitável `< 800ms`
- submissão de login com feedback visual: `< 100ms`
- navegação pós-login até dashboard utilizável: `< 800ms`
- logout até login utilizável: `< 400ms`

## Medições já conhecidas
- `GET /login` em documentação anterior: `~8.1s`
- `npm run build` em documentação anterior: `5m 37s`

## Tabela de registro recomendada
| Fluxo | Tempo total | TTFB | Redirects | Queries | SQL total | Observações |
| --- | --- | --- | --- | --- | --- | --- |
| `/` | a medir | a medir | a medir | a medir | a medir | guest |
| `/login` | a medir | a medir | a medir | a medir | a medir | guest |
| `login submit` | a medir | a medir | a medir | a medir | a medir | credenciais válidas |
| `/dashboard` | a medir | a medir | a medir | a medir | a medir | autenticado |
| `logout` | a medir | a medir | a medir | a medir | a medir | autenticado |

## Regras de validação
- medir antes e depois de cada mudança relevante
- separar claramente gargalo de ambiente, backend, frontend e navegação
- sempre anotar data, contexto e configuração do teste
