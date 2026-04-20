# Análise do Logout
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Fluxo atual
1. O botão de sair chama `logout()` em `resources/views/livewire/layout/navigation.blade.php`
2. A action `App\Livewire\Actions\Logout` faz:
- `Auth::guard('web')->logout()`
- `Session::invalidate()`
- `Session::regenerateToken()`
3. O componente Livewire redireciona para `/`
4. `/` redireciona para `/dashboard`
5. guest em `/dashboard` é redirecionado para `/login`

## Evidências confirmadas
- O procedimento interno de logout é simples e correto.
- O custo extra vem do destino final escolhido, não da ação de logout em si.

## Gargalo principal deste fluxo
- Redirecionamentos em cascata após logout:
- `/` -> `/dashboard` -> `/login`

## Impacto
- Mais latência percebida
- Mais bootstrap do framework
- Mais requests antes de exibir a tela útil
- Sensação de logout "pesado" sem necessidade

## Melhor hipótese atual
- O logout não é lento por regras de negócio.
- O logout parece lento porque o fluxo de navegação final está desenhado com hops desnecessários.

## Medições necessárias
- tempo total do clique de logout até a tela de login estar utilizável
- número de requests após logout
- comparação entre redirecionar para `/` e redirecionar diretamente para `/login`
