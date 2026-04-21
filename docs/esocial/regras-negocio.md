# Regras de Negocio e Validacao
**Atualizado em:** 20/04/2026

## Regras basicas derivadas dos leiautes e anexos

### Identificacao do empregador
- Validar `CPF/CNPJ` conforme `tpInsc`.
- `nrInsc` deve ser compativel com `tpInsc`.
- `classTrib` deve ser obrigatorio no cadastro institucional.
- `classTrib` deve ser selecionado a partir da lista inicial controlada pelo sistema para evitar payload institucional com codigo ainda nao mapeado.
- `natJurid` deve ser obrigatoria para inscricoes por `CNPJ`.
- `iniValid` e `fimValid` devem respeitar vigencia logica.
- Eventos de tabela nao devem nascer com vigencia futura incoerente.

### Admissao e ingresso
- `S-2200` so pode ser usado para categorias permitidas.
- `CPF` do trabalhador deve ser valido e consistente com data de nascimento.
- `data_admissao` nao pode violar coerencia temporal do vinculo.
- `matricula` deve ser unica no contexto contratual aplicavel.

### Alteracao cadastral
- `S-2205` deve alterar apenas dados cadastrais.
- Mudancas contratuais nao devem ser tratadas como alteracao cadastral.
- Toda alteracao precisa guardar historico e comparacao com estado anterior.

### Alteracao contratual
- `S-2206` deve tratar alteracoes de cargo, funcao, lotacao, jornada, remuneracao e dados do contrato.
- Nao deve existir alteracao contratual anterior a admissao.
- Alteracoes sucessivas devem respeitar ordem temporal e vigencia.

### Afastamento
- Nao permitir mais de um afastamento com mesma data de inicio e/ou fim para o mesmo trabalhador no mesmo vinculo.
- Bloquear sobreposicao de afastamentos ativos.
- Motivo deve vir de tabela oficial.

### Rubricas
- Rubrica precisa ter natureza, tipo e incidencia consistentes.
- A natureza da rubrica deve ser tratada como codigo `natRubr` numerico de 4 digitos no cadastro local.
- Compatibilidade entre rubrica e categoria do trabalhador deve ser verificada.
- Codigos de incidencia e rubricas especificas de grupos nao podem ser usados em categorias incompativeis.

### Compatibilidades estruturais
- Categoria do trabalhador deve ser compativel com classificacao tributaria do empregador.
- Categoria do trabalhador deve ser compativel com lotacao tributaria.
- Estabelecimento e lotacao tributaria devem respeitar tabelas oficiais.

### Duplicidade e historico
- Nao permitir duplicidade de evento equivalente para a mesma chave logica sem retificacao/exclusao adequada.
- Eventos precisam guardar:
  - status local;
  - payload;
  - protocolo;
  - recibo;
  - mensagem de retorno;
  - timestamps de envio e processamento.
- Reprocessamento local nesta etapa deve ser permitido apenas para eventos com `status = erro`, preservando o payload e limpando protocolo, recibo, mensagem de retorno e timestamps antes de retornar para `pendente`.

## Regras tecnicas para o sistema
- Separar `Pessoa` de `Servidor` e de `Contrato`.
- Tratar vigencia explicitamente em eventos de tabela.
- Criar camada de validacao de negocio antes da geracao do payload.
- Diferenciar erro de preenchimento local, erro de regra e erro de integracao.
- Nao serializar blocos vazios no payload dos eventos de tabela.
- No `S-1000`, `natJurid` nao deve ser enviado quando a inscricao institucional for por `CPF`.
