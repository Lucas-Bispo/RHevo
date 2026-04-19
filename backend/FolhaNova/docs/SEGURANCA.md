# Segurança do FolhaNova

## Diretrizes iniciais

O projeto trata dados pessoais, funcionais e previdenciários. Por isso, segurança não é um acabamento posterior, mas uma restrição de arquitetura.

## Medidas já previstas

- hash de senha com algoritmo padrão do Laravel;
- proteção contra mass assignment;
- CSRF habilitado;
- cookies com suporte a `http_only`;
- separação de banco landlord e bancos tenant;
- exclusão de certificados e artefatos sensíveis do versionamento;
- base para auditoria, 2FA e trilha de acesso.

## Dados sensíveis

Nunca expor em logs, exceptions ou responses:

- CPF
- NIS
- matrícula funcional completa, quando sensível
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
