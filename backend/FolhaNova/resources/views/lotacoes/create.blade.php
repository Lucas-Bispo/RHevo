<x-app-layout>
    <x-slot name="header">
        Nova lotacao
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura organizacional</p>
                    <h2 class="text-2xl font-semibold text-white">Cadastro de lotacao</h2>
                    <p class="max-w-3xl text-sm leading-6 text-slate-300">
                        Cadastre a estrutura administrativa que sera usada em vinculos funcionais e no mapeamento organizacional do eSocial.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de continuar.
                    </div>
                @endif

                <form method="POST" action="{{ route('lotacoes.store') }}" class="mt-6 space-y-8">
                    @csrf
                    @php($lotacao = new \App\Models\Lotacao())
                    @include('lotacoes.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Salvar lotacao</button>
                        <a href="{{ route('lotacoes.index') }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Boas praticas</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Use um codigo interno estavel e reutilizavel.</li>
                        <li>Preencha o codigo eSocial assim que a referencia oficial estiver definida.</li>
                        <li>Mantenha lotacoes inativas para preservar historico, sem reutilizar codigos antigos.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
