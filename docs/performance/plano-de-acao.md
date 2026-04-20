# Plano de Ação
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Objetivo
Executar a investigação de performance em ordem segura: medir, confirmar hipótese, priorizar, corrigir e medir novamente.

## Fase 1 - Baseline e instrumentação
- Medir `/`
- Medir `/login`
- Medir submissão de login
- Medir `/dashboard` autenticado
- Medir logout
- Registrar redirects, query count, tempo SQL, TTFB e tempo total

## Fase 2 - Ambiente
- Comparar execução no caminho atual versus filesystem nativo do WSL
- Comparar `APP_DEBUG=true` versus benchmark controlado
- Comparar com Telescope ativo e desativado
- Comparar sessão/cache em `file` versus alternativa apropriada para benchmark

## Fase 3 - Navegação e fluxo HTTP
- Revisar desenho de `/`
- Revisar desenho de logout
- Remover hops desnecessários

## Fase 4 - Payload inicial
- Medir custo das fontes externas
- Medir impacto do bundle global no login
- Medir custo visual da hero, blur e animações

## Fase 5 - SQL e componentes
- Medir queries reais de login, dashboard e logout
- Revisar N+1 ou eager loading ausente se aparecerem após instrumentação
- Revisar componentes Livewire e mount/render apenas se a métrica apontar

## Critério de saída
- Toda hipótese precisa ser validada com antes/depois
- Toda mudança precisa ser associada a uma métrica
- Nenhuma otimização deve ser considerada concluída apenas por sensação subjetiva
