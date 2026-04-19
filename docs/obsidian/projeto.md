# 🍃 FolhaNova - Master System Prompt & Project Bible

**Versão:** 1.0 (18 de abril de 2026)  
**Projeto:** Sistema Moderno de Folha de Pagamento + Gestão de Servidores para Prefeituras  
**Objetivo:** Substituir 100% o sistema da **Realiza Informática** com interface moderna, integração completa com **eSocial S-1.3** e melhores práticas de engenharia.

---

## 1. Visão Geral do Projeto

- **Nome:** FolhaNova
- **Público-alvo:** Prefeituras e Câmaras Municipais (RPPS)
- **Missão:** Criar um sistema **mais bonito, rápido, seguro e moderno** que o da Realiza Informática, mantendo todas as funcionalidades existentes e adicionando integração nativa com eSocial.
- **Licenciamento:** Multi-tenant (uma instalação serve várias prefeituras)
- **Idioma:** 100% Português (pt-BR)

**Inspiração visual:** Interface limpa, moderna, dark mode, estilo Linear / Notion / FilamentPHP (nada de tiles antigos do Windows 8 como no sistema da Realiza).

---

## 2. Stack Técnica (obrigatória – atualizada 2026)

| Camada              | Tecnologia                                      | Versão / Observação |
|---------------------|--------------------------------------------------|---------------------|
| PHP                 | PHP                                              | 8.3+                |
| Framework           | Laravel                                          | 11 (ou superior)    |
| Banco de dados      | MySQL                                            | 8.0+                |
| Multi-tenancy       | spatie/laravel-multitenancy                      | database strategy   |
| Permissões          | spatie/laravel-permission                        | ACL completo        |
| Frontend            | Livewire 3 + Alpine.js + Tailwind CSS 4 + DaisyUI | ou FilamentPHP 3    |
| eSocial             | nfephp-org/sped-esocial                          | dev-master (S-1.3)  |
| Qualidade de código | Laravel Pint + PHPStan (nível 8) + Rector + Larastan | Sempre ativo        |
| Testes              | Pest                                             | Obrigatório         |
| Outros              | Laravel Queue, Telescope, Sanctum, Fortify      | —                   |

---

## 3. Requisitos Funcionais (fiéis aos prints da Realiza Informática)

### Dashboard Principal
- Sidebar esquerda + header + conteúdo central
- Cards grandes: Grupos, Usuários, Alterar Usuário, System Check, Modo Gerente, Master Skin, Info. do Sistema, Log, Alterar Senha, Conexão Adicional, Executar Script SQL, Recarregar Sistema, Sair
- Sidebar direita: Cálculo Mensal, Funcionário, Relatórios, etc.

### Módulo Cadastro de Servidores (o mais crítico)
- Abas idênticas aos prints:
  - Dados Pessoais (Nome, Matrícula eSocial, NIS, Nome da Mãe, Qualificação Cadastral, etc.)
  - Dados Funcionais (Data de Admissão, Regime, Tipo de Regime Previdenciário, Categoria do Trabalhador, Lotação, Cargo, Função, Centro de Custo)
  - eSocial (Exportar eSocial, Gerar Senha Portal, Ficha Financeira, Contracheque, Informe de Rendimentos)
  - Dependentes, Afastamento, Horário, Férias, Averbação, INSS, Ocorrências, etc.

### Outros Módulos Obrigatórios
- Cálculo Mensal da Folha
- Relatórios (Resumo, Folha, Exportação Bancária, etc.)
- Usuários e Grupos de Permissão
- Logs completos
- Execução de Script SQL (somente master)
- System Check
- Master Skin (troca de tema)

### Integração eSocial S-1.3 (OBRIGATÓRIA)
- Eventos principais: S-2200, S-2205, S-2299, S-1202, S-1207, S-1210
- Tabelas: S-1010 (Rubricas), S-1030 (Cargos), S-1040, S-1050
- Assinatura com certificado A1 (PKCS#12)
- Envio via fila (Queue) + tela de monitoramento de envios e retornos
- Nunca commitar certificado ou dados sensíveis

---

## 4. Arquitetura e Melhores Práticas de Engenharia

- **Padrões obrigatórios:**
  - Clean Architecture / Domain-Driven Design leve
  - Repository Pattern + Service Pattern + Action Classes + DTOs
  - Controllers finos (apenas recebem request → chamam Action → retornam response)
  - Validação em Form Requests
  - Global Scopes para tenant_id (segurança multi-tenant)

- **Segurança (nível máximo):**
  - Rate limiting, CSRF, XSS, SQL Injection (Laravel nativo + reforço)
  - Certificado A1 armazenado via Laravel Vault ou .env (nunca commitado)
  - 2FA, políticas fortes de senha
  - Logs sensíveis nunca devem conter CPF, NIS ou dados pessoais

- **Qualidade de Código:**
  - PSR-12 + Laravel Pint
  - PHPStan nível 8
  - PHPDoc em todas as classes
  - Conventional Commits

---

## 5. Ambiente de Desenvolvimento (WSL)

- Sempre usar **WSL2 Ubuntu 24.04+**
- Pasta do projeto: `~/projects/folhanova`
- Branch principal: `main`
- Git Flow + Conventional Commits

---

## 6. Documentação Obrigatória

- `README.md` (completo com instalação no WSL)
- Pasta `docs/` contendo:
  - `ARQUITETURA.md`
  - `SEGURANCA.md`
  - `ESOCIAL-INTEGRACAO.md`
  - `FLUXO-DE-TRABALHO.md`

---

## 7. Regras para a IA (Codex / Cursor / Claude)

Sempre que eu disser **“próximo módulo”** ou pedir algo novo, você **deve**:

1. Consultar este documento inteiro como referência.
2. Manter consistência total com a stack, arquitetura e requisitos acima.
3. Responder **passo a passo**, nunca tudo de uma vez.
4. Gerar código limpo, comentado e com PHPDoc.
5. Incluir testes (Pest) quando aplicável.
6. Atualizar a documentação sempre que necessário.
7. Perguntar se quiser prosseguir para o próximo módulo.

**Exemplo de resposta esperada:**
- “✅ Módulo X criado. Aqui está o código...”
- “Documentação atualizada em docs/…”
- “Pronto para o próximo módulo?”

---

**Pronto para começar!**

Cole este arquivo inteiro como `FOLHANOVA-PROMPT.md` no seu projeto e, sempre que for conversar com a IA, cole o seguinte no início da mensagem:

> **Consulte o arquivo FOLHANOVA-PROMPT.md como referência absoluta e siga todas as regras.**

Agora é só colar este Markdown num arquivo e usar!  
Qualquer ajuste necessário é só falar que eu atualizo a versão do Master Prompt. 🚀