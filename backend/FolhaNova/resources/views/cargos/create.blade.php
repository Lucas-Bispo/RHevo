<x-app-layout>
    <x-slot name="header">
        Novo cargo
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura ocupacional</p>
                    <h2 class="text-2xl font-semibold text-white">Cadastro de cargo</h2>
                    <p class="max-w-3xl text-sm leading-6 text-slate-300">
                        Cadastre o cargo que sera utilizado nos vinculos funcionais e na modelagem ocupacional do eSocial.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de continuar.
                    </div>
                @endif

                <form method="POST" action="{{ route('cargos.store') }}" class="mt-6 space-y-8">
                    @csrf
                    @php($cargo = new \App\Models\Cargo())
                    @include('cargos.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Salvar cargo</button>
                        <a href="{{ route('cargos.index') }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Boas praticas</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Mantenha um codigo interno estavel e reutilizavel.</li>
                        <li>Descreva o papel do cargo para melhorar manutencao futura.</li>
                        <li>Use inativacao para preservar historico, evitando reaproveitamento indevido.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
