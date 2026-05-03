# 12 - Hardening de seguranca apos analise Gemini - 03/05/2026

## Acao realizada

Triagem e implementacao de correcoes pequenas para riscos reais apontados na analise Gemini, mantendo o fluxo oficial de desenvolvimento do FolhaNova.

## Arquivos alterados

- `backend/FolhaNova/app/Policies/Concerns/EnforcesTenantAuthorization.php`
- `backend/FolhaNova/app/Logging/RedactSensitiveData.php`
- `backend/FolhaNova/config/logging.php`
- `backend/FolhaNova/config/session.php`
- `backend/FolhaNova/tests/Unit/TenantAuthorizationTest.php`
- `backend/FolhaNova/tests/Unit/RedactSensitiveDataTest.php`
- `.github/workflows/security-audit.yml`
- `docs/10-tarefas-backlog/historico/12-hardening-seguranca-gemini-2026-05-03.md`
- `docs/11-implementacao/historico/12-hardening-seguranca-gemini-2026-05-03.md`

## Impacto

- Policies deixam de autorizar objetos sem `tenant_id` explicito.
- O proprio modelo `Tenant` continua autorizado por comparacao explicita entre `user.tenant_id` e `tenant.id`.
- Sessao passa a ser segura por padrao.
- Logs passam por mascaramento de CPF, NIS, salario e segredos.
- Pipeline passa a ter auditoria automatica de dependencias PHP e Node.

## Validacao

- `php artisan test --filter=TenantAuthorizationTest`: passou.
- `php artisan test --filter=RedactSensitiveDataTest`: passou.
- `php artisan test --filter=OrgaoPublicoTest`: passou.
- `php artisan test`: 156 testes passaram.
- `composer audit --locked`: nenhum advisory encontrado.
- `npm audit --audit-level=high`: zero vulnerabilidades.

## Pendencias tecnicas

- Definir se a evolucao multi-tenant sera por banco por tenant ou por isolamento logico com `tenant_id`.
- Planejar criptografia de colunas sensiveis com migracao, impacto em busca por CPF e estrategia de dados existentes.
- Integrar certificados A1 e segredos em AWS Secrets Manager ou SSM na fase de infraestrutura.
