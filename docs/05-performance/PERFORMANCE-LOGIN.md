# FolhaNova - Performance Login
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Diagnóstico Atual da Lentidão
- O layout de login usa efeitos visuais custosos, como `backdrop-filter`, múltiplos gradients e animações contínuas no background.
- O botão de envio estava com a camada de loading visível por padrão, o que gerava percepção de travamento mesmo antes da ação do usuário.
- Os campos do formulário estavam sincronizando com Livewire sem `defer`, o que aumenta trabalho de hidratação e risco de re-render desnecessário.
- O carregamento da página ainda depende de fontes externas, o que pode ampliar latência percebida em ambiente local ou rede mais restrita.
- A investigação mais recente aponta evidência forte de gargalo estrutural de ambiente, com a rota `/login` levando mais de `8s` para responder mesmo entregando HTML pequeno.

## Otimizações Já Aplicadas
- Estado visual do botão corrigido para mostrar `Entrando...` apenas durante a submissão real do `login`.
- Inclusão de controle explícito com `$isLoading` no componente Livewire para melhorar previsibilidade do fluxo.
- Campos do formulário alterados para `wire:model.defer`, reduzindo sincronizações enquanto o usuário digita.
- Fundo animado suavizado com menor opacidade, menor blur e ciclo mais lento nas animações dos ícones flutuantes.
- Card principal ajustado com blur mais leve para reduzir custo de composição.
- Suporte a `prefers-reduced-motion` adicionado para desabilitar animações e transições quando o usuário ou dispositivo pedirem menos movimento.
- Aplicado `content-visibility` nas áreas principais da tela para adiar custo de renderização em navegadores compatíveis.

## Próximas Ações de Performance
- Validar o impacto de executar o projeto fora de `/mnt/c/.../OneDrive` no WSL.
- Criar baseline com o Laravel mais próximo de benchmark local controlado.
- Medir tempo real de `DOMContentLoaded`, `Largest Contentful Paint` e hidratação do Livewire no ambiente local.
- Avaliar substituição das fontes externas por estratégia local ou fallback mais agressivo.
- Verificar se há assets JS/CSS extras sendo carregados na rota de autenticação sem necessidade.
- Revisar possibilidade de separar estilos críticos do login em bundle menor.
- Medir custo do `backdrop-filter` em máquinas mais modestas e considerar versão reduzida para navegadores mais lentos.

## Métricas Sugeridas
- Tempo alvo de carregamento da página de login: `< 800ms`
- Tempo ideal para primeira interação visual: `< 400ms`
- Latência de submissão do login até feedback visual: `< 100ms`
- Tempo de autenticação completa com redirecionamento local: `< 600ms`

## Documentos Complementares
- `DIAGNOSTICO-INICIAL.md`
- `ANALISE-TELA-LOGIN.md`
- `TAREFAS-PERFORMANCE.md`
- `PLANO-DE-ACAO.md`
- `METRICAS-E-VALIDACOES.md`
