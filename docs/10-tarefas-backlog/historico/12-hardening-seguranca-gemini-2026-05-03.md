# 12 - Hardening de seguranca apos analise Gemini - 03/05/2026

## Contexto

Revisao da analise de seguranca recebida para separar riscos reais do codigo atual de pontos arquiteturais que exigem decisao posterior.

## Tarefa

- Status: concluida.
- Prioridade: alta.
- Escopo: autorizacao por tenant, cookies de sessao, mascaramento de logs e auditoria automatica de dependencias.
- Arquivos envolvidos: `backend/FolhaNova/app/Policies/Concerns/EnforcesTenantAuthorization.php`, `backend/FolhaNova/config/session.php`, `backend/FolhaNova/config/logging.php`, `backend/FolhaNova/app/Logging/RedactSensitiveData.php`, testes unitarios e `.github/workflows/security-audit.yml`.

## Decisoes

- Corrigir o risco de IDOR removendo fallback de `tenant_id` para `id` do modelo.
- Tornar cookies seguros, `http_only` e `same_site=lax` por padrao.
- Implementar mascaramento automatico de dados pessoais e segredos em canais de log.
- Adicionar CI para `composer audit` e `npm audit`.
- Nao ativar `SwitchTenantDatabaseTask` neste ciclo porque o projeto atual usa isolamento logico por `tenant_id`; a troca de banco por tenant exige configuracao propria de conexoes e migracoes.
- Nao ativar casts `encrypted` para CPF/NIS/salario neste ciclo porque muda formato persistido, indices, buscas e dados existentes.

## Validacao executada

- `php artisan test --filter=TenantAuthorizationTest`: passou.
- `php artisan test --filter=RedactSensitiveDataTest`: passou.
- `php artisan test --filter=OrgaoPublicoTest`: passou apos ajuste explicito para o modelo `Tenant`.
- `php artisan test`: 156 testes passaram.
- `composer audit --locked`: nenhum advisory encontrado.
- `npm audit --audit-level=high`: zero vulnerabilidades.
