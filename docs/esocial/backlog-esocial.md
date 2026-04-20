# Backlog Tecnico eSocial
**Atualizado em:** 20/04/2026

## Alta prioridade

### Task: Parametrizacao do Empregador
- Evento relacionado: `S-1000`
- Descricao: consolidar empregador com classificacao tributaria, vigencia, contato e validacoes oficiais.
- Impacto no sistema: fundacao institucional e tributaria.
- Dependencias: `Tenant`, tipos de inscricao, classificacao tributaria.
- Backend necessario: entidade funcional `Empregador`, validacao de CPF/CNPJ, vigencia, service de montagem do payload.
- Frontend necessario: tela de parametros do orgao com campos oficiais, vigencia e consistencia.

### Task: Cadastro de Estabelecimentos e Unidades
- Evento relacionado: `S-1005`
- Descricao: criar camada de estabelecimentos/unidades com vigencia e identificacao oficial.
- Impacto no sistema: base da estrutura organizacional e tributaria.
- Dependencias: `S-1000`, tipos de inscricao, tipos de lotacao.
- Backend necessario: entidade `Estabelecimento`, relacionamentos com empregador e lotacoes.
- Frontend necessario: modulo de cadastro/listagem/edicao de estabelecimentos.

### Task: Cadastro Inicial de Servidor e Vinculo
- Evento relacionado: `S-2200`
- Descricao: evoluir o modulo atual para cobrir mais campos obrigatorios, categoria, contrato e validacoes oficiais.
- Impacto no sistema: principal fluxo de entrada de trabalhador.
- Dependencias: `S-1000`, `S-1005`, categorias de trabalhador.
- Backend necessario: `Pessoa`, `Servidor`, `Contrato`, validacoes temporais e de duplicidade.
- Frontend necessario: formulario guiado com secao civil, contratual e institucional.

### Task: Parametrizacao Avancada de Rubricas
- Evento relacionado: `S-1010`
- Descricao: evoluir rubricas para natureza oficial, incidencias e vigencia.
- Impacto no sistema: base de remuneracao e consistencia da folha.
- Dependencias: tabela 03, categorias, classificacao tributaria.
- Backend necessario: entidade `Rubrica` com natureza oficial e regras de compatibilidade.
- Frontend necessario: modulo de rubricas com campos oficiais, filtros e alertas de incompatibilidade.

## Media prioridade

### Task: Historico de Alteracao Cadastral
- Evento relacionado: `S-2205`
- Descricao: registrar e enviar alteracoes cadastrais do trabalhador.
- Impacto no sistema: manutencao confiavel do cadastro ao longo do tempo.
- Dependencias: `S-2200`, historico de pessoa, validacoes de CPF e datas.
- Backend necessario: entidade `HistoricoCadastralServidor` ou equivalente, diff entre estado anterior e novo.
- Frontend necessario: tela de alteracao cadastral e historico.

### Task: Historico de Alteracao Contratual
- Evento relacionado: `S-2206`
- Descricao: registrar mudancas de cargo, funcao, lotacao, jornada e remuneracao.
- Impacto no sistema: manutencao real do vinculo estatutario/contratual.
- Dependencias: `S-2200`, `S-1005`, `S-1020`, cargos e funcoes.
- Backend necessario: entidade `ContratoServidor` com versoes ou historico contratual.
- Frontend necessario: fluxo de alteracao contratual com linha do tempo.

### Task: Lotação Tributaria
- Evento relacionado: `S-1020`
- Descricao: modelar lotacao tributaria distinta da lotacao administrativa.
- Impacto no sistema: consistencia previdenciaria e remuneratoria.
- Dependencias: classificacao tributaria, tipos de lotacao, estabelecimentos.
- Backend necessario: entidade `LotacaoTributaria` e regras de compatibilidade.
- Frontend necessario: cadastro/listagem e vinculo nos formularios contratuais.

### Task: Gestao de Afastamentos
- Evento relacionado: `S-2230`
- Descricao: registrar afastamentos e validar motivo, datas e sobreposicao.
- Impacto no sistema: operacao real de RH e reflexos futuros na folha.
- Dependencias: `S-2200`, tabela 18.
- Backend necessario: entidade `AfastamentoServidor`, validacao de sobreposicao e vigencia.
- Frontend necessario: tela de registro e historico de afastamentos.

## Baixa prioridade

### Task: Desligamento do Servidor
- Evento relacionado: `S-2299`
- Descricao: encerrar vinculo com data e motivo oficial.
- Impacto no sistema: fechamento de ciclo do servidor.
- Dependencias: `S-2200`, tabela 19, historico contratual.
- Backend necessario: entidade ou estado de desligamento, validacao de sequencia temporal.
- Frontend necessario: fluxo de desligamento com conferencia final.

### Task: Beneficios e Pagamentos
- Evento relacionado: `S-1202`, `S-1210`
- Descricao: preparar dados remuneratorios e de pagamento para ciclo periodico.
- Impacto no sistema: entrada na folha e envio periodico.
- Dependencias: rubricas maduras, contrato, lotacao tributaria.
- Backend necessario: estrutura de calculo/remuneracao e eventos periodicos.
- Frontend necessario: painel de fechamento e conferencia.

### Task: Processos Trabalhistas
- Evento relacionado: familia `S-2500+`
- Descricao: registrar impactos de processos judiciais no cadastro e na tributacao.
- Impacto no sistema: cobertura de cenarios especializados.
- Dependencias: eventos basicos estabilizados.
- Backend necessario: modulo especifico e camadas de consolidacao.
- Frontend necessario: telas especificas de processo e decisao.
