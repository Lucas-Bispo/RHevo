# ⚡ FolhaNova - Performance Master Prompt & Optimization Bible

**Versão:** 1.0 (19 de abril de 2026)  
**Projeto:** FolhaNova – Sistema Moderno de Folha de Pagamento + Gestão de Servidores  
**Objetivo:** Garantir que **todo o código gerado** seja otimizado para alta performance, escalabilidade e baixa latência, mesmo com milhares de servidores por prefeitura e múltiplos tenants simultâneos.

**Este documento é de consulta OBRIGATÓRIA.**  
Sempre que eu pedir qualquer módulo, funcionalidade, migration, controller, query ou alteração, você **deve** consultar este arquivo antes de gerar código e aplicar todas as regras de performance abaixo.

---

## 1. Visão Geral de Performance do Projeto

- **Criticidade:** Sistema de Folha de Pagamento → picos de uso no fechamento da folha (final do mês), cálculo mensal de 1.000~10.000 servidores por prefeitura e envio simultâneo de eventos eSocial.
- **Metas de Performance (2026):**
  - Tempo de carregamento de qualquer tela: **< 800ms** (ideal < 400ms)
  - Cálculo Mensal da Folha: **< 8 segundos** para 5.000 servidores
  - Geração e envio de XML eSocial (S-1202): **< 2 segundos** por lote de 1.000 registros
  - Listagens com paginação: **< 300ms** mesmo com filtros complexos
  - Dashboard inicial: **< 600ms**
  - Suportar **mínimo 50 tenants simultâneos** sem degradação

---

## 2. Stack de Performance (obrigatória)

| Camada              | Tecnologia / Ferramenta                          | Objetivo |
|---------------------|--------------------------------------------------|----------|
| Cache               | **Redis** (predis ou phpredis)                   | Cache de queries, configurações, relatórios |
| Queue               | Laravel Horizon + Redis                          | Cálculo da folha, envio eSocial, relatórios pesados |
| Indexing            | MySQL 8 com índices compostos + FULLTEXT quando necessário | tenant_id + colunas de busca |
| ORM                 | Eloquent com eager loading + Query Builder otimizado | Evitar N+1 |
| Frontend            | Livewire 3 com defer, lazy e polling inteligente | Reduzir requisições |
| Observabilidade     | Laravel Telescope (dev) + Laravel Pulse (prod)   | Monitorar queries lentas e bottlenecks |
| Otimização Laravel  | Octane (Swoole) opcional no futuro               | Alto tráfego |

**Pacotes obrigatórios para performance:**
- `spatie/laravel-query-builder`
- `barryvdh/laravel-debugbar` (apenas dev)
- `laravel/horizon`
- `laravel/pulse`
- `predis/predis`

---

## 3. Regras de Performance no Laravel 11 (OBRIGATÓRIAS em TODO código)

### Banco de Dados (MySQL)
- **Sempre** adicionar `tenant_id` como primeiro campo em índices compostos.
- Índices obrigatórios em todas as tabelas principais: `tenant_id`, `matricula`, `cpf`, `data_admissao`, `situacao`.
- Usar `whereHas` e `with()` para evitar N+1 queries.
- Paginação sempre com `->paginate(25)` + cursor pagination quando possível.
- Queries pesadas (cálculo da folha, relatórios) **nunca** no request principal → mover para Job/Queue.

### Caching
- Usar `Cache::remember()` com TTL inteligente (5min ~ 24h dependendo do dado).
- Cache de configurações da prefeitura, rubricas, permissões e menus.
- Cache de resultados de relatórios mensais.
- Tags de cache por tenant (`Cache::tags(['tenant:'.tenant()->id])`).

### Queues & Jobs
- Todo cálculo de folha, geração de XML eSocial, relatórios grandes **deve** ser um Job.
- Usar `ShouldQueue` + `dispatchAfterResponse()` quando aplicável.
- Configurar Horizon com Redis + supervisor.
- Batch processing para envio em lote de eventos eSocial.

### Livewire & Frontend
- Usar `defer` em ações pesadas.
- `wire:loading` + skeletons.
- Lazy loading de componentes.
- Evitar re-renders desnecessários com `wire:key`.
- Polling apenas quando realmente necessário (ex: status de cálculo).

### Multi-Tenancy
- Global Scope `tenant_id` otimizado (indexado).
- Cache de tenant separado.
- Queries sempre filtradas por tenant (nunca full scan).

### Código Geral
- Controllers finos → Actions/Services.
- Evitar loops dentro de queries.
- Usar `DB::transaction()` apenas quando necessário e com o menor escopo possível.
- Lazy collections (`->lazy()`) para grandes volumes.
- Evitar `->get()` desnecessário → usar `->cursor()` ou `->chunk(1000)`.

---

## 4. Regras para a IA (Codex / Cursor / Claude)

**Sempre que gerar código, você deve:**

1. Consultar este documento inteiro antes de responder.
2. Aplicar todas as otimizações listadas acima.
3. Incluir comentários de performance em PHPDoc (`// PERFORMANCE: ...`).
4. Usar eager loading, caching e queues quando aplicável.
5. Evitar N+1, full table scans e queries pesadas em tempo real.
6. Atualizar `docs/PERFORMANCE.md` sempre que adicionar funcionalidade crítica.
7. No final de cada resposta, incluir um **Checklist de Performance** com ✓ ou ✗.

**Exemplo de checklist no final da resposta:**
```markdown
### ✅ Checklist de Performance Aplicada
- [✓] Índices compostos com tenant_id
- [✓] Eager loading (`with()`) para evitar N+1
- [✓] Job/Queue para cálculo ou eSocial
- [✓] Cache Redis implementado
- [✓] Paginação otimizada
- [ ] Lazy loading no Livewire (pendente)