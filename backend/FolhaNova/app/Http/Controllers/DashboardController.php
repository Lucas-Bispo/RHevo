<?php

namespace App\Http\Controllers;

use App\Models\EventoEsocial;
use App\Models\Rubrica;
use App\Models\Servidor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;

        $servidores = Servidor::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));
        $rubricas = Rubrica::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));
        $eventos = EventoEsocial::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        return view('dashboard', [
            'resumo' => [
                'servidores_ativos' => (clone $servidores)->where('situacao', 'ativo')->count(),
                'eventos_pendentes' => (clone $eventos)->where('status', 'pendente')->count(),
                'rubricas_ativas' => (clone $rubricas)->where('ativo', true)->count(),
                'eventos_com_erro' => (clone $eventos)->where('status', 'erro')->count(),
                'rubricas_sem_codigo' => (clone $rubricas)->whereNull('codigo_esocial')->count(),
                'eventos_com_retorno' => (clone $eventos)->whereNotNull('mensagem_retorno')->count(),
            ],
        ]);
    }
}
