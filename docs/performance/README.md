# FolhaNova - Performance
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Objetivo
Consolidar a investigação de performance da aplicação com foco nos fluxos críticos:

- carregamento inicial da aplicação;
- tela de login;
- autenticação;
- carregamento após login;
- logout.

## Escopo desta trilha
Esta pasta registra diagnóstico, hipóteses, evidências, métricas e prioridades antes de qualquer correção estrutural relevante. O objetivo é evitar mudanças cegas e manter a evolução guiada por medição.

## Arquivos desta pasta
- `tecnologias-atuais.md`
- `diagnostico-inicial.md`
- `analise-primeira-pagina.md`
- `analise-pos-login.md`
- `analise-performance-geral.md`
- `analise-carregamento-inicial.md`
- `analise-login.md`
- `analise-dashboard.md`
- `analise-logout.md`
- `tarefas-performance.md`
- `plano-de-acao.md`
- `plano-performance.md`
- `metricas-validacao.md`

## Atualizacao desta rodada
- Revisao do runtime real em WSL confirmou `debug=false`, `cache=database`, `session=database` e `sqlite`.
- Abertura do primeiro modulo funcional de RH com `servidores.index`, ja com eager loading e filtros server-side.
- Split do JS do login para reduzir payload inicial da primeira tela.

## Relação com a documentação existente
- Esta trilha complementa `docs/05-performance/`, que já contém material focado principalmente na tela de login e no ambiente.
- Sempre que houver divergência, a evidência técnica mais recente deve prevalecer.

## Leitura rápida
- Comece por `diagnostico-inicial.md`.
- Em seguida veja `tecnologias-atuais.md`.
- Depois avance para as análises específicas por fluxo.
