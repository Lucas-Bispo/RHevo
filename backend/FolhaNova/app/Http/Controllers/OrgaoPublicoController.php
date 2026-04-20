<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrgaoPublicoRequest;
use App\Models\EventoEsocial;
use App\Models\Tenant;
use App\Services\OrgaoPublico\AtualizarParametrosOrgaoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrgaoPublicoController extends Controller
{
    public function show(Request $request): View
    {
        $tenant = $this->resolveTenant($request);
        $parametros = $tenant !== null ? ($tenant->metadata['orgao_publico'] ?? []) : [];

        return view('orgao-publico.show', [
            'tenant' => $tenant,
            'parametros' => $parametros,
            'eventoS1000' => $this->resolveEventoS1000($tenant),
        ]);
    }

    public function edit(Request $request): View
    {
        $tenant = $this->resolveTenant($request);
        abort_if($tenant === null, 404);

        return view('orgao-publico.edit', [
            'tenant' => $tenant,
            'parametros' => $tenant->metadata['orgao_publico'] ?? [],
            'eventoS1000' => $this->resolveEventoS1000($tenant),
        ]);
    }

    public function update(
        UpdateOrgaoPublicoRequest $request,
        AtualizarParametrosOrgaoService $service
    ): RedirectResponse {
        $tenant = $this->resolveTenant($request);
        abort_if($tenant === null, 404);

        $tenant = $service->execute($tenant, $request->validated());

        return redirect()
            ->route('orgao-publico.show')
            ->with('status', "Parametros de {$tenant->name} atualizados com sucesso.");
    }

    private function resolveTenant(Request $request): ?Tenant
    {
        $tenantId = $request->user()?->tenant_id;

        if ($tenantId === null) {
            return null;
        }

        return Tenant::query()->find($tenantId);
    }

    private function resolveEventoS1000(?Tenant $tenant): ?EventoEsocial
    {
        if ($tenant === null) {
            return null;
        }

        return EventoEsocial::query()
            ->where('tenant_id', $tenant->id)
            ->whereNull('servidor_id')
            ->where('evento', 'S-1000')
            ->latest('id')
            ->first();
    }
}
