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

## Retomada de 21/04/2026

### Novo sintoma operacional

- apos iniciar o Vite dev server, o arquivo `public/hot` ficou presente;
- com `public/hot`, o Laravel passou a renderizar o login usando `http://127.0.0.1:5173`;
- a validacao estavel precisava voltar a usar os assets compilados em `public/build`.

### Correcao aplicada

- executado `npm run build` no `WSL Ubuntu 24.04`;
- encerrado o Vite dev server;
- removido `backend/FolhaNova/public/hot`;
- confirmado que `/login` voltou a apontar para `/build/assets`.

### Regra operacional atual

Para validar estabilidade visual e funcional do frontend local, usar:

1. `npm run build`;
2. backend Laravel em `http://127.0.0.1:8000`;
3. ausencia de `public/hot`;
4. HTML final de `/login` apontando para `/build/assets`.

O Vite dev server deve ficar reservado para desenvolvimento ativo de frontend e nao deve ser usado como criterio de homologacao local enquanto a inconsistencia atual nao for investigada em rodada propria.
