# Tarefas de Performance
**Documento gerado em:** 19 de abril de 2026  
**Versão:** 1.0

## Prioridade Alta
### PERF-01 - Medir os fluxos críticos com baseline reproduzível
**Descrição:**  
Medir `/`, `/login`, autenticação, `/dashboard` autenticado e logout no ambiente atual.

**Causa provável:**  
Hoje há evidências documentais pontuais, mas faltam medições completas e comparáveis por fluxo.

**Impacto:**  
Sem baseline, o time pode corrigir o ponto errado.

**Prioridade:** Alta

**Evidência:**  
Agora já há uma rodada inicial com logs de navegador mostrando `wait` dominante em `/`, `/login`, `/dashboard`, login e logout, mas ainda faltam query count, SQL total e comparação controlada por ambiente.

**Ação sugerida:**  
Capturar TTFB, tempo total, query count, tempo SQL, redirects e waterfall dos fluxos principais.

**Forma de validação:**  
Planilha ou documento com antes/depois por rota e por fluxo.

### PERF-02 - Eliminar redirects desnecessários na entrada da aplicação
**Descrição:**  
Revisar o fluxo `GET /` para reduzir saltos até a tela útil.

**Causa provável:**  
`/` redireciona para `/dashboard`, que por sua vez manda guest para `/login`.

**Impacto:**  
Latência adicional logo na primeira experiência do sistema.

**Prioridade:** Alta

**Evidência:**  
Fluxo confirmado em `backend/FolhaNova/routes/web.php`.

**Ação sugerida:**  
Avaliar envio direto de guest para `/login` e de usuário autenticado para `/dashboard`.

**Forma de validação:**  
Menor quantidade de redirects e queda no tempo total de abertura inicial.

**Status atual:**  
Concluído na etapa de navegação inicial. Agora `/` envia guest direto para `/login`.

### PERF-03 - Eliminar redirects desnecessários no logout
**Descrição:**  
Revisar o destino do logout para evitar cascata até `/login`.

**Causa provável:**  
Logout redireciona para `/`, que reencaminha para `/dashboard`, que volta para `/login`.

**Impacto:**  
Logout com sensação de lentidão sem ganho funcional.

**Prioridade:** Alta

**Evidência:**  
Fluxo confirmado em `resources/views/livewire/layout/navigation.blade.php` e `routes/web.php`.

**Ação sugerida:**  
Redirecionar o logout diretamente para `/login`.

**Forma de validação:**  
Redução do número de hops e melhora do tempo de saída até tela utilizável.

**Status atual:**  
Concluído na etapa de navegação inicial. O componente de navegação agora redireciona o logout diretamente para `/login`.

### PERF-04 - Validar impacto do ambiente WSL em `/mnt/c/.../OneDrive`
**Descrição:**  
Comparar o projeto no filesystem atual com execução em filesystem nativo do Linux no WSL.

**Causa provável:**  
I/O de disco degradado por NTFS montado e sincronização do OneDrive.

**Impacto:**  
Afeta bootstrap do Laravel, sessões, cache, views compiladas, logs e build frontend.

**Prioridade:** Alta

**Evidência:**  
Documentação existente já registrou `GET /login` em ~8.1s e build em 5m37s.

**Ação sugerida:**  
Rodar benchmark comparativo em clone espelhado dentro do home Linux do WSL.

**Forma de validação:**  
Queda significativa de TTFB e do tempo de build.

### PERF-05 - Medir impacto de `APP_DEBUG`, Telescope e drivers `file`
**Descrição:**  
Criar baseline controlado sem contaminar o fluxo normal de desenvolvimento.

**Causa provável:**  
Ambiente atual carrega overhead de debug, observabilidade e I/O em disco.

**Impacto:**  
Pode distorcer o diagnóstico dos fluxos críticos.

**Prioridade:** Alta

**Evidência:**  
`.env` e `config/telescope.php` confirmam debug ligado, Telescope ativo, sessão/cache em `file`.

**Ação sugerida:**  
Executar rodada de benchmark com ambiente controlado e comparar.

**Forma de validação:**  
Comparativo objetivo de tempo por rota e tempo SQL.

**Status atual:**  
Parcialmente concluído. Runtime local já foi validado com `Debug Mode OFF`, caches gerados e cache/sessão em `database`.

### PERF-10 - Instrumentar o backend para decompor o tempo de espera
**Descrição:**  
Separar quanto do `wait` vem de bootstrap, middleware, sessão, autenticação, Livewire e SQL.

**Causa provável:**  
Os logs mostram que a maior parte da latência está antes da transferência da resposta, mas ainda não está decomposta.

**Impacto:**  
Sem essa decomposição, há risco de otimizar a camada errada.

**Prioridade:** Alta

**Evidência:**  
`GET /` `~6.45s`, `/dashboard` `~7.02s`, `/login` `~3.29s`, login Livewire `~3.42s` e logout Livewire `~2.58s`, todos com `wait` dominante.

**Ação sugerida:**  
Adicionar medição controlada por request no backend ou usar profiling operacional do Laravel para capturar tempo total, SQL e etapas-chave.

**Forma de validação:**  
Relatório por fluxo com decomposição de tempo e principal suspeito confirmado.

### PERF-11 - Medir cold start versus warm run no ambiente local
**Descrição:**  
Separar explicitamente a diferença entre primeira carga e cargas subsequentes.

**Causa provável:**  
Os testes controlados mostraram queda forte de `/` e `/login` após aquecimento, sugerindo custo alto de bootstrap, leitura de arquivos e caches transitórios.

**Impacto:**  
Sem separar cold/warm, o time pode superestimar ou subestimar o ganho real de uma correção.

**Prioridade:** Alta

**Evidência:**  
`GET /` caiu de uma medição isolada em `~5.65s` para a faixa de `~2.30s` a `~2.54s`; `GET /login` caiu de `~3.03s` para `~0.36s` a `~0.41s`.

**Ação sugerida:**  
Executar baterias controladas com servidor recém-subido e depois com ambiente aquecido.

**Forma de validação:**  
Tabela comparando tempos frios e aquecidos por fluxo.

**Status atual:**  
Em andamento. A variância continua evidente mesmo após a otimização local.

## Prioridade Média
### PERF-06 - Reduzir payload inicial da tela de login
**Descrição:**  
Revisar fontes externas, bundle compartilhado e custo visual do login.

**Causa provável:**  
Login atual usa hero complexo, blur forte, fontes externas e assets globais.

**Impacto:**  
Piora FCP/LCP e custo de renderização.

**Prioridade:** Média

**Evidência:**  
Confirmado em `resources/views/components/layouts/auth-login.blade.php` e `resources/css/app.css`.

**Ação sugerida:**  
Medir e reduzir dependências não críticas da primeira tela.

**Forma de validação:**  
Menor LCP/FCP e menor waterfall inicial.

### PERF-07 - Confirmar query count real de login e dashboard
**Descrição:**  
Instrumentar e medir queries por request nos fluxos autenticados e não autenticados.

**Causa provável:**  
Hoje a leitura é majoritariamente por inspeção de código.

**Impacto:**  
Sem medir, permanece dúvida sobre custo real de SQL.

**Prioridade:** Média

**Evidência:**  
Não há relatório atual de query count por fluxo nesta trilha.

**Ação sugerida:**  
Capturar queries via Telescope, DB listen ou profiling controlado.

**Forma de validação:**  
Tabela de query count e tempo SQL por rota.

### PERF-08 - Revisar alinhamento dos testes com o login real
**Descrição:**  
Atualizar testes para o componente de login efetivamente usado em `/login`.

**Causa provável:**  
Testes atuais ainda apontam para `pages.auth.login` via Volt.

**Impacto:**  
Risco de regressões não percebidas no fluxo customizado.

**Prioridade:** Média

**Evidência:**  
`tests/Feature/Auth/AuthenticationTest.php` não reflete a rota customizada atual.

**Ação sugerida:**  
Ajustar a cobertura após o diagnóstico operacional.

**Forma de validação:**  
Testes passam exercitando o fluxo real.

## Prioridade Baixa
### PERF-09 - Revisar carregamento global de `axios`
**Descrição:**  
Avaliar se `resources/js/bootstrap.js` precisa ser carregado já no login.

**Causa provável:**  
`axios` é global, mesmo sem uso evidente no primeiro paint.

**Impacto:**  
Pequeno, mas desnecessário na rota de autenticação.

**Prioridade:** Baixa

**Evidência:**  
Confirmado em `resources/js/bootstrap.js`.

**Ação sugerida:**  
Medir e, se fizer sentido, adiar ou segmentar esse JS.

**Forma de validação:**  
Redução marginal no JS inicial.
