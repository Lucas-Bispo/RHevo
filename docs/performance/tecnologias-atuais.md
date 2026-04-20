# Tecnologias Atuais
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Objetivo
Listar a stack real identificada no código e separar o que está confirmado do que ainda depende de validação operacional.

## Tecnologias Confirmadas
### Linguagens utilizadas
- PHP 8.2+ confirmado em `backend/FolhaNova/composer.json`
- JavaScript ESM confirmado em `backend/FolhaNova/package.json`
- Blade, HTML e CSS confirmados em `backend/FolhaNova/resources/views` e `backend/FolhaNova/resources/css/app.css`

### Framework backend
- Laravel 11 confirmado em `backend/FolhaNova/composer.json`

### Framework frontend
- Livewire 3 confirmado em `backend/FolhaNova/composer.json`
- Livewire Volt confirmado em `backend/FolhaNova/composer.json` e `backend/FolhaNova/app/Providers/VoltServiceProvider.php`

### Bibliotecas principais
- `laravel/telescope`
- `spatie/laravel-permission`
- `spatie/laravel-multitenancy`
- `nfephp-org/sped-esocial`
- `axios`
- `tailwindcss`
- `@tailwindcss/forms`
- `daisyui`

### Mecanismo de renderização
- Renderização server-side com Blade
- Componentes Livewire para interações incrementais
- Volt usado em partes do auth/profile/layout

### Ferramenta de build
- Vite 6
- `laravel-vite-plugin`
- Tailwind via plugin `@tailwindcss/vite`

### Banco de dados
- SQLite confirmado no ambiente local atual por `backend/FolhaNova/.env`
- Configurações para MySQL e MariaDB disponíveis em `backend/FolhaNova/config/database.php`

### Cache
- Driver atual `file` confirmado em `backend/FolhaNova/.env`

### Filas
- Conexão atual `sync` confirmada em `backend/FolhaNova/.env`

### Sessão
- Driver atual `file` confirmado em `backend/FolhaNova/.env`

### Autenticação
- Guard `web` com driver `session` confirmado em `backend/FolhaNova/config/auth.php`
- Provider Eloquent usando `App\Models\User`
- Login customizado em `App\Livewire\Auth\Login`
- Logout via ação Livewire em `App\Livewire\Actions\Logout`

### Containers
- Laravel Sail está presente como dependência de desenvolvimento em `backend/FolhaNova/composer.json`

### Servidor web / proxy
- Ambiente local atual usa `php artisan serve`, evidenciado na documentação existente e nos scripts em `backend/FolhaNova/scripts`
- Vite dev server na porta `5173`

### Ambiente local
- Windows 11 como host
- WSL Ubuntu 24.04 como ambiente oficial de execução
- Projeto localizado em caminho montado do Windows com OneDrive: `C:\Users\lukao\OneDrive\Documents\RHevo\backend\FolhaNova`
- Diagnostico operacional em 20/04/2026 confirmou `Laravel 11.51.0` e `PHP 8.3.6` no WSL

### Ambiente futuro de produção
- Ubuntu 24.04, conforme documentação do projeto

### Dependências que impactam performance
- Bunny Fonts carregadas externamente nos layouts `auth-login` e `app`
- Livewire Scripts carregados na tela de login
- CSS global único para login e área autenticada
- `axios` permanece no bundle autenticado via `resources/js/app.js`
- A tela de login foi separada para `resources/js/auth-login.js`, deixando de puxar `axios` no primeiro acesso
- `spatie/laravel-permission` no modelo `User`
- `spatie/laravel-multitenancy` instalado, ainda sem finder ativo

## Tecnologias Inferidas, Mas Ainda Não Confirmadas
### Servidor web de produção
- Nginx ou Apache não foram encontrados configurados no repositório
- A inferência é que ainda não há setup de proxy reverso versionado

### Redis em uso efetivo
- Configuração existe em `config/database.php`, mas o ambiente atual local não confirma uso ativo

### Containers em uso real
- Sail está disponível, mas não há evidência nesta rodada de uso ativo no fluxo local

### Observabilidade adicional
- Há referência documental a Telescope e futura observabilidade, mas Horizon, Pulse ou outros serviços não aparecem configurados como parte ativa do código atual
