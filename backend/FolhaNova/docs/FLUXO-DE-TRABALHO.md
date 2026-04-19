# Fluxo de Trabalho

## Referência principal

O arquivo `docs/obsidian/projeto.md` passa a ser tratado como uma referência funcional e arquitetural prioritária para este repositório. Sempre que um novo módulo for iniciado, ele deve ser confrontado com esse documento antes da implementação.

## Regras operacionais

1. Trabalhar módulo por módulo.
2. Atualizar a documentação ao final de cada etapa relevante.
3. Preservar a stack oficial:
   - Laravel 11+
   - Livewire 3
   - Tailwind CSS 4
   - DaisyUI
   - Spatie Multitenancy
   - Spatie Permission
   - Telescope
   - eSocial com `nfephp-org/sped-esocial`
4. Priorizar o ambiente `WSL Ubuntu 24.04`.
5. Usar Conventional Commits.

## Fluxo sugerido por módulo

1. Ler `docs/obsidian/projeto.md` e os documentos técnicos do projeto.
2. Confirmar escopo do módulo.
3. Implementar backend, frontend e documentação em conjunto.
4. Validar migrations, build e testes aplicáveis.
5. Registrar status e próximos passos.

## Observações da fase atual

- A fundação do projeto já está criada.
- O layout base administrativo já substituiu o scaffold padrão do Breeze.
- As migrations iniciais de domínio já foram modeladas.
- O próximo módulo natural é `Cadastro de Servidor` com foco em S-2200.

## Pendência conhecida

O `projeto.md` define Pest como obrigatório. Nesta fundação, a suíte ainda está em PHPUnit por compatibilidade direta com o lock atual do Laravel 11. A migração para Pest deve ser tratada explicitamente na próxima rodada de qualidade técnica.
