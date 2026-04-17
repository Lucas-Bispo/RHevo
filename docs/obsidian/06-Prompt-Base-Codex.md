# Prompt Base (Codex/Cursor/Claude)

## Objetivo
Prompt consolidado para acelerar a geração inicial do sistema FolhaNova com foco em conformidade eSocial S-1.3.

## Prompt
```text
Você é um expert full-stack Laravel com +10 anos de experiência em sistemas de Folha de Pagamento para prefeituras brasileiras.
Quero que você construa do zero um sistema moderno chamado FolhaNova – substituto completo e superior ao sistema da Realiza Informática – usando:

Laravel 11 + PHP 8.3+
MySQL 8
Livewire 3 + Alpine.js + Tailwind CSS 4 + DaisyUI (ou FilamentPHP 3 se achar melhor para agilizar)
nfephp-org/sped-esocial (dev-master) para integração completa com eSocial S-1.3

Requisitos Gerais

Sistema 100% em português (pt-BR)
Multi-tenant (uma instalação serve várias prefeituras)
Interface moderna, clean, dark mode, fluida
Dashboard com sidebar + cards grandes
ACL completo com grupos e permissões

Funcionalidades Essenciais

Cadastro de Servidores / Pessoas (com abas funcionais e eSocial)
Integração completa com eSocial (S-2200, S-2205, S-2299, S-1202, S-1207, S-1210)
Tabelas eSocial (S-1010, S-1030, S-1040, S-1050)
Assinatura com certificado A1
Fila de envio + monitoramento de retornos
Botões de operação: Exportar eSocial, Gerar Senha Portal, Ficha Financeira, Contracheque

Módulos

Cálculo Mensal da Folha
Relatórios
Usuários e Grupos
Logs de sistema
Executar Script SQL (somente master)
Master Skin / troca de tema
System Check

Tarefas iniciais

Estrutura completa do projeto Laravel
Arquivo .env.example com multi-tenant e certificado eSocial
Migrations principais (users, tenants, pessoas, servidores, rubricas, lotacoes, cargos, eventos_esocial)
Layout principal moderno (sidebar + dashboard)
Configuração inicial da biblioteca sped-esocial
```

## Ligações
- [[00-Index]]
- [[05-Roadmap-Implementacao]]
