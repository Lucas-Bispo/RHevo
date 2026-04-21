# FolhaNova - Workflow Oficial de Desenvolvimento

**Versao:** 2.0 (20 de abril de 2026)  
**Objetivo:** definir o fluxo oficial para evoluir o projeto com seguranca, rastreabilidade, estabilidade e aderencia aos planos vigentes.

Este documento e a referencia principal para a forma de trabalhar no projeto. Ele deve ser seguido antes de qualquer alteracao de codigo, configuracao, asset, teste ou documentacao relevante.

---

## 1. Missao principal

Continuar o desenvolvimento do FolhaNova sem quebrar a aplicacao, sem alterar no escuro e sem fugir dos planos e restricoes ja definidos no projeto.

---

## 2. Principios obrigatorios

1. Ler antes de agir.
2. Consultar primeiro os arquivos `.md` relacionados ao tema.
3. Consultar PDFs do projeto quando a tarefa depender de regra funcional, leiaute oficial, arquitetura, integracao ou conformidade.
4. Nunca implementar no escuro.
5. Preferir mudancas pequenas, seguras, incrementais e reversiveis.
6. Nao quebrar login, frontend, backend, banco, testes, rotas, layout ou fluxo existente por pressa.
7. Sempre registrar o que foi feito.
8. Sempre explicar o que foi alterado, por que foi alterado e como validar.
9. Preservar o padrao visual, tecnico e arquitetural do projeto.
10. Priorizar estabilidade antes de evolucao funcional.

---

## 3. Regras de ambiente

- sistema hospedeiro: `Windows 11`
- editor principal: `VS Code`
- ambiente oficial local de execucao: `WSL Ubuntu 24.04`
- ambiente futuro de producao: `Linux Ubuntu 24.04` em nuvem
- nao usar `XAMPP`
- nao assumir ambiente `Apache/PHP/MySQL` nativo do Windows
- sempre priorizar comandos, paths, testes e validacoes dentro do `WSL Ubuntu 24.04`

---

## 4. Fonte de verdade e precedencia entre documentos

Quando houver duvida sobre o que fazer, aplicar esta ordem:

1. estabilidade da aplicacao e incidentes ativos
2. este workflow
3. `docs/workflow/recuperacao-e-padroes-de-ambiente.md`
4. planos de produto em `docs/produto/`
5. plano de execucao eSocial em `docs/esocial/`
6. backlog e linha do tempo

### Regra para divergencia entre planos

Se `docs/produto/` e `docs/esocial/` apontarem proximas etapas diferentes:

- nao escolher no impulso;
- registrar a divergencia;
- alinhar os `.md` primeiro;
- so depois iniciar implementacao de codigo.

### Regra pratica de decisao

- `docs/produto/plano-de-implementacao.md` define a ordem macro de evolucao do sistema;
- `docs/produto/priorizacao.md` resume a frente ativa;
- `docs/esocial/plano-implementacao.md` detalha a sequencia tecnica dentro da trilha eSocial escolhida;
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md` registra a tarefa concreta em andamento;
- `docs/11-implementacao/LINHA-DO-TEMPO.md` registra o que de fato foi executado.

---

## 5. Fluxo obrigatorio antes de qualquer implementacao

### Etapa 1 - Leitura e contexto

Antes de alterar qualquer coisa:

- localizar e ler os `.md` relevantes;
- consultar PDFs relevantes, se existirem;
- identificar restricoes de arquitetura, negocio, ambiente e fluxo;
- entender o estado atual do modulo afetado.

Pastas que devem ser verificadas primeiro, conforme o tema:

- `docs/`
- `docs/esocial/`
- `docs/produto/`
- `docs/frontend/`
- `docs/workflow/`
- `docs/performance/`
- `docs/11-implementacao/`

Referencias-base recomendadas:

- `docs/04-ciberseguranca/CYBERSECURITY-BIBLE.md`
- `docs/05-performance/PERFORMANCE-BIBLE.md`
- `docs/06-engenharia-software/ENGENHARIA-BIBLE.md`
- `docs/07-bug-prevention/BUG-PREVENTION-BIBLE.md`
- `docs/09-project-organization/PROJECT-ORGANIZER.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`
- este arquivo

### Etapa 2 - Diagnostico antes da mudanca

Antes de modificar arquivos:

- identificar quais arquivos serao afetados;
- identificar impacto em frontend, backend, banco, rotas, testes e documentacao;
- apontar riscos;
- resumir o que foi entendido.

### Etapa 3 - Plano da alteracao

Antes de executar:

- descrever o plano em passos curtos;
- classificar a criticidade em baixa, media ou alta;
- apontar riscos e dependencias;
- escolher a solucao mais segura e menos destrutiva.

### Etapa 4 - Registro da task

Antes de codar:

- atualizar `docs/10-tarefas-backlog/BACKLOG-GERAL.md`;
- registrar a task com descricao, status, prioridade e arquivos envolvidos.

### Etapa 5 - Implementacao segura

Ao implementar:

- fazer alteracoes pontuais;
- evitar refatoracoes desnecessarias;
- nao reescrever arquivos grandes sem necessidade;
- nao mexer em banco, migration, seed, autenticacao, layout base, assets ou rotas sem necessidade real;
- manter compatibilidade com o que ja existe.

### Etapa 6 - Validacao

Depois de implementar:

- validar se a aplicacao continua funcionando;
- validar a tela ou fluxo afetado;
- validar login e navegacao principal quando aplicavel;
- validar regressao visual quando aplicavel;
- executar testes existentes quando fizer sentido;
- preferir validacao no `WSL Ubuntu 24.04`.

### Etapa 7 - Documentacao e registro

Depois de validar:

- atualizar a documentacao relevante;
- registrar a execucao em `docs/11-implementacao/LINHA-DO-TEMPO.md`;
- explicar objetivo, contexto, arquivos alterados, impacto, validacao e proximos passos.

### Etapa 8 - Commit

Ao final da entrega:

- fazer commit com `Conventional Commits`;
- evitar commits que misturem temas diferentes;
- nao versionar alteracoes sem conteudo real.

---

## 5.1 Regra de seguranca operacional

Nenhuma rodada de desenvolvimento deve ser considerada pronta se qualquer uma destas condicoes estiver aberta:

- login quebrado;
- build frontend quebrado;
- backend nao sobe no `WSL Ubuntu 24.04`;
- rota principal critica sem resposta;
- teste focado do modulo afetado falhando;
- incidente de ambiente sem registro.

Se uma dessas condicoes ocorrer:

- parar a evolucao funcional;
- registrar o incidente;
- restaurar previsibilidade do ambiente;
- validar novamente;
- so depois retomar a proxima microetapa.

---

## 5.2 Fluxo oficial para evoluir sem quebrar

Toda evolucao deve seguir o modelo `dividir para conquistar`.

### Tamanho maximo recomendado de uma rodada

- 1 tema funcional por vez;
- 1 microetapa por vez;
- poucos arquivos por rodada;
- 1 pacote coerente de teste;
- 1 commit por escopo.

### Exemplo de ordem segura

1. diagnostico
2. alteracao pequena
3. teste focado
4. validacao manual minima
5. documentacao
6. commit
7. proxima microetapa

### O que nao fazer

- misturar login, layout, backend, banco e nova feature na mesma rodada;
- alterar fluxo funcional sem rebuild e sem teste;
- seguir implementando com incidente aberto;
- usar ambiente paralelo fora do `WSL Ubuntu 24.04`;
- depender de estado manual nao documentado.

---

## 5.3 Gates obrigatorios antes de liberar uma rodada

Antes de considerar qualquer rodada segura para continuidade, validar no minimo:

### Gate 1 - Ambiente

- backend sobe no `WSL Ubuntu 24.04`;
- build frontend conclui com sucesso;
- assets finais sao servidos por `public/build` quando a rodada depender de build compilado.

### Gate 2 - Login e acesso

- `/login` responde `200`;
- usuario local de teste existe;
- autenticacao volta a funcionar;
- primeira tela autenticada abre sem regressao critica.

### Gate 3 - Modulo afetado

- rota principal do modulo abre;
- fluxo principal do modulo funciona;
- nao ha quebra visual relevante na tela alterada.

### Gate 4 - Testes

- teste focado do modulo afetado passa;
- se a rodada tocar autenticacao, navegacao ou eventos eSocial, executar tambem a suite adjacente mais sensata.

### Gate 5 - Registro

- backlog atualizado;
- linha do tempo atualizada;
- incidente ou decisao relevante documentados.

---

## 5.4 Ambientes de trabalho

Para evitar confusao entre desenvolvimento e operacao:

- `desenvolvimento`: microetapas pequenas com validacao focada;
- `homologacao local`: aplicacao reconstruida no `WSL Ubuntu 24.04`, com login funcional, build valido e dados minimos para teste manual;
- `producao futura`: ambiente Linux Ubuntu 24.04 em nuvem, com o mesmo fluxo de gates e validacoes adaptado ao deploy.

Nenhuma mudanca deve ser promovida de `desenvolvimento` para `homologacao local` sem passar pelos gates desta documentacao.

---

## 6. Formato de resposta esperado antes de implementar

Antes de qualquer mudanca, responder com:

1. entendimento da tarefa
2. documentacao consultada
3. arquivos potencialmente afetados
4. riscos identificados
5. plano de implementacao
6. forma de validacao
7. arquivo(s) Markdown que serao atualizados

---

## 7. Formato de entrega esperado depois de implementar

Depois de cada implementacao, responder com:

1. o que foi alterado
2. por que foi alterado
3. arquivos modificados
4. impacto da mudanca
5. como foi validado
6. o que foi documentado
7. proximo passo recomendado

---

## 8. Regra de ouro

Antes de codar:

- entender
- localizar
- ler
- analisar
- documentar o plano
- so depois alterar

---

## 9. Checklist final

```markdown
### Fluxo de Trabalho Executado

- [ ] Contexto e documentacao relevante lidos
- [ ] Riscos e impacto identificados antes da mudanca
- [ ] Task registrada ou atualizada no backlog
- [ ] Implementacao executada de forma incremental e segura
- [ ] Validacao realizada no modulo afetado
- [ ] Registro atualizado na linha do tempo
- [ ] Documentacao complementar atualizada
- [ ] Commit realizado com escopo coerente
```
