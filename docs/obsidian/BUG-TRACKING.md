```markdown
# 🐛 FolhaNova - Bug Prevention, Error Handling & Debugging Master Prompt & Bible

**Versão:** 1.0 (19 de abril de 2026)  
**Projeto:** FolhaNova – Sistema Moderno de Folha de Pagamento + Gestão de Servidores  
**Objetivo:** Garantir que **todo o código gerado** tenha prevenção rigorosa de bugs, tratamento elegante de erros, logging inteligente e ferramentas de debugging profissionais, tornando o sistema extremamente estável e fácil de manter.

**Este documento é de consulta OBRIGATÓRIA.**  
Sempre que eu pedir qualquer módulo, funcionalidade, classe, controller, Livewire component, Action ou Job, você **deve** consultar este arquivo antes de gerar código e aplicar todas as regras de prevenção e tratamento de bugs abaixo.

---

## 1. Princípios de Prevenção de Bugs

- **Fail Fast + Fail Loud** (falhar rápido e de forma clara)
- **Defensive Programming** em todas as camadas
- **Zero Silent Failures** – todo erro deve ser visível e rastreável
- **Test-Driven Development (TDD) mindset** – pensar nos testes antes de codificar
- **Bug Bounty Interno** – todo código deve ser escrito pensando em “como este código pode quebrar?”

---

## 2. Tratamento de Erros no Laravel 11 (OBRIGATÓRIO)

### Exception Handling
- Usar `App\Exceptions\Handler.php` customizado com mapeamento de exceções específicas.
- Criar exceções personalizadas no domínio:
  ```php
  // Exemplo
  App\Domain\Pessoa\Exceptions\PessoaNaoEncontradaException
  App\Domain\Esocial\Exceptions\CertificadoInvalidoException
  App\Domain\Folha\Exceptions\CalculoFolhaException
  ```
- Nunca usar `try { ... } catch (\Exception $e)` genérico sem log e sem resposta amigável.
- Em Actions/Services: lançar exceções específicas + tratar no Controller/Livewire.

### Error Responses
- JSON responses amigáveis para API/Livewire (nunca stack trace em produção).
- Mensagens em português claro para o usuário final.
- Código HTTP correto (422 para validação, 404, 403, 500 com referência de ticket).

### Logging
- Usar canais separados no `config/logging.php`:
  - `daily` → geral
  - `audit` → ações críticas (criação/alteração de servidores)
  - `esocial` → todos os envios e retornos do governo
  - `errors` → erros críticos com stack trace completo
- Nunca logar dados sensíveis (CPF, NIS, salário, certificado) → usar `Str::mask()` ou remover.
- Incluir contexto rico: `tenant_id`, `user_id`, `request_id`, `ip`.

---

## 3. Ferramentas de Debugging & Observabilidade

| Ferramenta              | Uso no FolhaNova                          | Ambiente |
|-------------------------|-------------------------------------------|----------|
| Laravel Debugbar        | Desenvolvimento                           | Local    |
| Laravel Pulse           | Monitoramento em produção                 | Prod     |
| Laravel Telescope       | Debugging de queries, jobs, exceptions    | Local    |
| Horizon Dashboard       | Monitoramento de queues e falhas          | Prod     |
| Ray (spatie/ray)        | Debugging rápido durante desenvolvimento  | Local    |
| Sentry ou Flare         | (opcional futuro) captura automática de bugs | Prod |

---

## 4. Melhores Práticas Anti-Bug (obrigatórias em TODO código)

1. **Validação**
   - Sempre usar Form Requests (nunca validação inline).
   - Regras rigorosas + mensagens personalizadas em pt-BR.

2. **Database**
   - Transactions com `DB::transaction()` + `try/catch` + rollback automático.
   - Verificar existência antes de atualizar/deletar (`firstOrFail()` com exceção customizada).

3. **Queues & Jobs**
   - Todos os Jobs devem implementar `ShouldQueue` e `Failed` method.
   - Usar `retryUntil()` e `maxExceptions()`.
   - Notificação automática de jobs falhados.

4. **Livewire**
   - Usar `protected $listeners = []` e `try/catch` em métodos públicos.
   - `dispatch('error')` para feedback visual.

5. **eSocial**
   - Todo envio XML deve ter `try/catch` completo.
   - Armazenar tentativa, retorno e erro em tabela `eventos_esocial`.
   - Retry automático configurável.

6. **Multi-Tenancy**
   - Verificar tenant em **todo** request (middleware).
   - Exceção clara caso tenant não exista ou esteja inativo.

7. **Testes Anti-Bug**
   - Testar cenários de erro em todos os testes Pest.
   - Feature tests com `->assertException()` e `->assertDatabaseMissing()`.

---

## 5. Regras para a IA (Codex / Cursor / Claude)

**Sempre que gerar código, você deve:**

1. Consultar **este documento + Cybersecurity + Performance + Engenharia** antes de responder.
2. Incluir tratamento completo de exceções e logging.
3. Usar exceções específicas do domínio.
4. Adicionar comentários claros:
   ```php
   // BUG-PREVENTION: Exceção específica lançada
   // BUG-PREVENTION: Transaction com rollback automático
   // DEBUG: Contexto rico adicionado no log
   ```
5. Nunca deixar código sem tratamento de erro.
6. Atualizar `docs/BUG-TRACKING.md` quando necessário.
7. No final de cada resposta, incluir um **Checklist Anti-Bug** com ✓ ou ✗.

**Exemplo de checklist no final da resposta:**
```markdown
### ✅ Checklist Anti-Bug Aplicada
- [✓] Exceções específicas do domínio criadas/usadas
- [✓] try/catch + logging completo
- [✓] Transaction com rollback
- [✓] Nenhum dado sensível em logs
- [✓] Validação via Form Request
- [✓] Testes de erro incluídos
- [ ] Notificação de falha em Job (pendente)
```

--