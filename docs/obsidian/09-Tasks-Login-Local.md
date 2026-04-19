# FolhaNova · Tasks para Recuperar o Login Local

> Objetivo: restaurar a tela de login local com backend Laravel e frontend carregando corretamente, registrando cada diagnóstico e cada correção aplicada.

## Vinculação no plano macro

- Track pai: `TRACK-01 · Estabilização local da aplicação`
- Referência principal: `[[10-Tasks-Macro-Projeto]]`

## Contexto

- O problema atual é visual e operacional: a tela de login não aparece corretamente no navegador.
- O trabalho deve ser feito por etapas pequenas, com validação a cada mudança.
- Toda descoberta relevante deve ser refletida na documentação do projeto.

## Regras de execução

- Não fazer várias correções estruturais ao mesmo tempo.
- Sempre validar a tela de login após cada mudança.
- Registrar causa observada, ação aplicada e resultado.
- Preferir correções reversíveis e de baixo risco primeiro.

## Tasks

### TASK-LOGIN-01 · Confirmar o cenário atual

- Status: `done`
- Objetivo:
  - confirmar a URL usada;
  - confirmar se o backend responde;
  - confirmar se CSS e JS estão chegando corretamente;
  - registrar o sintoma real visto no navegador.
- Critério de aceite:
  - termos um diagnóstico objetivo do estado atual da tela.

### TASK-LOGIN-02 · Verificar pipeline de assets

- Status: `done`
- Objetivo:
  - revisar `@vite`, `vite.config.js`, `resources/css/app.css`, `resources/js/app.js` e o HTML emitido pelo login;
  - confirmar se os assets vêm do build ou do dev server;
  - detectar host incorreto, asset quebrado ou HMR inconsistente.
- Critério de aceite:
  - identificar exatamente de onde o frontend do login está sendo servido.

### TASK-LOGIN-03 · Validar layout Blade / Livewire / Volt do login

- Status: `done`
- Objetivo:
  - revisar o layout guest;
  - revisar a página `pages.auth.login`;
  - garantir que o componente está montando sem erro de slot, view ou renderização.
- Critério de aceite:
  - o HTML do login deve ser gerado sem erro estrutural.

### TASK-LOGIN-04 · Corrigir a causa principal

- Status: `done`
- Objetivo:
  - aplicar a menor correção necessária para restaurar a interface visual do login.
- Critério de aceite:
  - a tela de login aparece com CSS e JS corretos no navegador.

### TASK-LOGIN-05 · Validar autenticação ponta a ponta

- Status: `done`
- Objetivo:
  - confirmar tela de login;
  - confirmar submissão do formulário;
  - confirmar redirecionamento após autenticação;
  - confirmar logout.
- Critério de aceite:
  - fluxo de autenticação local funcionando do início ao fim.

### TASK-LOGIN-06 · Estabilizar o fluxo local de subida

- Status: `pending`
- Objetivo:
  - garantir um modo simples e previsível de subir backend e frontend localmente.
- Critério de aceite:
  - existir um procedimento único e reproduzível para rodar localmente.

### TASK-LOGIN-07 · Registrar causa raiz e correções

- Status: `pending`
- Objetivo:
  - atualizar a linha do tempo;
  - atualizar o guia de ambiente;
  - registrar causa raiz, tentativa, correção e validação final.
- Critério de aceite:
  - qualquer pessoa do projeto consegue entender o que aconteceu e como reproduzir a solução.

### TASK-LOGIN-08 · Investigar falha de autenticação real no navegador

- Status: `done`
- Objetivo:
  - separar problema de acesso da aplicação de problema de autenticação;
  - confirmar se a credencial existe;
  - confirmar se a sessão/cookie/Livewire estão preservando o login;
  - registrar a evidência técnica da falha real.
- Critério de aceite:
  - termos uma causa raiz objetiva para o “não está logando”.

## Registro de execução

### Log de trabalho

- `concluído`: HTML do login confirmado com assets locais via `public/build`.
- `concluído`: CSS compilado confirmado com classes da interface (`panel-surface`, tipografia, cores e utilitários do login).
- `concluído`: ambiente local alinhado para `FolhaNova`, locale `pt_BR` e timezone `America/Sao_Paulo`.
- `concluído`: textos da tela de login ajustados para português.
- `concluído`: `php artisan optimize:clear` executado.
- `concluído`: `npm run build` executado com sucesso.
- `concluído`: `AuthenticationTest` executado com 5 testes passando.
- `concluído`: HTML final validado com `<title>FolhaNova</title>`, `lang="pt-BR"` e labels em português.
- `concluído`: acesso via Windows confirmado pelo IP do WSL (`172.25.248.69:8000`), enquanto `localhost:8000` permaneceu inconsistente.
- `concluído`: investigação da falha de autenticação observada no navegador após a tela de login abrir.
- `concluído`: banco SQLite local real verificado com `users = 0`.
- `concluído`: `DatabaseSeeder` confirmado como responsável por criar `test@example.com`.
- `concluído`: diferença entre testes automatizados e banco local real documentada.
- `concluído`: script `ensure_local_login.php` criado para garantir um usuário local real.
- `concluído`: banco local confirmado com `users = 1`.
- `concluído`: usuário local revalidado em `2026-04-19` com `USER_ID=1`, e-mail `test@example.com` e senha `password`.
- `concluído`: backend local estabilizado em `127.0.0.1:8000` com scripts destacados via WSL e assets compilados servidos por `public/build`.
