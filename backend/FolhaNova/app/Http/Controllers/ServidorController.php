<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServidorRequest;
use App\Http\Requests\UpdateServidorRequest;
use App\Models\Cargo;
use App\Models\Funcao;
use App\Models\Lotacao;
use App\Models\Servidor;
use App\Services\Servidores\AtualizarServidorService;
use App\Services\Servidores\RegistrarAdmissaoService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ServidorController extends Controller
{
    public function __construct()
    {
        // SECURITY: aplica policy em todas as rotas resource de servidor.
        $this->authorizeResource(Servidor::class, 'servidor');
    }

    /**
     * Lista operacional inicial de servidores com foco no modulo de admissao.
     */
    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('situacao'));
        $prontidao = trim((string) $request->string('prontidao'));

        $baseQuery = Servidor::query()
            ->with(['pessoa', 'lotacao', 'cargo'])
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $servidores = (clone $baseQuery)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('matricula', 'like', "%{$search}%")
                        ->orWhere('categoria_esocial', 'like', "%{$search}%")
                        ->orWhereHas('pessoa', fn ($personQuery) => $personQuery
                            ->where('nome_completo', 'like', "%{$search}%")
                            ->orWhere('cpf', 'like', "%{$search}%"));
                });
            })
            ->when($status !== '', fn ($query) => $query->where('situacao', $status))
            ->when($prontidao !== '', fn ($query) => $this->applyProntidaoS2200Filter($query, $prontidao))
            ->orderByDesc('data_admissao')
            ->orderBy('matricula')
            ->paginate(12)
            ->withQueryString();

        $resumo = [
            'total' => (clone $baseQuery)->count(),
            'ativos' => (clone $baseQuery)->where('situacao', 'ativo')->count(),
            'admissoes_pendentes' => (clone $baseQuery)
                ->whereDoesntHave('eventosEsocial', fn ($query) => $query->where('evento', 'S-2200'))
                ->count(),
            'sem_lotacao' => (clone $baseQuery)->whereNull('lotacao_id')->count(),
            's2200_prontos' => $this->countByProntidaoS2200(clone $baseQuery, 'pronto'),
            's2200_pendentes' => $this->countByProntidaoS2200(clone $baseQuery, 'pendente'),
        ];

        return view('servidores.index', [
            'servidores' => $servidores,
            'resumo' => $resumo,
            'filtros' => [
                'q' => $search,
                'situacao' => $status,
                'prontidao' => $prontidao,
            ],
        ]);
    }

    public function create(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;

        return view('servidores.create', [
            'lotacoes' => $this->lookupOptions(Lotacao::class, $tenantId),
            'cargos' => $this->lookupOptions(Cargo::class, $tenantId),
            'funcoes' => $this->lookupOptions(Funcao::class, $tenantId),
        ]);
    }

    public function show(Request $request, Servidor $servidor): View
    {
        $servidor = $this->resolveServidor($request, $servidor);

        return view('servidores.show', [
            'servidor' => $servidor->load(['pessoa', 'lotacao', 'cargo', 'funcao', 'eventosEsocial']),
        ]);
    }

    public function edit(Request $request, Servidor $servidor): View
    {
        $tenantId = $request->user()?->tenant_id;
        $servidor = $this->resolveServidor($request, $servidor);

        return view('servidores.edit', [
            'servidor' => $servidor->load(['pessoa', 'lotacao', 'cargo', 'funcao', 'eventosEsocial']),
            'lotacoes' => $this->lookupOptions(Lotacao::class, $tenantId),
            'cargos' => $this->lookupOptions(Cargo::class, $tenantId),
            'funcoes' => $this->lookupOptions(Funcao::class, $tenantId),
        ]);
    }

    public function store(StoreServidorRequest $request, RegistrarAdmissaoService $service): RedirectResponse
    {
        $servidor = $service->execute($request->validated(), $request->user()?->tenant_id);

        return redirect()
            ->route('servidores.index')
            ->with('status', "Admissao inicial registrada para {$servidor->pessoa?->nome_completo}.");
    }

    public function update(UpdateServidorRequest $request, Servidor $servidor, AtualizarServidorService $service): RedirectResponse
    {
        $servidor = $this->resolveServidor($request, $servidor);
        $servidor = $service->execute($servidor, $request->validated());

        return redirect()
            ->route('servidores.show', $servidor)
            ->with('status', "Cadastro de {$servidor->pessoa?->nome_completo} atualizado com sucesso.");
    }

    /**
     * @param  class-string<Model>  $modelClass
     * @return Collection<int, Model>
     */
    private function lookupOptions(string $modelClass, ?int $tenantId)
    {
        return $modelClass::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId))
            ->orderBy('nome')
            ->get(['id', 'nome']);
    }

    private function resolveServidor(Request $request, Servidor $servidor): Servidor
    {
        return Servidor::query()
            ->whereKey($servidor->id)
            ->when($request->user()?->tenant_id, fn ($query, $tenantId) => $query->where('tenant_id', $tenantId))
            ->firstOrFail();
    }

    private function applyProntidaoS2200Filter($query, string $prontidao)
    {
        $applyPronto = function ($nestedQuery): void {
            $nestedQuery
                ->where('situacao', 'ativo')
                ->whereNotNull('lotacao_id')
                ->whereNotNull('cargo_id')
                ->whereNotNull('categoria_esocial')
                ->whereNotNull('regime_previdenciario')
                ->whereNotNull('data_admissao')
                ->whereHas('pessoa', fn ($personQuery) => $personQuery
                    ->whereNotNull('cpf')
                    ->whereNotNull('data_nascimento'))
                ->whereHas('eventosEsocial', fn ($eventQuery) => $eventQuery->where('evento', 'S-2200'));
        };

        return match ($prontidao) {
            'pronto' => $query->where($applyPronto),
            'pendente' => $query->whereNot($applyPronto),
            default => $query,
        };
    }

    private function countByProntidaoS2200($query, string $prontidao): int
    {
        return $this->applyProntidaoS2200Filter($query, $prontidao)->count();
    }
}
