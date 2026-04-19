# FolhaNova - Análise da Tela de Login
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Documentar especificamente o que a rota `/login` carrega, o que pode impactar sua performance e quais pontos já têm evidência concreta.

## Fluxo Atual até a Renderização
1. O Laravel recebe a requisição `GET /login`.
2. A rota aponta para o componente Livewire `App\Livewire\Auth\Login`.
3. O layout `auth-login.blade.php` injeta:
   - fontes externas via Bunny Fonts;
   - `@vite(['resources/css/app.css', 'resources/js/app.js'])`;
   - `@livewireScripts`.
4. A view do login renderiza:
   - bloco hero com cinco ícones SVG;
   - card principal;
   - formulário Livewire com snapshot inicial embutido no HTML.

## Evidências de Código
### Layout do login
- `resources/views/components/layouts/auth-login.blade.php`
- Pontos relevantes:
  - linha 10: `preconnect` para `fonts.bunny.net`
  - linha 11: carregamento de fonte externa
  - linha 13: bundle global CSS/JS via `@vite`
  - linha 17: `@livewireScripts`

### View do login
- `resources/views/livewire/auth/login.blade.php`
- Pontos relevantes:
  - linhas 3 a 52: hero visual com múltiplos elementos decorativos
  - linhas 83 a 104: topo do card com marca e subtítulo
  - linhas 124 a 210: formulário Livewire
  - linhas 135, 167 e 184: uso de `wire:model.defer`, que já reduz hidratações desnecessárias

### CSS do login
- `resources/css/app.css`
- Pontos relevantes:
  - linhas 44 a 50: background com múltiplos gradients
  - linhas 57 a 67: `content-visibility` aplicado nas duas áreas principais
  - linhas 155 a 209: orbs, elementos flutuantes, transforms 3D e animação contínua
  - linha 236: `backdrop-filter: blur(22px)` no card principal

### JS global carregado no login
- `resources/js/app.js`
- `resources/js/bootstrap.js`
- Pontos relevantes:
  - tema salvo em `localStorage`
  - função global `toggleTheme`
  - `axios` carregado globalmente mesmo sem necessidade explícita na tela inicial

## O que Já Tem Evidência
### 1. O HTML inicial é pequeno
- Medição observada: `size=12155`.
- Conclusão: o gargalo principal não é o volume do HTML entregue pela rota.

### 2. Os bundles gerados são moderados
- CSS gerado: `97.370 bytes`
- JS gerado: `37.977 bytes`
- Conclusão: os assets merecem otimização, mas ainda assim não justificam isoladamente um TTFB acima de `8 s`.

### 3. A tela tem custo visual real
- O login usa:
  - `backdrop-filter`
  - gradientes múltiplos
  - animações contínuas
  - sombras e transforms 3D
- Conclusão: há custo de paint/compositing no front, especialmente em máquinas mais fracas.

## O que Ainda é Hipótese
### 1. Impacto real do Livewire no first paint do login
- O snapshot Livewire é pequeno e o componente não aparenta consultar dados para renderizar.
- Ainda falta medir no navegador se a hidratação está atrasando interação.

### 2. Peso da fonte externa na percepção de carregamento
- O uso de Bunny Fonts é uma evidência clara.
- Ainda falta medir se a troca por fonte local ou fallback melhora LCP e FCP.

### 3. Ganho real de separar bundle exclusivo para autenticação
- A estrutura atual usa `app.css` e `app.js` globais.
- Ainda falta medir diferença entre bundle compartilhado e bundle reduzido do login.

## Leitura Técnica Consolidada
### O que parece não ser o principal gargalo
- Tamanho do HTML da rota.
- Tamanho bruto dos bundles gerados.
- Lógica do componente Livewire `Login`, que é simples e sem consulta visível para render.

### O que parece ser o principal gargalo
- Ambiente local em WSL sobre `/mnt/c/.../OneDrive`.
- Bootstrap Laravel em modo de desenvolvimento e sem caches.
- Servidor atual baseado em `php artisan serve`.

### O que provavelmente compõe a lentidão percebida depois do backend
- Fonte externa.
- CSS global carregado para a tela.
- Efeitos visuais sofisticados no hero e no card.
