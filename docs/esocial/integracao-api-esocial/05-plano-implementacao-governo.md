# Integracao eSocial - Plano de implementacao com o governo

Consulta oficial feita em 02/05/2026.

## Fontes oficiais que governam esta frente

- Documentacao tecnica do eSocial: https://www.gov.br/esocial/pt-br/documentacao-tecnica/documentacao-tecnica
- Producao Restrita: https://www.gov.br/esocial/pt-br/acesso-ao-sistema/ambiente-de-producao-restrita

Na consulta de 02/05/2026, a documentacao tecnica oficial lista o leiaute `S-1.3`, a `NT 06/2026 rev. 09/04/2026`, XSDs com producao em `27/04/2026`, MOS consolidado ate `NO 10/2026`, Manual do Desenvolvedor `v1.15`, Mensagens do Sistema `v2.5` e Pacote de Comunicacao `v1.6`.

Antes de codificar transmissao real, a release deve congelar estes artefatos em uma versao de referencia e registrar a data da consulta.

## Decisao tecnica principal

O FolhaNova nao deve tentar "automatizar o site" do eSocial.

O caminho correto e:

1. montar payload interno do evento;
2. gerar XML oficial conforme leiaute vigente;
3. validar XML contra XSD oficial;
4. assinar digitalmente cada evento;
5. montar lote;
6. enviar por Web Service SOAP;
7. consultar resultado depois;
8. salvar protocolo, recibo, ocorrencias e XMLs de auditoria.

## Ordem recomendada de implementacao

### Marco 1 - Base tecnica offline

Objetivo: provar que o FolhaNova consegue gerar XML valido sem falar com o governo.

Status em 02/05/2026: iniciado com geracao local do XML `S-1000`, hash SHA-256 e exposicao no detalhe do evento. A validacao XSD final permanece pendente porque o XSD oficial exige a assinatura digital (`Signature`), que pertence ao Marco 2.

Entregas:

- versionar estrategia de XSDs oficiais fora de dados sensiveis;
- criar `EsocialXmlFactory`;
- criar `EsocialXsdValidator`;
- criar builders para `S-1000`, `S-1010` e `S-2200`;
- criar testes automatizados validando XML contra XSD;
- gravar XML gerado no evento local com hash.

Evento inicial recomendado: `S-1000`.

### Marco 2 - Certificado e assinatura

Objetivo: assinar evento XML com certificado A1 em ambiente local controlado.

Entregas:

- cadastro seguro de metadados do certificado;
- configuracao por `.env` para caminho protegido e senha;
- bloqueio para nunca gravar senha ou certificado no Git;
- service `CertificateStore`;
- service `XmlSigner`;
- teste com certificado de homologacao/teste;
- validacao de assinatura antes do envio.

### Marco 3 - Lotes e transporte SOAP

Objetivo: transmitir primeiro lote para Producao Restrita.

Entregas:

- tabela `esocial_lotes`;
- job `SendEsocialBatchJob`;
- client `EsocialSoapClient`;
- configuracao de endpoints por ambiente;
- suporte inicial a `EnviarLoteEventos`;
- gravacao de protocolo e XML enviado;
- timeout e retry controlado.

Ambiente inicial obrigatorio: Producao Restrita.

### Marco 4 - Consulta e retorno

Objetivo: consultar processamento e refletir resultado no painel eSocial.

Entregas:

- job `ConsultEsocialBatchResultJob`;
- parser de retorno;
- tabela `esocial_ocorrencias`;
- status `aceito`, `rejeitado`, `erro_tecnico` e `processando`;
- gravacao de recibo;
- exibicao clara no painel;
- link da rejeicao para a tela de origem.

### Marco 5 - Homologacao funcional por evento

Objetivo: validar eventos na ordem exigida pelo eSocial.

Sequencia sugerida:

1. `S-1000` orgao publico;
2. tabelas: `S-1005`, `S-1010`, `S-1020`, `S-1030`, `S-1040`;
3. trabalhador: `S-2200`;
4. alteracoes: `S-2205`, `S-2206`;
5. desligamento: `S-2299`;
6. periodicos: `S-1202`, `S-1207`, `S-1210`.

## Riscos que precisam virar tarefa

- O leiaute muda com frequencia; a versao usada precisa ser explicita.
- XML aceito em XSD ainda pode ser rejeitado por regra de negocio.
- Certificado vencido ou sem permissao gera falha operacional.
- Reenvio sem rastreabilidade pode criar duplicidade.
- Eventos fora de ordem geram rejeicao.
- XMLs e retornos contem dados pessoais e precisam de controle de acesso.

## O que ja temos no FolhaNova

- autenticao local funcionando;
- cadastros base;
- painel eSocial;
- registros `EventoEsocial`;
- status e reprocessamento local;
- prontidao operacional para eventos de tabela e `S-2200`;
- dependencia `nfephp-org/sped-esocial`;
- documentacao de fluxo, estados, erro e seguranca.

## Proxima frente de desenvolvimento

A proxima frente recomendada e o Marco 1:

1. criar a estrutura de services `App\Services\Esocial`;
2. iniciar pelo builder do `S-1000`;
3. gerar XML local;
4. validar contra XSD oficial;
5. salvar XML e hash no evento;
6. expor no painel um estado "XML gerado/validado".

Isso mantem o projeto seguro: primeiro provamos XML e validacao local, depois entramos em certificado, assinatura e governo.
