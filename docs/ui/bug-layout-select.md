# Bug de Layout: Botao Sobrepondo Select
**Atualizado em:** 20/04/2026

## Problema encontrado
- Os filtros das listagens administrativas usavam `grid` com colunas rigidas e uma ultima coluna `auto` para os botoes.
- Em larguras intermediarias, esse arranjo podia comprimir o `select` ou o `input`, causando sensacao visual de sobreposicao entre campo e botao.
- O problema era mais perceptivel no modulo `Servidores`, mas o mesmo padrao aparecia em `Cargos`, `Funcoes`, `Lotacoes`, `Rubricas` e `Eventos eSocial`.

## Causa raiz
- Estrutura de layout dependente de `grid` fixo para uma linha que precisava ser fluida.
- Falta de `w-full` e `min-w-0` nos campos, o que dificultava a acomodacao correta do conteudo quando a largura diminuia.
- Grupo de acoes sem largura controlada em breakpoints menores.

## Solucao aplicada
- Troca do layout dos filtros para `flex` responsivo.
- Padrao adotado:
  - `flex flex-col`
  - `xl:flex-row xl:flex-wrap xl:items-end`
  - `gap-3`
  - campos com `w-full`
  - campo principal com `min-w-0 flex-1`
  - botoes com `w-full sm:w-auto`
- Nenhuma logica da aplicacao foi alterada.

## Antes
- Campos e botoes dependiam de colunas rigidas.
- Em larguras intermediarias, o botao podia encostar ou invadir visualmente a area do select/input.

## Depois
- Mobile: campos e botoes empilhados.
- Desktop: campos alinhados na horizontal com espacamento consistente.
- Sem `absolute`, sem `z-index`, sem hacks visuais.

## Telas ajustadas
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/resources/views/cargos/index.blade.php`
- `backend/FolhaNova/resources/views/funcoes/index.blade.php`
- `backend/FolhaNova/resources/views/lotacoes/index.blade.php`
- `backend/FolhaNova/resources/views/rubricas/index.blade.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`

## Boas praticas para evitar recorrencia
- Preferir `flex` responsivo para barras de filtro com numero variavel de campos.
- Usar `w-full` nos campos de formulario.
- Aplicar `min-w-0` no item flexivel principal.
- Deixar botoes em grupo proprio com largura controlada por breakpoint.
- Evitar `grid` com colunas fixas quando a linha precisa se adaptar a diferentes larguras.
