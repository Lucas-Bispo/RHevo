# eSocial S-1.3 · Requisitos Práticos (RPPS)

## Eventos obrigatórios no contexto alvo
- **S-2200**: admissão/cadastro inicial do servidor
- **S-2205**: alteração cadastral
- **S-2299**: desligamento/rescisão
- **S-1202**: remuneração mensal de servidor vinculado ao RPPS
- **S-1207**: benefícios previdenciários (aposentados/pensionistas)
- **S-1210**: pagamentos efetuados

## Tabelas essenciais
- **S-1010**: rubricas
- **S-1030**: cargos
- **S-1040**: funções
- **S-1050**: lotações/estabelecimentos

## Requisitos técnicos obrigatórios
- Geração de XML válido conforme leiaute vigente.
- Assinatura digital com certificado A1 (PKCS#12).
- Envio por webservice (SOAP + SSL).
- Tratamento de recibos, protocolos e rejeições.
- Base para integração com DCTFWeb.

## Diretriz de implementação
Centralizar integração eSocial em uma camada de domínio própria (ex.: `Domain/eSocial`) e usar filas para processamento assíncrono, com rastreabilidade completa do ciclo de envio.

## Ligações
- [[00-Index]]
- [[02-Stack-Tecnologica-2026]]
- [[04-Arquitetura-Proposta-Laravel]]
