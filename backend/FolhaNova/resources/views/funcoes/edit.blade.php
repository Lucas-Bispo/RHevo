<x-app-layout>
    <x-slot name="header">
        Editar funcao
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Estrutura funcional</p>
                        <h2 class="text-2xl font-semibold text-white">Atualizacao de funcao</h2>
                        <p class="max-w-3xl text-sm leading-6 text-slate-300">
                            Ajuste os dados da funcao preservando o cadastro usado nos vinculos existentes.
                        </p>
                    </div>

                    <a href="{{ route('funcoes.index') }}" class="btn btn-ghost">Voltar para lista</a>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de salvar.
                    </div>
                @endif

                <form method="POST" action="{{ route('funcoes.update', $funcao) }}" class="mt-6 space-y-8">
                    @csrf
                    @method('PUT')
                    @include('funcoes.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Salvar alteracoes</button>
                        <a href="{{ route('funcoes.index') }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Uso atual</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Codigo: {{ $funcao->codigo }}</li>
                        <li>Servidores vinculados: {{ $funcao->servidores()->count() }}</li>
                        <li>Status: {{ $funcao->ativo ? 'Ativa' : 'Inativa' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
