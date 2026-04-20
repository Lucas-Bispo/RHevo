# Visao Geral do eSocial no Sistema
**Atualizado em:** 20/04/2026

## Fonte de verdade desta rodada
- PDFs presentes no repositorio raiz:
  - `Leiautes do eSocial v. S-1.3 (cons. ate NT 06.2026 rev.).pdf`
  - `Leiautes do eSocial v. S-1.3 - Anexo I - Tabelas (cons. ate NT 06.2026 rev.).pdf`
  - `Leiautes do eSocial v. S-1.3 - Anexo II - Regras (cons. ate NT 06.2026 rev.).pdf`
- Navegacao complementar pela documentacao oficial em `gov.br`, usada para localizar secoes e sumarios equivalentes dos mesmos leiautes S-1.3.

## Objetivo da traducao para software
Transformar a documentacao oficial do eSocial em:
- entidades e relacionamentos de dominio;
- validacoes obrigatorias no backend;
- fluxos operacionais na interface web;
- backlog tecnico incremental para evolucao do produto.

## Recorte de produto
O FolhaNova nao deve ser apenas um CRUD de RH. A plataforma precisa:
- refletir a estrutura dos eventos do eSocial;
- armazenar dados com vigencia e rastreabilidade;
- impedir inconsistencias basicas antes do envio;
- suportar futuro ciclo de assinatura, transmissao, retorno e reprocessamento.

## Eventos foco desta fase
- `S-1000` - empregador/contribuinte/orgao publico
- `S-1005` - estabelecimentos, obras ou unidades de orgaos publicos
- `S-1010` - rubricas
- `S-1020` - lotacoes tributarias
- `S-2200` - cadastramento inicial e admissao/ingresso
- `S-2205` - alteracao cadastral
- `S-2206` - alteracao contratual/relacao estatutaria
- `S-2230` - afastamento temporario
- `S-2299` - desligamento

## Leitura arquitetural
- Eventos de tabela pedem entidades com vigencia e codigos oficiais.
- Eventos nao periodicos pedem historico por trabalhador e controle de duplicidade.
- Eventos periodicos e de retorno pedem camada futura de processamento e consolidacao.

## Proxima traducao recomendada
- Consolidar `S-2205` e `S-2206` como evolucao funcional imediata do modulo de servidores.
- Em paralelo, preparar `S-1020` como camada tecnica entre `S-1005` e calculo/remuneracao.
