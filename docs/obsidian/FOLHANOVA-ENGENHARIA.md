```markdown
# ⚙️ FolhaNova - Software Engineering Master Prompt & Design Patterns Bible

**Versão:** 1.0 (19 de abril de 2026)  
**Projeto:** FolhaNova – Sistema Moderno de Folha de Pagamento + Gestão de Servidores  
**Objetivo:** Garantir que **todo o código gerado** siga as melhores práticas de Engenharia de Software 2026, Clean Architecture, SOLID, Design Patterns recomendados e padrões modernos do Laravel.

**Este documento é de consulta OBRIGATÓRIA.**  
Sempre que eu pedir qualquer módulo, funcionalidade, classe, migration ou alteração, você **deve** consultar este arquivo antes de gerar código e aplicar todas as regras e padrões abaixo.

---

## 1. Princípios Fundamentais de Engenharia de Software

- **SOLID** – Aplicar rigorosamente em todas as classes
- **Clean Architecture** (camadas bem definidas)
- **Domain-Driven Design (DDD) leve** (focado em domínios do negócio: Pessoas, Folha, eSocial, Relatórios, etc.)
- **KISS + YAGNI + DRY**
- **Código legível, testável e manutenível**
- **Separação clara de responsabilidades**

---

## 2. Arquitetura do Projeto (obrigatória)

O projeto deve seguir esta estrutura de pastas (Clean Architecture + Laravel):

```bash
app/
├── Domain/                  # Domínios do negócio (Pessoas, Folha, eSocial, etc.)
│   ├── Pessoa/
│   ├── Folha/
│   ├── Esocial/
│   └── ...
├── Application/             # Casos de uso / Actions
│   ├── Actions/
│   ├── DTOs/
│   └── Services/
├── Infrastructure/          # Camada técnica
│   ├── Persistence/         # Repositories, Migrations, Models
│   ├── Providers/
│   └── External/            # Integrações (eSocial, PDF, etc.)
├── Presentation/            # HTTP Layer
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Livewire/
│   │   ├── Requests/
│   │   └── Resources/
│   └── Policies/
├── Support/                 # Helpers, Traits, Enums
└── ...
```

**Regras de pastas:**
- Models ficam em `Infrastructure/Persistence/Models`
- Repositories em `Infrastructure/Persistence/Repositories`
- Actions (casos de uso) em `Application/Actions`
- DTOs em `Application/DTOs`
- Controllers e Livewire em `Presentation/Http`

---

## 3. Melhores Padrões de Projeto (Design Patterns) – Use estes

| Padrão                  | Onde aplicar no FolhaNova                              | Exemplo |
|-------------------------|--------------------------------------------------------|---------|
| **Repository Pattern**  | Todas as operações de banco (CRUD)                     | `PessoaRepository` |
| **Action / Use Case**   | Lógica de negócio complexa (ex: CalcularFolhaAction)  | `CalcularFolhaMensalAction` |
| **Service Pattern**     | Serviços reutilizáveis (ex: EsocialService)            | `GerarXmlS2200Service` |
| **DTO (Data Transfer Object)** | Transferência de dados entre camadas               | `PessoaDTO`, `EventoEsocialDTO` |
| **Policy**              | Autorização (Laravel Gates/Policies)                   | `PessoaPolicy` |
| **Form Request**        | Validação de entrada                                   | `StorePessoaRequest` |
| **Factory**             | Criação de objetos complexos (ex: XML eSocial)        | `EventoEsocialFactory` |
| **Observer / Event**    | Auditoria, notificações, sincronização eSocial        | `PessoaAtualizadaEvent` |
| **Strategy**            | Cálculo de diferentes regimes (Efetivo, Comissionado) | `RegimeCalculoStrategy` |
| **Decorator**           | Adicionar comportamentos (ex: cache em repositórios)  | `CachedPessoaRepository` |

**Nunca use:**
- Fat Models
- Controllers gordos
- Lógica de negócio dentro de controllers ou Livewire components

---

## 4. Melhores Práticas de Engenharia (obrigatórias)

### Código
- PSR-12 + Laravel Pint
- PHPDoc completo em todas as classes, métodos e propriedades
- Tipagem forte (PHP 8.3+ typed properties, return types)
- Controllers **finos** (máximo 5-7 linhas)
- Actions recebem DTOs e retornam DTOs ou Responses
- Injeção de dependência via constructor (nunca `app()` ou `new`)
- Uso de Enums, Value Objects e Collections fortes

### Testes
- Pest PHP (feature + unit)
- Testar **todas** as Actions e Services
- Testes de integração para eSocial (mock do webservice)
- Cobertura mínima 80% nas camadas críticas

### Git & Versionamento
- Conventional Commits (`feat:`, `fix:`, `refactor:`, `docs:`, etc.)
- Branching: `main` (produção), `develop`, feature branches (`feature/cadastro-pessoa`)
- Pull Requests com descrição + checklist de qualidade

### Documentação
- Atualizar `docs/ARQUITETURA.md` sempre que criar novo domínio
- PHPDoc + comentários `// ENGENHARIA: ...` quando usar padrão específico

### Segurança & Performance
- Sempre cruzar com os arquivos `FOLHANOVA-CYBERSECURITY.md` e `FOLHANOVA-PERFORMANCE.md`

---

## 5. Regras para a IA (Codex / Cursor / Claude)

**Sempre que gerar código, você deve:**

1. Consultar **este documento + os outros dois** (Cybersecurity e Performance) antes de responder.
2. Usar a estrutura de pastas Clean Architecture.
3. Aplicar os Design Patterns listados acima.
4. Incluir comentários claros:
   ```php
   // ENGENHARIA: Repository Pattern aplicado
   // ENGENHARIA: Action Pattern (caso de uso isolado)
   // PERFORMANCE: Eager loading usado
   // SECURITY: Policy aplicada
   ```
5. Gerar código limpo, legível e com tipagem forte.
6. Atualizar a documentação de arquitetura quando necessário.
7. No final de cada resposta, incluir um **Checklist de Engenharia de Software** com ✓ ou ✗.

**Exemplo de checklist no final da resposta:**
```markdown
### ✅ Checklist de Engenharia de Software Aplicada
- [✓] Clean Architecture (pastas corretas)
- [✓] Repository Pattern usado
- [✓] Action Pattern para lógica de negócio
- [✓] DTOs para transferência de dados
- [✓] SOLID respeitado
- [✓] PHPDoc completo
- [ ] Testes Pest (pendente)
```

