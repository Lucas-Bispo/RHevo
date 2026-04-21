# Funcionalidades Existentes
**Atualizado em:** 20/04/2026

## Plataforma administrativa
- Login customizado com Livewire.
- Rotas de autenticacao auxiliares via Volt.
- Dashboard inicial.
- Perfil do usuario autenticado.
- Navegacao lateral para modulos principais.
- Modulo de parametros do orgao publico para o tenant atual.
- Painel operacional de eventos eSocial com filtros e detalhe.

## Cadastros e dominio
- Modelos e migracoes para `Tenant`, `Pessoa`, `Servidor`, `Lotacao`, `Cargo`, `Funcao`, `Rubrica` e `EventoEsocial`.
- Controle de usuarios e papeis com `spatie/laravel-permission`.
- Estrutura de tenant landlord preparada, ainda sem finder operacional.
- Edicao operacional do tenant atual com dados institucionais e parametros iniciais do `S-1000`.
- Modulo inicial de lotacoes com listagem, cadastro e edicao.
- Modulo inicial de cargos com listagem, cadastro e edicao.
- Modulo inicial de funcoes com listagem, cadastro e edicao.
- Modulo inicial de rubricas com listagem, cadastro e edicao.
- Validacao inicial de rubricas para `S-1010`, exigindo natureza eSocial (`natRubr`) numerica de 4 digitos.

## RH operacional
- Listagem de servidores com filtros por busca e situacao.
- Resumo operacional de base ativa, pendencias de `S-2200` e vinculos sem lotacao.
- Cadastro inicial de admissao com criacao de pessoa, vinculo funcional e evento eSocial pendente.
- Tela de detalhe do servidor com leitura consolidada do cadastro e dos eventos vinculados.
- Edicao do cadastro do servidor com sincronizacao do payload do `S-2200` pendente.

## eSocial
- Dependencia `nfephp-org/sped-esocial` instalada.
- Modelo `EventoEsocial` para recibo, protocolo, retorno e payload.
- Registro inicial de evento `S-1000` pendente no fluxo de configuracao do orgao publico.
- Reprocessamento local de evento eSocial com erro, retornando o registro para `pendente` sem alterar o payload.
- Registro inicial de evento `S-2200` pendente no fluxo de admissao.
- Painel para leitura de eventos institucionais e eventos vinculados a servidores.

## O que ainda nao existe em operacao real
- Atualizacoes cadastrais, afastamentos e desligamentos.
- Geracao real de XML, assinatura, envio e consulta ao governo.
