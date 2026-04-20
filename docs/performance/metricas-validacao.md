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
- `GET /`: `~6.45s`, `wait ~6.14s`
- `GET /dashboard` autenticado: `~7.02s`, `wait ~6.60s`
- `GET /login`: `~3.29s`, `wait ~2.82s`
- `POST /livewire/update` no login: `~3.42s`, `wait ~3.35s`
- `POST /livewire/update` no logout: `~2.58s`, `wait ~2.50s`
- CSS, favicon e fonte com tempos baixos em comparação aos requests principais

## Tabela de registro recomendada
| Fluxo | Tempo total | TTFB | Redirects | Queries | SQL total | Observações |
| --- | --- | --- | --- | --- | --- | --- |
| `/` | a medir | a medir | a medir | a medir | a medir | guest |
| `/login` | a medir | a medir | a medir | a medir | a medir | guest |
| `login submit` | a medir | a medir | a medir | a medir | a medir | credenciais válidas |
| `/dashboard` | a medir | a medir | a medir | a medir | a medir | autenticado |
| `logout` | a medir | a medir | a medir | a medir | a medir | autenticado |

## Leitura atual das medições
- O padrão mais forte desta rodada é `wait` muito alto em todos os fluxos críticos.
- Isso sugere gargalo dominante no backend, no ambiente ou no encadeamento dos requests.
- Os assets estáticos não aparecem como suspeitos principais nesta etapa.

## Rodada controlada de teste HTTP - 19/04/2026 para 20/04/2026
### Medições isoladas
| Fluxo | Tempo total | TTFB | Observações |
| --- | --- | --- | --- |
| `GET /` | `~5.65s` | `~5.50s` | request isolado por `curl` |
| `GET /login` | `~3.03s` | `~2.99s` | request isolado por `curl` |
| `GET /login` + `POST /livewire/update` + `GET /dashboard` | `2811.81ms`, `3295.03ms`, `6620.25ms` | n/a | fluxo autenticado reproduzido via sessão HTTP real |

### Amostragem curta aquecida
| Fluxo | Execuções | Resultado |
| --- | --- | --- |
| `GET /` | 3 | `2.54s`, `2.49s`, `2.30s` |
| `GET /login` | 3 | `0.41s`, `0.37s`, `0.40s` |

### Fluxo autenticado reproduzido
| Execução | `GET /login` | `POST login /livewire/update` | `GET /dashboard` |
| --- | --- | --- | --- |
| 1 | `2681.26ms` | `856.73ms` | `6351.05ms` |
| 2 | `2710.22ms` | `3205.80ms` | `6924.04ms` |

### Logout reproduzido
| Fluxo | Tempo | Observações |
| --- | --- | --- |
| `POST logout /livewire/update` | `2334.86ms` | sessão invalidada durante o fluxo; a automação HTTP recebeu `419`, mas o servidor registrou o request na faixa esperada de `~2s` |

## Conclusões da rodada controlada
- Há alta variância entre request frio e request aquecido.
- `GET /login` melhora drasticamente após aquecimento, mas `/dashboard` continua muito caro.
- O dashboard autenticado permanece como o request mais caro da rodada reproduzida.
- O login via Livewire também apresenta variação relevante entre execuções, reforçando a suspeita de gargalo estrutural no backend/ambiente.

## Regras de validação
- medir antes e depois de cada mudança relevante
- separar claramente gargalo de ambiente, backend, frontend e navegação
- sempre anotar data, contexto e configuração do teste
