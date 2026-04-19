# FolhaNova

Sistema moderno de Folha de Pagamento e Gestão de Servidores para prefeituras brasileiras, com base arquitetural preparada para integração completa com o eSocial S-1.3, operação multi-tenant e requisitos elevados de segurança.

## Objetivo do projeto

O FolhaNova nasce para substituir fluxos legados de RH e Folha com uma base técnica mais segura, auditável e sustentável. A proposta é combinar:

- operação fiel ao contexto de prefeituras brasileiras;
- aderência progressiva ao eSocial S-1.3;
- arquitetura modular por domínio;
- segurança por padrão desde a primeira fase;
- experiência moderna com Laravel 11, Livewire 3 e dark mode nativo.

## Stack adotada

- Laravel 11
- PHP 8.3+
- MySQL 8.0 ou MariaDB 10.11
- Livewire 3
- Tailwind CSS 4
- DaisyUI na camada de interface
- Spatie Laravel Permission
- Spatie Laravel Multitenancy
- nfephp-org/sped-esocial
- Laravel Telescope
- Laravel Pint
- PHPStan + Larastan
- Rector

## Estrutura arquitetural

A aplicação está sendo organizada com foco em uma Clean Architecture leve e orientação por domínio. A regra principal é evitar lógica de negócio em controllers e manter o acoplamento baixo para facilitar manutenção, testes e evolução regulatória.

### Domínios previstos

- Administração
- Pessoas
- Servidores
- Folha
- Rubricas
- eSocial
- Multi-tenant
- Auditoria

### Padrões adotados

- Service Layer para regras de negócio
- Repository Pattern para abstração de persistência
- Form Requests para validação
- Policies e Gates para autorização
- Migrations explícitas e nomeadas por domínio
- Documentação contínua em `docs/`

## Ambiente de desenvolvimento

O ambiente padrão deste projeto é o `WSL Ubuntu 24.04`. Todas as rotinas de bootstrap e manutenção devem ser executadas em Linux, mesmo quando o repositório estiver em um caminho compartilhado do Windows.

Documentação complementar:

- [Arquitetura](docs/ARQUITETURA.md)
- [Segurança](docs/SEGURANCA.md)
- [Integração eSocial](docs/ESOCIAL-INTEGRACAO.md)
- [Ambiente WSL](docs/AMBIENTE-WSL.md)
- [Fluxo de Trabalho](docs/FLUXO-DE-TRABALHO.md)
- [Fase 01](docs/FASE-01.md)

## Instalação no WSL

### 1. Dependências de sistema

Instale no Ubuntu 24.04:

- PHP 8.3 com extensões `mysql`, `sqlite3`, `soap`, `xml`, `mbstring`, `curl`, `intl`, `zip` e `gd`
- Composer
- Node.js 20
- MySQL 8.0 ou MariaDB 10.11
- Git

### 2. Clonar ou acessar o projeto

```bash
cd /mnt/c/Users/lukao/OneDrive/Documents/RHevo/backend/FolhaNova
```

### 3. Instalar dependências

```bash
composer install
npm install
```

### 4. Configurar ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Ajuste especialmente:

- `DB_*`
- `LANDLORD_DB_*`
- `ESOCIAL_*`
- `SESSION_SECURE_COOKIE`
- `APP_DEBUG`

### 5. Rodar migrations

```bash
php artisan migrate
```

Se houver base landlord separada, a estratégia de migração será refinada nas próximas fases para distinguir banco landlord e bancos tenant.

### 6. Rodar frontend

```bash
npm run dev
```

### 7. Rodar aplicação local

```bash
php artisan serve
```

## Comandos úteis

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan queue:work
php artisan schedule:work
php artisan telescope:prune
./vendor/bin/pint
./vendor/bin/phpstan analyse
./vendor/bin/rector process
npm run dev
npm run build
```

## Certificado A1 do eSocial

O certificado A1 nunca deve ser commitado. O fluxo esperado é:

1. armazenar o arquivo fora do versionamento;
2. apontar o caminho via `ESOCIAL_CERTIFICATE_PATH`;
3. proteger a senha via `.env`;
4. impedir inclusão por `.gitignore`;
5. evitar logging de conteúdo, caminho sensível completo e senha.

## Segurança adotada desde a fundação

- uso de `$fillable` nos modelos;
- hash de senha com cast `hashed`;
- CSRF habilitado;
- proteção padrão contra SQL Injection usando Query Builder e Eloquent;
- preparação para cookies seguros e `http_only`;
- isolamento de dados por tenant;
- configuração explícita para não versionar certificados e backups;
- base pronta para políticas de senha forte, 2FA e auditoria.

## Qualidade de código

- Laravel Pint para padronização
- PHPStan + Larastan para análise estática
- Rector para refatoração assistida
- comentários e PHPDoc exigidos nos artefatos centrais

## Estratégia de branches

Modelo recomendado:

- `main` para produção
- `develop` para integração
- `feature/*` para novas funcionalidades
- `hotfix/*` para correções urgentes

Commits futuros devem seguir Conventional Commits, por exemplo:

- `feat: adiciona cadastro inicial de pessoas`
- `fix: corrige índice único de matrícula`
- `docs: atualiza estratégia de integração do esocial`
- `refactor: extrai serviço de cálculo de rubricas`

## Roadmap inicial

- Fase 01: fundação da aplicação, autenticação, multi-tenant, segurança e layout base
- Fase 02: cadastro completo de servidores e evento S-2200
- Fase 03: tabelas eSocial, folha e monitoramento de eventos
- Fase 04: auditoria, backups, observabilidade e endurecimento de produção
