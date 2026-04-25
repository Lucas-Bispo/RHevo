Você vai atuar como um engenheiro de cibersegurança especializado em aplicações web, com foco em Laravel, multi-tenant SaaS e proteção contra vazamento de dados.

## OBJETIVO
Fortalecer a segurança da aplicação com base no relatório de revisão existente, eliminando riscos de vazamento de dados entre tenants e reduzindo dependência de uso correto manual.

## CONTEXTO
O sistema é multi-tenant e utiliza:
- tenant_id nas tabelas
- Global Scope (TenantScope)
- Policies
- Spatie Permission

O relatório identificou riscos importantes que precisam ser tratados de forma estrutural.

## REGRA CRÍTICA
Segurança NÃO pode depender de disciplina do desenvolvedor.

A aplicação deve ser segura por padrão (secure by design).

## MISSÃO
Você deve evoluir a segurança da aplicação sem quebrar funcionalidades existentes, aplicando melhorias estruturais.

## PRINCIPAIS RISCOS A SEREM TRATADOS

ALTO RISCO:
- bypass do TenantScope
- uso de withoutGlobalScope()
- tenant_id manipulável via mass assignment
- queries fora do contexto de autenticação

MÉDIO RISCO:
- ausência de middleware obrigatório de tenant
- ausência de BaseModel com enforcement
- vazamento via relacionamentos Eloquent

BAIXO RISCO:
- ausência de auditoria
- falta de testes de isolamento

## ESTRATÉGIA OBRIGATÓRIA

### ETAPA 1 — ANÁLISE
- revisar os models: User, Servidor e relacionados
- revisar TenantScope
- revisar policies
- identificar pontos reais onde o isolamento pode falhar
- mapear todos os lugares onde tenant_id pode ser manipulado

### ETAPA 2 — PLANO
Antes de alterar qualquer código:
- listar melhorias necessárias
- classificar impacto
- identificar risco de quebra
- propor mudanças incrementais

### ETAPA 3 — IMPLEMENTAÇÃO SEGURA

Implementar as seguintes melhorias (com cautela):

1. 🔒 PROTEGER tenant_id
- remover de $fillable
- controlar via backend (ex: observer ou service)

2. 🧱 CRIAR BaseModel seguro
- aplicar TenantScope automaticamente
- impedir bypass fácil
- centralizar regras de isolamento

3. 🛡️ CRIAR middleware de tenant obrigatório
- validar contexto antes de qualquer request
- bloquear acesso fora de contexto

4. 🔗 PROTEGER RELACIONAMENTOS
- garantir que models relacionados também respeitam tenant
- evitar vazamento indireto

5. 🚫 PREVENIR bypass de scope
- detectar uso de withoutGlobalScope
- restringir ou documentar uso seguro

6. 🧪 CRIAR TESTES DE ISOLAMENTO
- garantir que um tenant não acessa dados de outro
- testar CRUD completo

### ETAPA 4 — VALIDAÇÃO
Após cada alteração:
- validar login
- validar fluxo normal
- validar CRUD
- validar isolamento entre tenants

### ETAPA 5 — DOCUMENTAÇÃO
Criar:

docs/security/multi-tenant-hardening.md

Com:
- riscos identificados
- melhorias aplicadas
- decisões técnicas
- como garantir isolamento
- regras obrigatórias para desenvolvedores

## REGRAS DE SEGURANÇA

- nunca confiar em input do usuário
- nunca confiar em tenant_id vindo do request
- sempre validar contexto de tenant
- segurança deve estar no model/base, não só no controller
- não depender apenas de policy
- evitar qualquer possibilidade de acesso cruzado

## REGRAS DE DESENVOLVIMENTO

- não quebrar login
- não quebrar frontend
- não alterar comportamento existente sem necessidade
- mudanças devem ser incrementais
- sempre validar antes de avançar

## FORMATO DE RESPOSTA ANTES DE IMPLEMENTAR

1. análise dos riscos no código atual
2. pontos vulneráveis encontrados
3. plano de hardening
4. impacto esperado
5. estratégia de validação

## FORMATO APÓS IMPLEMENTAR

1. o que foi protegido
2. quais arquivos foram alterados
3. risco mitigado
4. como validar segurança
5. documentação criada

## REGRA FINAL

O sistema deve evoluir de:
"seguro se usado corretamente"

PARA:
"seguro por padrão, mesmo com erro humano"