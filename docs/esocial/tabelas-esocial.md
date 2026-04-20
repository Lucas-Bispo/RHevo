# Tabelas eSocial
**Atualizado em:** 20/04/2026

## Tabelas obrigatorias mais relevantes para o sistema

### Tabela 01 - Categorias de Trabalhadores
- Uso no sistema:
  - campo `codCateg` do trabalhador/servidor;
  - validacao de compatibilidade com tipo de evento;
  - derivacao de regras contratuais e previdenciarias.

### Tabela 03 - Natureza das Rubricas da Folha de Pagamento
- Uso no sistema:
  - catalogo oficial de natureza de rubrica;
  - base para `S-1010`;
  - validacao de incidencias e consistencia de calculo.

### Tabela 05 - Tipos de Inscricao
- Uso no sistema:
  - `tpInsc` para empregador e estabelecimento;
  - suporte a CPF/CNPJ.

### Tabela 08 - Classificacao Tributaria
- Uso no sistema:
  - classificacao do empregador no `S-1000`;
  - impacto em lotacao tributaria e compatibilidades.
- Valor de destaque para administracao publica:
  - codigo `85` para administracao direta, autarquias e fundacoes publicas.

### Tabela 10 - Tipos de Lotacao Tributaria
- Uso no sistema:
  - entidade `LotacaoTributaria`;
  - base para compatibilidade do vinculo e da remuneracao.

### Tabela 11 - Compatibilidade entre Categoria, Classificacao Tributaria e Tipos de Lotacao
- Uso no sistema:
  - validacao cruzada entre trabalhador, empregador e lotacao tributaria;
  - bloqueio de configuracoes invalidas no cadastro e na alteracao contratual.

### Tabela 12 - Compatibilidade entre Tipos de Lotacao e Classificacao Tributaria
- Uso no sistema:
  - validacao de `S-1005` e `S-1020`.

### Tabela 18 - Motivos de Afastamento
- Uso no sistema:
  - catalogo oficial para `S-2230`.

### Tabela 19 - Motivos de Desligamento
- Uso no sistema:
  - catalogo oficial para `S-2299`.

### Tabela 20 - Tipos de Logradouro
- Uso no sistema:
  - padronizacao de enderecos no cadastro cadastral.

## Traducao tecnica recomendada
- Criar tabelas de dominio internas sincronizaveis com o eSocial:
  - `categorias_trabalhador`
  - `classificacoes_tributarias`
  - `tipos_lotacao_tributaria`
  - `naturezas_rubrica`
  - `motivos_afastamento`
  - `motivos_desligamento`
- Essas tabelas devem ter:
  - codigo oficial;
  - descricao;
  - vigencia;
  - status de ativacao local;
  - possibilidade de associacao a regras internas.
