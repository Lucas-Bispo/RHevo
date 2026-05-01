# FolhaNova - Arquitetura de Nuvem AWS

**Documento criado em:** 1 de maio de 2026  
**Versao:** 1.0

## Objetivo

Este documento registra a diretriz de infraestrutura em nuvem prevista para o projeto FolhaNova. A aplicacao sera preparada para operar em uma arquitetura AWS escalavel, segura e resiliente, usando servicos gerenciados e componentes de alta disponibilidade.

O desenho alvo considera execucao em ambiente Linux na AWS, com separacao clara entre aplicacao, banco de dados, cache, arquivos compartilhados, balanceamento de carga, seguranca de borda e escalabilidade automatica.

## Componentes Principais

### Amazon EC2

As instancias EC2 serao usadas para executar a aplicacao Laravel, workers de fila e rotinas operacionais quando necessario. A camada de aplicacao devera ser tratada como substituivel, permitindo criar novas instancias sem depender de arquivos locais persistentes.

Diretrizes:

- executar a aplicacao em instancias Linux;
- automatizar provisionamento e configuracao sempre que possivel;
- manter logs, uploads e cache fora do disco local da instancia;
- separar processos web, filas e agendamentos quando o crescimento exigir.

### Amazon RDS

O banco de dados principal sera hospedado no Amazon RDS, preferencialmente com MySQL ou MariaDB conforme compatibilidade final do projeto.

Diretrizes:

- usar backups automatizados;
- habilitar criptografia em repouso;
- restringir acesso por security groups;
- planejar Multi-AZ para ambientes de producao;
- separar credenciais por ambiente.

### Redis

O Redis sera usado para cache, filas, locks e sessoes, conforme a maturidade da aplicacao evoluir.

Diretrizes:

- usar Redis gerenciado quando possivel;
- evitar cache em disco local das instancias EC2;
- preparar Laravel para cache, queue e session drivers baseados em Redis;
- configurar TTLs e politicas de invalidação de forma explicita.

### Amazon EFS

O EFS sera usado para arquivos compartilhados que precisem sobreviver a troca de instancias EC2, especialmente quando houver multiplas instancias atendendo a aplicacao.

Diretrizes:

- armazenar arquivos compartilhados fora do disco local da EC2;
- controlar permissoes de montagem;
- avaliar uso para uploads, documentos e arquivos gerados;
- manter certificados e segredos fora do EFS sempre que possivel.

### Load Balancer

Um Load Balancer sera usado como ponto de entrada da aplicacao, distribuindo trafego entre instancias EC2 saudaveis.

Diretrizes:

- expor a aplicacao via HTTPS;
- configurar health checks;
- encaminhar trafego apenas para instancias saudaveis;
- permitir crescimento horizontal da camada web.

### AWS WAF

O AWS WAF sera usado para protecao de borda contra ataques comuns e filtros de trafego malicioso.

Diretrizes:

- aplicar regras gerenciadas da AWS;
- proteger rotas publicas e autenticacao;
- registrar eventos relevantes de seguranca;
- revisar excecoes antes de liberar regras permissivas.

### Auto Scaling

O Auto Scaling sera usado para ajustar automaticamente a quantidade de instancias EC2 conforme demanda, saude da aplicacao e metricas operacionais.

Diretrizes:

- definir metricas de escala, como CPU, memoria, fila ou requisicoes;
- manter instancias stateless;
- validar bootstrap automatico de novas instancias;
- garantir que novas instancias consigam acessar RDS, Redis, EFS e configuracoes necessarias.

## Fluxo Alvo

1. O usuario acessa o dominio publico do FolhaNova por HTTPS.
2. O trafego passa pelo AWS WAF.
3. O Load Balancer recebe a requisicao e encaminha para uma instancia EC2 saudavel.
4. A aplicacao Laravel processa a requisicao.
5. Dados persistentes sao lidos e gravados no Amazon RDS.
6. Cache, sessoes, filas e locks usam Redis.
7. Arquivos compartilhados ficam no Amazon EFS quando necessario.
8. O Auto Scaling adiciona ou remove instancias EC2 conforme as metricas definidas.

## Principios Arquiteturais

- A aplicacao deve ser preparada para escalar horizontalmente.
- Instancias EC2 nao devem guardar estado essencial em disco local.
- Dados sensiveis devem ficar protegidos por criptografia, IAM, security groups e variaveis de ambiente seguras.
- Componentes criticos devem ter estrategia de backup, monitoramento e recuperacao.
- Ambientes de desenvolvimento, homologacao e producao devem ter configuracoes isoladas.

## Impactos no Desenvolvimento

Para manter compatibilidade com a futura arquitetura AWS, o desenvolvimento do FolhaNova deve considerar:

- uso correto de variaveis `.env`;
- separacao entre storage local e storage compartilhado;
- compatibilidade com Redis para cache, filas e sessoes;
- migrations seguras para RDS;
- logs preparados para centralizacao futura;
- workers e scheduler executaveis fora do processo web;
- ausencia de dependencia em arquivos locais permanentes na EC2.

## Proximos Passos

- Detalhar diagrama da arquitetura AWS.
- Definir estrategia de ambientes: desenvolvimento, homologacao e producao.
- Escolher padrao de deploy para EC2 e Auto Scaling.
- Definir politica de backups para RDS e EFS.
- Documentar security groups, subnets e VPC.
- Planejar observabilidade com logs, metricas e alertas.
