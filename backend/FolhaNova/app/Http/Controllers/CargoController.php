<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Cargo;
use App\Services\Cargos\AtualizarCargoService;
use App\Services\Cargos\RegistrarCargoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('status'));

        $baseQuery = Cargo::query()
            ->withCount('servidores')
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $cargos = (clone $baseQuery)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('codigo', 'like', "%{$search}%")
                        ->orWhere('nome', 'like', "%{$search}%")
                        ->orWhere('codigo_esocial', 'like', "%{$search}%");
                });
            })
            ->when($status !== '', fn ($query) => $query->where('ativo', $status === 'ativos'))
            ->orderBy('nome')
            ->paginate(12)
            ->withQueryString();

        return view('cargos.index', [
            'cargos' => $cargos,
            'resumo' => [
                'total' => (clone $baseQuery)->count(),
                'ativos' => (clone $baseQuery)->where('ativo', true)->count(),
                'inativos' => (clone $baseQuery)->where('ativo', false)->count(),
                'com_codigo_esocial' => (clone $baseQuery)->whereNotNull('codigo_esocial')->count(),
            ],
            'filtros' => [
                'q' => $search,
                'status' => $status,
            ],
        ]);
    }

    public function create(): View
    {
        return view('cargos.create');
    }

    public function store(StoreCargoRequest $request, RegistrarCargoService $service): RedirectResponse
    {
        $cargo = $service->execute($request->validated(), $request->user()?->tenant_id);

        return redirect()
            ->route('cargos.index')
            ->with('status', "Cargo {$cargo->nome} cadastrado com sucesso.");
    }

    public function edit(Request $request, Cargo $cargo): View
    {
        return view('cargos.edit', [
            'cargo' => $this->resolveCargo($request, $cargo),
        ]);
    }

    public function update(UpdateCargoRequest $request, Cargo $cargo, AtualizarCargoService $service): RedirectResponse
    {
        $cargo = $this->resolveCargo($request, $cargo);
        $cargo = $service->execute($cargo, $request->validated());

        return redirect()
            ->route('cargos.index')
            ->with('status', "Cargo {$cargo->nome} atualizado com sucesso.");
    }

    private function resolveCargo(Request $request, Cargo $cargo): Cargo
    {
        return Cargo::query()
            ->whereKey($cargo->id)
            ->when($request->user()?->tenant_id, fn ($query, $tenantId) => $query->where('tenant_id', $tenantId))
            ->firstOrFail();
    }
}
