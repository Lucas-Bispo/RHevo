<x-app-layout>
    <x-slot name="header">
        Eventos eSocial
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Total de eventos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['total'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Rastreabilidade operacional</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Pendentes</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['pendentes'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Fila aguardando processamento</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Processados</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['processados'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Com trilha de retorno</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Com mensagem</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['com_retorno'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Apoio a analise operacional</p>
            </div>
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

                        <div class="flex w-full flex-col gap-3 sm:flex-row xl:w-auto xl:flex-none">
                            <button type="submit" class="btn btn-info w-full sm:w-auto">Filtrar</button>
                            <a href="{{ route('eventos-esocial.index') }}" class="btn btn-ghost w-full sm:w-auto">Limpar</a>
                        </div>
                    </form>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Evento</th>
                                <th>Origem</th>
                                <th>Ambiente</th>
                                <th>Status</th>
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
                                    <td>{{ optional($evento->updated_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('eventos-esocial.show', $evento) }}" class="btn btn-ghost btn-sm">Detalhar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-sm text-slate-400">
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
