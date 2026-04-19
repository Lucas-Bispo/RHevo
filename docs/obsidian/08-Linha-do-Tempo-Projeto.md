# FolhaNova · Linha do Tempo do Projeto

> Documento de referência histórica do projeto. O objetivo é registrar, em ordem temporal, as decisões, mudanças de stack, marcos de implementação, documentação produzida e incidentes locais observados durante o desenvolvimento.

## Propósito

Este arquivo existe para:

- preservar memória técnica do projeto;
- separar fatos confirmados de inferências;
- facilitar debugging quando algo quebrar;
- apoiar retrospectivas, auditoria técnica e retomada de contexto;
- registrar incidentes de ambiente local, especialmente no WSL e no fluxo Laravel + Vite.

## Critério de confiabilidade

Legenda usada neste histórico:

- `Confirmado por git`: informação obtida diretamente do histórico do repositório.
- `Confirmado por documentação`: informação encontrada em arquivos markdown existentes no projeto.
- `Confirmado por execução local`: informação validada no ambiente atual.
- `Inferência`: interpretação provável com base no contexto, mas não garantida pelo repositório.

## Linha do Tempo

### Início e concepção

#### `b85fec9` · Início do projeto

- Tipo: `Confirmado por git`
- Mensagem: `:tada: Inicio de Projeto - planjamento`
- Leitura: marco inicial do repositório e do planejamento do produto.

#### Primeira direção de stack

- Tipo: `Confirmado por git`
- Commit: `d29ff40`
- Mensagem: `:zap: Stack sugerida para PHP no frontend e Python no backend`
- Leitura: o projeto começou com uma proposta híbrida, com backend em Python e frontend em PHP.

#### Configurações iniciais de backend

- Tipo: `Confirmado por git`
- Commit: `4bc4d28`
- Mensagem: `:wrench: Realizando configurações de Backend`
- Leitura: início da estrutura técnica do backend.

#### Infraestrutura inicial

- Tipo: `Confirmado por git`
- Commits:
  - `a1142cc` `Adiciona docker-compose para serviços`
  - `f5f1477` `Cria .gitignore para ignorar caches`
- Leitura: primeira organização de ambiente e versionamento.

## Fase Python / PostgreSQL / Pydantic / SQLAlchemy

#### Estrutura inicial do backend

- Tipo: `Confirmado por git`
- Commit: `c770860`
- Mensagem: `Adiciona estrutura inicial do projeto backend`

#### Banco PostgreSQL e ORM

- Tipo: `Confirmado por git`
- Commits:
  - `d3bbc1c` `adiciona conexão com PostgreSQL usando SQLAlchemy`
  - `84b8546` `Criado modelo de dados para lotação tributária com SQLAlchemy`
- Leitura: o backend evoluiu com base em SQLAlchemy e PostgreSQL.

#### Modelagem com Pydantic

- Tipo: `Confirmado por git`
- Commit: `4dbc3e7`
- Mensagem: `Adicionado modelos de dados para lotação tributária com Pydantic`

#### Estrutura do evento S-2200

- Tipo: `Confirmado por git`
- Commit: `fc440b9`
- Mensagem: `Adiciona estrutura completa do evento S-2200`
- Leitura: o tema eSocial já estava presente na fase Python.

#### Ajustes e compatibilidade

- Tipo: `Confirmado por git`
- Commits:
  - `24b7dab` `corrige compatibilidade com Pydantic v2 e ajusta frontend PHP`
  - `7e6b09b` `Adiciona relacionamento com lotações tributárias via ForeignKey`
  - `78d7f05` `Substitua o uso de /dev/tcp por nc (netcat)`
  - `95c744d` `Falha ao Recarregar o Apache no Frontend`
- Leitura: houve esforço para estabilizar a stack antiga e o frontend PHP.

## Fase de API e testes

#### Validação de endpoints REST

- Tipo: `Confirmado por git`
- Commit: `7c52675`
- Mensagem: `test(api): valida criação de lotação e vínculo com servidor via endpoints REST`
- Leitura: o projeto já tinha alguma superfície de API testável antes da mudança maior de stack.

## Mudança estratégica para Laravel

#### Rebase e integração de branches

- Tipo: `Confirmado por git`
- Commit: `ae141dc`
- Mensagem: `Integra alterações da branch developer na main`
- Leitura: consolidação de trabalho paralelo antes da mudança de documentação e direção técnica.

#### Criação do hub Obsidian

- Tipo: `Confirmado por git`
- Commit: `7330487`
- Mensagem: `docs: add Obsidian-linked context for FolhaNova and eSocial`
- Leitura: nasce a camada documental atual em `docs/obsidian`.

#### Merge da documentação de contexto

- Tipo: `Confirmado por git`
- Merge commit: `a48793c`
- Leitura: a documentação virou parte central do projeto.

#### Remoção da infraestrutura Python legada

- Tipo: `Confirmado por git`
- Commit: `6e120da`
- Mensagem: `chore: remove infraestrutura Python legada`
- Merge final: `1628872`
- Leitura: o projeto assumiu de vez a direção Laravel/PHP.

## Documentação-base do projeto moderno

#### `projeto.md`

- Tipo: `Confirmado por documentação`
- Data visível no arquivo: `18 de abril de 2026`
- Leitura: consolida a visão macro do produto, módulos funcionais e fases.

#### `docs/obsidian/00-Index.md`

- Tipo: `Confirmado por documentação`
- Papel: hub central do vault Obsidian.

#### `docs/obsidian/01-Visao-Produto.md` até `06-Prompt-Base-Codex.md`

- Tipo: `Confirmado por documentação`
- Data de criação local visível: `18/04/2026`
- Leitura: formalização da visão, stack 2026, eSocial, arquitetura proposta, roadmap e instruções de trabalho com IA.

## Situação observada em 19/04/2026

### Ambiente Laravel existente no repositório

- Tipo: `Confirmado por execução local`
- Pasta da aplicação: `backend/FolhaNova`
- Stack local validada:
  - PHP `8.3.6`
  - Composer `2.7.1`
  - Node `20.20.2`
  - npm `10.8.2`

### Estrutura local encontrada

- Tipo: `Confirmado por execução local`
- O projeto já possuía:
  - `vendor/`
  - `node_modules/`
  - `.env`
  - `database/database.sqlite`

### Ajustes de ambiente local realizados

- Tipo: `Confirmado por execução local`
- Ações realizadas:
  - limpeza de cache com `php artisan optimize:clear`;
  - validação de migrations;
  - ajuste do `.env` local para rodar com SQLite;
  - simplificação local de `session`, `cache` e `queue` para desenvolvimento.

### Incidente de interface de login

- Tipo: `Confirmado por execução local`
- Sintoma observado:
  - a interface de login aparecia quebrada ou sem o frontend esperado;
  - em alguns momentos o navegador exibia conteúdo cru do dev server;
  - em outros momentos a página carregava sem CSS/JS corretos.

### Causa identificada no fluxo frontend

- Tipo: `Confirmado por execução local`
- Diagnóstico:
  - o HTML da aplicação chegou a referenciar assets do Vite com host `0.0.0.0:5173`;
  - isso é inadequado para consumo do navegador;
  - quando a URL aberta era a porta `5173`, o usuário via código/saída do Vite em vez da interface da aplicação;
  - a URL correta da aplicação é a do Laravel, não a do Vite.

### Correção aplicada no Vite

- Tipo: `Confirmado por execução local`
- Arquivo alterado: `backend/FolhaNova/vite.config.js`
- Ajustes feitos:
  - `host: '0.0.0.0'`
  - `port: 5173`
  - `strictPort: true`
  - `origin: 'http://127.0.0.1:5173'`
  - `hmr.host: '127.0.0.1'`

### Resultado técnico após a correção

- Tipo: `Confirmado por execução local`
- Validações obtidas:
  - `http://127.0.0.1:8000/login` respondeu `200 OK`;
  - `http://127.0.0.1:5173/@vite/client` respondeu conteúdo do Vite;
  - `http://127.0.0.1:5173/resources/js/app.js` respondeu o bundle esperado.

### Incidente adicional de acesso Windows ⇄ WSL

- Tipo: `Confirmado por execução local`
- Sintoma observado:
  - a aplicação respondia dentro do WSL, mas o navegador no Windows não conseguia acessar `localhost:8000` ou `127.0.0.1:8000` de forma confiável;
  - no Opera GX o usuário relatou `404`, enquanto em verificações de shell também houve momentos de falha de conexão.
- Diagnóstico confirmado:
  - o Laravel ficou acessível de dentro do WSL em `127.0.0.1:8000`;
  - do Windows, o acesso funcional foi obtido pelo IP do Ubuntu no WSL, por exemplo `http://172.25.248.69:8000/login`;
  - isso indica um problema de ponte/encaminhamento `Windows -> localhost do WSL`, e não da rota `/login` em si.
- Estado:
  - workaround funcional identificado via IP do WSL;
  - correção definitiva de `localhost` ainda pendente.

### Observação importante sobre a UX do problema

- Tipo: `Inferência`
- Interpretação provável:
  - parte da confusão visual veio de abrir a porta `5173` diretamente;
  - parte veio da inconsistência do launcher local para manter backend e Vite vivos ao mesmo tempo;
  - isso pode ter passado a sensação de que “o frontend sumiu”, quando o problema real era o vínculo entre Laravel, Vite e a URL aberta.

## Documentação criada/ajustada em 19/04/2026

### Guia de ambiente WSL

- Tipo: `Confirmado por execução local`
- Arquivo: `docs/obsidian/07-Ambiente-WSL-Ubuntu.md`
- O que mudou:
  - o guia foi reescrito para ficar operacional;
  - passou a incluir fluxo de subida local;
  - passou a registrar credenciais locais de desenvolvimento;
  - ganhou instruções para Laravel e Vite.

### Script de inicialização local

- Tipo: `Confirmado por execução local`
- Arquivo: `backend/FolhaNova/scripts/start-local-wsl.ps1`
- Propósito:
  - automatizar a abertura do backend Laravel e do frontend Vite pelo Windows/WSL.
- Estado:
  - útil como atalho;
  - ainda precisa de estabilização para manter os serviços vivos de forma consistente em todos os cenários.

### Conta local de desenvolvimento

- Tipo: `Confirmado por execução local`
- Origem: `php artisan db:seed`
- Credenciais registradas:
  - `test@example.com`
  - `password`

### Incidente adicional de autenticação no banco local real

- Tipo: `Confirmado por execução local`
- Sintoma observado:
  - a tela de login passou a abrir corretamente, mas o usuário não conseguia concluir a autenticação no navegador.
- Diagnóstico confirmado:
  - o banco SQLite local em uso no momento estava com `users = 0`;
  - o seeder padrão prevê `test@example.com`, mas esse usuário não existia no banco atual;
  - os testes de autenticação continuavam passando porque criam usuários efêmeros em banco de teste isolado.
- Leitura:
  - havia uma diferença entre “ambiente de teste automatizado” e “banco local real usado pelo navegador”.

### Correção do usuário local de autenticação

- Tipo: `Confirmado por execução local`
- Ação aplicada:
  - criação do script `backend/FolhaNova/scripts/ensure_local_login.php`;
  - execução do script para garantir `test@example.com` no banco SQLite local.
- Evidência:
  - retorno do script com `USER_ID=1` e `TOTAL_USERS=1`;
  - `php artisan db:show --counts` passou a indicar `users = 1`.

## Estado atual resumido

- Tipo: `Confirmado por execução local`
- O projeto está em transição consolidada para Laravel 11 + Livewire 3 + Tailwind 4 + DaisyUI.
- A documentação estratégica está relativamente madura.
- O ambiente local já sobe componentes importantes, mas ainda apresenta instabilidade operacional no launcher e na percepção visual do frontend.
- O próximo foco recomendado é estabilizar a tela de login em execução real no navegador, com backend e Vite presos de forma previsível.

## Próximos passos sugeridos

1. Confirmar exatamente qual URL está sendo aberta quando a interface “some”.
2. Padronizar um fluxo único de subida local:
   `backend` em `127.0.0.1:8000` e `Vite` em `127.0.0.1:5173`.
3. Validar no navegador a tela de login com DevTools aberto para detectar erro de asset, CORS ou HMR.
4. Corrigir definitivamente o launcher local, ou substituí-lo por um script mais simples e determinístico.
5. Continuar registrando qualquer incidente novo neste arquivo para manter a linha do tempo viva.
