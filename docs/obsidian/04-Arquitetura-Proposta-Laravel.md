# Arquitetura Proposta (Laravel)

## Módulos iniciais
- **Cadastros-base**: pessoas, servidores, lotações, cargos, funções, rubricas.
- **Folha**: cálculo mensal, fechamento, contracheque, ficha financeira.
- **eSocial**: geração/assinatura/envio/retorno por evento.
- **Administração**: usuários, grupos, permissões, logs e system check.

## Componentes técnicos
- **Queues**: envio assíncrono de eventos e reprocessamento.
- **Jobs/Events**: pipeline de integração eSocial.
- **Migrations por domínio**: separação clara de responsabilidade.
- **Observabilidade**: log estruturado + painel de monitoramento.

## Modelo de dados (macro)
- `tenants`
- `users`
- `pessoas`
- `servidores`
- `lotacoes`
- `cargos`
- `rubricas`
- `eventos_esocial`

## Princípios
1. Conformidade legal por padrão.
2. Evolução incremental por módulo.
3. Rastreabilidade fim a fim.
4. Segurança e isolamento por tenant.

## Ligações
- [[00-Index]]
- [[03-eSocial-S-1.3-Requisitos]]
- [[05-Roadmap-Implementacao]]
