# FolhaNova - Bug Prevention Bible
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Garantir que o FolhaNova tenha prevenção rigorosa de bugs, tratamento claro de erros, logging útil e observabilidade suficiente para manutenção segura.

## Princípios
- Fail fast.
- Defensive programming.
- Nenhuma falha silenciosa.
- Pensar em cenários de erro desde o desenho.

## Regras Obrigatórias
### Exceções e respostas
- Usar exceções específicas por domínio quando necessário.
- Retornar mensagens claras ao usuário sem expor stack trace.
- Diferenciar erros de validação, autorização, ausência de recurso e falha interna.

### Logging
- Separar logs por contexto quando fizer sentido.
- Incluir `tenant_id`, `user_id`, correlação e contexto técnico.
- Nunca registrar dados pessoais sensíveis em texto puro.

### Robustez operacional
- Usar transações em operações compostas.
- Garantir estratégia de retry e falha em jobs críticos.
- Persistir tentativa, sucesso e rejeição em integrações sensíveis como eSocial.

### Testabilidade
- Cobrir cenários de erro e comportamento limite.
- Revisar regressões sempre que houver bug confirmado.

## Fonte de Origem
Documento consolidado a partir de `docs/obsidian/BUG-TRACKING.md`.
