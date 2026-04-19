# FolhaNova - Requisitos Funcionais
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Consolidar os requisitos funcionais principais do FolhaNova com base na visão do produto, na documentação de eSocial e no roadmap inicial do projeto.

## Requisitos Funcionais Centrais
### Cadastro e gestão de pessoas
- Permitir cadastro de pessoa física com dados pessoais, funcionais e de contato.
- Manter histórico de vínculos, cargos, funções, lotações e alterações cadastrais.
- Validar unicidade e consistência de CPF, matrícula, NIS e identificadores exigidos pelo eSocial.

### Gestão de servidores
- Permitir cadastro inicial de servidor com dados compatíveis com o evento S-2200.
- Registrar admissões, alterações cadastrais e desligamentos.
- Manter rastreabilidade completa do ciclo funcional do servidor.

### Folha de pagamento
- Calcular folha mensal por competência.
- Processar rubricas, vencimentos, descontos e eventos periódicos.
- Gerar contracheques, demonstrativos e relatórios gerenciais.

### Administração e acesso
- Autenticar usuários locais com perfis e permissões.
- Suportar ACL por roles e permissões.
- Restringir acesso por tenant e escopo operacional.

### eSocial
- Gerar XML válido conforme leiaute vigente.
- Assinar eventos com certificado A1.
- Enviar eventos por webservice com rastreabilidade de protocolo, retorno e rejeição.
- Controlar eventos obrigatórios, com destaque para S-2200, S-2205, S-2299, S-1202, S-1207 e S-1210.

### Observabilidade e operação
- Exibir dashboard operacional com estado da aplicação e rotinas principais.
- Monitorar filas, falhas, rejeições e reprocessamentos.
- Registrar logs e auditoria de ações sensíveis.

## Requisitos Não Funcionais de Referência
- Segurança por padrão com foco em LGPD.
- Performance adequada para milhares de servidores por prefeitura.
- Isolamento por tenant.
- Documentação contínua e rastreabilidade técnica.

## Fontes Consolidadas
- `docs/obsidian/01-Visao-Produto.md`
- `docs/obsidian/03-eSocial-S-1.3-Requisitos.md`
- `backend/FolhaNova/README.md`
