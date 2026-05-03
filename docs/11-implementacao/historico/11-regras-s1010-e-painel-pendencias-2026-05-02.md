# FolhaNova - Linha do Tempo - 02/05/2026

Registros historicos de implementacao separados para leitura rapida.

### 02/05/2026 - Invalidacao de XML S-1000 ao Editar Parametros

**Acao realizada:**
- Limpar XML local, hash, status, mensagem e datas de validacao quando um evento `S-1000` pendente for reaproveitado apos edicao dos parametros do orgao publico.
- Manter o payload atualizado como fonte de verdade para a proxima geracao local.
- Cobrir o fluxo com teste focado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php`: `22` testes verdes e `148` assercoes.
- `./vendor/bin/pint app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php tests/Feature/OrgaoPublicoTest.php`: sem pendencias.
- `php artisan test tests/Feature/OrgaoPublicoTest.php tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php`: `51` testes verdes e `349` assercoes.
- `php artisan test`: `149` testes verdes e `935` assercoes.
- `npm run build`: build Vite concluido com sucesso.

**Status:** Concluido

### 02/05/2026 - Normalizacao do nrInsc no S-1000

**Acao realizada:**
- Normalizar o `nrInsc` do `S-1000` para raiz de 8 digitos quando a inscricao institucional for por CNPJ.
- Preservar CPF com 11 digitos no mesmo builder.
- Atualizar a orientacao da tela de parametros do orgao publico.
- Ajustar o evento `S-1000` da massa demo para usar a raiz CNPJ.
- Cobrir payload e XML local com teste focado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Services/Esocial/Payloads/S1000PayloadBuilder.php`
- `backend/FolhaNova/database/seeders/DemoDataSeeder.php`
- `backend/FolhaNova/resources/views/orgao-publico/partials/form-fields.blade.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php`: `21` testes verdes e `138` assercoes.
- `./vendor/bin/pint app/Services/Esocial/Payloads/S1000PayloadBuilder.php database/seeders/DemoDataSeeder.php tests/Feature/OrgaoPublicoTest.php`: sem pendencias.
- `php artisan test tests/Feature/OrgaoPublicoTest.php tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php`: `50` testes verdes e `339` assercoes.
- `php artisan test`: `148` testes verdes e `925` assercoes.
- `npm run build`: build Vite concluido com sucesso.

**Status:** Concluido

### 02/05/2026 - Regras Locais de Incidencia S-1010

**Acao realizada:**
- Criar regras locais de compatibilidade para as naturezas `1000`, `9201` e `9219`.
- Aplicar as regras nas requests de criacao e edicao de rubricas.
- Exibir a regra aplicavel no bloco de consistencia `S-1010`.
- Cobrir criacao e edicao invalidas com testes focados.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Support/Esocial/RegrasIncidenciaRubrica.php`
- `backend/FolhaNova/app/Http/Requests/StoreRubricaRequest.php`
- `backend/FolhaNova/app/Http/Requests/UpdateRubricaRequest.php`
- `backend/FolhaNova/resources/views/rubricas/partials/consistency-guide.blade.php`
- `backend/FolhaNova/tests/Feature/RubricaCrudTest.php`
- `docs/esocial/regras-negocio.md`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Validacao:**
- `php artisan test tests/Feature/RubricaCrudTest.php tests/Feature/RubricasIndexTest.php`: `33` testes verdes e `242` assercoes.
- `./vendor/bin/pint app/Support/Esocial/RegrasIncidenciaRubrica.php app/Http/Requests/StoreRubricaRequest.php app/Http/Requests/UpdateRubricaRequest.php tests/Feature/RubricaCrudTest.php`: sem pendencias.
- `php artisan test`: `146` testes verdes e `890` assercoes.
- `npm run build`: build Vite concluido com sucesso.

**Status:** Concluido

### 02/05/2026 - Pendencias Anteriores no Painel eSocial

**Acao realizada:**
- Adicionar contadores de pendencias e erros anteriores ao dia atual.
- Exibir cards dedicados para `Pendentes anteriores` e `Erros anteriores`.
- Adicionar filtro `Periodo` na listagem do painel eSocial.
- Cobrir a filtragem de eventos envelhecidos com teste focado.

**Arquivos criados / alterados:**
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/index.blade.php`
- `backend/FolhaNova/tests/Feature/EventosEsocialIndexTest.php`
- `docs/produto/funcionalidades-existentes.md`
- `docs/10-tarefas-backlog/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`
- `docs/11-implementacao/historico/11-regras-s1010-e-painel-pendencias-2026-05-02.md`

**Validacao:**
- `php artisan test tests/Feature/EventosEsocialIndexTest.php`: `22` testes verdes e `160` assercoes.
- `./vendor/bin/pint app/Http/Controllers/EventoEsocialController.php tests/Feature/EventosEsocialIndexTest.php`: sem pendencias.
- `php artisan test tests/Feature/Auth/AuthenticationTest.php tests/Feature/DashboardTest.php tests/Feature/EventosEsocialIndexTest.php tests/Feature/EventoEsocialShowTest.php`: `36` testes verdes e `286` assercoes.
- `npm run build`: build Vite concluido com sucesso.
- `php scripts/ensure_local_login.php`: usuario local recriado apos testes com `RefreshDatabase`.

**Status:** Concluido

### 02/05/2026 - XML Local do S-1000

**Acao realizada:**
- Criar campos de XML gerado, hash, status de validacao e datas no evento eSocial.
- Extrair builder reutilizavel para payload/configuracao `S-1000`.
- Gerar XML local `S-1000` com `nfephp-org/sped-esocial`.
- Exibir botao `Gerar XML local` no detalhe do evento.
- Registrar a validacao como `pendente_assinatura` quando o XSD oficial exigir `Signature`.

**Arquivos criados / alterados:**
- `backend/FolhaNova/database/migrations/2026_05_02_153200_add_xml_generation_to_evento_esocials_table.php`
- `backend/FolhaNova/app/Models/EventoEsocial.php`
- `backend/FolhaNova/app/Services/Esocial/Payloads/S1000PayloadBuilder.php`
- `backend/FolhaNova/app/Services/Esocial/Xml/EsocialXmlFactory.php`
- `backend/FolhaNova/app/Services/Esocial/Xml/EsocialXsdValidator.php`
- `backend/FolhaNova/app/Services/Esocial/Xml/EsocialXmlValidationResult.php`
- `backend/FolhaNova/app/Services/EventosEsocial/GerarXmlEventoEsocialService.php`
- `backend/FolhaNova/app/Services/OrgaoPublico/AtualizarParametrosOrgaoService.php`
- `backend/FolhaNova/app/Http/Controllers/EventoEsocialController.php`
- `backend/FolhaNova/resources/views/eventos-esocial/show.blade.php`
- `backend/FolhaNova/routes/web.php`
- `backend/FolhaNova/tests/Feature/OrgaoPublicoTest.php`
- `docs/esocial/integracao-api-esocial/05-plano-implementacao-governo.md`
- `docs/produto/funcionalidades-existentes.md`

**Validacao:**
- `php artisan test tests/Feature/OrgaoPublicoTest.php tests/Feature/EventosEsocialIndexTest.php`: `43` testes verdes e `296` assercoes.
- `./vendor/bin/pint --dirty`: formatacao aplicada.
- `php artisan test`: `148` testes verdes e `923` assercoes.

**Status:** Concluido
