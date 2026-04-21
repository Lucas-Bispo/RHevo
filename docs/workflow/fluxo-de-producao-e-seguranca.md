# Fluxo de Producao e Seguranca Operacional

**Atualizado em:** 20/04/2026

## Objetivo

Definir um fluxo seguro para evoluir a aplicacao sem repetir regressao de login, ambiente quebrado, build inconsistente ou perda de previsibilidade operacional.

## Problema que motivou esta regra

Nas rodadas anteriores, o projeto sofreu com uma sequencia repetida de sintomas:

- login deixava de funcionar;
- frontend perdia consistencia de assets;
- backend subia sem contexto operacional completo;
- novas alteracoes eram iniciadas antes da estabilizacao da rodada anterior.

O problema nao era apenas tecnico. Era tambem de fluxo.

## Regra principal

Nao avancar para a proxima feature enquanto a rodada atual nao estiver estavel.

Estavel, neste projeto, significa:

- login funcional;
- backend respondendo no `WSL Ubuntu 24.04`;
- build frontend valido;
- modulo alterado validado;
- teste focado passando;
- documentacao atualizada.

## Ambientes oficiais

### Desenvolvimento

- uso para microetapas pequenas;
- alteracoes locais controladas;
- foco em uma unica frente por vez.

### Homologacao local

- rebuild completo no `WSL Ubuntu 24.04`;
- dados minimos para navegacao manual;
- validacao de login, rotas principais e modulo alterado;
- execucao de testes automatizados focados.

### Producao futura

- Linux Ubuntu 24.04 em nuvem;
- mesmo principio de gates e validacoes;
- sem improviso de ambiente Windows nativo;
- sem `XAMPP`.

## Gates obrigatorios

### Gate de ambiente

- `php artisan migrate` ou estrategia segura equivalente sem erro;
- `npm run build` sem erro;
- backend respondendo no `WSL Ubuntu 24.04`.

### Gate de acesso

- `/login` responde corretamente;
- usuario local de teste existe;
- autenticacao funciona;
- primeira tela autenticada abre.

### Gate funcional

- rota principal do modulo alterado abre;
- fluxo principal do modulo foi testado;
- nao ha regressao visual relevante.

### Gate automatizado

- executar pelo menos a suite focada do modulo afetado;
- ampliar a validacao quando a rodada tocar autenticacao, eventos ou navegacao.

### Gate documental

- registrar no backlog;
- registrar na linha do tempo;
- registrar incidente, se houve.

## Politica de microetapas

Para reduzir risco, toda frente deve ser quebrada em partes menores:

1. validacao
2. payload
3. leitura operacional
4. vigencia
5. integracao futura

Ou equivalente, conforme o modulo.

Cada microetapa deve terminar com:

- teste;
- validacao minima manual;
- documentacao;
- commit coerente.

## Politica de incidente

Se qualquer um destes itens falhar:

- login;
- build;
- subida do backend;
- rota critica;
- teste focado;

entao a rodada entra em incidente.

Com incidente aberto:

- parar novas features;
- diagnosticar;
- corrigir;
- validar;
- registrar;
- so depois retomar a evolucao.

## Checklist minimo antes de seguir

- [ ] backend respondeu no `WSL Ubuntu 24.04`
- [ ] `/login` respondeu corretamente
- [ ] usuario local de teste validado
- [ ] build frontend concluido
- [ ] modulo alterado validado
- [ ] teste focado passou
- [ ] backlog atualizado
- [ ] linha do tempo atualizada

## Regras de ambiente

- sistema hospedeiro: `Windows 11`
- editor: `VS Code`
- ambiente oficial local: `WSL Ubuntu 24.04`
- producao futura: `Linux Ubuntu 24.04`
- nao usar `XAMPP`
- nao assumir `Apache/PHP/MySQL` do Windows

## Resultado esperado

Com este fluxo, o projeto passa a operar com mais previsibilidade:

- menos regressao de login;
- menos rodada grande demais;
- menos ambiente contaminado;
- mais seguranca para evoluir;
- mais clareza entre desenvolver, validar e liberar.
