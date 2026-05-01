<x-app-layout>
    <x-slot name="header">
        Lotacoes
    </x-slot>

    @php
        $filtrosAtivos = collect([
            'Busca' => $filtros['q'],
            'Status' => $filtros['status'] === 'ativas'
                ? 'Ativas'
                : ($filtros['status'] === 'inativas' ? 'Inativas' : ''),
            'Prontidao S-1005/S-1020' => match ($filtros['prontidao']) {
                'pronta' => 'Pronta',
                'pendente' => 'Com pendencias',
                default => '',
            },
        ])->filter();
    @endphp

    <section class="space-y-6">
        @if (session('status'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Total de lotacoes</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['total'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base estrutural do orgao</p>
            </div>
            <a href="{{ route('lotacoes.index', ['status' => 'ativas']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Ativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['ativas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Disponiveis para vinculos</p>
            </a>
            <a href="{{ route('lotacoes.index', ['status' => 'inativas']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Inativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['inativas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Revisar uso historico</p>
            </a>
            <a href="{{ route('lotacoes.index', ['prontidao' => 'pronta']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Prontas S-1005/S-1020</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['s1005_prontas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Ativas com codigo eSocial</p>
            </a>
            <a href="{{ route('lotacoes.index', ['prontidao' => 'pendente']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Pendencias S-1005/S-1020</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['s1005_pendentes'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Revisar codigo ou status</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Com codigo eSocial</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['com_codigo_esocial'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base para S-1005</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Sem codigo eSocial</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['sem_codigo_esocial'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Pendencia estrutural</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura organizacional</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Lotações da administração pública</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                            Este módulo organiza setores, departamentos, secretarias e unidades que sustentam os vínculos funcionais e o mapeamento estrutural do eSocial.
                        </p>
                    </div>

                    <div class="flex w-full max-w-3xl flex-col gap-3 lg:items-end">
                        <a href="{{ route('lotacoes.create') }}" class="btn btn-info">Nova lotacao</a>
                        <form method="GET" action="{{ route('lotacoes.index') }}" class="flex w-full flex-col gap-3 xl:flex-row xl:flex-wrap xl:items-end">
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
                                    <option value="">Todas</option>
                                    <option value="ativas" @selected($filtros['status'] === 'ativas')>Ativas</option>
                                    <option value="inativas" @selected($filtros['status'] === 'inativas')>Inativas</option>
                                </select>
                            </label>

                            <label class="form-control w-full xl:w-60">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Prontidao</span>
                                <select name="prontidao" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todas</option>
                                    <option value="pronta" @selected($filtros['prontidao'] === 'pronta')>Pronta S-1005/S-1020</option>
                                    <option value="pendente" @selected($filtros['prontidao'] === 'pendente')>Com pendencias</option>
                                </select>
                            </label>

                            <div class="flex w-full flex-col gap-3 sm:flex-row xl:w-auto xl:flex-none">
                                <button type="submit" class="btn btn-info w-full sm:w-auto">Filtrar</button>
                                <a href="{{ route('lotacoes.index') }}" class="btn btn-ghost w-full sm:w-auto">Limpar</a>
                            </div>
                        </form>
                    </div>
                </div>

                @if ($filtrosAtivos->isNotEmpty())
                    <div class="mt-6 flex flex-col gap-3 rounded-2xl border border-cyan-400/20 bg-cyan-500/10 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-cyan-200">Filtros ativos</p>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach ($filtrosAtivos as $rotulo => $valor)
                                    <span class="badge badge-outline badge-info">{{ $rotulo }}: {{ $valor }}</span>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('lotacoes.index') }}" class="btn btn-ghost btn-sm">Limpar filtros</a>
                    </div>
                @endif

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Codigo</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>eSocial</th>
                                <th>Servidores</th>
                                <th>Status</th>
                                <th class="text-right">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lotacoes as $lotacao)
                                <tr>
                                    <td class="font-medium text-white">{{ $lotacao->codigo }}</td>
                                    <td>{{ $lotacao->nome }}</td>
                                    <td>{{ \App\Support\Esocial\TiposLotacao::label($lotacao->tipo) ?? ucfirst($lotacao->tipo) }}</td>
                                    <td>{{ $lotacao->codigo_esocial ?? 'Nao informado' }}</td>
                                    <td>{{ number_format($lotacao->servidores_count, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-outline {{ $lotacao->ativa ? 'badge-success' : 'badge-warning' }}">
                                            {{ $lotacao->ativa ? 'Ativa' : 'Inativa' }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('lotacoes.edit', $lotacao) }}" class="btn btn-ghost btn-sm">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 text-center text-sm text-slate-400">
                                        Nenhuma lotacao encontrada com os filtros atuais.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $lotacoes->links() }}
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Base para S-1005/S-1020</h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Cada lotacao organiza a estrutura administrativa do orgao.</li>
                        <li>O codigo interno serve ao sistema; o codigo eSocial prepara o espelhamento governamental.</li>
                        <li>Lotações prontas nesta etapa sao ativas e possuem codigo eSocial informado.</li>
                        <li>Esse cadastro alimenta a qualidade dos vinculos de servidores.</li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Proximo incremento</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Cargos e funcoes</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        A consolidacao de lotacoes abre o caminho para estruturar cargos e funcoes no mesmo padrao e fortalecer o cadastro funcional.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
