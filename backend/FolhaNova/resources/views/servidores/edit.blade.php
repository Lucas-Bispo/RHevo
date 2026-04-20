<x-app-layout>
    <x-slot name="header">
        Editar servidor
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex flex-col gap-3 border-b border-white/10 pb-5 md:flex-row md:items-start md:justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Modulo RH</p>
                        <h2 class="text-2xl font-semibold text-white">Atualizacao cadastral do servidor</h2>
                        <p class="max-w-3xl text-sm leading-6 text-slate-300">
                            Esta tela preserva o vinculo funcional e sincroniza o payload do evento inicial pendente quando houver necessidade de correcao cadastral.
                        </p>
                    </div>

                    <a href="{{ route('servidores.show', $servidor) }}" class="btn btn-ghost">Voltar ao detalhe</a>
                </div>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-100">
                        Revise os campos destacados antes de salvar.
                    </div>
                @endif

                <form method="POST" action="{{ route('servidores.update', $servidor) }}" class="mt-6 space-y-8">
                    @csrf
                    @method('PUT')
                    @php($mode = 'edit')
                    @include('servidores.partials.form-fields')

                    <div class="flex flex-wrap items-center gap-3 border-t border-white/10 pt-6">
                        <button type="submit" class="btn btn-info">Salvar alteracoes</button>
                        <a href="{{ route('servidores.show', $servidor) }}" class="btn btn-ghost">Cancelar</a>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Registro atual</p>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li>Matricula: {{ $servidor->matricula }}</li>
                        <li>Situacao: {{ ucfirst($servidor->situacao) }}</li>
                        <li>Admissao: {{ optional($servidor->data_admissao)->format('d/m/Y') ?? 'Nao informada' }}</li>
                        <li>Ultimo evento: {{ $servidor->eventosEsocial->sortByDesc('id')->first()?->evento ?? 'Sem evento' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
