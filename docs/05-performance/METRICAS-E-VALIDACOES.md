# FolhaNova - Métricas e Validações de Performance
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Metas de Referência para a Tela de Login
- `TTFB`: ideal `< 200ms`, aceitável `< 500ms`
- `FCP`: ideal `< 400ms`, aceitável `< 800ms`
- `LCP`: ideal `< 800ms`, aceitável `< 1.2s`
- Tempo total de resposta HTTP da `/login`: ideal `< 500ms`
- Build local de frontend para ciclo normal de desenvolvimento: reduzir drasticamente em relação ao observado de `5m 37s`

## Métricas Já Observadas
- `GET /login` em WSL: `time_total=8.125102`, `code=200`, `size=12155`
- Build de produção: `5m 37s`
- CSS final: `97.370 bytes`
- JS final: `37.977 bytes`

## Como Validar Melhorias
### Backend
- Repetir `curl` na rota `/login`.
- Comparar tempos com ambiente atual e ambiente ajustado.
- Registrar se houve mudança no tipo de servidor ou no path do projeto.

### Frontend
- Medir FCP, LCP e waterfall em navegador.
- Confirmar quantidade de requests e bloqueios de fonte/CSS/JS.
- Comparar comportamento com e sem fontes externas.

### Build e Ambiente
- Medir `npm run build` antes e depois de cada mudança estrutural.
- Registrar se o projeto está em `/mnt/c` ou em filesystem nativo do WSL.

## Regras de Validação
- Toda melhoria precisa ter métrica anterior e posterior.
- Não assumir ganho apenas por “sensação de velocidade”.
- Separar claramente melhoria de backend, melhoria de frontend e melhoria de ambiente.
