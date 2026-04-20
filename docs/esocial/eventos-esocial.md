# Eventos eSocial
**Atualizado em:** 20/04/2026

## Eventos identificados nos leiautes S-1.3

### Alta prioridade
- `S-1000 - Informacoes do Empregador/Contribuinte/Orgao Publico`
  - Finalidade: identificar o ente e parametrizar classificacao tributaria, vigencia e dados institucionais.
  - Tradução para o sistema:
    - entidade `Empregador` ou camada funcional sobre `Tenant`;
    - formulario de parametros institucionais;
    - validacao de `tpInsc`, `nrInsc`, `classTrib`, `iniValid` e `fimValid`.

- `S-1005 - Tabela de Estabelecimentos, Obras ou Unidades de Orgaos Publicos`
  - Finalidade: estruturar unidades administrativas e estabelecimentos.
  - Traducao para o sistema:
    - entidade `Estabelecimento` e vinculo com empregador;
    - relacao com lotacoes e unidades administrativas;
    - vigencia por unidade.

- `S-1010 - Tabela de Rubricas`
  - Finalidade: parametrizar rubricas de folha, natureza e incidencias.
  - Traducao para o sistema:
    - entidade `Rubrica` com codigos, natureza e incidencias;
    - regras de compatibilidade com categoria e tributacao;
    - historico de vigencia por rubrica.

- `S-1020 - Tabela de Lotações Tributárias`
  - Finalidade: definir lotacao tributaria e compatibilidade com classificacao tributaria.
  - Traducao para o sistema:
    - entidade `LotacaoTributaria`;
    - relacao com `Estabelecimento`, `Servidor` e futura remuneracao.

- `S-2200 - Cadastramento Inicial do Vinculo e Admissao/Ingresso de Trabalhador`
  - Finalidade: criar trabalhador, vinculo e ingresso.
  - Traducao para o sistema:
    - entidades `Pessoa`, `Servidor`, `Contrato`;
    - captura de categoria, matricula, lotacao, cargo, funcao, salario e datas;
    - evento pendente com payload rastreavel.

### Media prioridade
- `S-2205 - Alteracao de Dados Cadastrais do Trabalhador`
  - Finalidade: alterar nome, estado civil, endereco, documentos, dependentes e outros dados cadastrais.
  - Traducao para o sistema:
    - historico cadastral por trabalhador;
    - comparacao entre estado atual e alteracao;
    - fila de eventos de alteracao cadastral.

- `S-2206 - Alteracao de Contrato de Trabalho/Relacao Estatutaria`
  - Finalidade: alterar dados contratuais como cargo, funcao, jornada, remuneracao e lotacao.
  - Traducao para o sistema:
    - historico contratual;
    - snapshot de contrato vigente;
    - validacao de datas e coerencia com admissao anterior.

- `S-2230 - Afastamento Temporario`
  - Finalidade: registrar afastamentos com motivo, datas e consequencias previdenciarias.
  - Traducao para o sistema:
    - entidade `Afastamento`;
    - controle de sobreposicao;
    - referencia a motivos oficiais.

### Baixa prioridade
- `S-2299 - Desligamento`
  - Finalidade: encerrar vinculo com data, motivo e verbas rescisorias.
  - Traducao para o sistema:
    - encerramento do contrato;
    - bloqueios em alteracoes posteriores;
    - ligacao com eventos remuneratorios finais.

## Observacao funcional
- O projeto ja possui base operacional para `S-1000`, `S-1010` e `S-2200`, mas ainda com cobertura parcial.
- `S-2205`, `S-2206` e `S-2230` sao a proxima camada coerente para transformar o sistema em operacao real de RH.
