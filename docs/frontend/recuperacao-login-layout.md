# Recuperacao do Layout de Login

## Sintoma encontrado

- tela de login com perda forte de estrutura visual;
- formulario pequeno e desalinhado;
- elementos decorativos soltos e dominando a tela;
- indicio de assets inconsistentes entre layout Blade e build do Vite.

## Causa raiz

O layout de login usa um entrypoint proprio:

- `resources/js/auth-login.js`

Esse arquivo estava sendo referenciado em:

- `resources/views/components/layouts/auth-login.blade.php`

Mas o build estavel disponivel no projeto so gerava assets para `resources/js/app.js`. Como resultado, o login ficava dependente de um entrypoint separado sem garantia de manifesto valido no ambiente atual, abrindo espaco para regressao visual e carregamento inconsistente dos assets da tela.

## Arquivos analisados

- `backend/FolhaNova/resources/views/components/layouts/auth-login.blade.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `backend/FolhaNova/resources/js/auth-login.js`
- `backend/FolhaNova/resources/js/app.js`
- `backend/FolhaNova/vite.config.js`
- `backend/FolhaNova/public/build/manifest.json`

## Arquivos corrigidos

- `backend/FolhaNova/resources/views/components/layouts/auth-login.blade.php`

## O que foi restaurado

- alinhamento do layout de login ao entrypoint estavel ja presente no manifesto;
- carregamento consistente de `app.css` e `app.js` na tela de login;
- restauracao do caminho mais seguro para o frontend sem reescrever a interface.

## Como validar

1. executar o build no `WSL Ubuntu 24.04`;
2. confirmar que `public/build/manifest.json` contem `resources/css/app.css` e `resources/js/app.js`;
3. abrir `/login`;
4. verificar se o formulario voltou a ficar centralizado;
5. verificar se os elementos decorativos ficaram restritos ao hero e nao invadem o conteudo;
6. validar responsividade basica em viewport desktop e mobile.

## Observacao obrigatoria

- ambiente oficial local: `WSL Ubuntu 24.04`
- nao usar `XAMPP`
