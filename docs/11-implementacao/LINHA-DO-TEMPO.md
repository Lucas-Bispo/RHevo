# FolhaNova - Linha do Tempo
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

### 19/04/2026 - 16:26 - Correção do Botão Entrar e Performance do Login

**Ação realizada:**  
- Corrigido o botão principal da página de login para iniciar em estado normal e exibir `Entrando...` apenas durante a submissão real do formulário.
- Adicionado controle explícito de loading no componente Livewire e reduzidas sincronizações desnecessárias com `wire:model.defer`.
- Aplicado um primeiro passe de otimização visual na tela de login, com animações mais leves, blur reduzido, suporte a `prefers-reduced-motion` e documentação específica de performance.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/05-performance/PERFORMANCE-LOGIN.md`
- `docs/05-performance/README.md`
- `docs/README.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- O estado de loading foi mantido com `wire:loading` para feedback imediato no clique e reforçado com `$isLoading` no componente para previsibilidade do fluxo.
- O spinner de loading passou a ficar oculto por padrão para eliminar o falso estado inicial de carregamento.
- As otimizações priorizaram redução de trabalho no frontend sem descaracterizar a identidade visual da tela.

**Status:** Concluído ✅

### 19/04/2026 - 15:34 - Página de Login V2

**Ação realizada:**  
- Refatorado o layout da página de login para uma versão mais organizada, com fundo atmosférico e ícones 3D flutuantes de baixa competição visual.
- Mantido o formulário fixo e centralizado na área principal do card, com foco em legibilidade e destaque visual.
- Ajustados textos, link de contato com administrador e hierarquia visual do módulo de autenticação.

**Arquivos criados / alterados:**  
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/app/Livewire/Forms/LoginForm.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões técnicas:**  
- Removida a cena mais carregada da versão anterior para reduzir ruído visual.
- Os ícones 3D agora flutuam como nuvens com opacidade baixa e animação lenta.
- O card foi mantido estático para reforçar previsibilidade, acessibilidade e foco no login.
- A validação do campo principal foi flexibilizada para acompanhar o rótulo genérico de usuário na interface.

**Status:** Concluído ✅

### 19 de abril de 2026 - 15:20 - Página de Login

**Ação realizada:**
- Implementada uma nova página de login em Livewire 3 com foco visual em gestão pública, rede colaborativa, glassmorphism e efeitos 3D em CSS.
- Substituído o apontamento da rota de login para o novo componente de classe `App\Livewire\Auth\Login`.
- Criado o registro oficial da linha do tempo da implementação para documentar o módulo atual.

**Arquivos criados/alterados:**
- `backend/FolhaNova/routes/auth.php`
- `backend/FolhaNova/app/Livewire/Auth/Login.php`
- `backend/FolhaNova/resources/views/components/layouts/auth-login.blade.php`
- `backend/FolhaNova/resources/views/livewire/auth/login.blade.php`
- `backend/FolhaNova/resources/css/app.css`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Decisões de design:**
- Cena lateral construída com CSS 3D puro para preservar performance e evitar dependência extra.
- Card de login com glassmorphism, profundidade, glow institucional e botões com efeito tridimensional.
- Mantido o fluxo de autenticação do formulário existente para reaproveitar rate limiting e comportamento já validado.

**Status:** Concluído ✅
