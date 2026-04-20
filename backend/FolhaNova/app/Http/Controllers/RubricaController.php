<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRubricaRequest;
use App\Http\Requests\UpdateRubricaRequest;
use App\Models\Rubrica;
use App\Services\Rubricas\AtualizarRubricaService;
use App\Services\Rubricas\RegistrarRubricaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RubricaController extends Controller
{
    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('status'));

        $baseQuery = Rubrica::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $rubricas = (clone $baseQuery)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('codigo', 'like', "%{$search}%")
                        ->orWhere('nome', 'like', "%{$search}%")
                        ->orWhere('natureza', 'like', "%{$search}%")
                        ->orWhere('tipo', 'like', "%{$search}%")
                        ->orWhere('codigo_esocial', 'like', "%{$search}%");
                });
            })
            ->when($status !== '', fn ($query) => $query->where('ativo', $status === 'ativos'))
            ->orderBy('nome')
            ->paginate(12)
            ->withQueryString();

        return view('rubricas.index', [
            'rubricas' => $rubricas,
            'resumo' => [
                'total' => (clone $baseQuery)->count(),
                'ativas' => (clone $baseQuery)->where('ativo', true)->count(),
                'inativas' => (clone $baseQuery)->where('ativo', false)->count(),
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
        return view('rubricas.create');
    }

    public function store(StoreRubricaRequest $request, RegistrarRubricaService $service): RedirectResponse
    {
        $rubrica = $service->execute($request->validated(), $request->user()?->tenant_id);

        return redirect()
            ->route('rubricas.index')
            ->with('status', "Rubrica {$rubrica->nome} cadastrada com sucesso.");
    }

    public function edit(Request $request, Rubrica $rubrica): View
    {
        return view('rubricas.edit', [
            'rubrica' => $this->resolveRubrica($request, $rubrica),
        ]);
    }

    public function update(UpdateRubricaRequest $request, Rubrica $rubrica, AtualizarRubricaService $service): RedirectResponse
    {
        $rubrica = $this->resolveRubrica($request, $rubrica);
        $rubrica = $service->execute($rubrica, $request->validated());

        return redirect()
            ->route('rubricas.index')
            ->with('status', "Rubrica {$rubrica->nome} atualizada com sucesso.");
    }

    private function resolveRubrica(Request $request, Rubrica $rubrica): Rubrica
    {
        return Rubrica::query()
            ->whereKey($rubrica->id)
            ->when($request->user()?->tenant_id, fn ($query, $tenantId) => $query->where('tenant_id', $tenantId))
            ->firstOrFail();
    }
}
