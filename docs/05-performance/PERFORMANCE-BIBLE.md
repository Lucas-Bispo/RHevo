# FolhaNova - Performance Bible
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Objetivo
Garantir que o FolhaNova seja otimizado para alta performance, escalabilidade e baixa latência, mesmo com milhares de servidores por prefeitura e múltiplos tenants ativos.

## Metas de Referência
- Carregamento de telas em menos de 800 ms.
- Dashboard em menos de 600 ms.
- Listagens filtradas em menos de 300 ms.
- Cálculo mensal da folha em janela compatível com a operação.
- Geração e envio de lotes eSocial sem travar a interface principal.

## Regras Obrigatórias
### Banco de dados
- Priorizar índices compostos começando por `tenant_id`.
- Evitar N+1 com eager loading.
- Paginar resultados.
- Remover queries pesadas do request síncrono.

### Cache e filas
- Usar cache para configurações, permissões e artefatos repetitivos.
- Tratar cálculo de folha, geração de XML e relatórios como jobs.
- Processar lotes com filas e monitoramento.

### Frontend e Livewire
- Usar lazy loading, defer e renderização controlada.
- Evitar re-renders desnecessários.
- Aplicar feedback visual durante operações assíncronas.

### Multi-tenancy
- Isolamento lógico e cache por tenant.
- Nada de full scan em bases multi-tenant.

## Ferramentas Relevantes
- Redis para cache e filas.
- Horizon e Pulse para observabilidade.
- Telescope e Debugbar apenas em ambientes apropriados.

## Fonte de Origem
Documento consolidado a partir de `docs/obsidian/FOLHANOVA-PERFORMANCE.md`.
