# Check-up da Aplicação

## Objetivo

Registrar o diagnóstico técnico da aplicação local para identificar por que o sistema não carregava corretamente após o login e organizar as próximas correções.

## Contexto do teste

- Ambiente: WSL Ubuntu 24.04
- URL local: `http://localhost:8088`
- Banco em uso no momento: SQLite local
- Conta de teste esperada: `test@example.com`

## Achados confirmados

### 1. Erro crítico no pós-login

Status: corrigido nesta rodada.

Sintoma:

- o login aceitava as credenciais;
- após autenticar, a aplicação quebrava ao abrir o dashboard.

Causa raiz:

- a view `resources/views/livewire/layout/navigation.blade.php` foi transformada em um wrapper de layout completo;
- essa view passou a depender de `{{ $slot }}`, mas ela é montada apenas como componente de navegação dentro do layout principal;
- por isso o Laravel gerava `Undefined variable $slot`.

Evidência técnica:

- erro registrado em `storage/logs/laravel.log`;
- stacktrace apontando explicitamente para `resources/views/livewire/layout/navigation.blade.php`.
- após a correção, os testes de autenticação e renderização do dashboard passaram.

### 2. Layout principal acoplado de forma incorreta

Status: corrigido nesta rodada.

Problema:

- a responsabilidade de renderizar cabeçalho, sidebar e conteúdo principal ficou espalhada entre `layouts/app.blade.php` e `livewire/layout/navigation.blade.php`.

Correção aplicada:

- `layouts/app.blade.php` voltou a ser o wrapper principal;
- `livewire/layout/navigation.blade.php` voltou a ser apenas a navegação/sidebar.

### 3. Configuração local ainda parcialmente em modo scaffold

Status: pendente.

Pontos observados:

- `.env` local usava `APP_NAME=Laravel` e locale `en` em parte da investigação;
- `.env` local ainda está em SQLite;
- a fundação documental já está em FolhaNova, mas o ambiente local ainda não foi totalmente alinhado.

### 4. Banco local funcional, mas provisório

Status: pendente.

Situação atual:

- o sistema roda com SQLite para validação inicial;
- migrations passam corretamente;
- MariaDB/MySQL ainda não foi provisionado neste ciclo.

### 5. Falha real de autenticação no ambiente local

Status: corrigido nesta rodada.

Sintoma:

- a tela de login abre;
- no navegador, a autenticação não conclui como esperado;
- as credenciais informadas anteriormente não funcionam no banco local atual.

Causa raiz confirmada:

- o banco SQLite local em uso pelo navegador está com `users = 0`;
- o `DatabaseSeeder` realmente prevê a criação de `test@example.com`;
- porém o seed não está presente no banco local atual;
- por isso o problema não era mais “a tela de login” e sim “não existe usuário para autenticar”.

Correção aplicada:

- foi criado um script utilitário local em `scripts/ensure_local_login.php`;
- o script executa `updateOrCreate` para garantir a conta `test@example.com`;
- após a execução, o banco local passou a ter `users = 1`.

Observação importante:

- os testes de autenticação continuam passando;
- isso acontece porque `AuthenticationTest` usa `RefreshDatabase` e cria usuários efêmeros no ambiente de teste;
- portanto esses testes não provam que o banco local real do navegador contém uma conta válida.

### 6. Testes automatizados ainda não migrados para Pest

Status: pendente.

Observação:

- o `projeto.md` define Pest como obrigatório;
- a base atual ainda permanece no setup padrão do Laravel 11 com PHPUnit.

## Checklist atual

- Login renderiza: OK
- Credenciais de teste no banco local real: OK
- Dashboard pós-login carrega: corrigido
- Build frontend: OK
- Migrations locais: OK
- Testes críticos de autenticação e navegação: OK
- Documentação base: OK
- Banco local contém usuário autenticável: OK
- MariaDB local: pendente
- Pest: pendente
- `.env` local alinhado com FolhaNova: pendente

## Próximas tarefas recomendadas

1. Alinhar `.env` local com `FolhaNova`, `pt_BR` e timezone correto.
2. Provisionar MariaDB/MySQL no WSL e migrar o ambiente local para ele.
3. Criar usuário admin real com perfil institucional.
4. Migrar a suíte de testes para Pest.
5. Iniciar o módulo de Cadastro de Servidor com base no `projeto.md`.

## Validação executada nesta rodada

- `php artisan optimize:clear`
- `npm run build`
- `php artisan test tests/Feature/Auth/AuthenticationTest.php tests/Feature/ExampleTest.php`

Resultado:

- 6 testes passaram
- 17 assertions passaram
