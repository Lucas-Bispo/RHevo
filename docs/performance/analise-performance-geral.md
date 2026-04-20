# Analise de Performance Geral
**Atualizado em:** 20/04/2026

## Stack e runtime confirmados
- Backend: Laravel 11.51.0 com PHP 8.3.6
- Frontend: Blade + Livewire 3 + Volt + Vite 6 + Tailwind 4 + DaisyUI
- Banco local: SQLite
- Sessao e cache: `database`
- Queue: `sync`
- Ambiente: WSL Ubuntu 24.04 executando projeto em caminho sincronizado pelo OneDrive no Windows

## Gargalos confirmados
- Bootstrap Laravel excessivamente lento no ambiente local atual.
- Variancia alta entre request frio e aquecido.
- Primeira pagina ainda herda CSS global e fontes externas.
- Ausencia de medicao fina de query count e tempo SQL por request.

## Gargalos nao confirmados
- Nao ha evidencia atual de N+1 no login ou dashboard.
- Nao ha evidencia atual de SQL de dominio pesado nos fluxos criticos observados.
- Nao ha evidencia atual de middleware customizado caro; o `bootstrap/app.php` segue enxuto.

## Classificacao
### Corrigivel agora
- Segmentar assets da tela de login.
- Garantir eager loading nas novas telas operacionais.
- Manter a rota raiz e o logout sem cascatas.

### Corrigivel depois
- Mover benchmark para filesystem nativo do Linux no WSL.
- Introduzir profiling com `DB::listen`, Telescope controlado ou ferramenta equivalente.
- Reavaliar split de CSS e fontes apos nova rodada de medicao.

### Precisa de mais investigacao
- Custo exato de bootstrap versus sessao versus Livewire.
- Tempo real do primeiro request apos cold start com o codigo atual.

### Nao bloqueia a evolucao funcional
- O gargalo ambiental local nao impede modelagem, telas operacionais e preparacao do dominio eSocial.
