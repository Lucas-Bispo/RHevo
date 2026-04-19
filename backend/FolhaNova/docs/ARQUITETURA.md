# Arquitetura do FolhaNova

## Visão geral

O FolhaNova está sendo estruturado como uma aplicação monolítica modular em Laravel 11. A escolha é intencional: ela reduz complexidade operacional no início do projeto, preserva produtividade da equipe e facilita evolução incremental de domínios regulatórios complexos.

## Princípios

- regras de negócio fora de controllers;
- persistência abstraída por repositórios;
- validação concentrada em Form Requests;
- autorização por Policies e Gates;
- evolução por domínio e não por camada técnica isolada;
- segurança como requisito transversal.

## Módulos de domínio

- Administração
- Pessoas
- Servidores
- Folha
- Rubricas
- eSocial
- Multi-tenant
- Auditoria

## Estratégia de persistência

- banco landlord para metadados globais de tenants;
- banco tenant para dados operacionais de cada prefeitura;
- migrations separadas quando o contexto exigir isolamento explícito.

## Interface

- Livewire 3 para manter fluxo server-driven;
- Blade para composição previsível;
- dark mode como padrão;
- dashboard administrativo com sidebar fixa e navegação responsiva.
