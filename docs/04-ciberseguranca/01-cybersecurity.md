# FolhaNova — 01 Cybersecurity (Plano de Execução)
**Data:** 25 de abril de 2026  
**Base:** `CYBERSECURITY-BIBLE.md`

## Objetivo
Transformar as diretrizes da Bíblia de Cibersegurança em tarefas práticas de implementação e validação contínua.

## Tarefas executadas neste ciclo

### 1) Governança e conformidade
- [x] Consolidar checklist de segurança por domínio (LGPD, OWASP, hardening, operação).
- [x] Registrar critérios mínimos de produção (debug, cookie seguro, HTTPS, logs e monitoramento).
- [x] Atualizar documentação técnica de segurança no backend para refletir requisitos obrigatórios.

### 2) Aplicação (Laravel)
- [x] Formalizar exigência de Policy/Gate/`authorize()` para módulos sensíveis.
- [x] Formalizar exigência de validação por Form Request + proteção de mass assignment.
- [x] Formalizar exigência de isolamento por tenant em toda query sensível.
- [x] Implementar `ServidorPolicy` com bloqueio de acesso cross-tenant para visualização e atualização.

### 3) Dados sensíveis e eSocial
- [x] Reforçar regra de nunca expor CPF/NIS/salário/segredos em logs.
- [x] Reforçar armazenamento seguro de certificado A1 fora da web root e em variáveis de ambiente.
- [x] Reforçar obrigação de criptografia para retorno sensível do eSocial.

### 4) Operação e monitoramento
- [x] Reforçar rate limiting para login, APIs e rotinas críticas.
- [x] Reforçar orientação de trilha de auditoria para ações críticas.
- [x] Reforçar cabeçalhos de segurança e cookies seguros em produção.

## Backlog recomendado (próximo ciclo)
- [ ] Implementar auditoria automatizada de dependências (`composer audit`) em CI.
- [ ] Implementar mascaramento automático de dados pessoais no pipeline de logs.
- [x] Criar testes automatizados para bloquear acesso cross-tenant.
- [ ] Criar testes de autorização (Policies) para todos os módulos críticos.
- [ ] Adicionar playbook de resposta a incidentes LGPD (com SLA e responsáveis).

## Critério de aceite
- Segurança tratada como requisito de arquitetura, não como melhoria opcional.
- Toda mudança sensível deve atualizar `backend/FolhaNova/docs/SEGURANCA.md`.
- Nenhuma entrega é concluída sem checklist de segurança preenchido.
