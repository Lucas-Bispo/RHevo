# Seguranca do FolhaNova

## Diretrizes iniciais

O projeto trata dados pessoais, funcionais, previdenciarios e financeiros. Seguranca e restricao de arquitetura e requisito obrigatorio de entrega.

## Regras obrigatorias

### 1) Conformidade (LGPD + eSocial)
- Definir base legal de tratamento para cada dado pessoal sensivel.
- Garantir atendimento aos direitos do titular por fluxo seguro.
- Manter trilha de incidentes com dados pessoais.
- Nunca expor certificado A1, senha de certificado e retornos sensiveis em logs.

### 2) OWASP e hardening
- Aplicar `Policy`, `Gate` e `authorize()` em modulos sensiveis.
- `Servidor`, `Cargo`, `Lotacao`, `Funcao`, `Rubrica` e `EventoEsocial` devem usar `authorizeResource()` com policy por tenant.
- `OrgaoPublico` deve autorizar o `Tenant` autenticado antes de exibir ou atualizar parametros institucionais.
- Desabilitar debug em producao (`APP_DEBUG=false`).
- Revisar dependencias periodicamente (`composer audit`).
- Evitar injecao com Eloquent e statements parametrizados.
- Nao registrar CPF, NIS, salario e segredos em logs.

### 3) Requisitos tecnicos de codigo
- Usar Form Requests para validacao rigorosa de entrada.
- Proteger mass assignment com `$fillable`/`$guarded` explicito.
- Isolar dados por tenant (sem acesso cross-tenant).
- Reforcar o isolamento com policies de mesmo tenant em listagem, criacao e atualizacao.
- Aplicar rate limiting em autenticacao, APIs e rotinas criticas.
- Configurar cabecalhos de seguranca e cookies seguros conforme ambiente.

## Dados sensiveis

Nunca expor em logs, exceptions ou responses:

- CPF
- NIS
- matricula funcional completa, quando sensivel
- salario e dados bancarios
- caminho e senha de certificado A1
- payloads integrais do eSocial em ambientes inseguros

## Producao

Requisitos minimos para producao:

- `APP_DEBUG=false`
- `SESSION_SECURE_COOKIE=true`
- HTTPS obrigatorio
- rotacao de backups
- revisao de permissoes de filesystem
- filas e scheduler supervisionados

## Checklist operacional

- identidade e acesso
- segregacao por tenant
- criptografia de dados sensiveis
- gestao segura de segredos
- auditoria e monitoramento
- politica de logs sem dados pessoais
