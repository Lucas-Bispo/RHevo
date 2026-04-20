# Escopo Funcional RH
**Atualizado em:** 20/04/2026

## Visao do produto
- Plataforma web para operacao de RH de prefeitura ou orgao publico.
- Interface grafica para cadastros, manutencao e acompanhamento operacional.
- Backend preparado para gerar, validar, rastrear e futuramente transmitir eventos ao governo.

## Modulos prioritarios
- Cadastro do orgao publico e dados do empregador.
- Estabelecimentos, unidades e lotacoes.
- Pessoas e servidores.
- Cargos, funcoes e rubricas.
- Eventos eSocial com rastreabilidade de status, recibo e retorno.

## O que ja existe no codigo
- Modelos para `Tenant`, `Pessoa`, `Servidor`, `Lotacao`, `Cargo`, `Funcao`, `Rubrica` e `EventoEsocial`.
- Dashboard inicial.
- Nova tela operacional de `Servidores` para iniciar a frente de admissao.

## O que ainda falta
- Formularios reais de cadastro e edicao.
- Validacoes de negocio aderentes aos eventos.
- Preparacao de payload XML e camada de integracao.
- Controle operacional por tenant e por papel de usuario.
