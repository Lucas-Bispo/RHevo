# Modelagem Funcional
**Atualizado em:** 20/04/2026

## Entidades principais
- `Tenant`: prefeitura ou orgao operado.
- `Pessoa`: dados civis e cadastrais reutilizaveis.
- `Servidor`: vinculo funcional com dados de admissao e situacao.
- `Lotacao`: unidade administrativa relacionada ao contexto organizacional.
- `Cargo` e `Funcao`: estrutura ocupacional.
- `Rubrica`: itens remuneratorios com impacto na folha.
- `EventoEsocial`: trilha de envio, recibo, protocolo e retorno.

## Regras funcionais iniciais
- Pessoa e vinculo devem permanecer separados para permitir historico limpo.
- Toda tela operacional nova deve nascer preparada para tenant e eager loading.
- Cadastros estruturais devem guardar codigo interno e campo de referencia eSocial.
- Eventos precisam ser rastreaveis por status e por trabalhador.

## Proximo salto funcional recomendado
- Criar formulario guiado de cadastro de servidor, dividindo:
  - dados pessoais
  - dados do vinculo
  - lotacao/cargo/funcao
  - validacoes minimas para S-2200
