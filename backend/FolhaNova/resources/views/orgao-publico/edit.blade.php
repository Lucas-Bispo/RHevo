<x-app-layout>
    <x-slot name="header">
        Editar Orgao Publico
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Parametros do empregador</p>
                        <h2 class="text-2xl font-semibold text-white">Configuracao institucional do orgao</h2>
                        <p class="max-w-3xl text-sm leading-6 text-slate-300">
                            Ajuste os dados base do ente publico para consolidar a operacao administrativa e preparar
                            a trilha do <strong>S-1000</strong>.
                        </p>
                    </div>

                    <a href="{{ route('orgao-publico.show') }}" class="btn btn-ghost">Voltar</a>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de salvar.
                    </div>
                @endif

                <form method="POST" action="{{ route('orgao-publico.update') }}" class="mt-6 space-y-8">
                    @csrf
                    @method('PUT')
                    @include('orgao-publico.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Salvar parametros</button>
                        <a href="{{ route('orgao-publico.show') }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Tenant tecnico</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Slug: {{ $tenant->slug }}</li>
                        <li>Dominio: {{ $tenant->domain ?: 'Nao informado' }}</li>
                        <li>Base: {{ $tenant->database }}</li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Impacto da tela</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Atualiza a base institucional do tenant atual.</li>
                        <li>Gera ou sincroniza um evento `S-1000` pendente.</li>
                        <li>Evita espalhar parametros do empregador em modulos operacionais.</li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Evento atual</p>
                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        {{ $eventoS1000 ? "Ultimo status: ".ucfirst($eventoS1000->status)." em ".optional($eventoS1000->updated_at)->format('d/m/Y H:i') : 'Nenhum evento S-1000 pendente encontrado.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
