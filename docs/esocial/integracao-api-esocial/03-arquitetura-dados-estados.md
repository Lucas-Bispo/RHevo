# Integracao eSocial - Arquitetura, dados e estados

Recorte do guia de integracao com a API/Web Services do eSocial.

## Como explicar em uma frase

O FolhaNova nao "preenche o site do eSocial"; ele gera documentos XML oficiais, assina com certificado, envia para Web Services do governo, consulta o resultado depois e guarda a prova de tudo.


## Arquitetura recomendada no FolhaNova

### Camadas

| Camada | Responsabilidade |
| --- | --- |
| Tela | Usuario cadastra, revisa e dispara preparacao |
| Dominio | Regras de RH, folha, vigencia, consistencia |
| Payload builder | Converte entidades em estrutura de evento |
| XML builder | Converte payload em XML oficial |
| XSD validator | Valida XML contra schemas oficiais |
| Signer | Assina evento com certificado |
| Batch service | Agrupa eventos em lote |
| Transport | Chama Web Services SOAP |
| Return parser | Interpreta retorno do eSocial |
| Audit service | Persiste protocolo, recibo, erro e historico |

### Services sugeridos

```text
App\Services\Esocial\Payloads\S1000PayloadBuilder
App\Services\Esocial\Payloads\S1010PayloadBuilder
App\Services\Esocial\Payloads\S2200PayloadBuilder
App\Services\Esocial\Xml\EsocialXmlFactory
App\Services\Esocial\Xml\EsocialXsdValidator
App\Services\Esocial\Security\CertificateStore
App\Services\Esocial\Security\XmlSigner
App\Services\Esocial\Batches\EsocialBatchBuilder
App\Services\Esocial\Transport\EsocialSoapClient
App\Services\Esocial\Returns\EsocialReturnParser
App\Services\Esocial\Audit\EsocialEventRecorder
```

### Jobs sugeridos

```text
PrepareEsocialEventJob
ValidateEsocialEventXmlJob
SignEsocialEventJob
SendEsocialBatchJob
ConsultEsocialBatchResultJob
ProcessEsocialReturnJob
```

Essa divisao evita que uma tela de cadastro precise saber como SOAP, certificado, XML e retorno funcionam.


## Banco de dados que provavelmente sera necessario

O modelo atual `eventos_esocial` ja e uma boa base. Na etapa de transmissao real, ele deve evoluir ou ganhar tabelas auxiliares.

Campos ou tabelas recomendadas:

- `eventos_esocial`
  - evento;
  - status local;
  - ambiente;
  - payload interno;
  - XML gerado;
  - XML assinado;
  - hash;
  - recibo;
  - protocolo;
  - mensagem de retorno;
  - codigo de retorno;
  - datas de envio e processamento.
- `esocial_lotes`
  - ambiente;
  - grupo;
  - status;
  - protocolo;
  - endpoint;
  - XML do lote;
  - tentativa atual;
  - enviado_em;
  - consultado_em.
- `esocial_ocorrencias`
  - evento local;
  - lote;
  - codigo;
  - descricao;
  - tipo;
  - localizacao do erro;
  - resolvida ou nao.
- `esocial_certificados`
  - identificador seguro;
  - tenant;
  - validade;
  - emissor;
  - caminho protegido ou referencia em cofre;
  - nunca salvar senha aberta.


## Estados do evento no painel

Uma leitura simples para o usuario:

| Status humano | O que significa |
| --- | --- |
| Pendente | O evento existe no FolhaNova, mas ainda nao foi enviado |
| Validando | O XML esta sendo conferido antes do envio |
| Assinado | O evento ja recebeu assinatura digital |
| Enviado | O lote foi transmitido e recebeu protocolo |
| Processando | O eSocial ainda nao devolveu resultado final |
| Aceito | O evento foi aceito e tem recibo |
| Rejeitado | O governo recusou por erro de regra, schema ou conteudo |
| Erro tecnico | Houve falha de comunicacao, certificado, timeout ou instabilidade |
| Cancelado | O envio foi interrompido localmente antes de concluir |
