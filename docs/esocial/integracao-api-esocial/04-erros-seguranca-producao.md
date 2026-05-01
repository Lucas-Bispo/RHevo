# Integracao eSocial - Erros, seguranca e preparacao para producao

Recorte do guia de integracao com a API/Web Services do eSocial.

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
