# 🤝 Contribuindo com o projeto PrefRH

Este repositório segue uma estrutura organizada de branches para garantir a estabilidade do sistema nos diferentes ambientes: **Desenvolvimento**, **Homologação** e **Produção**.

---

## 🌳 Estrutura de Branches

| Branch        | Ambiente            | Descrição                                                 |
|---------------|---------------------|-----------------------------------------------------------|
| `main`        | 🟢 Produção        | Código estável em uso real pela prefeitura.                |
| `homolog`     | 🟡 Homologação     | Testes finais com dados reais e validação de usuários.     |
| `develop`     | 🔵 Desenvolvimento | Funcionalidades em desenvolvimento e testes internos.      |
| `feature/*`   |                     | Novas funcionalidades (ex: `feature/ponto-eletronico`)     |
| `bugfix/*`    |                     | Correções não críticas (ex: `bugfix/ajuste-label`)         |
| `hotfix/*`    | Produção (urgente)  | Correções críticas e urgentes em produção.                 |
| `release/*`   |                     | Preparação de uma nova versão (ex: `release/v1.0.0`)       |

---

## 🔁 Fluxo de Trabalho

### 1. Desenvolvimento de funcionalidade
```bash
git checkout develop
git checkout -b feature/folha-pagamento
# Trabalhe na funcionalidade
git commit -m "Adiciona módulo de folha de pagamento"
git push origin feature/folha-pagamento
2. Preparando uma nova versão
bash
Copiar
Editar
git checkout develop
git checkout -b release/v1.0.0
# Últimos ajustes, testes, revisões
git push origin release/v1.0.0
Após finalização:

bash
Copiar
Editar
git checkout homolog
git merge release/v1.0.0
git push origin homolog
3. Publicação em Produção
Após validação do setor de RH ou área responsável:

bash
Copiar
Editar
git checkout main
git merge homolog
git push origin main
4. Correção urgente em Produção
bash
Copiar
Editar
git checkout main
git checkout -b hotfix/ajuste-holerite
# Correção crítica
git commit -m "Corrige cálculo de holerite"
git push origin hotfix/ajuste-holerite
Depois:

bash
Copiar
Editar
git checkout main
git merge hotfix/ajuste-holerite
git checkout develop
git merge hotfix/ajuste-holerite
git checkout homolog
git merge hotfix/ajuste-holerite
✅ Regras para Pull Requests
Toda contribuição deve ser feita via branch (nunca direto na main, homolog ou develop);

Crie pull requests descritivos com o que foi feito e por quê;

Nomeie as branches seguindo o padrão:

feature/nome-funcionalidade

bugfix/descricao

hotfix/descricao

release/vX.Y.Z

🛠️ Requisitos
Escreva código limpo e documentado.

Adicione testes se aplicável.

Certifique-se que a aplicação está funcionando antes de enviar PR.

👮 Proteções recomendadas
Configure no GitHub:

Branches protegidas para main, homolog e develop;

Exigir revisão de pelo menos 1 pessoa;

CI automatizado (GitHub Actions) para testes e deploy nos merges.

