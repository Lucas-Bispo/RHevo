<x-app-layout>
    <x-slot name="header">
        Detalhe do evento eSocial
    </x-slot>

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

        <div class="grid gap-6 xl:grid-cols-[1.8fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Trilha eSocial</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">{{ $eventoEsocial->evento }}</h2>
                        <p class="mt-2 text-sm text-slate-300">
                            {{ $eventoEsocial->servidor?->pessoa?->nome_completo ?? 'Evento institucional do orgao' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @php
                            $retornoFiltro = $eventoEsocial->mensagem_retorno ? 'com_mensagem' : 'sem_mensagem';
                            $retornoLabel = $eventoEsocial->mensagem_retorno ? 'Com retorno' : 'Sem retorno';
                            $origemEvento = data_get($eventoEsocial->payload, 'origem');
                            $contextoFiltro = $eventoEsocial->servidor ? 'vinculado' : 'institucional';
                            $dataEvento = optional($eventoEsocial->updated_at)->toDateString();
                        @endphp
                        @if ($eventoEsocial->status === 'erro')
                            <div class="flex max-w-md flex-col gap-2 rounded-2xl border border-amber-400/20 bg-amber-500/10 p-3 text-sm text-amber-100">
                                <p>Evento com erro pode ser reenfileirado para reprocessamento local.</p>
                                <form method="POST" action="{{ route('eventos-esocial.reprocessar', $eventoEsocial) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Reprocessar</button>
                                </form>
                            </div>
                        @endif
                        @if ($eventoEsocial->evento === 'S-1000')
                            <form method="POST" action="{{ route('eventos-esocial.gerar-xml', $eventoEsocial) }}">
                                @csrf
                                <button type="submit" class="btn btn-info">Gerar XML local</button>
                            </form>
                        @endif
                        <a href="{{ route('eventos-esocial.index') }}" class="btn btn-ghost">Voltar para painel</a>
                        <a href="{{ route('eventos-esocial.index', ['evento' => $eventoEsocial->evento]) }}" class="btn btn-ghost">Mesmo evento</a>
                        <a href="{{ route('eventos-esocial.index', ['status' => $eventoEsocial->status]) }}" class="btn btn-ghost">Mesmo status</a>
                        <a href="{{ route('eventos-esocial.index', ['ambiente' => $eventoEsocial->ambiente]) }}" class="btn btn-ghost">Mesmo ambiente</a>
                        <a href="{{ route('eventos-esocial.index', ['contexto' => $contextoFiltro]) }}" class="btn btn-ghost">Mesmo contexto</a>
                        @if ($dataEvento)
                            <a href="{{ route('eventos-esocial.index', ['data' => $dataEvento]) }}" class="btn btn-ghost">Mesma data</a>
                        @endif
                        @if ($origemEvento)
                            <a href="{{ route('eventos-esocial.index', ['origem' => $origemEvento]) }}" class="btn btn-ghost">Mesma origem</a>
                        @endif
                        @if ($eventoEsocial->servidor)
                            <a href="{{ route('eventos-esocial.index', ['servidor' => $eventoEsocial->servidor->id]) }}" class="btn btn-ghost">Mesmo servidor</a>
                        @endif
                        <a href="{{ route('eventos-esocial.index', ['retorno' => $retornoFiltro]) }}" class="btn btn-ghost">{{ $retornoLabel }}</a>
                        @if ($eventoEsocial->servidor)
                            <a href="{{ route('servidores.show', $eventoEsocial->servidor) }}" class="btn btn-info">Abrir servidor</a>
                        @endif
                    </div>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Status</p>
                        <p class="mt-3 text-2xl font-semibold text-white">{{ ucfirst($eventoEsocial->status) }}</p>
                        <p class="mt-2 text-sm text-cyan-300">Situacao atual do processamento</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Ambiente</p>
                        <p class="mt-3 text-2xl font-semibold text-white">{{ ucfirst($eventoEsocial->ambiente) }}</p>
                        <p class="mt-2 text-sm text-emerald-300">Canal operacional</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Recibo</p>
                        <p class="mt-3 text-lg font-semibold text-white">{{ $eventoEsocial->recibo ?? 'Nao informado' }}</p>
                        <p class="mt-2 text-sm text-amber-300">Identificacao de retorno</p>
                    </div>
                    <div class="stat-card">
                        <p class="text-sm text-slate-400">Protocolo</p>
                        <p class="mt-3 text-lg font-semibold text-white">{{ $eventoEsocial->protocolo ?? 'Nao informado' }}</p>
                        <p class="mt-2 text-sm text-cyan-300">Controle de envio</p>
                    </div>
                </div>

                <div class="mt-6 grid gap-6 xl:grid-cols-2">
                    <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Contexto do evento</p>
                        <dl class="mt-4 space-y-3 text-sm text-slate-300">
                            <div class="flex items-start justify-between gap-4">
                                <dt>Origem</dt>
                                <dd class="text-right text-white">{{ data_get($eventoEsocial->payload, 'origem', 'Nao informada') }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Matricula</dt>
                                <dd class="text-right text-white">{{ $eventoEsocial->servidor?->matricula ?? 'Nao aplicavel' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Servidor</dt>
                                <dd class="text-right text-white">{{ $eventoEsocial->servidor?->pessoa?->nome_completo ?? 'Evento institucional' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Enviado em</dt>
                                <dd class="text-right text-white">{{ optional($eventoEsocial->enviado_em)->format('d/m/Y H:i') ?? 'Nao enviado' }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Processado em</dt>
                                <dd class="text-right text-white">{{ optional($eventoEsocial->processado_em)->format('d/m/Y H:i') ?? 'Nao processado' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Mensagem de retorno</p>
                        <p class="mt-4 whitespace-pre-line text-sm leading-6 text-slate-300">
                            {{ $eventoEsocial->mensagem_retorno ?: 'Nenhuma mensagem de retorno registrada ate o momento.' }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                    @php
                        $xmlS1000Pendente = $eventoEsocial->evento === 'S-1000' && blank($eventoEsocial->xml_gerado);
                    @endphp
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-400">XML oficial</p>
                            <h3 class="mt-2 text-lg font-semibold text-white">Geracao local</h3>
                        </div>
                        <div class="text-sm text-slate-300 md:text-right">
                            <p>Status: <span class="text-white">{{ $eventoEsocial->xml_validacao_status ?? 'Nao gerado' }}</span></p>
                            <p>Gerado em: <span class="text-white">{{ optional($eventoEsocial->xml_gerado_em)->format('d/m/Y H:i') ?? 'Nao gerado' }}</span></p>
                        </div>
                    </div>

                    @if ($xmlS1000Pendente)
                        <div class="mt-4 rounded-2xl border border-amber-400/20 bg-amber-500/10 p-4 text-sm leading-6 text-amber-100">
                            XML S-1000 pendente de geracao local. Gere novamente o XML depois de revisar ou alterar os parametros do orgao publico.
                        </div>
                    @endif

                    <dl class="mt-4 space-y-3 text-sm text-slate-300">
                        <div class="flex flex-col gap-1">
                            <dt>Hash SHA-256</dt>
                            <dd class="break-all text-white">{{ $eventoEsocial->xml_hash ?? 'Nao gerado' }}</dd>
                        </div>
                        <div class="flex flex-col gap-1">
                            <dt>Validacao</dt>
                            <dd class="text-white">{{ $eventoEsocial->xml_validacao_mensagem ?? 'Gere o XML local para preparar a validacao e a assinatura digital.' }}</dd>
                        </div>
                    </dl>

                    @if ($eventoEsocial->xml_gerado)
                        <pre class="mt-4 overflow-x-auto rounded-2xl border border-white/10 bg-slate-950/80 p-4 text-xs leading-6 text-slate-200">{{ $eventoEsocial->xml_gerado }}</pre>
                    @endif
                </div>

                <div class="mt-6 rounded-3xl border border-white/10 bg-slate-950/40 p-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Payload</p>
                    <h3 class="mt-2 text-lg font-semibold text-white">Estrutura registrada no sistema</h3>
                    <pre class="mt-4 overflow-x-auto rounded-2xl border border-white/10 bg-slate-950/80 p-4 text-xs leading-6 text-slate-200">{{ $payloadFormatado ?: '{}' }}</pre>
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Relacionamentos</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Lotacao: {{ $eventoEsocial->servidor?->lotacao?->nome ?? 'Nao aplicavel' }}</li>
                        <li>Cargo: {{ $eventoEsocial->servidor?->cargo?->nome ?? 'Nao aplicavel' }}</li>
                        <li>Funcao: {{ $eventoEsocial->servidor?->funcao?->nome ?? 'Nao aplicavel' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
