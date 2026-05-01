# FolhaNova - Linha do Tempo - 30/04/2026

Registros historicos de implementacao separados para leitura rapida.

### 30/04/2026 - Grupos Operacionais no Painel eSocial

**Acao realizada:**
- Adicionado filtro `grupo` no painel eSocial.
- Criada a classificacao local de eventos em `Eventos de tabela`, `Eventos nao periodicos` e `Eventos periodicos`.
- Criados cards dedicados para abrir a listagem por grupo.
- O resumo de filtros ativos passou a exibir o grupo selecionado.
- A leitura lateral do painel passou a explicar que essa separacao prepara a futura montagem de lotes sem misturar grupos.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php`: `21` testes verdes e `144` assercoes.
- `./vendor/bin/pint app/Http/Controllers/EventoEsocialController.php tests/Feature/EventosEsocialIndexTest.php`: sem alteracoes pendentes.

**Status:** Concluido


### 30/04/2026 - Guia Humano da Integracao com a API do eSocial

**Acao realizada:**
- Lidos os MDs internos da trilha eSocial para manter aderencia ao plano do projeto.
- Consultada a documentacao oficial em `gov.br` no dia 30/04/2026.
- Registrada a referencia vigente encontrada: leiaute `S-1.3`, MOS `consolidado ate NO 10/2026`, leiautes `NT 06/2026 rev. 09/04/2026`, XSD ate `NT 06/2026`, Manual do Desenvolvedor v1.15, Mensagens do Sistema v2.4 e Pacote de Comunicacao v1.6.
- Criado um guia explicando que a integracao oficial e feita por Web Services SOAP, XML, XSD, certificado digital, assinatura, lotes, consulta assincrona de retorno, recibos e rejeicoes.
- O documento reforca que a transmissao real deve ficar para a ultima etapa, depois da maturidade dos cadastros, regras e prontidao operacional.

**Arquivos criados / alterados:**
- `docs/esocial/integracao-api-esocial.md`
- `docs/esocial/README.md`
- `docs/08-esocial/ESOCIAL-DOCUMENTACAO-OFICIAL.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- Revisao documental local e conferencia de fontes oficiais em `gov.br`.

**Status:** Concluido


### 30/04/2026 - Prontidao S-2200 na Listagem de Servidores e Dashboard

**Acao realizada:**
- Adicionado filtro operacional `prontidao` na listagem de servidores.
- Criados cards `Prontos S-2200` e `Pendencias S-2200`.
- Servidores prontos foram definidos, nesta etapa, como ativos, com lotacao, cargo, categoria, regime previdenciario, data de admissao, CPF e nascimento da pessoa, alem de evento local `S-2200`.
- O resumo visual de filtros passou a exibir `Prontidao S-2200`.
- O dashboard passou a calcular servidores prontos e pendentes para a trilha `S-2200`.
- A triagem `S-2200` ganhou atalhos para servidores prontos, pendencias e painel de eventos `S-2200`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/ServidorController.php`
- `backend/FolhaNova/resources/views/servidores/index.blade.php`
- `backend/FolhaNova/app/Http/Controllers/DashboardController.php`
- `backend/FolhaNova/resources/views/dashboard.blade.php`
- `backend/FolhaNova/tests/Feature/ServidoresIndexTest.php`
- `backend/FolhaNova/tests/Feature/DashboardTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/BACKLOG-GERAL.md`
- `docs/11-implementacao/LINHA-DO-TEMPO.md`

**Validacao:**
- `php artisan test tests/Feature/ServidoresIndexTest.php tests/Feature/DashboardTest.php`: `5` testes verdes e `90` assercoes.

**Status:** Concluido
