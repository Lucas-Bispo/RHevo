# Integracao com a API do eSocial
**Atualizado em:** 30/04/2026

## Objetivo humano deste documento

Este documento explica, em linguagem pratica, como o FolhaNova devera se integrar ao eSocial na ultima etapa do projeto.

A ideia central e simples:

1. o FolhaNova organiza os dados de RH e folha;
2. transforma esses dados em eventos XML no formato oficial do eSocial;
3. assina digitalmente cada evento com certificado;
4. envia os eventos em lotes para o ambiente nacional;
5. consulta depois o resultado do processamento;
6. guarda recibos, protocolos, rejeicoes e historico para auditoria.

Ou seja: nao e uma API REST moderna com `POST /eventos`. A integracao oficial acontece por Web Services SOAP, XML, XSD, certificado digital e assinatura digital.

## Fontes oficiais consultadas

Consulta feita em 30/04/2026:

- Documentacao Tecnica do eSocial: https://www.gov.br/esocial/pt-br/documentacao-tecnica/documentacao-tecnica
- Manual de Orientacao do Desenvolvedor do eSocial v1.15: https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/manualorientacaodesenvolvedoresocialv1-15.pdf
- Manual de Orientacao do eSocial S-1.3 consolidado ate NO 10/2026: https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/mos-s-1-3-consolidada-ate-a-no-s-1-3-10-2026-com-marcacoes.pdf
- Producao Restrita: https://www.gov.br/esocial/pt-br/acesso-ao-sistema/ambiente-de-producao-restrita
- FAQ Producao Empresas e Producao Restrita: https://www.gov.br/esocial/pt-br/acesso-ao-sistema/cronograma-de-implantacao/perguntas-frequentes-producao-empresas-e-producao-restrita

Na data desta consulta, a pagina oficial lista:

- leiaute S-1.3;
- MOS S-1.3 consolidado ate NO 10/2026;
- leiautes NT 06/2026 rev. 09/04/2026;
- esquemas XSD S-1.3 ate NT 06/2026;
- Manual de Orientacao do Desenvolvedor v1.15;
- Mensagens do Sistema v2.4;
- Pacote de Comunicacao eSocial v1.6.

Antes de implementar a transmissao real, estes arquivos devem ser baixados novamente para garantir que a versao usada no codigo ainda e a versao oficial vigente.

## O que significa "mandar informacoes para o eSocial"

O eSocial nao recebe uma ficha inteira do sistema do jeito que ela aparece na tela. Ele recebe eventos.

Exemplos:

| Dado no FolhaNova | Evento eSocial |
| --- | --- |
| Parametros do orgao publico | `S-1000` |
| Estabelecimentos e unidades | `S-1005` |
| Rubricas da folha | `S-1010` |
| Lotacoes tributarias | `S-1020` |
| Cargo | `S-1030` |
| Funcao | `S-1040` |
| Admissao ou ingresso do servidor | `S-2200` |
| Alteracao cadastral | `S-2205` |
| Alteracao contratual | `S-2206` |
| Desligamento | `S-2299` |
| Remuneracao de servidor RPPS | `S-1202` |
| Pagamento | `S-1210` |

Cada evento tem campos obrigatorios, regras, ordem de envio e formato proprio. O sistema precisa montar cada XML exatamente conforme o leiaute oficial.

## A ordem importa

O eSocial valida um evento olhando tambem o que ja existe na base dele. Por isso a ordem logica e obrigatoria.

Para o FolhaNova, uma ordem segura de implantacao e:

1. enviar `S-1000`, identificando o orgao publico;
2. enviar tabelas estruturais, como `S-1005`, `S-1010`, `S-1020`, `S-1030` e `S-1040`;
3. enviar eventos de trabalhador, comecando por `S-2200`;
4. depois enviar alteracoes, afastamentos e desligamentos;
5. por ultimo, enviar eventos periodicos de folha e pagamento.

A FAQ oficial reforca que o primeiro evento deve ser o `S-1000`; depois entram os eventos de tabela, sempre respeitando a ordem logica do leiaute.

## Ambientes

### Producao restrita

E o ambiente oficial de testes. Ele nao tem efeito juridico e nao deve ser usado para teste de carga ou performance.

URLs oficiais de producao restrita:

- Envio de lote:
  `https://webservices.producaorestrita.esocial.gov.br/servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc`
- Consulta de resultado:
  `https://webservices.producaorestrita.esocial.gov.br/servicos/empregador/consultarloteeventos/WsConsultarLoteEventos.svc`

### Producao

E o ambiente oficial, com efeitos juridicos e obrigacionais.

URLs oficiais de producao:

- Envio de lote:
  `https://webservices.envio.esocial.gov.br/servicos/empregador/enviarloteeventos/WsEnviarLoteEventos.svc`
- Consulta de resultado:
  `https://webservices.consulta.esocial.gov.br/servicos/empregador/consultarloteeventos/WsConsultarLoteEventos.svc`

No FolhaNova, o ambiente deve ser configuravel por tenant ou por instalacao:

- `homologacao` ou `producao_restrita`, para testes;
- `producao`, somente depois de validacao operacional, juridica e contabil.

## Certificado digital

A transmissao exige certificado digital.

Para o FolhaNova, a premissa ja definida e usar certificado A1, porque ele pode ser armazenado em arquivo protegido e usado por processos de fila no servidor.

O certificado tem tres funcoes:

1. autenticar a comunicacao com o Web Service;
2. assinar digitalmente os eventos XML;
3. provar autoria e integridade da informacao transmitida.

Regras praticas:

- nunca versionar o certificado;
- nunca salvar senha do certificado em texto aberto no repositorio;
- guardar caminho e senha em ambiente seguro;
- limitar permissao de leitura no servidor;
- registrar apenas metadados operacionais, nunca o conteudo sensivel do certificado;
- confirmar se o certificado usado tem permissao para transmitir pelo empregador, diretamente ou por procuracao eletronica quando aplicavel.

## O fluxo tecnico completo

### 1. O usuario fecha uma acao no FolhaNova

Exemplo: uma admissao fica pronta.

O FolhaNova nao deve enviar imediatamente durante o clique do usuario. Ele deve criar ou atualizar um registro em `eventos_esocial`, com status local.

Exemplo de status local:

- `rascunho`;
- `pendente`;
- `validando`;
- `assinado`;
- `enviado`;
- `processando`;
- `aceito`;
- `rejeitado`;
- `erro`;
- `cancelado`.

Hoje o projeto ja possui `EventoEsocial` e painel operacional. A etapa futura deve expandir esse modelo para tentativas, lote, protocolo, recibo e rejeicoes detalhadas.

### 2. O sistema monta o payload do evento

O payload interno nao e ainda o XML final. Primeiro, o FolhaNova deve transformar os dados do dominio em uma estrutura limpa.

Exemplo conceitual para `S-2200`:

- pessoa;
- CPF;
- data de nascimento;
- matricula;
- categoria eSocial;
- regime previdenciario;
- lotacao;
- cargo;
- data de admissao;
- dados contratuais.

Esse mapeamento deve ficar em services especificos, por exemplo:

- `S1000PayloadBuilder`;
- `S1010PayloadBuilder`;
- `S2200PayloadBuilder`;
- `S1202PayloadBuilder`.

Cada builder deve receber entidades do sistema e devolver uma estrutura previsivel, testavel e independente da tela.

### 3. O sistema gera o XML oficial

Depois do payload interno, o FolhaNova gera o XML no formato oficial do evento.

Nesta etapa entram:

- tag raiz correta;
- namespace correto;
- versao correta do leiaute;
- grupos obrigatorios;
- campos opcionais somente quando aplicaveis;
- identificador unico `Id` do evento;
- normalizacao de datas, valores e codigos.

O projeto ja possui a dependencia `nfephp-org/sped-esocial`. A decisao recomendada e usar essa biblioteca para ajudar na montagem, assinatura e comunicacao sempre que ela cobrir a necessidade do leiaute vigente. Onde a biblioteca nao cobrir, criar uma camada propria pequena, testada e isolada.

### 4. O XML e validado contra XSD

Antes de transmitir, o FolhaNova deve validar o XML contra os XSD oficiais da versao em uso.

Essa validacao evita enviar lixo para o governo e receber rejeicao basica.

Validacoes minimas antes do envio:

- XML bem formado;
- schema XSD correto;
- versao do leiaute correta;
- grupo do evento correto;
- campos obrigatorios presentes;
- ordem dos elementos compativel com o XSD;
- tamanho e formato de campos conforme leiaute.

### 5. O evento e assinado digitalmente

Cada evento dentro do lote deve ser assinado individualmente.

Isso e diferente de assinar somente o lote. O lote transporta eventos; os eventos precisam carregar sua assinatura.

No FolhaNova, a assinatura deve acontecer fora da requisicao HTTP do usuario, em job de fila.

### 6. Os eventos sao agrupados em lote

O Web Service de envio recebe lote de eventos.

O lote deve respeitar restricoes importantes:

- eventos de um unico empregador;
- eventos de um mesmo grupo;
- ordem de precedencia;
- limite de eventos por lote conforme documentacao vigente;
- nao misturar eventos que o eSocial espera processar em sequencia.

Para o FolhaNova, a recomendacao e comecar simples:

- um lote pequeno por tipo de evento;
- envio serial para eventos de tabela;
- evitar paralelismo em eventos dependentes;
- registrar `batch_id` ou equivalente no banco.

### 7. O lote e enviado ao Web Service

O envio chama o metodo `EnviarLoteEventos`.

O retorno inicial nao significa que todos os eventos foram aceitos. Ele confirma a recepcao do lote e devolve protocolo quando o lote entra para processamento.

O FolhaNova deve salvar:

- XML enviado;
- hash do XML;
- ambiente;
- endpoint usado;
- data/hora do envio;
- protocolo de envio;
- certificado usado ou identificador seguro do certificado;
- status `processando`.

### 8. O resultado e consultado depois

O processamento e assincrono. Por isso, depois do envio, o FolhaNova precisa consultar o resultado usando o protocolo.

Essa consulta chama o metodo `ConsultarLoteEventos`.

O retorno pode trazer:

- sucesso do lote;
- sucesso do evento;
- advertencia;
- rejeicao;
- codigo da resposta;
- descricao da resposta;
- ocorrencias;
- recibo do evento aceito.

O recibo e importantissimo: ele prova que o evento foi aceito e sera necessario para retificacoes, exclusoes ou auditorias futuras.

### 9. O FolhaNova atualiza a trilha de auditoria

Depois da consulta, o sistema atualiza o evento local:

- `aceito`, quando o eSocial aceitou;
- `rejeitado`, quando ha erro de regra, conteudo, schema ou precedencia;
- `erro`, quando houve falha tecnica temporaria;
- `processando`, se ainda nao terminou.

O painel eSocial deve mostrar isso para o usuario de RH de forma simples:

- o que foi enviado;
- quando foi enviado;
- qual protocolo voltou;
- se foi aceito ou rejeitado;
- qual recibo foi gerado;
- qual mensagem precisa ser corrigida;
- qual tela deve ser aberta para corrigir a origem do problema.

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

## O que fazer quando da erro

Nem todo erro e igual.

### Erro de conteudo

Exemplo: campo obrigatorio ausente, categoria invalida, data incoerente.

Acao:

- marcar como `rejeitado`;
- mostrar mensagem no painel;
- apontar para a tela de origem;
- permitir corrigir o cadastro;
- gerar novo XML;
- reenviar.

### Erro de schema

Exemplo: XML fora do XSD.

Acao:

- tratar como bug tecnico;
- bloquear reenvio automatico;
- registrar log tecnico;
- corrigir builder/XML;
- testar contra XSD antes de novo envio.

### Erro temporario

Exemplo: timeout, indisponibilidade, falha 301.

Acao:

- manter evento em `erro`;
- permitir retentativa com backoff;
- nao duplicar evento sem estrategia;
- consultar protocolo anterior quando existir.

### Duplicidade

Pode acontecer quando o lote foi recebido, mas a conexao caiu antes de o sistema guardar o retorno.

Acao:

- usar identificador do evento e protocolo quando existir;
- consultar resultado;
- tratar retorno de duplicidade com cuidado;
- nunca recriar eventos sem manter rastreabilidade.

## Regras de seguranca

- Certificado e senha ficam fora do Git.
- Producao exige revisao manual antes de habilitar.
- Logs nao devem conter senha, certificado, chave privada ou XML completo com dados sensiveis sem politica clara de acesso.
- Acesso ao painel de eventos deve ser restrito por permissao.
- XMLs e retornos contem dados pessoais; devem seguir politica de LGPD.
- Retencao de XMLs deve ser definida com criterio contabil, juridico e operacional.
- Toda chamada externa deve ter timeout, retry controlado e log de correlacao.

## Como isso se encaixa no fluxo atual do FolhaNova

O projeto ja tem pecas importantes:

- `EventoEsocial`;
- painel de eventos;
- status local;
- reprocessamento local;
- payloads iniciais;
- prontidao operacional para `S-1000`, `S-1010`, `S-1005/S-1020`, `S-1030/S-1040` e `S-2200`;
- dependencia `nfephp-org/sped-esocial`.

O que ainda falta para transmissao real:

1. completar campos oficiais por evento;
2. validar regras oficiais antes de gerar XML;
3. gerar XML por leiaute vigente;
4. validar XML contra XSD;
5. assinar digitalmente;
6. montar lotes;
7. chamar Web Services SOAP;
8. consultar resultado;
9. interpretar retornos;
10. gravar recibos, protocolos e ocorrencias;
11. criar uma rotina operacional de correcao e reenvio.

## Sequencia recomendada para a ultima etapa

Quando chegar a hora da integracao real, seguir nesta ordem:

1. baixar documentacao oficial atualizada;
2. congelar versao de leiaute e XSD usada na release;
3. criar configuracao de ambiente e certificado;
4. implementar validacao XSD local;
5. implementar assinatura de XML;
6. transmitir primeiro em producao restrita;
7. comecar por `S-1000`;
8. enviar uma tabela simples, como `S-1010` ou estrutura equivalente;
9. enviar `S-2200` de teste;
10. consultar retorno e gravar recibo;
11. testar rejeicoes conhecidas;
12. testar queda de conexao e reconsulta;
13. fazer homologacao funcional com usuario;
14. habilitar producao somente com checklist assinado.

## Checklist antes de producao

- Documentacao oficial conferida no dia da release.
- Certificado valido e com permissao correta.
- Producao restrita validada.
- XSD versionado ou armazenado com controle claro.
- Eventos prioritarios aceitos em ambiente de teste.
- Tratamento de rejeicao validado.
- Consulta de retorno validada.
- Recibos gravados corretamente.
- Logs revisados para nao expor dado sensivel indevido.
- Rotina de backup definida.
- Usuario sabe corrigir evento rejeitado pelo painel.
- Plano de rollback operacional documentado.

## Decisao de produto

A integracao com o eSocial deve ser a ultima etapa porque ela depende da qualidade dos dados anteriores.

Enviar cedo demais gera rejeicao, retrabalho e risco operacional. O caminho mais seguro e continuar amadurecendo cadastros, prontidao, regras e rastreabilidade. Quando a base estiver consistente, a transmissao vira consequencia tecnica: gerar XML correto, assinar, enviar, consultar e auditar.
