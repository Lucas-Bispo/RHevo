# FolhaNova - Tarefas de Performance
**Documento gerado automaticamente em:** 19 de abril de 2026
**Versão:** 1.0

## Prioridade Alta
### 1. Validar impacto do filesystem atual no WSL
**Problema identificado:**  
Projeto executado em `/mnt/c/.../OneDrive`, cenário propenso a I/O lento.

**Impacto provável:**  
Bootstrap do Laravel lento, build do frontend muito demorado e medições pouco confiáveis.

**Ação sugerida:**  
Comparar o mesmo projeto rodando no filesystem nativo do Linux no WSL.

**Dependência:**  
Ambiente duplicado ou espelhado fora de `/mnt/c`.

**Como validar:**  
Comparar `curl` da rota `/login`, `npm run build` e tempo de inicialização do backend antes/depois.

### 2. Criar baseline de benchmark do Laravel local
**Problema identificado:**  
`APP_DEBUG` ativo, `config/routes/events` sem cache e drivers `file`.

**Impacto provável:**  
Request mais caro e resultados de performance contaminados pelo modo de desenvolvimento.

**Ação sugerida:**  
Rodar uma bateria de medição com ambiente local ajustado para benchmark controlado.

**Dependência:**  
Checklist seguro para não prejudicar a experiência de desenvolvimento.

**Como validar:**  
Comparar `TTFB` e tempo total da `/login` antes e depois do ajuste.

### 3. Medir a rota `/login` no navegador com foco em FCP/LCP/TTFB
**Problema identificado:**  
Só existe evidência atual via `curl` e build output.

**Impacto provável:**  
Sem métricas de navegador, o time pode corrigir a parte errada.

**Ação sugerida:**  
Capturar waterfall e métricas de performance em navegador para a tela de login.

**Dependência:**  
Ferramenta de inspeção de rede e performance do browser.

**Como validar:**  
Registrar FCP, LCP, TTFB e tempo até interatividade da tela.

## Prioridade Média
### 4. Remover dependência externa de fontes na tela de login
**Problema identificado:**  
Fonte carregada via `fonts.bunny.net`.

**Impacto provável:**  
Mais uma dependência de rede antes do visual final ficar estável.

**Ação sugerida:**  
Testar fallback local ou hospedagem local das fontes.

**Dependência:**  
Definição do padrão tipográfico aceito pelo projeto.

**Como validar:**  
Comparar waterfall e LCP com e sem carregamento externo.

### 5. Avaliar bundle específico para autenticação
**Problema identificado:**  
A rota `/login` consome `app.css` e `app.js` globais.

**Impacto provável:**  
Carregamento de estilos e scripts além do necessário na primeira tela.

**Ação sugerida:**  
Investigar split de bundle ou folha crítica específica para autenticação.

**Dependência:**  
Mapeamento do que realmente é compartilhado com o restante da aplicação.

**Como validar:**  
Comparar tamanho dos assets e métricas de carregamento da rota.

### 6. Perfil de paint/compositing da tela de login
**Problema identificado:**  
Uso de `backdrop-filter`, gradients, sombras e animações contínuas.

**Impacto provável:**  
Custo visual em GPUs fracas e perda de fluidez.

**Ação sugerida:**  
Medir no navegador e preparar versão visualmente equivalente com composição mais barata.

**Dependência:**  
Ferramenta de performance do browser.

**Como validar:**  
Comparar frames, tempo de paint e sensação de fluidez.

## Prioridade Baixa
### 7. Revisar JS global carregado no login
**Problema identificado:**  
`axios` e alternância de tema entram no bundle global.

**Impacto provável:**  
Impacto pequeno, mas ainda acima do estritamente necessário para a primeira renderização.

**Ação sugerida:**  
Avaliar carregamento condicional ou bundle menor para autenticação.

**Dependência:**  
Decisão sobre arquitetura de assets.

**Como validar:**  
Comparar tamanho do JS e custo de execução inicial.

### 8. Refinar elementos decorativos da área hero
**Problema identificado:**  
Hero envia muitos elementos decorativos mesmo quando é apenas visual.

**Impacto provável:**  
HTML e CSS mais complexos do que o necessário na primeira tela.

**Ação sugerida:**  
Revisar quantidade de elementos e uso de SVGs decorativos.

**Dependência:**  
Validação de design.

**Como validar:**  
Comparar DOM size e paint profile antes/depois.
