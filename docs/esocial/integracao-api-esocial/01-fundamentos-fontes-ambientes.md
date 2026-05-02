# Integracao eSocial - Fundamentos, fontes, ambientes e certificado

Recorte do guia de integracao com a API/Web Services do eSocial.

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

Consulta feita em 02/05/2026:

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
- Mensagens do Sistema v2.5;
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
