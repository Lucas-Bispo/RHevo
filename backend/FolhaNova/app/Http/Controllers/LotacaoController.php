<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLotacaoRequest;
use App\Http\Requests\UpdateLotacaoRequest;
use App\Models\Lotacao;
use App\Services\Lotacoes\AtualizarLotacaoService;
use App\Services\Lotacoes\RegistrarLotacaoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    public function __construct()
    {
        // SECURITY: aplica policy em todas as rotas resource de lotacoes.
        $this->authorizeResource(Lotacao::class, 'lotacao');
    }

    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('status'));
        $prontidao = trim((string) $request->string('prontidao'));

        $baseQuery = Lotacao::query()
            ->withCount('servidores')
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $applyPronta = function ($query): void {
            $query
                ->where('ativa', true)
                ->whereNotNull('codigo_esocial');
        };

        $lotacoes = (clone $baseQuery)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('codigo', 'like', "%{$search}%")
                        ->orWhere('nome', 'like', "%{$search}%")
                        ->orWhere('codigo_esocial', 'like', "%{$search}%");
                });
            })
            ->when($status !== '', fn ($query) => $query->where('ativa', $status === 'ativas'))
            ->when($prontidao === 'pronta', fn ($query) => $query->where($applyPronta))
            ->when($prontidao === 'pendente', fn ($query) => $query->whereNot($applyPronta))
            ->orderBy('nome')
            ->paginate(12)
            ->withQueryString();

        return view('lotacoes.index', [
            'lotacoes' => $lotacoes,
            'resumo' => [
                'total' => (clone $baseQuery)->count(),
                'ativas' => (clone $baseQuery)->where('ativa', true)->count(),
                'inativas' => (clone $baseQuery)->where('ativa', false)->count(),
                'com_codigo_esocial' => (clone $baseQuery)->whereNotNull('codigo_esocial')->count(),
                'sem_codigo_esocial' => (clone $baseQuery)->whereNull('codigo_esocial')->count(),
                's1005_prontas' => (clone $baseQuery)->where($applyPronta)->count(),
                's1005_pendentes' => (clone $baseQuery)->whereNot($applyPronta)->count(),
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
        return view('lotacoes.create');
    }

    public function store(StoreLotacaoRequest $request, RegistrarLotacaoService $service): RedirectResponse
    {
        $lotacao = $service->execute($request->validated(), $request->user()?->tenant_id);

        return redirect()
            ->route('lotacoes.index')
            ->with('status', "Lotacao {$lotacao->nome} cadastrada com sucesso.");
    }

    public function edit(Request $request, Lotacao $lotacao): View
    {
        return view('lotacoes.edit', [
            'lotacao' => $this->resolveLotacao($request, $lotacao),
        ]);
    }

    public function update(UpdateLotacaoRequest $request, Lotacao $lotacao, AtualizarLotacaoService $service): RedirectResponse
    {
        $lotacao = $this->resolveLotacao($request, $lotacao);
        $lotacao = $service->execute($lotacao, $request->validated());

        return redirect()
            ->route('lotacoes.index')
            ->with('status', "Lotacao {$lotacao->nome} atualizada com sucesso.");
    }

    private function resolveLotacao(Request $request, Lotacao $lotacao): Lotacao
    {
        return Lotacao::query()
            ->whereKey($lotacao->id)
            ->when($request->user()?->tenant_id, fn ($query, $tenantId) => $query->where('tenant_id', $tenantId))
            ->firstOrFail();
    }
}
