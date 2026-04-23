# Funcionalidades Existentes
**Atualizado em:** 20/04/2026

## Plataforma administrativa
- Login customizado com Livewire.
- Rotas de autenticacao auxiliares via Volt.
- Dashboard inicial.
- Triagem eSocial no dashboard com atalhos para eventos com erro, pendentes e com retorno.
- Perfil do usuario autenticado.
- Navegacao lateral para modulos principais.
- Modulo de parametros do orgao publico para o tenant atual.
- Painel operacional de eventos eSocial com filtros e detalhe.

## Cadastros e dominio
- Modelos e migracoes para `Tenant`, `Pessoa`, `Servidor`, `Lotacao`, `Cargo`, `Funcao`, `Rubrica` e `EventoEsocial`.
- Controle de usuarios e papeis com `spatie/laravel-permission`.
- Estrutura de tenant landlord preparada, ainda sem finder operacional.
- Edicao operacional do tenant atual com dados institucionais e parametros iniciais do `S-1000`.
- Classificacao tributaria do `S-1000` controlada por lista inicial de codigos suportados pelo produto.
- Compatibilidade inicial entre tipo de inscricao institucional e classificacao tributaria no `S-1000`.
- Validacao de CPF/CNPJ institucional por digito verificador no fluxo do `S-1000`.
- Leitura operacional do status de vigencia institucional do `S-1000`.
- Normalizacao da natureza juridica do `S-1000`, evitando persistencia de `natJurid` em inscricoes por CPF.
- Atalho do orgao publico para abrir o painel eSocial filtrado pela trilha `S-1000`.
- Modulo inicial de lotacoes com listagem, cadastro e edicao.
- Modulo inicial de cargos com listagem, cadastro e edicao.
- Modulo inicial de funcoes com listagem, cadastro e edicao.
- Modulo inicial de rubricas com listagem, cadastro e edicao.
- Validacao inicial de rubricas para `S-1010`, exigindo natureza eSocial (`natRubr`) numerica de 4 digitos.
- Normalizacao previa dos campos de rubrica para preservar unicidade por tenant mesmo com espacos no preenchimento.
- Normalizacao e unicidade do codigo eSocial da rubrica por tenant para evitar parametrizacao duplicada do `S-1010`.
- Filtros de rubricas por tipo, incidencia e situacao de codigo eSocial, incluindo pendencias sem codigo.
- Cards de rubricas para abrir rapidamente a listagem filtrada por status `Ativas` e `Inativas`.
- Resumo visual de filtros ativos na listagem de rubricas com acao para limpar filtros.
- Atalho de rubricas para abrir o painel eSocial filtrado pela trilha `S-1010`.
- Atalhos de revisao S-1010 na edicao de rubrica para painel eSocial e pendencias sem codigo.
- Controle inicial de vigencia das rubricas para preparar `S-1010`, com inicio obrigatorio e fim opcional validado.

## RH operacional
- Listagem de servidores com filtros por busca e situacao.
- Resumo operacional de base ativa, pendencias de `S-2200` e vinculos sem lotacao.
- Cadastro inicial de admissao com criacao de pessoa, vinculo funcional e evento eSocial pendente.
- Tela de detalhe do servidor com leitura consolidada do cadastro e dos eventos vinculados.
- Atalho do detalhe do servidor para abrir o detalhe de cada evento eSocial vinculado.
- Edicao do cadastro do servidor com sincronizacao do payload do `S-2200` pendente.

## eSocial
- Dependencia `nfephp-org/sped-esocial` instalada.
- Modelo `EventoEsocial` para recibo, protocolo, retorno e payload.
- Registro inicial de evento `S-1000` pendente no fluxo de configuracao do orgao publico.
- Reprocessamento local de evento eSocial com erro, retornando o registro para `pendente` sem alterar o payload.
- Registro inicial de evento `S-2200` pendente no fluxo de admissao.
- Painel para leitura de eventos institucionais e eventos vinculados a servidores.
- Acao de reprocessamento local direto na listagem do painel para eventos com erro.
- Resumo da mensagem de retorno exibido diretamente na listagem do painel eSocial.
- Resumo visual de filtros ativos no painel eSocial com acao para limpar filtros.
- Cards do painel eSocial para filtrar eventos por ambiente de homologacao ou producao.
- Atalhos do painel eSocial para eventos prioritarios `S-1000`, `S-1010` e `S-2200`.
- Card do painel eSocial para filtrar eventos sem mensagem de retorno registrada.
- Filtro do painel eSocial para eventos com ou sem mensagem de retorno registrada, disponivel no card e no formulario principal.
- Tela de detalhe do evento eSocial com atalhos para retornar ao painel filtrado por evento, status, ambiente ou contexto de retorno.
- Atalho do detalhe eSocial para abrir o servidor vinculado quando o evento possuir vinculo funcional.

## O que ainda nao existe em operacao real
- Atualizacoes cadastrais, afastamentos e desligamentos.
- Geracao real de XML, assinatura, envio e consulta ao governo.
