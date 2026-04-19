# FolhaNova - Plano de Ação de Performance
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Transformar o diagnóstico inicial em etapas executáveis, mantendo a ordem correta: medir, validar hipótese, corrigir e medir novamente.

## Fase 1 - Validar o gargalo estrutural
- Medir a rota `/login` no estado atual.
- Rodar a aplicação fora de `/mnt/c/.../OneDrive` e repetir as medições.
- Comparar tempo de `npm run build` e tempo de resposta da rota.

## Fase 2 - Criar baseline de benchmark local
- Rodar uma variação controlada do ambiente com:
  - `APP_DEBUG=false`
  - caches de configuração/rotas/eventos quando aplicável ao benchmark
  - revisão do uso de drivers `file`
- Registrar diferenças sem comprometer a rotina de desenvolvimento.

## Fase 3 - Medir a experiência real do login
- Capturar waterfall da rota `/login`.
- Medir FCP, LCP, TTFB, tamanho transferido e tempo até interação.
- Identificar quanto do tempo está no backend e quanto está no frontend.

## Fase 4 - Atacar dependências e payload inicial
- Avaliar fontes locais ou fallback tipográfico.
- Avaliar bundle específico de autenticação.
- Revisar o que do JS global precisa realmente existir no login.

## Fase 5 - Otimizar o custo visual
- Medir impacto real de `backdrop-filter`, gradients e animações.
- Criar alternativa visual menos custosa, se a medição justificar.
- Priorizar preservação da identidade visual com menor custo de renderização.

## Critério de Saída de Cada Fase
- A hipótese precisa ser validada por medição comparativa.
- A documentação deve registrar antes/depois.
- Nenhuma correção deve ser considerada concluída sem validação explícita.
