# FolhaNova - Cybersecurity Bible
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Garantir que todo o código e toda a operação do FolhaNova sigam padrões fortes de segurança, LGPD, eSocial S-1.3 e boas práticas modernas de proteção de dados.

## Visão Geral de Segurança
- O sistema trata dados altamente sensíveis, incluindo identificação civil, vínculo funcional, remuneração e dados previdenciários.
- O contexto é de administração pública municipal, com exigência elevada de rastreabilidade, conformidade e proteção de dados.
- O projeto deve seguir privacy by design, default deny, zero trust entre tenants e auditoria integral de ações críticas.

## Regras Obrigatórias
### Conformidade e proteção de dados
- Definir base legal para tratamento de dados pessoais.
- Implementar trilha de incidentes com dados pessoais.
- Atender direitos do titular por meios seguros.
- Nunca expor certificado A1, senha de certificado ou retorno sensível em logs.

### OWASP e hardening
- Aplicar policies, gates e autorização explícita em módulos sensíveis.
- Desabilitar debug em produção.
- Revisar dependências periodicamente.
- Usar criptografia nativa e hashing adequado para senhas.
- Evitar injeção com Eloquent e statements parametrizados.
- Proteger logs contra vazamento de CPF, NIS, salário e segredos.

### Requisitos técnicos
- Policies em modelos sensíveis.
- Validação rigorosa via Form Requests.
- Proteção de mass assignment.
- Isolamento por tenant.
- Rate limiting em autenticação, APIs e rotinas críticas.
- Cabeçalhos de segurança e cookies seguros conforme ambiente.

## Checklist Operacional de Segurança
- Identidade e acesso.
- Segregação por tenant.
- Criptografia de dados sensíveis.
- Gestão segura de segredos.
- Auditoria e monitoramento.
- Política de logs sem dados pessoais expostos.

## Fonte de Origem
Documento consolidado a partir de `docs/obsidian/FOLHANOVA-CYBERSECURITY.md` e de `backend/FolhaNova/docs/SEGURANCA.md`.
