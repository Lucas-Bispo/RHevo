# Segurança do FolhaNova

## Diretrizes iniciais

O projeto trata dados pessoais, funcionais, previdenciários e financeiros. Segurança é restrição de arquitetura e requisito obrigatório de entrega.

## Regras obrigatórias

### 1) Conformidade (LGPD + eSocial)
- Definir base legal de tratamento para cada dado pessoal sensível.
- Garantir atendimento aos direitos do titular por fluxo seguro.
- Manter trilha de incidentes com dados pessoais.
- Nunca expor certificado A1, senha de certificado e retornos sensíveis em logs.

### 2) OWASP e hardening
- Aplicar `Policy`, `Gate` e `authorize()` em módulos sensíveis.
- Desabilitar debug em produção (`APP_DEBUG=false`).
- Revisar dependências periodicamente (`composer audit`).
- Evitar injeção com Eloquent e statements parametrizados.
- Não registrar CPF, NIS, salário e segredos em logs.

### 3) Requisitos técnicos de código
- Usar Form Requests para validação rigorosa de entrada.
- Proteger mass assignment com `$fillable`/`$guarded` explícito.
- Isolar dados por tenant (sem acesso cross-tenant).
- Aplicar rate limiting em autenticação, APIs e rotinas críticas.
- Configurar cabeçalhos de segurança e cookies seguros conforme ambiente.

## Dados sensíveis

Nunca expor em logs, exceptions ou responses:

- CPF
- NIS
- matrícula funcional completa, quando sensível
- salário e dados bancários
- caminho e senha de certificado A1
- payloads integrais do eSocial em ambientes inseguros

## Produção

Requisitos mínimos para produção:

- `APP_DEBUG=false`
- `SESSION_SECURE_COOKIE=true`
- HTTPS obrigatório
- rotação de backups
- revisão de permissões de filesystem
- filas e scheduler supervisionados

## Checklist operacional

- identidade e acesso
- segregação por tenant
- criptografia de dados sensíveis
- gestão segura de segredos
- auditoria e monitoramento
- política de logs sem dados pessoais
