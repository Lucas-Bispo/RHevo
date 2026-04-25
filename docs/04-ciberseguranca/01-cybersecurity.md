# FolhaNova - 01 Cybersecurity
**Data:** 25 de abril de 2026
**Base:** `CYBERSECURITY-BIBLE.md`

## Objetivo
Fortalecer a seguranca da aplicacao com foco em Laravel, multi-tenant SaaS e protecao contra vazamento de dados entre tenants.

Este documento unifica duas necessidades:
- o guia de hardening estrutural da aplicacao;
- o plano de execucao pratico para implementacao e validacao continua.

## Contexto
O sistema e multi-tenant e utiliza:
- `tenant_id` nas tabelas;
- `TenantScope`;
- Policies;
- `spatie/laravel-permission`.

A seguranca nao pode depender de disciplina do desenvolvedor. A aplicacao deve ser segura por padrao.

## Missao
Evoluir a seguranca sem quebrar funcionalidades existentes, aplicando melhorias estruturais, incrementais e validaveis.

## Principais riscos a tratar

### Alto risco
- bypass do `TenantScope`;
- uso de `withoutGlobalScope()`;
- `tenant_id` manipulavel via mass assignment;
- queries fora do contexto de autenticacao.

### Medio risco
- ausencia de middleware obrigatorio de tenant;
- ausencia de `BaseModel` com enforcement;
- vazamento via relacionamentos Eloquent.

### Baixo risco
- ausencia de auditoria;
- falta de testes de isolamento.

## Estrategia obrigatoria

### Etapa 1 - Analise
- revisar os models `User`, `Servidor` e relacionados;
- revisar `TenantScope`;
- revisar policies;
- identificar pontos reais onde o isolamento pode falhar;
- mapear todos os lugares onde `tenant_id` pode ser manipulado.

### Etapa 2 - Plano
Antes de alterar qualquer codigo:
- listar melhorias necessarias;
- classificar impacto;
- identificar risco de quebra;
- propor mudancas incrementais.

### Etapa 3 - Implementacao segura
Implementar com cautela:

1. Proteger `tenant_id`
- remover de `$fillable`;
- controlar via backend, observer ou service.

2. Criar `BaseModel` seguro
- aplicar `TenantScope` automaticamente;
- impedir bypass facil;
- centralizar regras de isolamento.

3. Criar middleware de tenant obrigatorio
- validar contexto antes de qualquer request;
- bloquear acesso fora de contexto.

4. Proteger relacionamentos
- garantir que models relacionados tambem respeitam tenant;
- evitar vazamento indireto.

5. Prevenir bypass de scope
- detectar uso de `withoutGlobalScope`;
- restringir ou documentar uso seguro.

6. Criar testes de isolamento
- garantir que um tenant nao acessa dados de outro;
- testar CRUD completo.

### Etapa 4 - Validacao
Apos cada alteracao:
- validar login;
- validar fluxo normal;
- validar CRUD;
- validar isolamento entre tenants.

### Etapa 5 - Documentacao
Criar ou manter atualizado:

`docs/security/multi-tenant-hardening.md`

Documentar:
- riscos identificados;
- melhorias aplicadas;
- decisoes tecnicas;
- como garantir isolamento;
- regras obrigatorias para desenvolvedores.

## Regras de seguranca
- nunca confiar em input do usuario;
- nunca confiar em `tenant_id` vindo do request;
- sempre validar contexto de tenant;
- seguranca deve estar no model/base, nao so no controller;
- nao depender apenas de policy;
- evitar qualquer possibilidade de acesso cruzado.

## Regras de desenvolvimento
- nao quebrar login;
- nao quebrar frontend;
- nao alterar comportamento existente sem necessidade;
- mudancas devem ser incrementais;
- sempre validar antes de avancar.

## Formato de resposta antes de implementar
1. analise dos riscos no codigo atual;
2. pontos vulneraveis encontrados;
3. plano de hardening;
4. impacto esperado;
5. estrategia de validacao.

## Formato de resposta apos implementar
1. o que foi protegido;
2. quais arquivos foram alterados;
3. risco mitigado;
4. como validar seguranca;
5. documentacao criada.

## Plano de execucao
Transformar as diretrizes da Biblia de Ciberseguranca em tarefas praticas de implementacao e validacao continua.

### Tarefas executadas neste ciclo

#### 1. Governanca e conformidade
- [x] Consolidar checklist de seguranca por dominio: LGPD, OWASP, hardening e operacao.
- [x] Registrar criterios minimos de producao: debug, cookie seguro, HTTPS, logs e monitoramento.
- [x] Atualizar documentacao tecnica de seguranca no backend para refletir requisitos obrigatorios.

#### 2. Aplicacao Laravel
- [x] Formalizar exigencia de Policy, Gate e `authorize()` para modulos sensiveis.
- [x] Formalizar exigencia de validacao por Form Request e protecao de mass assignment.
- [x] Formalizar exigencia de isolamento por tenant em toda query sensivel.
- [x] Implementar `ServidorPolicy` com bloqueio de acesso cross-tenant para visualizacao e atualizacao.

#### 3. Dados sensiveis e eSocial
- [x] Reforcar regra de nunca expor CPF, NIS, salario ou segredos em logs.
- [x] Reforcar armazenamento seguro de certificado A1 fora da web root e em variaveis de ambiente.
- [x] Reforcar obrigacao de criptografia para retorno sensivel do eSocial.

#### 4. Operacao e monitoramento
- [x] Reforcar rate limiting para login, APIs e rotinas criticas.
- [x] Reforcar orientacao de trilha de auditoria para acoes criticas.
- [x] Reforcar cabecalhos de seguranca e cookies seguros em producao.

### Backlog recomendado para o proximo ciclo
- [ ] Implementar auditoria automatizada de dependencias com `composer audit` em CI.
- [ ] Implementar mascaramento automatico de dados pessoais no pipeline de logs.
- [x] Criar testes automatizados para bloquear acesso cross-tenant.
- [ ] Criar testes de autorizacao com Policies para todos os modulos criticos.
- [ ] Adicionar playbook de resposta a incidentes LGPD com SLA e responsaveis.

## Criterio de aceite
- seguranca tratada como requisito de arquitetura, nao como melhoria opcional;
- toda mudanca sensivel deve atualizar `backend/FolhaNova/docs/SEGURANCA.md`;
- nenhuma entrega e concluida sem checklist de seguranca preenchido.

## Regra final
O sistema deve evoluir de:

`seguro se usado corretamente`

para:

`seguro por padrao, mesmo com erro humano`
