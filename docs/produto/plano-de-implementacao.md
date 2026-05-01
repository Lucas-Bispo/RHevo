# Plano de Implementacao
**Atualizado em:** 01/05/2026

## Etapa concluida nesta rodada
- Mapeamento funcional do projeto.
- Organizacao da trilha de produto.
- Implementacao do fluxo inicial de admissao de servidor.
- Implementacao de detalhe e edicao de servidor.
- Implementacao inicial do modulo de lotacoes.
- Implementacao inicial dos modulos de cargos e funcoes.
- Implementacao inicial do modulo de parametros do orgao publico.
- Implementacao inicial do modulo de rubricas.
- Implementacao inicial do painel operacional de eventos eSocial.

## Etapa atual
- Consolidar a base estrutural do RH:
  - servidores com operacao inicial.
  - lotacoes com cadastro operacional.
  - cargos e funcoes com cadastro operacional.
  - parametros do orgao publico em operacao inicial.
  - rubricas com cadastro operacional.
  - eventos eSocial com leitura operacional.

## Proxima etapa recomendada
- Evoluir o modulo de parametros do orgao publico com regras mais profundas de `S-1000`.
- Evoluir rubricas com regras mais profundas de `S-1010`.
- Evoluir o painel de eventos com acoes de processamento e reprocessamento.
- Depois voltar ao historico funcional com a base estrutural mais completa.
- Deixar a integracao real com o governo para a ultima macroetapa, depois da consistencia local dos cadastros, eventos e fluxos operacionais.

## Regra de continuidade
- a ordem macro de evolucao do produto deve partir deste documento;
- quando `docs/esocial/plano-implementacao.md` sugerir um proximo evento diferente, isso deve ser tratado como detalhamento tecnico da trilha eSocial, nao como mudanca automatica da prioridade global do produto;
- qualquer troca de frente deve ser refletida antes em `docs/produto/priorizacao.md`, no backlog e na linha do tempo.

## Dependencias posteriores
- CRUD de lotacoes, cargos e funcoes.
- Parametros do orgao publico.
- Validacoes de negocio especificas por evento.
