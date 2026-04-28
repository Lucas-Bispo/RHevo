<x-app-layout>
    <x-slot name="header">
        Eventos eSocial
    </x-slot>

    @php
        $filtrosAtivos = collect([
            'Busca' => $filtros['q'],
            'Evento' => $filtros['evento'],
            'Status' => $filtros['status'] !== '' ? ucfirst($filtros['status']) : '',
            'Ambiente' => $filtros['ambiente'] !== '' ? ucfirst($filtros['ambiente']) : '',
            'Origem' => $filtros['origem'],
            'Retorno' => $filtros['retorno'] === 'com_mensagem'
                ? 'Com mensagem'
                : ($filtros['retorno'] === 'sem_mensagem' ? 'Sem mensagem' : ''),
            'Contexto' => $filtros['contexto'] === 'institucional'
                ? 'Institucional'
                : ($filtros['contexto'] === 'vinculado' ? 'Vinculado a servidor' : ''),
            'Acao' => $filtros['acao_label'],
            'Servidor' => $filtros['servidor_label'],
            'Data' => $filtros['data_label'],
        ])->filter();
    @endphp

    <section class="space-y-6">
        @if (session('status'))
            <div class="alert alert-success border-emerald-400/30 bg-emerald-500/10 text-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning border-amber-400/30 bg-amber-500/10 text-amber-100">
                {{ session('warning') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-6">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Total de eventos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['total'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Rastreabilidade operacional</p>
            </div>
            <a href="{{ route('eventos-esocial.index', ['status' => 'pendente', 'data' => $resumo['hoje']]) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Pendentes hoje</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['pendentes_hoje'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Fila recente do dia</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['status' => 'erro', 'data' => $resumo['hoje']]) }}" class="stat-card block transition hover:border-rose-400/40 hover:bg-rose-500/5 focus:outline-none focus:ring-2 focus:ring-rose-400/50">
                <p class="text-sm text-slate-400">Erros hoje</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['erros_hoje'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-rose-300">Prioridades abertas no dia</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['status' => 'pendente']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Pendentes</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['pendentes'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Fila aguardando processamento</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['status' => 'processado']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Processados</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['processados'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Com trilha de retorno</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['status' => 'erro']) }}" class="stat-card block transition hover:border-rose-400/40 hover:bg-rose-500/5 focus:outline-none focus:ring-2 focus:ring-rose-400/50">
                <p class="text-sm text-slate-400">Com erro</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['erros'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-rose-300">Prioridade para reprocessamento</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['acao' => 'reprocessamento']) }}" class="stat-card block transition hover:border-orange-400/40 hover:bg-orange-500/5 focus:outline-none focus:ring-2 focus:ring-orange-400/50">
                <p class="text-sm text-slate-400">Reprocessamento</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['reprocessaveis'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-orange-300">Eventos prontos para reenfileirar</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['retorno' => 'com_mensagem']) }}" class="stat-card block transition hover:border-sky-400/40 hover:bg-sky-500/5 focus:outline-none focus:ring-2 focus:ring-sky-400/50">
                <p class="text-sm text-slate-400">Com retorno</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['com_retorno'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-sky-300">Mensagens registradas</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['retorno' => 'sem_mensagem']) }}" class="stat-card block transition hover:border-slate-400/40 hover:bg-slate-500/5 focus:outline-none focus:ring-2 focus:ring-slate-400/50">
                <p class="text-sm text-slate-400">Sem retorno</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['sem_retorno'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-slate-300">Aguardando mensagem registrada</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1000']) }}" class="stat-card block transition hover:border-cyan-400/40 hover:bg-cyan-500/5 focus:outline-none focus:ring-2 focus:ring-cyan-400/50">
                <p class="text-sm text-slate-400">S-1000</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['s1000'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base institucional</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1010']) }}" class="stat-card block transition hover:border-sky-400/40 hover:bg-sky-500/5 focus:outline-none focus:ring-2 focus:ring-sky-400/50">
                <p class="text-sm text-slate-400">S-1010</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['s1010'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-sky-300">Rubricas</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-2200']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">S-2200</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['s2200'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Admissao inicial</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <a href="{{ route('eventos-esocial.index', ['ambiente' => 'homologacao']) }}" class="stat-card block transition hover:border-indigo-400/40 hover:bg-indigo-500/5 focus:outline-none focus:ring-2 focus:ring-indigo-400/50">
                <p class="text-sm text-slate-400">Homologacao</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['homologacao'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-indigo-300">Eventos em ambiente de teste</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['ambiente' => 'producao']) }}" class="stat-card block transition hover:border-fuchsia-400/40 hover:bg-fuchsia-500/5 focus:outline-none focus:ring-2 focus:ring-fuchsia-400/50">
                <p class="text-sm text-slate-400">Producao</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['producao'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-fuchsia-300">Eventos em ambiente definitivo</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <a href="{{ route('eventos-esocial.index', ['contexto' => 'institucional']) }}" class="stat-card block transition hover:border-cyan-400/40 hover:bg-cyan-500/5 focus:outline-none focus:ring-2 focus:ring-cyan-400/50">
                <p class="text-sm text-slate-400">Institucionais</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['institucionais'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Eventos sem vinculo funcional</p>
            </a>
            <a href="{{ route('eventos-esocial.index', ['contexto' => 'vinculado']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Vinculados</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['vinculados'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Eventos ligados a servidor</p>
            </a>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.85fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Operacao eSocial</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Painel de eventos com status e contexto</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                            Este painel consolida os eventos ja preparados pelo sistema, permitindo acompanhar
                            pendencias, ambiente, vinculo relacionado e sinais de retorno sem depender de consulta direta no banco.
                        </p>
                    </div>

                    <form method="GET" action="{{ route('eventos-esocial.index') }}" class="flex w-full flex-col gap-3 xl:flex-row xl:flex-wrap xl:items-end">
                        <label class="form-control w-full min-w-0 xl:min-w-[18rem] xl:flex-1">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Busca</span>
                            <input
                                type="search"
                                name="q"
                                value="{{ $filtros['q'] }}"
                                placeholder="Evento, matricula, nome, recibo"
                                class="input input-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500"
                            >
                        </label>

                        <label class="form-control w-full xl:w-36">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Evento</span>
                            <select name="evento" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todos</option>
                                @foreach ($eventosDisponiveis as $eventoDisponivel)
                                    <option value="{{ $eventoDisponivel }}" @selected($filtros['evento'] === $eventoDisponivel)>{{ $eventoDisponivel }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-36">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Status</span>
                            <select name="status" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todos</option>
                                <option value="pendente" @selected($filtros['status'] === 'pendente')>Pendente</option>
                                <option value="processado" @selected($filtros['status'] === 'processado')>Processado</option>
                                <option value="erro" @selected($filtros['status'] === 'erro')>Erro</option>
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-36">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Ambiente</span>
                            <select name="ambiente" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todos</option>
                                <option value="homologacao" @selected($filtros['ambiente'] === 'homologacao')>Homologacao</option>
                                <option value="producao" @selected($filtros['ambiente'] === 'producao')>Producao</option>
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-52">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Origem</span>
                            <select name="origem" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todas</option>
                                @foreach ($origensDisponiveis as $origemDisponivel)
                                    <option value="{{ $origemDisponivel }}" @selected($filtros['origem'] === $origemDisponivel)>{{ $origemDisponivel }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-44">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Retorno</span>
                            <select name="retorno" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todos</option>
                                <option value="com_mensagem" @selected($filtros['retorno'] === 'com_mensagem')>Com mensagem</option>
                                <option value="sem_mensagem" @selected($filtros['retorno'] === 'sem_mensagem')>Sem mensagem</option>
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-52">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Contexto</span>
                            <select name="contexto" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todos</option>
                                <option value="institucional" @selected($filtros['contexto'] === 'institucional')>Institucional</option>
                                <option value="vinculado" @selected($filtros['contexto'] === 'vinculado')>Vinculado a servidor</option>
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-52">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Acao</span>
                            <select name="acao" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todas</option>
                                <option value="reprocessamento" @selected($filtros['acao'] === 'reprocessamento')>Reprocessamento local</option>
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-64">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Servidor</span>
                            <select name="servidor" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                <option value="">Todos</option>
                                @foreach ($servidoresDisponiveis as $servidorDisponivel)
                                    <option value="{{ $servidorDisponivel->id }}" @selected((string) $filtros['servidor'] === (string) $servidorDisponivel->id)>
                                        {{ $servidorDisponivel->pessoa?->nome_completo ?? 'Servidor sem nome' }} - {{ $servidorDisponivel->matricula }}
                                    </option>
                                @endforeach
                            </select>
                        </label>

                        <label class="form-control w-full xl:w-44">
                            <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Data</span>
                            <input
                                type="date"
                                name="data"
                                value="{{ $filtros['data'] }}"
                                class="input input-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white"
                            >
                        </label>

                        <div class="flex w-full flex-col gap-3 sm:flex-row xl:w-auto xl:flex-none">
                            <button type="submit" class="btn btn-info w-full sm:w-auto">Filtrar</button>
                            <a href="{{ route('eventos-esocial.index') }}" class="btn btn-ghost w-full sm:w-auto">Limpar</a>
                        </div>
                    </form>
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
                        <a href="{{ route('eventos-esocial.index') }}" class="btn btn-ghost btn-sm">Limpar filtros</a>
                    </div>
                @endif

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Evento</th>
                                <th>Origem</th>
                                <th>Ambiente</th>
                                <th>Status</th>
                                <th>Retorno</th>
                                <th>Atualizado</th>
                                <th class="text-right">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($eventos as $evento)
                                <tr>
                                    <td>
                                        <p class="font-medium text-white">{{ $evento->evento }}</p>
                                        <p class="text-xs text-slate-500">{{ $evento->servidor?->matricula ?? 'Sem vinculo funcional' }}</p>
                                    </td>
                                    <td>
                                        <p>{{ data_get($evento->payload, 'origem', 'Nao informada') }}</p>
                                        <p class="text-xs text-slate-500">
                                            {{ $evento->servidor?->pessoa?->nome_completo ?? 'Evento institucional' }}
                                        </p>
                                    </td>
                                    <td>{{ ucfirst($evento->ambiente) }}</td>
                                    <td>
                                        <span class="badge badge-outline {{ $evento->status === 'processado' ? 'badge-success' : ($evento->status === 'erro' ? 'badge-error' : 'badge-warning') }}">
                                            {{ ucfirst($evento->status) }}
                                        </span>
                                    </td>
                                    <td class="max-w-xs">
                                        <p class="text-sm text-slate-300">
                                            {{ $evento->mensagem_retorno ? \Illuminate\Support\Str::limit($evento->mensagem_retorno, 90) : 'Sem retorno registrado' }}
                                        </p>
                                    </td>
                                    <td>{{ optional($evento->updated_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            @if ($evento->status === 'erro')
                                                <form method="POST" action="{{ route('eventos-esocial.reprocessar', $evento) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm">Reprocessar</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('eventos-esocial.show', $evento) }}" class="btn btn-ghost btn-sm">Detalhar</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 text-center text-sm text-slate-400">
                                        Nenhum evento encontrado com os filtros atuais.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $eventos->links() }}
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura operacional</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>O painel une eventos institucionais e eventos ligados a servidores no mesmo fluxo.</li>
                        <li>Os filtros ajudam a separar pendencias de homologacao e producao antes da integracao real.</li>
                        <li>A tela de detalhe expande payload, retorno e dados do vinculo sem misturar isso ao cadastro.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
