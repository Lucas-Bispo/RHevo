<x-app-layout>
    <x-slot name="header">
        Orgao Publico
    </x-slot>

    @php
        $tipoInscricao = $parametros['tipo_inscricao'] ?? null;
        $naturezaJuridicaLabel = $tipoInscricao === '2'
            ? 'Nao se aplica para inscricao por CPF'
            : ($parametros['natureza_juridica'] ?? 'Nao informada');
        $classificacoesTributarias = [
            '21' => '21 - Pessoa fisica equiparada / contexto por CPF',
            '85' => '85 - Administracao publica direta, autarquias e fundacoes',
        ];
        $classificacaoTributaria = $parametros['classificacao_tributaria'] ?? null;
        $classificacaoTributariaLabel = $classificacaoTributaria
            ? ($classificacoesTributarias[$classificacaoTributaria] ?? $classificacaoTributaria)
            : 'Nao informada';
        $vigenciaLabel = isset($parametros['inicio_validade'])
            ? (($parametros['inicio_validade'] ?? 'Nao definido').' ate '.($parametros['fim_validade'] ?? 'Em aberto'))
            : 'Nao definida';
    @endphp

    <section class="space-y-6">
        @if (session('status'))
            <div class="rounded-2xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100">
                {{ session('status') }}
            </div>
        @endif

        @if ($tenant === null)
            <div class="panel-surface rounded-3xl p-6">
                <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Modulo estrutural</p>
                <h2 class="mt-3 text-2xl font-semibold text-white">Nenhum orgao publico vinculado ao usuario atual</h2>
                <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-300">
                    O modulo de parametros do orgao depende de um tenant ativo para centralizar as informacoes do
                    empregador no fluxo do <strong>S-1000</strong>. O login segue funcional, mas esta conta ainda nao
                    possui vinculo operacional com um orgao cadastrado.
                </p>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="stat-card">
                    <p class="text-sm text-slate-400">Nome do orgao</p>
                    <p class="mt-3 text-2xl font-semibold text-white">{{ $tenant->name }}</p>
                    <p class="mt-2 text-sm text-cyan-300">Base administrativa do tenant</p>
                </div>
                <div class="stat-card">
                    <p class="text-sm text-slate-400">Inscricao</p>
                    <p class="mt-3 text-2xl font-semibold text-white">{{ $parametros['numero_inscricao'] ?? 'Nao informada' }}</p>
                    <p class="mt-2 text-sm text-emerald-300">Identificacao do S-1000</p>
                </div>
                <div class="stat-card">
                    <p class="text-sm text-slate-400">Inicio de validade</p>
                    <p class="mt-3 text-2xl font-semibold text-white">{{ $parametros['inicio_validade'] ?? 'Nao definido' }}</p>
                    <p class="mt-2 text-sm {{ $vigenciaStatus['tone'] }}">{{ $vigenciaStatus['label'] }}</p>
                </div>
                <div class="stat-card">
                    <p class="text-sm text-slate-400">Evento S-1000</p>
                    <p class="mt-3 text-2xl font-semibold text-white">{{ $eventoS1000?->status ? ucfirst($eventoS1000->status) : 'Nao gerado' }}</p>
                    <p class="mt-2 text-sm text-cyan-300">Rastreabilidade inicial do ente</p>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
                <div class="panel-surface rounded-3xl p-6">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Parametros do empregador</p>
                            <h2 class="mt-2 text-2xl font-semibold text-white">Base do orgao publico para RH e eSocial</h2>
                            <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-300">
                                Este modulo centraliza as informacoes principais do ente publico e prepara a trilha
                                inicial do evento <strong>S-1000</strong> sem acoplar a operacao diaria a detalhes de integracao.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('orgao-publico.edit') }}" class="btn btn-info">Editar parametros</a>
                            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1000']) }}" class="btn btn-ghost">Ver S-1000 no painel</a>
                            <a href="{{ route('dashboard') }}" class="btn btn-ghost">Voltar ao dashboard</a>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 xl:grid-cols-2">
                        <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Identificacao institucional</p>
                            <dl class="mt-4 space-y-3 text-sm text-slate-300">
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Slug tecnico</dt>
                                    <dd class="text-right text-white">{{ $tenant->slug }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Dominio</dt>
                                    <dd class="text-right text-white">{{ $tenant->domain ?: 'Nao informado' }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Tipo de inscricao</dt>
                                    <dd class="text-right text-white">
                                        {{ ($parametros['tipo_inscricao'] ?? null) === '2' ? 'CPF' : (($parametros['tipo_inscricao'] ?? null) === '1' ? 'CNPJ' : 'Nao informado') }}
                                    </dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Numero de inscricao</dt>
                                    <dd class="text-right text-white">{{ $parametros['numero_inscricao'] ?? 'Nao informado' }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Natureza juridica</dt>
                                    <dd class="text-right text-white">{{ $naturezaJuridicaLabel }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Configuracao eSocial</p>
                            <dl class="mt-4 space-y-3 text-sm text-slate-300">
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Classificacao tributaria</dt>
                                    <dd class="text-right text-white">{{ $classificacaoTributariaLabel }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Ambiente</dt>
                                    <dd class="text-right text-white">{{ ucfirst($parametros['ambiente_esocial'] ?? 'homologacao') }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Inicio de validade</dt>
                                    <dd class="text-right text-white">{{ $parametros['inicio_validade'] ?? 'Nao definido' }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Fim de validade</dt>
                                    <dd class="text-right text-white">{{ $parametros['fim_validade'] ?? 'Em aberto' }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Janela de vigencia</dt>
                                    <dd class="text-right text-white">{{ $vigenciaLabel }}</dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Status de vigencia</dt>
                                    <dd class="text-right">
                                        <span class="{{ $vigenciaStatus['tone'] }}">{{ $vigenciaStatus['label'] }}</span>
                                        <span class="block text-xs text-slate-500">{{ $vigenciaStatus['detail'] }}</span>
                                    </dd>
                                </div>
                                <div class="flex items-start justify-between gap-4">
                                    <dt>Contato</dt>
                                    <dd class="text-right text-white">{{ $parametros['contato_nome'] ?? 'Nao informado' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="panel-surface rounded-3xl p-6">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Evento atual</p>
                        <h3 class="mt-3 text-xl font-semibold text-white">Trilha do S-1000</h3>
                        @if ($eventoS1000)
                            <div class="mt-4 rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="font-semibold text-white">{{ $eventoS1000->evento }}</p>
                                    <span class="badge badge-outline badge-info">{{ ucfirst($eventoS1000->status) }}</span>
                                </div>
                                <p class="mt-2 text-sm text-slate-300">Ambiente: {{ ucfirst($eventoS1000->ambiente) }}</p>
                                <p class="mt-1 text-xs text-slate-500">Atualizado em {{ optional($eventoS1000->updated_at)->format('d/m/Y H:i') }}</p>
                                <div class="mt-4 flex flex-wrap gap-3">
                                    <a href="{{ route('eventos-esocial.show', $eventoS1000) }}" class="btn btn-ghost btn-sm">Detalhar evento</a>
                                    <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1000']) }}" class="btn btn-ghost btn-sm">Abrir S-1000 no painel</a>
                                </div>
                            </div>
                        @else
                            <p class="mt-4 text-sm text-slate-400">Nenhum evento S-1000 foi preparado ainda.</p>
                            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1000']) }}" class="btn btn-ghost btn-sm mt-4">Abrir S-1000 no painel</a>
                        @endif
                    </div>

                    <div class="panel-surface rounded-3xl p-6">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura funcional</p>
                        <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                            <li>O modulo concentra os parametros do ente publico antes das tabelas e dos vinculos.</li>
                            <li>As informacoes ficam preservadas no tenant e espelhadas em um payload inicial de S-1000.</li>
                            <li>As rotinas de RH passam a nascer sobre uma base institucional mais consistente.</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </section>
</x-app-layout>
