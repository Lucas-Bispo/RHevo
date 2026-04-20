# Análise do Carregamento Inicial
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Fluxo atual
1. Usuário abre `/`
2. `routes/web.php` faz `Route::redirect('/', '/dashboard')`
3. A rota `/dashboard` exige `auth` e `verified`
4. Usuário guest é redirecionado para `/login`
5. O layout do login carrega fontes externas, CSS/JS globais e scripts do Livewire

## Evidências
- A abertura da aplicação para usuário não autenticado não vai direto para `/login`.
- Há pelo menos dois redirecionamentos antes da primeira tela útil.
- Cada hop adicional paga novamente custo de bootstrap, middleware, sessão e resposta HTTP.
- Log do navegador: `GET /` levou `~6.45s`, com `wait ~6.14s`.

## Gargalos prováveis
- Redirecionamento em cascata `/` -> `/dashboard` -> `/login`
- Bootstrap Laravel em ambiente local lento
- Sessão e cache em disco
- Fonte externa e assets compartilhados

## O que não parece ser o principal problema
- Regras de negócio complexas na rota inicial
- Consultas pesadas específicas da homepage, porque a raiz apenas redireciona

## Melhor hipótese atual
- O carregamento inicial sofre mais com hops extras e custo estrutural de ambiente do que com lógica de aplicação.
- O `wait` alto em `/` reforça que o tempo está sendo consumido antes do navegador começar a baixar a resposta útil.

## Medições necessárias
- tempo total de `GET /`
- quantidade de redirects
- TTFB por hop
- comparação entre abrir `/` e abrir `/login` diretamente
