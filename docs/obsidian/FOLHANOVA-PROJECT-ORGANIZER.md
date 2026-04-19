# 📋 FolhaNova - Project Organization & Task Management Master Prompt

**Versão:** 1.0 (19 de abril de 2026)  
**Projeto:** FolhaNova – Sistema Moderno de Folha de Pagamento + Gestão de Servidores com eSocial S-1.3  
**Objetivo:** Organizar todo o projeto, definir roadmap claro, priorizar tarefas e manter o desenvolvimento alinhado com a documentação oficial do governo.

**Este documento é de consulta OBRIGATÓRIA.**  
Sempre que eu pedir para organizar tarefas, criar backlog, definir próxima fase ou planejar um módulo, você **deve** consultar este arquivo + os outros Bibles (FOLHANOVA-PROMPT.md, FOLHANOVA-CYBERSECURITY.md, FOLHANOVA-PERFORMANCE.md, FOLHANOVA-ENGENHARIA.md e FOLHANOVA-BUG.md).

---

## 1. Documentação Oficial do eSocial (Referência Absoluta - 2026)

**Versão vigente:** S-1.3 (consolidada até NT 06/2026 rev. 09/04/2026)

**Links oficiais mais importantes (sempre usar estes):**
- [Documentação Técnica Completa](https://www.gov.br/esocial/pt-br/documentacao-tecnica)
- [Manual de Orientação do eSocial – MOS S-1.3 (consolidado até NO 08/2026)](https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/mos-s-1-3-consolidada-ate-a-no-s-1-3-08-2026.pdf)
- [Leiautes eSocial versão S-1.3 – NT 06/2026 rev. 09/04/2026 (HTML)](https://www.gov.br/esocial/pt-br/documentacao-tecnica/leiautes-esocial-versao-s-1-3-nt-06-2026-rev-09-04-2026/index.html)
- [Esquemas XSD S-1.3 (mais recente)](https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/2026-04-27_esquemas_xsd_v_s_01_03_00.zip)
- [Manual de Orientação do Desenvolvedor](https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/manualorientacaodesenvolvedoresocialv1-15.pdf)
- [Pacote de Comunicação eSocial v.1.6](https://www.gov.br/esocial/pt-br/documentacao-tecnica/manuais/pacote-de-comunicacao-esocial-v1-6.zip)

**Eventos e Tabelas críticas para Prefeituras (RPPS):**
- **Eventos principais:** S-2200, S-2205, S-2299, S-1202, S-1207, S-1210
- **Tabelas obrigatórias:** S-1010, S-1030, S-1040, S-1050, S-1010 (Rubricas), etc.

---

## 2. Estrutura de Fases do Projeto (Roadmap Geral)

Divida o desenvolvimento em fases claras e sequenciais:

**Fase 0 – Setup & Fundação** (já em andamento)
- Ambiente WSL + Laravel 11 + multi-tenancy
- Estrutura Clean Architecture + pastas Domain/Application/Infrastructure
- Configuração de Git, .gitignore, README.md
- Integração inicial da biblioteca sped-esocial

**Fase 1 – Core & Autenticação** (próxima prioridade)
- Autenticação, 2FA, ACL (Spatie Permission)
- Multi-tenancy completo
- Dashboard moderno + sidebar (igual aos prints da Realiza)

**Fase 2 – Módulo Cadastro de Servidores** (o mais importante)
- Formulário completo com todas as abas dos prints
- Integração S-2200 / S-2205 / S-2299

**Fase 3 – Folha de Pagamento**
- Cálculo mensal + S-1202
- Rubricas + Tabelas eSocial

**Fase 4 – Relatórios & Exportações**
- Contracheque, Ficha Financeira, Informe de Rendimentos, etc.

**Fase 5 – eSocial Completo + Monitoramento**
- Todos os eventos restantes + fila de envio + tela de status

**Fase 6 – Testes, Segurança & Deploy**

---

## 3. Regras para Organização de Tarefas

Sempre que eu pedir para organizar o projeto ou criar tarefas, você deve responder no seguinte formato:

1. **Resumo da Fase Atual**
2. **Backlog Priorizado** (dividido em: Alta / Média / Baixa prioridade)
3. **Tarefas da Próxima Sprint** (próximos 5–7 dias de desenvolvimento)
4. **Dependências e Bloqueadores**
5. **Checklist de Qualidade** (cruzando com os outros Bibles: Cybersecurity, Performance, Engenharia, Bug)
6. **Próximo Módulo Sugerido**

Use **Conventional Commits** para todas as tarefas.

---

## 4. Regras para a IA (Codex / Cursor / Claude)

**Sempre que responder sobre organização ou tarefas, você deve:**

1. Consultar **este documento + toda a documentação oficial do eSocial** acima.
2. Manter o desenvolvimento alinhado com a versão S-1.3 vigente.
3. Priorizar primeiro o que aparece nos prints da Realiza Informática.
4. Garantir que todo evento eSocial tenha:
   - Tabela de mapeamento no banco
   - Action/Service dedicado
   - Job de envio em fila
   - Tela de monitoramento
5. Atualizar este arquivo sempre que uma fase for concluída ou uma nova prioridade surgir.
6. No final de toda resposta, incluir:

```markdown
### ✅ Status do Projeto
- Fase atual: X
- % concluído: XX%
- Próxima fase: Y

### ✅ Checklist de Organização
- [ ] Roadmap atualizado
- [ ] Tarefas priorizadas
- [ ] Dependências mapeadas
- [ ] Alinhamento com eSocial S-1.3