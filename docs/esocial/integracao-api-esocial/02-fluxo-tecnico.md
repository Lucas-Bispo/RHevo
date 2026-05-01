# Integracao eSocial - Fluxo tecnico completo

Recorte do guia de integracao com a API/Web Services do eSocial.

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
