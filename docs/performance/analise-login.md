# Análise do Login
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Fluxo atual
1. `GET /login` monta `App\Livewire\Auth\Login`
2. O componente usa layout `components.layouts.auth-login`
3. O layout injeta Bunny Fonts, Vite global e Livewire scripts
4. O formulário usa `wire:model.defer` e `wire:submit="login"`
5. `login()` chama `LoginForm::authenticate()`
6. `authenticate()` verifica rate limit e executa `Auth::attempt`
7. A sessão é regenerada e o usuário é redirecionado para `/dashboard`

## Evidências confirmadas no código
### Backend
- O login não executa consultas de domínio explícitas além da autenticação.
- `Auth::attempt()` sugere uma consulta principal ao provider de usuários.
- Há verificação de rate limit, mas ela usa cache local e não parece ser o maior gargalo.

### Frontend
- A tela tem hero grande e decorativo.
- Há múltiplos elementos animados.
- Há `backdrop-filter: blur(22px)` no card.
- Há fontes externas em todos os acessos ao login.
- O login carrega `resources/css/app.css` e `resources/js/app.js`, ambos globais.

## Gargalos prováveis
- custo de primeira renderização da UI
- download e resolução de fontes externas
- carga de CSS global para uma tela que usa subconjunto do sistema
- bootstrap do Livewire
- I/O local do ambiente

## Quantas queries o login parece fazer
### Confirmado
- Não há consultas explícitas adicionais no componente `App\Livewire\Auth\Login`

### Inferido
- Uma consulta principal ao usuário durante `Auth::attempt()`
- Leituras e escritas indiretas de sessão/rate limit no backend

## O que precisa ser medido
- query count real no `GET /login`
- query count real no `POST`/request Livewire de autenticação
- tempo SQL total do login
- waterfall de fontes, CSS, JS e Livewire

## Observação importante de qualidade
- Os testes `AuthenticationTest` ainda validam o componente Volt `pages.auth.login`, enquanto a rota real de login usa `App\Livewire\Auth\Login`.
- Isso cria uma lacuna de cobertura exatamente no fluxo customizado que está sendo diagnosticado.
