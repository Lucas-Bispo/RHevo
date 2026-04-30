# FolhaNova - Documentação Oficial do eSocial
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0
**Ultima conferencia oficial:** 30 de abril de 2026

## Objetivo
Consolidar os pontos de consulta essenciais para a integração do FolhaNova com o eSocial S-1.3, deixando claro o conjunto inicial de eventos, tabelas e requisitos técnicos que orientam o projeto.

## Referencia Oficial Atual
- Portal oficial de Documentacao Tecnica do eSocial: https://www.gov.br/esocial/pt-br/documentacao-tecnica/documentacao-tecnica
- Na consulta de 30/04/2026, o portal lista leiaute `S-1.3`, MOS `consolidado ate NO 10/2026`, leiautes `NT 06/2026 rev. 09/04/2026`, esquemas XSD ate `NT 06/2026`, Manual de Orientacao do Desenvolvedor v1.15, Mensagens do Sistema v2.4 e Pacote de Comunicacao eSocial v1.6.
- Documento explicativo criado para o projeto: `docs/esocial/integracao-api-esocial.md`.

## Eventos Prioritários
- S-2200: admissão ou cadastro inicial.
- S-2205: alteração cadastral.
- S-2299: desligamento.
- S-1202: remuneração de servidor vinculado ao RPPS.
- S-1207: benefícios previdenciários.
- S-1210: pagamentos efetuados.

## Tabelas Essenciais
- S-1010: rubricas.
- S-1005: estabelecimentos, obras ou unidades de orgaos publicos.
- S-1020: lotacoes tributarias.
- S-1030: cargos.
- S-1040: funções.

## Requisitos Técnicos
- XML conforme leiaute vigente.
- Assinatura digital com certificado A1 em PKCS#12.
- Envio por webservice com SOAP e SSL.
- Armazenamento de recibos, protocolos, rejeições e histórico de reprocessamento.
- Preparação para integração com DCTFWeb.

## Estratégia de Implementação
- Centralizar o domínio eSocial em módulo próprio.
- Processar eventos e retornos por filas.
- Garantir rastreabilidade ponta a ponta.
- Proteger certificados, retornos e artefatos sensíveis.

## Referências do Projeto
- `docs/obsidian/03-eSocial-S-1.3-Requisitos.md`
- `backend/FolhaNova/docs/ESOCIAL-INTEGRACAO.md`
- Documentação oficial do Governo Federal deve complementar esta base em atividades de integração real.
