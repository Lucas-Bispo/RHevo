<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncaoRequest;
use App\Http\Requests\UpdateFuncaoRequest;
use App\Models\Funcao;
use App\Services\Funcoes\AtualizarFuncaoService;
use App\Services\Funcoes\RegistrarFuncaoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FuncaoController extends Controller
{
    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('status'));

        $baseQuery = Funcao::query()
            ->withCount('servidores')
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $funcoes = (clone $baseQuery)
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

        return view('funcoes.index', [
            'funcoes' => $funcoes,
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
        return view('funcoes.create');
    }

    public function store(StoreFuncaoRequest $request, RegistrarFuncaoService $service): RedirectResponse
    {
        $funcao = $service->execute($request->validated(), $request->user()?->tenant_id);

        return redirect()
            ->route('funcoes.index')
            ->with('status', "Funcao {$funcao->nome} cadastrada com sucesso.");
    }

    public function edit(Request $request, Funcao $funcao): View
    {
        return view('funcoes.edit', [
            'funcao' => $this->resolveFuncao($request, $funcao),
        ]);
    }

    public function update(UpdateFuncaoRequest $request, Funcao $funcao, AtualizarFuncaoService $service): RedirectResponse
    {
        $funcao = $this->resolveFuncao($request, $funcao);
        $funcao = $service->execute($funcao, $request->validated());

        return redirect()
            ->route('funcoes.index')
            ->with('status', "Funcao {$funcao->nome} atualizada com sucesso.");
    }

    private function resolveFuncao(Request $request, Funcao $funcao): Funcao
    {
        return Funcao::query()
            ->whereKey($funcao->id)
            ->when($request->user()?->tenant_id, fn ($query, $tenantId) => $query->where('tenant_id', $tenantId))
            ->firstOrFail();
    }
}
