# 🔧 FolhaNova - Prompt Específico: Correção do Botão "ENTRAR" + Análise de Performance

**Versão:** 1.0 (19 de abril de 2026)  
**Módulo atual:** Página de Login  
**Problema principal:** O botão "ENTRAR" está com estado de loading ativo por padrão (mostra "ENTRANDO..." e o spinner mesmo sem ter clicado).

### Objetivo
Corrigir o botão para que ele fique em estado normal ("ENTRAR") até o momento em que o usuário realmente clicar.  
Além disso, identificar e começar a tratar a lentidão geral da aplicação (carregamento da página de login está lento).

---

## 1. Correção do Botão "ENTRAR"

O botão deve ter **dois estados claros**:

- **Estado Normal (padrão):**
  - Texto: **ENTRAR**
  - Gradiente bonito (azul-turquesa para azul)
  - Sem spinner
  - Cursor pointer

- **Estado de Loading (somente após clique):**
  - Texto: **ENTRANDO...**
  - Ícone de spinner (loading circle)
  - Desabilitado (disabled)
  - Mesma aparência visual, mas com opacidade ligeiramente reduzida ou efeito sutil

**Requisitos técnicos:**
- Usar Livewire para controlar o estado (`$isLoading`).
- O botão **não pode** iniciar a página já no estado de loading.
- Ao clicar, disparar a ação de login e mudar para estado de loading.
- Se der erro, voltar ao estado normal.
- Manter o design bonito com gradiente, mas sem bugs visuais.

---

## 2. Análise e Melhoria Inicial de Performance

A aplicação está lenta para carregar a página de login.  
No mesmo prompt, o Codex deve:

- Identificar possíveis causas de lentidão na página de login (imagens pesadas, animações 3D mal otimizadas, queries desnecessárias, Livewire carregando demais, etc.).
- Aplicar otimizações imediatas na página de login:
  - Lazy loading onde possível
  - Reduzir peso das animações 3D (usar CSS puro ao invés de bibliotecas pesadas)
  - Otimizar o carregamento do Livewire component
  - Remover códigos não utilizados
  - Usar `defer` e `wire:loading` de forma inteligente

---

## 3. Criação do Arquivo de Performance

Além da correção do botão, crie o seguinte arquivo:

- Caminho: `docs/05-performance/PERFORMANCE-LOGIN.md`
- Conteúdo inicial deve incluir:
  - Diagnóstico atual da lentidão na página de login
  - Lista de otimizações já aplicadas
  - Próximas ações de performance (para trabalharmos mais para frente)
  - Métricas sugeridas (tempo de carregamento alvo: < 800ms)

Este arquivo servirá como base para melhorarmos a performance da aplicação de forma contínua.

---

## 4. Fluxo de Trabalho OBRIGATÓRIO

Siga **rigorosamente** o arquivo `FOLHANOVA-WORKFLOW.md`:

1. Ler todos os arquivos MD relevantes (especialmente PERFORMANCE-BIBLE.md e BUG-PREVENTION-BIBLE.md)
2. Criar/atualizar task no `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
3. Executar a correção do botão + otimizações de performance
4. Registrar tudo na `docs/11-implementacao/LINHA-DO-TEMPO.md`
5. Fazer commit com mensagem clara (ex: `fix(login): corrige estado inicial do botão entrar`)
6. Mostrar o código atualizado do botão e do componente Livewire

---

### ✅ Checklist Final

```markdown
### ✅ Checklist - Correção do Botão e Performance

- [ ] Botão "ENTRAR" inicia no estado normal (sem loading)
- [ ] Estado de loading aparece apenas após clique
- [ ] Botão volta ao normal em caso de erro
- [ ] Otimizações de performance aplicadas na página de login
- [ ] Arquivo `docs/05-performance/PERFORMANCE-LOGIN.md` criado
- [ ] Task atualizada no backlog
- [ ] Registro completo na LINHA-DO-TEMPO.md
- [ ] Commit realizado
```

**Agora execute este prompt seguindo o fluxo completo do workflow.**
```

---

**Como usar:**

1. Salve o prompt acima.
2. No Codex, envie primeiro:

> **Consulte o arquivo FOLHANOVA-WORKFLOW.md como referência absoluta e siga o fluxo completo.**

3. Depois cole todo o prompt do botão e diga:  
   **Execute o prompt de correção do botão conforme FOLHANOVA-LOGIN-BOTAO-FIX.md**

---

Quer que eu ajuste algo antes de você colar?  
Por exemplo:
- Deixar o botão mais simples ainda?
- Adicionar debounce no formulário?
- Focar mais pesado na performance logo agora?

Me diga se quer alguma mudança e eu refino o prompt! 🚀
