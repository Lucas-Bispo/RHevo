# Recuperacao e Padroes de Ambiente

## Resumo do incidente

Em `20/04/2026`, uma rodada recente de alteracoes no modulo de servidores ampliou o escopo funcional local com fluxos de alteracao cadastral, alteracao contratual, afastamento e desligamento. A aplicacao deixou de ficar em um estado previsivel para validacao local e passou a acumular mudancas de codigo, testes, bootstrap e artefatos indevidos de ambiente.

## O que quebrou

- rotas e telas do detalhe de servidor passaram a depender de fluxos ainda nao estabilizados;
- o bootstrap local foi ampliado com cargas artificiais demais em `scripts/ensure_local_login.php`;
- surgiram migrations, models, services, controllers, requests, views e testes novos fora do ultimo estado funcional conhecido;
- foram gerados artefatos invalidos dentro de `backend/FolhaNova/public/`, indicando contaminacao do ambiente local.

## Arquivos afetados

Escopo principal da reversao aplicada:

- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/app/Http/Requests/UpdateServidorRequest.php`
- `backend/FolhaNova/app/Models/Servidor.php`
- `backend/FolhaNova/app/Services/Servidores/AtualizarServidorService.php`
- `backend/FolhaNova/phpunit.xml`
- `backend/FolhaNova/resources/views/servidores/show.blade.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/scripts/ensure_local_login.php`
- `backend/FolhaNova/tests/Feature/ServidorDetailTest.php`
- `backend/FolhaNova/tests/TestCase.php`
- arquivos novos de `S-2205`, `S-2206`, `S-2230` e `S-2299` criados na rodada recente
- artefatos indevidos sob `backend/FolhaNova/public/`

## Estrategia de reversao aplicada

1. comparacao dos arquivos alterados com o estado versionado anterior;
2. restauracao dos arquivos existentes para o ultimo estado conhecido em `HEAD`;
3. remocao dos arquivos novos introduzidos pela rodada recente de historico funcional;
4. limpeza dos artefatos invalidos gerados em `public/`;
5. preservacao das demais alteracoes do repositorio fora do escopo direto da reversao.

## Validacoes executadas

- confirmacao de que a rota de login continua registrada na aplicacao;
- revisao das alteracoes de rotas, view de detalhe de servidor, requests, services e testes;
- tentativa de validacao no `WSL Ubuntu 24.04`.

## Estado final do sistema apos correcao

- o escopo recente de historico funcional foi revertido para o ultimo estado versionado;
- o bootstrap local voltou ao formato mais enxuto anterior;
- o projeto permaneceu sem tocar nas alteracoes fora do escopo direto da recuperacao;
- a validacao completa no `WSL Ubuntu 24.04` ainda depende de permissao operacional do ambiente.

## Padrao oficial de ambiente do projeto

- sistema hospedeiro: `Windows 11`
- editor: `VS Code`
- ambiente local oficial de execucao: `WSL Ubuntu 24.04`
- ambiente de referencia: `Linux Ubuntu 24.04`
- ambiente futuro de producao: `Linux Ubuntu 24.04` em nuvem

## Regra explicita: NAO USAR XAMPP

- nao usar `XAMPP`;
- nao orientar comandos baseados em `XAMPP`;
- nao assumir `Apache/PHP/MySQL` do Windows como ambiente padrao;
- sempre priorizar comandos, paths e execucao dentro do `WSL Ubuntu 24.04`.

## Workflow oficial daqui para frente

- subir backend e frontend a partir do `WSL Ubuntu 24.04`;
- validar `/login` e rotas principais no ambiente Linux local;
- registrar incidentes e reversoes antes de retomar qualquer feature;
- nao continuar desenvolvimento de novas trilhas enquanto o ambiente nao estiver estavel.
