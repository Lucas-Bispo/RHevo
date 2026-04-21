<x-app-layout>
    <x-slot name="header">
        Cargos
    </x-slot>

    <section class="space-y-6">
        @if (session('status'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Total de cargos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['total'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base ocupacional do orgao</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Ativos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['ativos'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Disponiveis para vinculos</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Inativos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['inativos'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Preservando historico</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Com codigo eSocial</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['com_codigo_esocial'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base para S-1030</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura ocupacional</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Cargos estruturados para RH e eSocial</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                            Este modulo organiza os cargos que sustentam os vinculos funcionais e a padronizacao ocupacional exigida pelo sistema.
                        </p>
                    </div>

                    <div class="flex w-full max-w-3xl flex-col gap-3 lg:items-end">
                        <a href="{{ route('cargos.create') }}" class="btn btn-info">Novo cargo</a>
                        <form method="GET" action="{{ route('cargos.index') }}" class="flex w-full flex-col gap-3 xl:flex-row xl:flex-wrap xl:items-end">
                            <label class="form-control w-full min-w-0 flex-1">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Busca</span>
                                <input
                                    type="search"
                                    name="q"
                                    value="{{ $filtros['q'] }}"
                                    placeholder="Codigo, nome ou referencia eSocial"
                                    class="input input-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500"
                                >
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Status</span>
                                <select name="status" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todos</option>
                                    <option value="ativos" @selected($filtros['status'] === 'ativos')>Ativos</option>
                                    <option value="inativos" @selected($filtros['status'] === 'inativos')>Inativos</option>
                                </select>
                            </label>

                            <div class="flex w-full flex-col gap-3 sm:flex-row xl:w-auto xl:flex-none">
                                <button type="submit" class="btn btn-info w-full sm:w-auto">Filtrar</button>
                                <a href="{{ route('cargos.index') }}" class="btn btn-ghost w-full sm:w-auto">Limpar</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Codigo</th>
                                <th>Nome</th>
                                <th>eSocial</th>
                                <th>Servidores</th>
                                <th>Status</th>
                                <th class="text-right">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cargos as $cargo)
                                <tr>
                                    <td class="font-medium text-white">{{ $cargo->codigo }}</td>
                                    <td>{{ $cargo->nome }}</td>
                                    <td>{{ $cargo->codigo_esocial ?? 'Nao informado' }}</td>
                                    <td>{{ number_format($cargo->servidores_count, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-outline {{ $cargo->ativo ? 'badge-success' : 'badge-warning' }}">
                                            {{ $cargo->ativo ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-ghost btn-sm">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-sm text-slate-400">
                                        Nenhum cargo encontrado com os filtros atuais.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $cargos->links() }}
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Base para S-1030</h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>O cargo estabiliza a classificacao ocupacional do vinculo.</li>
                        <li>O codigo interno serve a operacao; o codigo eSocial prepara o espelhamento governamental.</li>
                        <li>Esse cadastro reduz inconsistencias na admissao e nas futuras alteracoes contratuais.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
