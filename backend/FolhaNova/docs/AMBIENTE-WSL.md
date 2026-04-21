# Ambiente WSL Ubuntu 24.04

## Diretriz

Este projeto deve ser desenvolvido e operado localmente via `WSL Ubuntu 24.04`, mesmo quando os arquivos estiverem armazenados em caminho compartilhado do Windows.

## Regra obrigatoria

- nao usar `XAMPP`;
- nao orientar comandos com Apache/PHP/MySQL do Windows;
- nao assumir runtime local fora do `WSL Ubuntu 24.04`;
- sempre priorizar execucao, paths e validacoes dentro do ambiente Linux.

## Motivos da decisão

- maior compatibilidade com o ambiente Linux de produção;
- menor diferença entre desenvolvimento e deploy;
- melhor previsibilidade para Composer, extensões PHP e scripts de shell;
- fluxo mais seguro para certificados, permissões e automações.

## Estado atual da preparação

- WSL Ubuntu 24.04 validado
- PHP 8.3 validado
- Composer validado
- SQLite habilitado para comandos do Laravel
- SOAP habilitado para integração eSocial

## Próximos ajustes planejados

- alinhamento explícito do Node.js para versão 20;
- padronização do MySQL ou MariaDB do ambiente local;
- scripts de bootstrap reexecutáveis.
