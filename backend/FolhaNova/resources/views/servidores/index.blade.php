<x-app-layout>
    <x-slot name="header">
        Servidores
    </x-slot>

    <section class="space-y-6">
        @if (session('status'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Base cadastrada</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['total'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Vinculos prontos para operacao</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Servidores ativos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['ativos'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Base viva para folha e eventos</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Pendentes de S-2200</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['admissoes_pendentes'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Prioridade para admissao inicial</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Sem lotacao</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['sem_lotacao'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-rose-300">Revisar antes do envio governamental</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Modulo RH</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Cadastro operacional alinhado ao S-2200</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                            Esta visao concentra os vinculos funcionais e ajuda a localizar rapidamente pendencias de cadastro civil, lotacao e evento inicial de admissao.
                        </p>
                    </div>

                    <div class="flex w-full max-w-3xl flex-col gap-3 lg:items-end">
                        <a href="{{ route('servidores.create') }}" class="btn btn-info">Nova admissao</a>
                        <form method="GET" action="{{ route('servidores.index') }}" class="flex w-full flex-col gap-3 xl:flex-row xl:flex-wrap xl:items-end">
                            <label class="form-control w-full min-w-0 flex-1">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Busca</span>
                                <input
                                    type="search"
                                    name="q"
                                    value="{{ $filtros['q'] }}"
                                    placeholder="Nome, CPF, matricula ou categoria"
                                    class="input input-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500"
                                >
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Situacao</span>
                                <select name="situacao" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todas</option>
                                    <option value="ativo" @selected($filtros['situacao'] === 'ativo')>Ativo</option>
                                    <option value="afastado" @selected($filtros['situacao'] === 'afastado')>Afastado</option>
                                    <option value="desligado" @selected($filtros['situacao'] === 'desligado')>Desligado</option>
                                </select>
                            </label>

                            <div class="flex w-full flex-col gap-3 sm:flex-row xl:w-auto xl:flex-none">
                                <button type="submit" class="btn btn-info w-full sm:w-auto">Filtrar</button>
                                <a href="{{ route('servidores.index') }}" class="btn btn-ghost w-full sm:w-auto">Limpar</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Servidor</th>
                                <th>Matricula</th>
                                <th>Lotacao</th>
                                <th>Cargo</th>
                                <th>Categoria</th>
                                <th>Admissao</th>
                                <th>Status</th>
                                <th class="text-right">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($servidores as $servidor)
                                <tr>
                                    <td>
                                        <div class="font-medium text-white">{{ $servidor->pessoa?->nome_completo ?? 'Pessoa nao vinculada' }}</div>
                                        <div class="text-xs text-slate-400">{{ $servidor->pessoa?->cpf ?? 'CPF pendente' }}</div>
                                    </td>
                                    <td>{{ $servidor->matricula }}</td>
                                    <td>{{ $servidor->lotacao?->nome ?? 'Nao informada' }}</td>
                                    <td>{{ $servidor->cargo?->nome ?? 'Nao informado' }}</td>
                                    <td>{{ $servidor->categoria_esocial ?? 'Pendente' }}</td>
                                    <td>{{ optional($servidor->data_admissao)->format('d/m/Y') ?? 'Pendente' }}</td>
                                    <td>
                                        <span @class([
                                            'badge badge-outline',
                                            'badge-success' => $servidor->situacao === 'ativo',
                                            'badge-warning' => $servidor->situacao === 'afastado',
                                            'badge-error' => $servidor->situacao === 'desligado',
                                            'badge-info' => ! in_array($servidor->situacao, ['ativo', 'afastado', 'desligado'], true),
                                        ])>
                                            {{ ucfirst($servidor->situacao) }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <span class="badge badge-outline badge-info">S-2205 planejado</span>
                                            <a href="{{ route('servidores.edit', $servidor) }}" class="btn btn-outline btn-warning btn-sm">S-2206</a>
                                            <a href="{{ route('servidores.show', $servidor) }}" class="btn btn-ghost btn-sm">Abrir</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-10 text-center text-sm text-slate-400">
                                        Nenhum servidor encontrado com os filtros atuais.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $servidores->links() }}
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Campos chave para admissao</h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Dados pessoais da pessoa fisica com CPF e nascimento consistentes.</li>
                        <li>Matricula, categoria e regime previdenciario do vinculo funcional.</li>
                        <li>Lotacao e cargo prontos para refletir tabelas S-1005 e estrutura organizacional.</li>
                        <li>Rastreabilidade do evento inicial para posterior envio ao governo.</li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Proximo incremento</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Detalhe e manutencao cadastral</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        A partir desta etapa, o modulo passa a suportar consulta detalhada e correcao dos dados sem romper a trilha inicial do `S-2200`.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
