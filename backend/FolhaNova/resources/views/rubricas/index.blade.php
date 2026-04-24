<x-app-layout>
    <x-slot name="header">
        Rubricas
    </x-slot>

    @php
        $filtrosAtivos = collect([
            'Busca' => $filtros['q'],
            'Status' => $filtros['status'] === 'ativos'
                ? 'Ativas'
                : ($filtros['status'] === 'inativos' ? 'Inativas' : ''),
            'Tipo' => $filtros['tipo'] !== '' ? ucfirst($filtros['tipo']) : '',
            'Incidencia' => $filtros['incidencia'] !== '' ? strtoupper($filtros['incidencia']) : '',
            'eSocial' => $filtros['esocial'] === 'com_codigo'
                ? 'Com codigo'
                : ($filtros['esocial'] === 'sem_codigo' ? 'Sem codigo' : ''),
            'Vigencia' => match ($filtros['vigencia']) {
                'ativa' => 'Ativa',
                'futura' => 'Futura',
                'encerrada' => 'Encerrada',
                'sem_inicio' => 'Sem inicio',
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
                <p class="text-sm text-slate-400">Total de rubricas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['total'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base remuneratoria do orgao</p>
            </div>
            <a href="{{ route('rubricas.index', ['status' => 'ativos']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Ativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['ativas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Disponiveis para parametrizacao</p>
            </a>
            <a href="{{ route('rubricas.index', ['status' => 'inativos']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Inativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['inativas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Preservando historico de calculo</p>
            </a>
            <a href="{{ route('rubricas.index', ['esocial' => 'com_codigo']) }}" class="stat-card block transition hover:border-cyan-400/40 hover:bg-cyan-500/5 focus:outline-none focus:ring-2 focus:ring-cyan-400/50">
                <p class="text-sm text-slate-400">Com codigo eSocial</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['com_codigo_esocial'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base para S-1010</p>
            </a>
            <a href="{{ route('rubricas.index', ['esocial' => 'sem_codigo']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Sem codigo eSocial</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['sem_codigo_esocial'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Pendencias do S-1010</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <a href="{{ route('rubricas.index', ['tipo' => 'provento']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Proventos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['proventos'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Verbas de credito</p>
            </a>
            <a href="{{ route('rubricas.index', ['tipo' => 'desconto']) }}" class="stat-card block transition hover:border-rose-400/40 hover:bg-rose-500/5 focus:outline-none focus:ring-2 focus:ring-rose-400/50">
                <p class="text-sm text-slate-400">Descontos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['descontos'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-rose-300">Verbas redutoras</p>
            </a>
            <a href="{{ route('rubricas.index', ['tipo' => 'informativa']) }}" class="stat-card block transition hover:border-sky-400/40 hover:bg-sky-500/5 focus:outline-none focus:ring-2 focus:ring-sky-400/50">
                <p class="text-sm text-slate-400">Informativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['informativas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-sky-300">Base auxiliar do calculo</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <a href="{{ route('rubricas.index', ['incidencia' => 'irrf']) }}" class="stat-card block transition hover:border-fuchsia-400/40 hover:bg-fuchsia-500/5 focus:outline-none focus:ring-2 focus:ring-fuchsia-400/50">
                <p class="text-sm text-slate-400">IRRF</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['irrf'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-fuchsia-300">Incidencia tributavel</p>
            </a>
            <a href="{{ route('rubricas.index', ['incidencia' => 'inss']) }}" class="stat-card block transition hover:border-cyan-400/40 hover:bg-cyan-500/5 focus:outline-none focus:ring-2 focus:ring-cyan-400/50">
                <p class="text-sm text-slate-400">INSS</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['inss'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base previdenciaria</p>
            </a>
            <a href="{{ route('rubricas.index', ['incidencia' => 'fgts']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">FGTS</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['fgts'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Base fundiaria</p>
            </a>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <a href="{{ route('rubricas.index', ['vigencia' => 'ativa']) }}" class="stat-card block transition hover:border-emerald-400/40 hover:bg-emerald-500/5 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                <p class="text-sm text-slate-400">Vigencia ativa</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['vigencia_ativa'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Rubricas validas na data atual</p>
            </a>
            <a href="{{ route('rubricas.index', ['vigencia' => 'futura']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Vigencia futura</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['vigencia_futura'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Entrada programada para frente</p>
            </a>
            <a href="{{ route('rubricas.index', ['vigencia' => 'encerrada']) }}" class="stat-card block transition hover:border-rose-400/40 hover:bg-rose-500/5 focus:outline-none focus:ring-2 focus:ring-rose-400/50">
                <p class="text-sm text-slate-400">Vigencia encerrada</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['vigencia_encerrada'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-rose-300">Historico fora da janela atual</p>
            </a>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura remuneratoria</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Rubricas organizadas para folha e eSocial</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300">
                            Este modulo consolida proventos, descontos e verbas informativas com foco em incidencia,
                            governanca operacional e preparo gradual do <strong>S-1010</strong>.
                        </p>
                    </div>

                    <div class="flex w-full max-w-3xl flex-col gap-3 lg:items-end">
                        <div class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">
                            <a href="{{ route('rubricas.create') }}" class="btn btn-info">Nova rubrica</a>
                            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1010']) }}" class="btn btn-ghost">Ver S-1010 no painel</a>
                        </div>
                        <form method="GET" action="{{ route('rubricas.index') }}" class="flex w-full flex-col gap-3 xl:flex-row xl:flex-wrap xl:items-end">
                            <label class="form-control w-full min-w-0 flex-1">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Busca</span>
                                <input
                                    type="search"
                                    name="q"
                                    value="{{ $filtros['q'] }}"
                                    placeholder="Codigo, nome, natureza ou eSocial"
                                    class="input input-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white placeholder:text-slate-500"
                                >
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Status</span>
                                <select name="status" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todos</option>
                                    <option value="ativos" @selected($filtros['status'] === 'ativos')>Ativas</option>
                                    <option value="inativos" @selected($filtros['status'] === 'inativos')>Inativas</option>
                                </select>
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Tipo</span>
                                <select name="tipo" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todos</option>
                                    <option value="provento" @selected($filtros['tipo'] === 'provento')>Provento</option>
                                    <option value="desconto" @selected($filtros['tipo'] === 'desconto')>Desconto</option>
                                    <option value="informativa" @selected($filtros['tipo'] === 'informativa')>Informativa</option>
                                </select>
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Incidencia</span>
                                <select name="incidencia" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todas</option>
                                    <option value="irrf" @selected($filtros['incidencia'] === 'irrf')>IRRF</option>
                                    <option value="inss" @selected($filtros['incidencia'] === 'inss')>INSS</option>
                                    <option value="fgts" @selected($filtros['incidencia'] === 'fgts')>FGTS</option>
                                </select>
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">eSocial</span>
                                <select name="esocial" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todas</option>
                                    <option value="com_codigo" @selected($filtros['esocial'] === 'com_codigo')>Com codigo</option>
                                    <option value="sem_codigo" @selected($filtros['esocial'] === 'sem_codigo')>Sem codigo</option>
                                </select>
                            </label>

                            <label class="form-control w-full xl:w-48">
                                <span class="mb-2 text-xs uppercase tracking-[0.25em] text-slate-400">Vigencia</span>
                                <select name="vigencia" class="select select-bordered w-full border-white/10 bg-slate-950/50 text-sm text-white">
                                    <option value="">Todas</option>
                                    <option value="ativa" @selected($filtros['vigencia'] === 'ativa')>Ativa</option>
                                    <option value="futura" @selected($filtros['vigencia'] === 'futura')>Futura</option>
                                    <option value="encerrada" @selected($filtros['vigencia'] === 'encerrada')>Encerrada</option>
                                    <option value="sem_inicio" @selected($filtros['vigencia'] === 'sem_inicio')>Sem inicio</option>
                                </select>
                            </label>

                            <div class="flex w-full flex-col gap-3 sm:flex-row xl:w-auto xl:flex-none">
                                <button type="submit" class="btn btn-info w-full sm:w-auto">Filtrar</button>
                                <a href="{{ route('rubricas.index') }}" class="btn btn-ghost w-full sm:w-auto">Limpar</a>
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
                        <a href="{{ route('rubricas.index') }}" class="btn btn-ghost btn-sm">Limpar filtros</a>
                    </div>
                @endif

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Codigo</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Incidencias</th>
                                <th>Status</th>
                                <th class="text-right">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rubricas as $rubrica)
                                <tr>
                                    <td class="font-medium text-white">{{ $rubrica->codigo }}</td>
                                    <td>
                                        <p class="text-white">{{ $rubrica->nome }}</p>
                                        <p class="text-xs text-slate-500">{{ $rubrica->codigo_esocial ?? 'Sem codigo eSocial' }}</p>
                                    </td>
                                    <td>
                                        <p>{{ ucfirst($rubrica->tipo) }}</p>
                                        <p class="text-xs text-slate-500">Natureza eSocial {{ $rubrica->natureza }}</p>
                                        <p class="text-xs text-slate-500">
                                            Vigencia:
                                            {{ $rubrica->inicio_validade?->format('d/m/Y') ?? 'Nao informada' }}
                                            @if ($rubrica->fim_validade)
                                                ate {{ $rubrica->fim_validade->format('d/m/Y') }}
                                            @endif
                                        </p>
                                    </td>
                                    <td class="text-sm text-slate-300">
                                        IRRF {{ $rubrica->incide_irrf ? 'sim' : 'nao' }} /
                                        INSS {{ $rubrica->incide_inss ? 'sim' : 'nao' }} /
                                        FGTS {{ $rubrica->incide_fgts ? 'sim' : 'nao' }}
                                    </td>
                                    <td>
                                        <span class="badge badge-outline {{ $rubrica->ativo ? 'badge-success' : 'badge-warning' }}">
                                            {{ $rubrica->ativo ? 'Ativa' : 'Inativa' }}
                                        </span>
                                        @php
                                            $hoje = now()->startOfDay();
                                            $vigenciaAtual = 'Sem inicio';
                                            $vigenciaTone = 'badge-ghost';

                                            if ($rubrica->inicio_validade) {
                                                if ($rubrica->inicio_validade->gt($hoje)) {
                                                    $vigenciaAtual = 'Vigencia futura';
                                                    $vigenciaTone = 'badge-warning';
                                                } elseif ($rubrica->fim_validade && $rubrica->fim_validade->lt($hoje)) {
                                                    $vigenciaAtual = 'Vigencia encerrada';
                                                    $vigenciaTone = 'badge-error';
                                                } else {
                                                    $vigenciaAtual = 'Vigencia ativa';
                                                    $vigenciaTone = 'badge-success';
                                                }
                                            }
                                        @endphp
                                        <span class="badge badge-outline {{ $vigenciaTone }}">
                                            {{ $vigenciaAtual }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('rubricas.edit', $rubrica) }}" class="btn btn-ghost btn-sm">Editar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-sm text-slate-400">
                                        Nenhuma rubrica encontrada com os filtros atuais.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $rubricas->links() }}
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Base para S-1010</h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>A rubrica organiza a base de verbas da folha antes da integracao governamental.</li>
                        <li>As incidencias ajudam a reduzir inconsistencias futuras em calculo e envio.</li>
                        <li>A natureza deve ser informada como codigo numerico de 4 digitos para aproximar o cadastro do `natRubr`.</li>
                        <li>O codigo interno atende a operacao; o codigo eSocial prepara o espelhamento oficial.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
