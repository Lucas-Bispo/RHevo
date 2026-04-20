<x-app-layout>
    <x-slot name="header">
        Dashboard Operacional
    </x-slot>

    <section class="space-y-6">
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="stat-card">
                <p class="text-sm text-slate-400">Servidores ativos</p>
                <p class="mt-3 text-3xl font-semibold text-white">1.248</p>
                <p class="mt-2 text-sm text-emerald-300">+18 este mês</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Eventos pendentes</p>
                <p class="mt-3 text-3xl font-semibold text-white">37</p>
                <p class="mt-2 text-sm text-amber-300">Acompanhar fila do eSocial</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Rubricas ativas</p>
                <p class="mt-3 text-3xl font-semibold text-white">214</p>
                <p class="mt-2 text-sm text-cyan-300">Base preparada para S-1010</p>
            </div>
            <div class="stat-card">
                <p class="text-sm text-slate-400">Saúde operacional</p>
                <p class="mt-3 text-3xl font-semibold text-white">98,4%</p>
                <p class="mt-2 text-sm text-emerald-300">Observabilidade ativa</p>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="panel-surface rounded-3xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Operação diária</p>
                        <h2 class="mt-2 text-2xl font-semibold text-white">Centro de controle de RH e Folha</h2>
                    </div>

                    <a href="{{ route('servidores.index') }}" class="btn btn-info btn-sm">Abrir modulo</a>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-slate-400">
                                <th>Rotina</th>
                                <th>Status</th>
                                <th>Prazo</th>
                                <th>Responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fechamento da folha mensal</td>
                                <td><span class="badge badge-warning badge-outline">Em validação</span></td>
                                <td>Hoje, 18:00</td>
                                <td>Equipe RH</td>
                            </tr>
                            <tr>
                                <td>Envio S-2200 admissões</td>
                                <td><span class="badge badge-info badge-outline">Aguardando fila</span></td>
                                <td>Amanhã, 09:00</td>
                                <td>eSocial</td>
                            </tr>
                            <tr>
                                <td>Conferência de rubricas</td>
                                <td><span class="badge badge-success badge-outline">Concluído</span></td>
                                <td>Concluído</td>
                                <td>Folha</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Checklist técnico</p>
                    <ul class="mt-4 space-y-3 text-sm text-slate-200">
                        <li class="flex items-center justify-between">
                            <span>Laravel 11</span>
                            <span class="badge badge-success badge-outline">OK</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Livewire 3</span>
                            <span class="badge badge-success badge-outline">OK</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Telescope</span>
                            <span class="badge badge-success badge-outline">OK</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span>Multi-tenant</span>
                            <span class="badge badge-info badge-outline">Base pronta</span>
                        </li>
                    </ul>
                </div>

                <div class="panel-surface rounded-3xl p-6">
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Próximo módulo</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Painel de Eventos eSocial</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-300">
                        A fundação do projeto já suporta a próxima etapa: cadastro de pessoa, vínculo funcional, lotação, cargo, função e rastreabilidade de eventos do eSocial.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('eventos-esocial.index') }}" class="btn btn-outline btn-info btn-sm">Abrir painel</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
