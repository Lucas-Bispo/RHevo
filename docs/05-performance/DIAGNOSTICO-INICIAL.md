# FolhaNova - Diagnóstico Inicial de Performance
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Escopo desta Etapa
Esta etapa é exclusivamente diagnóstica. O objetivo aqui é entender e documentar a lentidão da aplicação, com foco inicial na rota de login, antes de qualquer nova alteração de código.

## Resumo Executivo
- Há evidência concreta de lentidão severa no carregamento da rota `/login`.
- O maior indício atual aponta para gargalo de ambiente e bootstrap do backend, não apenas para peso visual da tela.
- A interface do login tem custos de renderização relevantes, mas os tamanhos dos bundles gerados não explicam sozinhos respostas de 7 a 8 segundos.
- O pipeline local também está lento, com build de frontend concluindo em `5m 37s`, o que reforça a hipótese de gargalo estrutural no ambiente de execução.

## Evidências Confirmadas
### 1. Resposta da rota `/login` muito acima da meta
- Medição realizada no WSL Ubuntu 24.04 com `curl` para `http://127.0.0.1:8000/login`.
- Resultado observado: `time_total=8.125102`, `code=200`, `size=12155`.
- Interpretação: um HTML de aproximadamente `12 KB` está levando mais de `8 s` para ser entregue.

### 2. Build local muito lento
- O build de produção com `npm run build` concluiu com sucesso, porém levou `5m 37s`.
- Os artefatos gerados não são grandes o suficiente para justificar esse tempo:
  - CSS: `97.370 bytes`
  - JS: `37.977 bytes`
  - Manifest: `274 bytes`

### 3. Ambiente local favorece lentidão estrutural
- O projeto está sendo executado no WSL a partir de um caminho montado do Windows:
  - `/mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova`
- Esse cenário combina:
  - filesystem montado do Windows no WSL;
  - pasta sincronizada pelo OneDrive;
  - framework PHP que faz leitura intensa de arquivos por request.
- Isso é compatível com sintomas de bootstrap lento em Laravel e builds demorados em Node/Vite.

### 4. Configuração atual do Laravel não está otimizada nem para benchmark local
- Saída de `php artisan about`:
  - `Debug Mode: ENABLED`
  - `Config: NOT CACHED`
  - `Routes: NOT CACHED`
  - `Events: NOT CACHED`
  - `Cache: file`
  - `Session: file`
  - `Queue: sync`
- Interpretação: o ambiente está preparado para desenvolvimento, não para medir baseline de performance.

### 5. A rota está sendo servida por `php artisan serve`
- Processo identificado:
  - `php artisan serve --host=0.0.0.0 --port=8000`
- Interpretação: é suficiente para desenvolvimento, mas não representa um servidor mais estável para benchmark.

## Hipóteses Técnicas
### Hipótese A - Gargalo principal no ambiente WSL + `/mnt/c` + OneDrive
- **Status:** Forte
- **Base:** evidência consistente
- **Por quê:** Laravel e Vite fazem leitura intensa de arquivos. Executar isso sobre NTFS montado e ainda sob OneDrive costuma introduzir alta latência de I/O.

### Hipótese B - Bootstrap do Laravel inflado pelo modo de desenvolvimento
- **Status:** Forte
- **Base:** evidência consistente
- **Por quê:** debug ativo, caches ausentes e drivers `file` aumentam custo por request e por operação do framework.

### Hipótese C - A tela de login adiciona custo de pintura/composição perceptível
- **Status:** Moderada
- **Base:** evidência de código, sem medição de paint profile ainda
- **Por quê:** há `backdrop-filter`, gradients múltiplos, sombras, transforms 3D e animações contínuas no background.

### Hipótese D - Dependências externas ampliam a percepção de lentidão no front
- **Status:** Moderada
- **Base:** evidência de código
- **Por quê:** a página busca fontes externas em `fonts.bunny.net`, o que adiciona dependência de rede antes da experiência visual ficar completa.

### Hipótese E - Bundle global está maior do que o necessário para a tela de login
- **Status:** Moderada
- **Base:** evidência de estrutura
- **Por quê:** a tela de login carrega o `app.css` e `app.js` globais. Os tamanhos não são extremos, mas ainda trazem estilos e comportamentos que não são exclusivos do login.

## O que Precisa Ser Validado
- Comparação direta entre rodar o projeto dentro do filesystem Linux do WSL e rodar em `/mnt/c/.../OneDrive`.
- Medição de `TTFB`, `DOMContentLoaded`, `LCP` e tempo de hidratação do Livewire com navegador.
- Impacto de `APP_DEBUG=false`, `config:cache`, `route:cache` e sessão/cache fora de `file`.
- Ganho real ao localmente hospedar fontes ou usar fallback sem dependência externa.
- Ganho de separar CSS crítico do login do bundle global.

## Priorização Inicial
### Alta
- Validar o impacto do ambiente WSL sobre `/mnt/c/.../OneDrive`.
- Criar baseline de performance com o Laravel mais próximo de um modo de benchmark.
- Medir a rota `/login` com foco em `TTFB`.

### Média
- Medir custo visual do login no navegador.
- Reduzir dependência externa de fontes.
- Revisar separação de bundles da tela de login.

### Baixa
- Refinos cosméticos finos de animação e profundidade visual.
- Micro-otimizações do JS do tema e do bootstrap atual.
