<x-app-layout>
    <x-slot name="header">
        Dashboard Operacional
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Servidores ativos</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['servidores_ativos'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-emerald-300">Base operacional do tenant</p>
            </div>

            <a href="{{ route('eventos-esocial.index', ['status' => 'pendente']) }}" class="stat-card block transition hover:border-amber-400/40 hover:bg-amber-500/5 focus:outline-none focus:ring-2 focus:ring-amber-400/50">
                <p class="text-sm text-slate-400">Eventos pendentes</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['eventos_pendentes'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-amber-300">Acompanhar fila do eSocial</p>
            </a>

            <a href="{{ route('rubricas.index', ['status' => 'ativos']) }}" class="stat-card block transition hover:border-cyan-400/40 hover:bg-cyan-500/5 focus:outline-none focus:ring-2 focus:ring-cyan-400/50">
                <p class="text-sm text-slate-400">Rubricas ativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['rubricas_ativas'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-cyan-300">Base preparada para S-1010</p>
            </a>

            <a href="{{ route('eventos-esocial.index', ['status' => 'erro']) }}" class="stat-card block transition hover:border-rose-400/40 hover:bg-rose-500/5 focus:outline-none focus:ring-2 focus:ring-rose-400/50">
                <p class="text-sm text-slate-400">Eventos com erro</p>
                <p class="mt-3 text-3xl font-semibold text-white">{{ number_format($resumo['eventos_com_erro'], 0, ',', '.') }}</p>
                <p class="mt-2 text-sm text-rose-300">Prioridade de revisao</p>
            </a>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Validacao manual</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Atalhos para testar a massa demo</h2>
                        <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-300">
                            Use estes caminhos para conferir rapidamente os fluxos entregues no localhost com dados reais do tenant demo.
                        </p>
                    </div>

                    <a href="{{ route('servidores.index') }}" class="btn btn-info btn-sm">Abrir servidores</a>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Fluxo</th>
                                <th>O que validar</th>
                                <th class="text-right">Atalho</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Orgao publico</td>
                                <td>Status de vigencia, dados institucionais e evento S-1000.</td>
                                <td class="text-right">
                                    <a href="{{ route('orgao-publico.show') }}" class="btn btn-ghost btn-sm">Abrir</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Rubricas</td>
                                <td>Filtros com codigo, sem codigo, tipo, incidencia e vigencia.</td>
                                <td class="text-right">
                                    <a href="{{ route('rubricas.index', ['esocial' => 'sem_codigo']) }}" class="btn btn-ghost btn-sm">Abrir pendencias</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Vigencia das rubricas</td>
                                <td>Base ativa, futuras programacoes e historico encerrado do `S-1010`.</td>
                                <td class="text-right">
                                    <a href="{{ route('rubricas.index', ['vigencia' => 'futura']) }}" class="btn btn-ghost btn-sm">Abrir vigencias</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Eventos eSocial</td>
                                <td>Cards por status, evento prioritario, retorno e detalhe.</td>
                                <td class="text-right">
                                    <a href="{{ route('eventos-esocial.index') }}" class="btn btn-ghost btn-sm">Abrir painel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Leitura demo</p>
                    <ul class="mt-4 space-y-3 text-sm text-slate-200">
                        <li class="flex items-center justify-between">
                            <span>Rubricas sem codigo</span>
                            <span class="badge badge-warning badge-outline">{{ number_format($resumo['rubricas_sem_codigo'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Vigencia ativa</span>
                            <span class="badge badge-success badge-outline">{{ number_format($resumo['rubricas_vigencia_ativa'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Vigencia futura</span>
                            <span class="badge badge-info badge-outline">{{ number_format($resumo['rubricas_vigencia_futura'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Vigencia encerrada</span>
                            <span class="badge badge-error badge-outline">{{ number_format($resumo['rubricas_vigencia_encerrada'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Eventos com retorno</span>
                            <span class="badge badge-info badge-outline">{{ number_format($resumo['eventos_com_retorno'], 0, ',', '.') }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Login demo</span>
                            <span class="badge badge-success badge-outline">OK</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Tenant demo</span>
                            <span class="badge badge-info badge-outline">Ativo</span>
                        </li>
                    </ul>
                </div>

                @if ($orgaoPublicoResumo)
                    <div class="panel-surface rounded-3xl p-6">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Triagem S-1000</p>
                        <h3 class="mt-3 text-xl font-semibold text-white">Base institucional</h3>
                        <dl class="mt-4 space-y-3 text-sm text-slate-200">
                            <div class="flex items-start justify-between gap-4">
                                <dt>Orgao</dt>
                                <dd class="text-right text-white">{{ $orgaoPublicoResumo['nome'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Ambiente</dt>
                                <dd class="text-right text-white">{{ $orgaoPublicoResumo['ambiente'] }}</dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Vigencia</dt>
                                <dd class="text-right">
                                    <span class="text-white">{{ $orgaoPublicoResumo['vigencia_label'] }}</span>
                                    <span class="block text-xs text-slate-500">{{ $orgaoPublicoResumo['vigencia_detail'] }}</span>
                                </dd>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <dt>Evento S-1000</dt>
                                <dd class="text-right text-white">{{ $orgaoPublicoResumo['evento_status'] }}</dd>
                            </div>
                        </dl>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="{{ route('orgao-publico.show') }}" class="btn btn-ghost btn-sm">Abrir orgao publico</a>
                            <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1000']) }}" class="btn btn-ghost btn-sm">Abrir S-1000</a>
                        </div>
                    </div>
                @endif

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Triagem S-1010</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Vigencia das rubricas</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-200">
                        <a href="{{ route('rubricas.index', ['vigencia' => 'ativa']) }}" class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 transition hover:border-emerald-400/40 hover:bg-emerald-500/5">
                            <span>Rubricas com vigencia ativa</span>
                            <span class="badge badge-success badge-outline">{{ number_format($resumo['rubricas_vigencia_ativa'], 0, ',', '.') }}</span>
                        </a>
                        <a href="{{ route('rubricas.index', ['vigencia' => 'futura']) }}" class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 transition hover:border-sky-400/40 hover:bg-sky-500/5">
                            <span>Rubricas com vigencia futura</span>
                            <span class="badge badge-info badge-outline">{{ number_format($resumo['rubricas_vigencia_futura'], 0, ',', '.') }}</span>
                        </a>
                        <a href="{{ route('rubricas.index', ['vigencia' => 'encerrada']) }}" class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 transition hover:border-rose-400/40 hover:bg-rose-500/5">
                            <span>Rubricas com vigencia encerrada</span>
                            <span class="badge badge-error badge-outline">{{ number_format($resumo['rubricas_vigencia_encerrada'], 0, ',', '.') }}</span>
                        </a>
                    </div>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Painel eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Eventos com retorno</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        Confira eventos que ja possuem mensagem de retorno registrada e depois navegue para o detalhe.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('eventos-esocial.index', ['retorno' => 'com_mensagem']) }}" class="btn btn-outline btn-info btn-sm">Abrir retornos</a>
                    </div>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Triagem eSocial</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Fila operacional</h3>
                    <div class="mt-4 space-y-3 text-sm text-slate-200">
                        <a href="{{ route('eventos-esocial.index', ['status' => 'erro']) }}" class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 transition hover:border-rose-400/40 hover:bg-rose-500/5">
                            <span>Eventos com erro</span>
                            <span class="badge badge-error badge-outline">{{ number_format($resumo['eventos_com_erro'], 0, ',', '.') }}</span>
                        </a>
                        <a href="{{ route('eventos-esocial.index', ['status' => 'pendente']) }}" class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 transition hover:border-amber-400/40 hover:bg-amber-500/5">
                            <span>Eventos pendentes</span>
                            <span class="badge badge-warning badge-outline">{{ number_format($resumo['eventos_pendentes'], 0, ',', '.') }}</span>
                        </a>
                        <a href="{{ route('eventos-esocial.index', ['retorno' => 'com_mensagem']) }}" class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-950/40 px-4 py-3 transition hover:border-sky-400/40 hover:bg-sky-500/5">
                            <span>Eventos com retorno</span>
                            <span class="badge badge-info badge-outline">{{ number_format($resumo['eventos_com_retorno'], 0, ',', '.') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
