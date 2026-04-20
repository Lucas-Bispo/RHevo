<x-app-layout>
    <x-slot name="header">
        Detalhe do servidor
    </x-slot>

    <section class="space-y-6">
        @if (session('status'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid gap-4 lg:grid-cols-[1.8fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Modulo RH</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">{{ $servidor->pessoa?->nome_completo ?? 'Servidor sem pessoa vinculada' }}</h2>
                        <p class="mt-2 text-sm text-slate-300">Matricula {{ $servidor->matricula }} - CPF {{ $servidor->pessoa?->cpf ?? 'Pendente' }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('servidores.edit', $servidor) }}" class="btn btn-info">Editar cadastro</a>
                        <a href="{{ route('servidores.index') }}" class="btn btn-ghost">Voltar para lista</a>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Situacao</p>
                        <p class="mt-3 text-2xl font-semibold text-white">{{ ucfirst($servidor->situacao) }}</p>
                        <p class="mt-2 text-sm text-cyan-300">Acompanhamento do vinculo</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Admissao</p>
                        <p class="mt-3 text-2xl font-semibold text-white">{{ optional($servidor->data_admissao)->format('d/m/Y') ?? 'Pendente' }}</p>
                        <p class="mt-2 text-sm text-emerald-300">Base do evento inicial</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Salario base</p>
                        <p class="mt-3 text-2xl font-semibold text-white">R$ {{ number_format((float) $servidor->salario_base, 2, ',', '.') }}</p>
                        <p class="mt-2 text-sm text-amber-300">Valor atual do vinculo</p>
                    </div>
                </div>

                <div class="mt-6 grid gap-6 xl:grid-cols-2">
                    <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Dados pessoais</p>
                        <dl class="mt-4 space-y-3 text-sm text-slate-300">
                            <div class="flex items-start justify-between gap-4">
                                <dt>Nome social</dt>
                                <dd class="text-right text-white">{{ $servidor->pessoa?->nome_social ?? 'Nao informado' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Nascimento</dt>
                                <dd class="text-right text-white">{{ optional($servidor->pessoa?->data_nascimento)->format('d/m/Y') ?? 'Nao informado' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>E-mail</dt>
                                <dd class="text-right text-white">{{ $servidor->pessoa?->email ?? 'Nao informado' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Telefone</dt>
                                <dd class="text-right text-white">{{ $servidor->pessoa?->telefone ?? 'Nao informado' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Cidade / UF</dt>
                                <dd class="text-right text-white">{{ trim(($servidor->pessoa?->cidade ?? '').' / '.($servidor->pessoa?->uf ?? ''), ' /') ?: 'Nao informado' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Vinculo funcional</p>
                        <dl class="mt-4 space-y-3 text-sm text-slate-300">
                            <div class="flex items-start justify-between gap-4">
                                <dt>Tipo de vinculo</dt>
                                <dd class="text-right text-white">{{ ucfirst($servidor->tipo_vinculo) }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Categoria eSocial</dt>
                                <dd class="text-right text-white">{{ $servidor->categoria_esocial ?? 'Nao informada' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Regime previdenciario</dt>
                                <dd class="text-right text-white">{{ strtoupper($servidor->regime_previdenciario ?? 'Nao informado') }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Lotacao</dt>
                                <dd class="text-right text-white">{{ $servidor->lotacao?->nome ?? 'Nao informada' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Cargo</dt>
                                <dd class="text-right text-white">{{ $servidor->cargo?->nome ?? 'Nao informado' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Funcao</dt>
                                <dd class="text-right text-white">{{ $servidor->funcao?->nome ?? 'Nao informada' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Eventos eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Rastreabilidade atual</h3>
                    <div class="mt-4 space-y-3">
                        @forelse ($servidor->eventosEsocial->sortByDesc('id') as $evento)
                            <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="font-semibold text-white">{{ $evento->evento }}</p>
                                    <span class="badge badge-outline badge-info">{{ ucfirst($evento->status) }}</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-300">Ambiente: {{ ucfirst($evento->ambiente) }}</p>
                                <p class="mt-1 text-xs text-slate-500">Atualizado em {{ optional($evento->updated_at)->format('d/m/Y H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400">Nenhum evento vinculado a este servidor.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
