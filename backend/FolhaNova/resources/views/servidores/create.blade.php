<x-app-layout>
    <x-slot name="header">
        Nova admissao
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Modulo RH</p>
                    <h2 class="text-2xl font-semibold text-white">Cadastro inicial de servidor</h2>
                    <p class="max-w-3xl text-sm leading-6 text-slate-300">
                        Este fluxo cria os dados civis da pessoa, registra o vinculo funcional e abre um evento eSocial <strong>S-2200</strong> com status pendente para rastreabilidade.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de continuar.
                    </div>
                @endif

                <form method="POST" action="{{ route('servidores.store') }}" class="mt-6 space-y-8">
                    @csrf
                    @php($servidor = new \App\Models\Servidor())
                    @php($mode = 'create')
                    @include('servidores.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Registrar admissao</button>
                        <a href="{{ route('servidores.index') }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Saida desta etapa</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Cadastro de pessoa civil vinculada ao tenant.</li>
                        <li>Registro do vinculo funcional com matricula unica por tenant.</li>
                        <li>Evento `S-2200` criado como pendente para acompanhamento.</li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Dependencias</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Lotacoes, cargos e funcoes podem ser preenchidos gradualmente.</li>
                        <li>Validacoes mais profundas de eSocial ficam para a proxima iteracao.</li>
                        <li>Integracao governamental continua desacoplada desta primeira entrega operacional.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
