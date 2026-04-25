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
        $this->authorize('viewAny', Tenant::class);
        $tenant = $this->resolveTenant($request);
        abort_if($tenant === null, 403);
        $this->authorize('view', $tenant);
        $parametros = $tenant !== null ? ($tenant->metadata['orgao_publico'] ?? []) : [];

        return view('orgao-publico.show', [
            'tenant' => $tenant,
            'parametros' => $parametros,
            'eventoS1000' => $this->resolveEventoS1000($tenant),
            'vigenciaStatus' => $this->resolveVigenciaStatus($parametros),
        ]);
    }

    public function edit(Request $request): View
    {
        $this->authorize('viewAny', Tenant::class);
        $tenant = $this->resolveTenant($request);
        abort_if($tenant === null, 403);
        $this->authorize('update', $tenant);

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
        $this->authorize('viewAny', Tenant::class);
        $tenant = $this->resolveTenant($request);
        abort_if($tenant === null, 403);
        $this->authorize('update', $tenant);

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

    /**
     * @param  array<string, mixed>  $parametros
     * @return array{label: string, detail: string, tone: string}
     */
    private function resolveVigenciaStatus(array $parametros): array
    {
        $inicio = trim((string) ($parametros['inicio_validade'] ?? ''));
        $fim = trim((string) ($parametros['fim_validade'] ?? ''));

        if ($inicio === '') {
            return [
                'label' => 'Vigencia nao definida',
                'detail' => 'Informe o inicio de validade do S-1000',
                'tone' => 'text-slate-300',
            ];
        }

        $competenciaAtual = now()->format('Y-m');

        if ($inicio > $competenciaAtual) {
            return [
                'label' => 'Vigencia futura',
                'detail' => "Inicio previsto para {$inicio}",
                'tone' => 'text-amber-300',
            ];
        }

        if ($fim !== '' && $fim < $competenciaAtual) {
            return [
                'label' => 'Vigencia encerrada',
                'detail' => "Encerrada em {$fim}",
                'tone' => 'text-rose-300',
            ];
        }

        return [
            'label' => 'Vigencia ativa',
            'detail' => $fim !== '' ? "Ativa ate {$fim}" : 'Ativa sem fim informado',
            'tone' => 'text-emerald-300',
        ];
    }
}
