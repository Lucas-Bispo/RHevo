# 🔄 FolhaNova - Complete Development Workflow Master Prompt

**Versão:** 1.0 (19 de abril de 2026)  
**Objetivo:** Este é o **prompt mestre de fluxo de trabalho**.  
Ele define **exatamente** como a IA deve se comportar em **todas as tarefas**, sem exceção.

**Este documento tem prioridade máxima.**  
Sempre que receber qualquer pedido (mesmo que seja pequeno), você **DEVE** seguir o fluxo abaixo na ordem exata.

---

## 1. Regra de Ouro (obrigatória)

**Antes de fazer QUALQUER coisa** (criar código, alterar arquivo, gerar componente, etc.), você deve:

1. Ler e atualizar todos os arquivos de documentação relevantes.
2. Criar ou atualizar as tasks no backlog.
3. Executar a tarefa.
4. Sempre usar o WSL linux ubuntu 24.04
5. Realizar testes de performace e sempre encotrar a melhor maneira de fazer e regiistrar na linha do tempo confome . - `docs/05-performance/`
6. Registrar na linha do tempo.
7. Fazer commit no Git.

---

## 2. Fluxo Completo de Desenvolvimento (passo a passo obrigatório)

Sempre que eu te der uma tarefa ou prompt, siga **exatamente** esta sequência:

### Passo 0 – Leitura de Documentação (sempre primeiro)
- Leia **todos** os seguintes arquivos antes de começar:
  - `docs/01-visao-projeto/README.md`
  - `docs/04-ciberseguranca/CYBERSECURITY-BIBLE.md`
  - `docs/05-performance/PERFORMANCE-BIBLE.md`
  - `docs/06-engenharia-software/ENGENHARIA-BIBLE.md`
  - `docs/07-bug-prevention/BUG-PREVENTION-BIBLE.md`
  - `docs/09-project-organization/PROJECT-ORGANIZER.md`
  - `docs/11-implementacao/LINHA-DO-TEMPO.md`
  - Este arquivo (`FOLHANOVA-WORKFLOW.md`)

### Passo 1 – Criação / Atualização de Tasks
- Vá para a pasta `docs/10-tarefas-backlog/`
- Atualize o arquivo `BACKLOG-GERAL.md`
- Crie uma nova task no formato:

```markdown
### [NOME DA TASK] - [DATA]

**Descrição:**  
O que foi pedido.

**Status:** Em andamento / Concluído  
**Prioridade:** Alta / Média / Baixa  
**Arquivos envolvidos:** (liste aqui)
```

### Passo 2 – Execução da Tarefa
- Execute exatamente o que foi pedido.
- Siga todas as regras das Bibles (segurança, performance, engenharia, bug prevention, 3D, etc.).
- Use Clean Architecture, Livewire, etc.

### Passo 3 – Registro na Linha do Tempo
- Atualize o arquivo `docs/11-implementacao/LINHA-DO-TEMPO.md`
- Adicione uma entrada **no topo** com o formato:

```markdown
### [DD/MM/AAAA] - [HH:MM] - [Nome da Task]

**Ação realizada:**  
Descrição clara do que foi feito.

**Arquivos criados / alterados:**  
- `caminho/do/arquivo.php`

**Decisões técnicas:**  
(breve explicação se necessário)

**Status:** Concluído ✅
```

### Passo 4 – Commit no Git
- Faça um commit usando **Conventional Commits**:

```bash
git add .
git commit -m "feat(login): implementa página de login com ícones 3D"
# ou fix:, refactor:, docs:, etc.
```

- Mostre o comando do commit na sua resposta.

### Passo 5 – Atualização Final
- Atualize qualquer outro arquivo de documentação que tenha sido afetado.
- Mostre um **Checklist de Conclusão** no final da resposta.

---

## 3. Checklist de Conclusão (obrigatório no final de toda resposta)

```markdown
### ✅ Fluxo de Trabalho Executado

- [ ] Todos os arquivos MD foram lidos e atualizados
- [ ] Task criada/atualizada no backlog
- [ ] Tarefa executada conforme solicitado
- [ ] Registro completo na LINHA-DO-TEMPO.md
- [ ] Commit realizado no Git
- [ ] Checklist de qualidade (Cybersecurity, Performance, etc.) aplicado
```

---

## 4. Regras Finais (nunca quebre)

- Este fluxo é **obrigatório** para **todo e qualquer prompt** que você receber.
- Mesmo que eu peça algo pequeno (ex: “só mudar a cor do botão”), você deve seguir todos os passos.
- Se eu pedir para pular algum passo, você deve avisar que o fluxo completo é obrigatório e perguntar se desejo continuar mesmo assim.
- Sempre mantenha os arquivos MD atualizados e consistentes.
- Nunca gere código sem antes ter criado a task e lido a documentação.

---

**Pronto para usar!**

Agora copie todo o conteúdo acima e salve como `FOLHANOVA-WORKFLOW.md`.

Depois, teste enviando para o Codex a seguinte mensagem:

> **Consulte o arquivo FOLHANOVA-WORKFLOW.md como referência absoluta e siga o fluxo completo de desenvolvimento antes de fazer qualquer coisa.**  
> Agora execute a próxima tarefa que eu te der seguindo exatamente este workflow.

Se quiser, posso ajustar o prompt (por exemplo, adicionar mais pastas ou mudar o formato da task). É só falar!

Quer que eu crie também um prompt para a próxima tarefa específica (ex: continuar a página de login) já usando esse novo workflow?
