# FolhaNova

Sistema web em desenvolvimento para folha de pagamento e gestao de servidores de prefeituras brasileiras, com foco em operacao moderna, rastreabilidade, seguranca e compatibilidade progressiva com o eSocial.

## Visao geral

O FolhaNova esta sendo construido para substituir fluxos legados de RH e folha por uma base mais organizada, auditavel e preparada para evolucao modular. O projeto combina:

- operacao aderente ao contexto de prefeituras brasileiras;
- arquitetura web moderna com Laravel e Livewire;
- documentacao tecnica centralizada em `docs/`;
- prioridade para compatibilidade com ambiente Linux Ubuntu 24.04.

## Ambiente de desenvolvimento

O desenvolvimento acontece em uma maquina com:

- Windows 11 como sistema operacional host;
- Visual Studio Code como editor principal;
- repositorio acessado localmente pelo desenvolvedor no Windows.

O papel do Windows neste projeto e hospedar o workspace e a ferramenta de edicao. O Windows **nao** deve ser tratado como ambiente principal de execucao da aplicacao.

## Ambiente de execucao local

O ambiente valido para rodar a aplicacao localmente e:

- WSL;
- Linux Ubuntu 24.04;
- terminal Linux para comandos, scripts e validacoes do projeto.

Em outras palavras:

- o codigo pode ser editado no VS Code;
- a aplicacao deve ser executada, testada e validada no Ubuntu 24.04 via WSL;
- exemplos de comandos do projeto devem priorizar sempre o shell Linux.

Esse ambiente local em Linux e a referencia principal para comportamento da aplicacao durante o desenvolvimento.

## Ambiente de producao previsto

O ambiente futuro de producao sera em nuvem, tambem baseado em:

- Linux Ubuntu 24.04;
- servidor Linux como ambiente oficial de execucao;
- stack alinhada ao comportamento validado no WSL.

Isso significa que o WSL Ubuntu 24.04 nao e apenas uma conveniencia local: ele existe para aproximar o desenvolvimento do ambiente real onde a aplicacao sera publicada.

## Por que essa padronizacao existe

Padronizar a execucao em Ubuntu 24.04, mesmo com desenvolvimento em Windows 11, ajuda a:

- reduzir diferencas entre desenvolvimento e producao;
- evitar erros causados por comportamento diferente entre Windows e Linux;
- melhorar a consistencia de scripts, comandos e dependencias;
- facilitar troubleshooting, automacao e deploy;
- criar uma base mais confiavel para testes tecnicos e validacoes de performance.

## Instrucoes gerais

Ao trabalhar neste projeto:

- prefira sempre executar comandos no Ubuntu 24.04 via WSL;
- trate o Linux como ambiente local oficial da aplicacao;
- documente exemplos e procedimentos pensando primeiro no terminal Linux;
- evite assumir execucao nativa no Windows para rotinas da aplicacao;
- valide mudancas importantes no ambiente WSL antes de considerar a tarefa concluida.

## Organizacao do projeto

As principais referencias documentais ficam em `docs/`:

- `docs/README.md` para o indice geral;
- `docs/01-visao-projeto/` para visao do produto;
- `docs/05-performance/` para diagnosticos e metas de performance;
- `docs/10-tarefas-backlog/` para backlog;
- `docs/11-implementacao/` para linha do tempo e progresso.

O backend principal da aplicacao esta em:

- `backend/FolhaNova`

## Observacoes importantes

- Windows 11 atua como sistema hospedeiro do desenvolvedor.
- Visual Studio Code atua como editor de codigo.
- Ubuntu 24.04 no WSL e o ambiente principal para executar a aplicacao localmente.
- O ambiente final previsto para producao tambem sera Linux Ubuntu 24.04 em nuvem.
- Sempre que houver duvida sobre qual ambiente considerar como referencia, use o Ubuntu 24.04.
