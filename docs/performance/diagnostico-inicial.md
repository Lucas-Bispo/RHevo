# Diagnóstico Inicial de Performance
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Resumo Executivo
- O maior gargalo atualmente parece ser estrutural de ambiente, não apenas da UI.
- A aplicação roda em WSL sobre `/mnt/c/.../OneDrive`, com `APP_DEBUG=true`, sessão/cache em disco e servidor `php artisan serve`.
- O fluxo de acesso inicial e o fluxo de logout têm redirecionamentos em cascata evitáveis.
- A tela de login tem custo visual real e carrega dependências que não são estritamente necessárias para a primeira pintura.
- O dashboard atual é visualmente leve em termos de consultas, mas ainda herda o peso do layout global, fontes externas e bundle compartilhado.

## O que está comprovadamente lento
- A documentação existente em `docs/05-performance` já registra `GET /login` em aproximadamente `8.1s` no ambiente local.
- O build `npm run build` já foi observado em `5m 37s`, incompatível com o tamanho final dos assets.
- Uma nova rodada de logs do navegador confirmou lentidão concentrada no tempo de espera do backend:
  - `GET /`: `~6.45s`, com `wait ~6.14s`
  - `GET /dashboard` após login: `~7.02s`, com `wait ~6.60s`
  - `GET /login`: `~3.29s`, com `wait ~2.82s`
  - `POST /livewire/update` no login: `~3.42s`, com `wait ~3.35s`
  - `POST /livewire/update` no logout: `~2.58s`, com `wait ~2.50s`

## O que foi confirmado nesta rodada
### 1. Ambiente local desfavorável para benchmark
- O repositório está em caminho sincronizado por OneDrive.
- O backend roda no WSL a partir de filesystem montado do Windows.
- Sessão, cache, logs, views compiladas e demais arquivos transitórios ficam sujeitos a I/O mais lento.

### 2. Laravel está em modo de desenvolvimento pleno
- `APP_DEBUG=true`
- `SESSION_DRIVER=file`
- `CACHE_STORE=file`
- `QUEUE_CONNECTION=sync`
- Telescope habilitado por padrão em `local`

### 2.1. Os testes controlados confirmam alta variância entre requests
- Rodada controlada por HTTP em `2026-04-19/20` mostrou diferença grande entre requests "frios" e requests já aquecidos.
- `GET /` foi medido em `~5.65s` numa medição isolada, mas caiu para uma faixa de `~2.30s` a `~2.54s` em três execuções consecutivas.
- `GET /login` foi medido em `~3.03s` numa medição isolada, mas caiu para `~0.36s` a `~0.41s` em três execuções consecutivas.
- Esse padrão sugere impacto relevante de bootstrap, leitura de arquivos, caches transitórios e aquecimento do ambiente.

### 3. O fluxo inicial da aplicação já nasce com redirecionamentos extras
- `GET /` redireciona para `/dashboard`
- usuário não autenticado em `/dashboard` é redirecionado pelo middleware `auth` para `/login`
- isso introduz pelo menos dois hops antes da tela de login

### 4. O fluxo de logout também sofre efeito cascata
- o logout redireciona para `/`
- `/` redireciona para `/dashboard`
- o middleware `auth` redireciona o guest para `/login`
- isso adiciona hops extras em um fluxo que deveria ser direto para `/login`

### 5. A tela de login carrega payload visual acima do necessário
- layout com Bunny Fonts externas
- CSS global compartilhado
- Livewire scripts
- hero com múltiplos ícones decorativos, gradientes, blur e animação contínua
- `backdrop-filter` pesado no card principal

### 5.1. Os assets não aparecem como causa principal nesta rodada
- CSS, favicon e fonte ficaram rápidos em comparação com os requests principais.
- Isso reduz a probabilidade de o gargalo dominante estar no download de assets estáticos.
- O foco passa a ser tempo de espera do backend, bootstrap da aplicação e encadeamento de requests.

### 6. O backend de autenticação está relativamente simples
- O `login()` customizado valida, chama `Auth::attempt`, regenera sessão e redireciona.
- Não há evidência de consultas de domínio complexas no login.
- O gargalo do login não parece estar em regra de negócio pesada.

### 7. O dashboard atual não aparenta gargalo de consulta
- A view `dashboard.blade.php` estática não executa consultas explícitas.
- O componente de navegação mostra `auth()->user()?->name` e `email`, sem uso aparente de permissões ou widgets pesados.
- O gargalo pós-login parece tender mais a layout, assets e ambiente do que a SQL.

## Hipóteses Técnicas
### Hipótese forte
- Gargalo principal no ambiente WSL sobre `/mnt/c/.../OneDrive` com intenso acesso a disco por Laravel, Vite, views compiladas, sessão e cache.

### Hipótese forte
- O tempo percebido é agravado por bootstrap de desenvolvimento: debug ativo, Telescope ativo, drivers `file` e servidor embutido.

### Hipótese forte
- O padrão de `wait` alto em `GET /`, `/dashboard`, `/login` e nos `POST /livewire/update` indica gargalo predominante no processamento do request no servidor, não no carregamento dos assets.

### Hipótese forte
- A variância entre primeira carga e carga aquecida sugere gargalo ligado a I/O, bootstrap e aquecimento de estado local mais do que a payload estática fixa.

### Hipótese média
- O carregamento inicial do login é piorado por fonte externa, CSS global e custo de composição visual.

### Hipótese média
- O fluxo `/` e o fluxo de logout parecem mais lentos do que precisariam por causa de redirecionamentos em cascata.

### Hipótese média
- A cobertura de testes está desalinhada do login real em produção local, o que pode esconder regressões de performance e comportamento.

## Riscos de interpretação
- Ainda faltam métricas de navegador para FCP, LCP e waterfall real.
- Ainda faltam medições instrumentadas de queries por request.
- Parte do diagnóstico de SQL permanece inferida a partir do código, porque não foi possível executar medições completas nesta rodada.

## Recomendação objetiva inicial
Atacar primeiro:

1. medição comparativa do ambiente e do fluxo HTTP real;
2. eliminação de redirecionamentos desnecessários em `/` e logout;
3. instrumentação do backend para separar bootstrap, sessão, auth, Livewire e SQL;
4. redução do peso do login e do bundle inicial só depois de confirmar os ganhos do backend e da navegação.

## Status das ações iniciais
- Remoção da cascata de `/`: aplicada
- Redirecionamento direto do logout para `/login`: aplicado
- Alinhamento dos testes com o fluxo atual: aplicado
- Instrumentação fina do backend: pendente
