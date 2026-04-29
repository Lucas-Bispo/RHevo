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
    public function __construct()
    {
        // SECURITY: aplica policy em todas as rotas resource de funcoes.
        $this->authorizeResource(Funcao::class, 'funcao');
    }

    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('status'));
        $prontidao = trim((string) $request->string('prontidao'));

        $baseQuery = Funcao::query()
            ->withCount('servidores')
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $applyPronta = function ($query): void {
            $query
                ->where('ativo', true)
                ->whereNotNull('codigo_esocial');
        };

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
            ->when($prontidao === 'pronta', fn ($query) => $query->where($applyPronta))
            ->when($prontidao === 'pendente', fn ($query) => $query->whereNot($applyPronta))
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
                'sem_codigo_esocial' => (clone $baseQuery)->whereNull('codigo_esocial')->count(),
                's1040_prontas' => (clone $baseQuery)->where($applyPronta)->count(),
                's1040_pendentes' => (clone $baseQuery)->whereNot($applyPronta)->count(),
            ],
            'filtros' => [
                'q' => $search,
                'status' => $status,
                'prontidao' => $prontidao,
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
