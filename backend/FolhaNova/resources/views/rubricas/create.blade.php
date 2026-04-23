<x-app-layout>
    <x-slot name="header">
        Nova rubrica
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura remuneratoria</p>
                    <h2 class="text-2xl font-semibold text-white">Cadastro de rubrica</h2>
                    <p class="max-w-3xl text-sm leading-6 text-slate-300">
                        Cadastre a rubrica que sera usada na base remuneratoria, observando natureza, tipo e incidencias
                        para manter a evolucao da folha alinhada ao <strong>S-1010</strong>.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de continuar.
                    </div>
                @endif

                <form method="POST" action="{{ route('rubricas.store') }}" class="mt-6 space-y-8">
                    @csrf
                    @php($rubrica = new \App\Models\Rubrica())
                    @include('rubricas.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Salvar rubrica</button>
                        <a href="{{ route('rubricas.index') }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Boas praticas</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Mantenha um codigo interno estavel e legivel para a equipe da folha.</li>
                        <li>Defina a incidencia com clareza para evitar retrabalho quando a folha crescer.</li>
                        <li>Prefira inativacao em vez de reaproveitar rubricas antigas com outro significado.</li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Apoio S-1010</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Trilha de parametrizacao</h3>
                    <div class="mt-4 flex flex-col gap-3">
                        <a href="{{ route('eventos-esocial.index', ['evento' => 'S-1010']) }}" class="btn btn-ghost btn-sm">Ver S-1010 no painel</a>
                        <a href="{{ route('rubricas.index', ['esocial' => 'sem_codigo']) }}" class="btn btn-ghost btn-sm">Ver pendencias sem codigo</a>
                        <a href="{{ route('rubricas.index', ['esocial' => 'com_codigo']) }}" class="btn btn-ghost btn-sm">Ver rubricas com codigo</a>
                        <a href="{{ route('rubricas.index', ['status' => 'ativos']) }}" class="btn btn-ghost btn-sm">Ver rubricas ativas</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
