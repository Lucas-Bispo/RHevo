# Stack Tecnológica Recomendada (2026)

## Base da aplicação
- **Backend:** Laravel 11 + PHP 8.3+
- **Banco de dados:** MySQL 8.0+
- **Frontend:** Livewire 3 + Alpine.js + Tailwind CSS 4 + DaisyUI
- **Admin (opcional/recomendado):** FilamentPHP 3

## Integrações e componentes
- **eSocial:** `nfephp-org/sped-esocial` (`dev-master`)
- **Autenticação:** Laravel Jetstream + Livewire (ou stack Filament)
- **Permissões/ACL:** Spatie Laravel Permission
- **PDF/holerite:** DomPDF ou Snappy
- **Multi-tenant:** `spatie/laravel-multitenancy` (estratégia por database/schema)

## Decisões de arquitetura
1. Manter backend coeso em Laravel para simplificar filas, eventos e jobs.
2. Priorizar server-side reativo (Livewire) para reduzir complexidade de SPA.
3. Isolar dados por tenant para segurança, governança e escalabilidade.

## Ligações
- [[00-Index]]
- [[04-Arquitetura-Proposta-Laravel]]
- [[05-Roadmap-Implementacao]]
