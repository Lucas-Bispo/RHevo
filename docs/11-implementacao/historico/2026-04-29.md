# FolhaNova - Linha do Tempo - 29/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 29/04/2026 - Atalhos S-1030/S-1040 no Painel eSocial

**Acao realizada:**
- O painel eSocial passou a calcular os totais de eventos `S-1030` e `S-1040`.
- A faixa de eventos prioritarios ganhou cards dedicados para cargos e funcoes.
- Os atalhos abrem a listagem ja filtrada pela trilha selecionada.
- A entrega preserva os cards existentes de `S-1000`, `S-1010` e `S-2200`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php`: `20` testes verdes e `127` assercoes.

**Status:** Concluido


### 29/04/2026 - Prontidao S-1030/S-1040 no Dashboard

**Acao realizada:**
- O dashboard passou a calcular cargos prontos e pendentes para a trilha `S-1030`.
- O dashboard passou a calcular funcoes prontas e pendentes para a trilha `S-1040`.
- A leitura demo passou a exibir os totais de `Prontos S-1030`, `Pendencias S-1030`, `Prontas S-1040` e `Pendencias S-1040`.
- A triagem `S-1030/S-1040` ganhou atalhos para abrir cargos e funcoes prontos ou pendentes.
- O criterio reutiliza a regra entregue nas listagens: cadastro ativo com codigo eSocial informado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/DashboardTest.php`: `1` teste verde e `57` assercoes.

**Status:** Concluido
