# Roadmap de Implementação

## Fase 0 · Fundação
- Estrutura Laravel 11 + dependências.
- `.env.example` com parâmetros de tenant e certificado eSocial.
- Migrations iniciais de domínio.
- Layout base moderno (sidebar + dashboard).

## Fase 1 · Cadastro de Servidor + S-2200
- Formulário completo (dados pessoais/funcionais/eSocial).
- Validações obrigatórias (matrícula eSocial, NIS, categoria, regime).
- Geração e envio de S-2200 com fila.

## Fase 2 · Folha e eventos periódicos
- Cálculo mensal e fechamento.
- Geração de S-1202, S-1207 e S-1210.
- Painel de monitoramento de retornos/rejeições.

## Fase 3 · Ciclo de vida funcional
- Alterações cadastrais (S-2205).
- Desligamento/rescisão (S-2299).
- Relatórios avançados e exportações bancárias.

## Critérios de pronto por fase
- Regra de negócio validada.
- Evidência de auditoria/log.
- Teste funcional dos cenários críticos.
- Documentação atualizada no hub Obsidian.

## Ligações
- [[00-Index]]
- [[04-Arquitetura-Proposta-Laravel]]
- [[06-Prompt-Base-Codex]]
