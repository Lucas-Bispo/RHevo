# 🔒 FolhaNova - Cybersecurity Master Prompt & Security Bible

**Versão:** 1.0 (19 de abril de 2026)  
**Projeto:** FolhaNova – Sistema Moderno de Folha de Pagamento + Gestão de Servidores  
**Objetivo:** Garantir que **todo o código gerado** esteja alinhado com as melhores práticas de cibersegurança 2026, LGPD, eSocial S-1.3 e OWASP Top 10:2025.

**Este documento é de consulta OBRIGATÓRIA.**  
Sempre que eu pedir qualquer módulo, funcionalidade ou alteração, você **deve** consultar este arquivo antes de gerar código e garantir que todas as regras abaixo sejam aplicadas.

---

## 1. Visão Geral de Segurança do Projeto

- **Dados tratados:** Altamente sensíveis (CPF, NIS, matrícula eSocial, dados bancários, salários, nome da mãe, endereço, dados de saúde, etc.).
- **Contexto:** Sistema para prefeituras (setor público brasileiro) → sujeita a LGPD + fiscalização do TCU, CGU e ANPD.
- **Princípios obrigatórios (Privacy by Design):**
  - Minimização de dados
  - Pseudonimização quando possível
  - Default Deny (nega por padrão)
  - Auditoria completa de todas as ações
  - Zero Trust no multi-tenant

---

## 2. Conformidade Legal (OBRIGATÓRIA)

- **LGPD (Lei Geral de Proteção de Dados – Lei 13.709/2018 + atualizações 2026):**
  - Tratamento de dados pessoais deve ter base legal clara (consentimento ou obrigação legal).
  - Implementar **Plano de Gestão de Incidentes com Dados Pessoais** (notificação à ANPD em até 2 dias úteis).
  - Direito do titular (acesso, correção, exclusão, portabilidade) deve ser implementado via API segura.
  - Registro de atividades de tratamento (art. 37).

- **eSocial S-1.3:**
  - Certificado A1 **nunca** pode ser commitado, logado ou exposto.
  - XMLs gerados devem ser assinados e enviados via fila segura.
  - Retornos do governo devem ser armazenados criptografados.

---

## 3. OWASP Top 10:2025 – Regras Obrigatórias para Laravel

| Risco (2025)                        | Como mitigar no FolhaNova (Laravel 11) |
|-------------------------------------|-----------------------------------------|
| **A01: Broken Access Control**     | Policy + Gate + `authorize()` em **todo** controller. Usar `tenant_id` + `user_id` em todas as queries. SSRF bloqueado. |
| **A02: Security Misconfiguration** | `APP_DEBUG=false` em produção. Remover Telescope/Horizon em prod. Security headers (CSP, HSTS, X-Frame-Options, etc.). |
| **A03: Software Supply Chain**     | `composer audit` + `composer update` semanal. Lock de versões. Verificar pacotes antes de instalar. |
| **A04: Cryptographic Failures**    | Usar `Crypt::` do Laravel + Argon2id para senhas. TLS 1.3 obrigatório. |
| **A05: Injection**                 | Eloquent + prepared statements. **Nunca** usar `DB::raw` sem sanitização. |
| **A06: Security Logging**          | Logs nunca podem conter CPF, NIS, salário ou dados pessoais. Usar Laravel Telescope apenas em dev. |
| **A07: Identification Failures**   | Rate limiting + 2FA + lock de conta após 5 tentativas. |
| **A08: Software & Data Integrity** | Assinatura digital em todos os XMLs do eSocial. |
| **A09: Security Misconfiguration** | (já coberto em A02) |
| **A10: Error Handling**            | Nunca exibir stack trace em produção. Usar custom exception handler que loga sem expor dados. |

---

## 4. Requisitos de Segurança no Laravel (obrigatórios em TODO o código)

1. **Autenticação & Autorização**
   - Laravel Fortify + Jetstream ou Filament com 2FA (Google Authenticator).
   - Spatie Permission para ACL (roles + permissions).
   - `auth:sanctum` para APIs internas.
   - Políticas (Policies) em **todos** os modelos sensíveis.

2. **Validação & Sanitização**
   - Form Requests com regras rigorosas.
   - `->validated()` + `strip_tags` + `purify` (HTML Purifier).
   - Mass Assignment Protection (`$guarded` ou `$fillable` explícito).

3. **Multi-Tenancy Security**
   - `spatie/laravel-multitenancy` com **database strategy**.
   - Global Scope `tenant_id` em **todos** os modelos.
   - Middleware `EnsureTenantIsSet`.
   - Jamais permitir cross-tenant data access.

4. **Dados Sensíveis**
   - Campos sensíveis (`cpf`, `nis`, `salario`, `certificado`) devem ser criptografados com `Crypt::encrypt`.
   - Nunca armazenar senha em claro (usar `Hash::make`).
   - Uploads de arquivos (foto, documentos) → validar MIME + tamanho + scan de vírus.

5. **Certificado eSocial A1**
   - Armazenado em `storage/app/private/cert/` (fora de web root).
   - Caminho e senha no `.env` (nunca commitado).
   - Uso via `nfephp-org/sped-esocial` com `openssl` seguro.
   - Rotina de expiração automática (alerta 30 dias antes).

6. **Logging & Monitoramento**
   - Monolog com canal separado para auditoria (`audit.log`).
   - Nunca logar dados pessoais (use `Str::mask()` ou remova).
   - Laravel Telescope **apenas** em ambiente local/dev.

7. **Proteções Adicionais**
   - Rate Limiting (`ThrottleRequests`) em login, API e cálculo de folha.
   - CSRF, XSS, CORS configurados corretamente.
   - Security Headers via middleware (Helmet-like).
   - Backup criptografado automático do banco.

---

## 5. Regras para a IA (Codex / Cursor / Claude)

**Sempre que gerar código, você deve:**

1. Verificar este documento inteiro antes de responder.
2. Incluir comentários de segurança em PHPDoc (`// SECURITY: ...`).
3. Aplicar as mitigações da OWASP Top 10:2025.
4. Garantir LGPD (minimização, consentimento, auditoria).
5. Nunca gerar código que exponha dados sensíveis em logs, responses ou exceções.
6. Atualizar `docs/SEGURANCA.md` sempre que adicionar nova funcionalidade sensível.
7. No final de cada resposta, incluir um **Checklist de Segurança** com ✓ ou ✗.

**Exemplo de checklist no final da resposta:**
```markdown
### ✅ Checklist de Segurança Aplicada
- [✓] Broken Access Control (Policy + tenant_id)
- [✓] Dados sensíveis criptografados
- [✓] Rate limiting ativado
- [✓] Nenhum dado pessoal em logs
- [ ] 2FA obrigatório (pendente no módulo X)