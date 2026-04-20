# Análise do Dashboard
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Fluxo atual após autenticação
1. Login bem-sucedido redireciona para `/dashboard`
2. A rota usa `Route::view('dashboard', 'dashboard')`
3. O layout autenticado `layouts.app` carrega Bunny Fonts e Vite global
4. O layout monta `<livewire:layout.navigation />`
5. A view do dashboard exibe cards e tabela estáticos

## Evidências confirmadas
- A view `dashboard.blade.php` não contém consultas explícitas.
- O conteúdo atual da dashboard é essencialmente estático.
- O componente de navegação usa `auth()->user()?->name` e `email`, o que tende a ser leve.

## Gargalos prováveis
- peso do layout global e dos assets
- bootstrap do Livewire para a sidebar
- fonte externa novamente presente
- custo estrutural do ambiente local

## O que merece atenção futura
- quando o dashboard passar a carregar métricas reais, widgets e permissões, o risco de N+1 e excesso de consultas crescerá
- o uso de `HasRoles` no `User` sugere potencial de consultas adicionais se menus por permissão forem introduzidos sem cache adequado

## Estado atual sobre queries repetidas
### Confirmado
- Não há sinais no código atual de queries pesadas dentro de `dashboard.blade.php`

### Inferido
- O dashboard atual não deve ser o principal gargalo de SQL
- O gargalo pós-login provavelmente está mais ligado a renderização, assets e ambiente

## Medições necessárias
- tempo total de `GET /dashboard` autenticado
- query count real do dashboard
- tempo total SQL
- waterfall do primeiro carregamento autenticado
