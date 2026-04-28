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
use Illuminate\Support\Carbon;

class RubricaController extends Controller
{
    public function __construct()
    {
        // SECURITY: aplica policy em todas as rotas resource de rubricas.
        $this->authorizeResource(Rubrica::class, 'rubrica');
    }

    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $status = trim((string) $request->string('status'));
        $tipo = trim((string) $request->string('tipo'));
        $tipo = in_array($tipo, ['provento', 'desconto', 'informativa'], true) ? $tipo : '';
        $natureza = trim((string) $request->string('natureza'));
        $natureza = preg_match('/^\d{4}$/', $natureza) === 1 ? $natureza : '';
        $incidencia = trim((string) $request->string('incidencia'));
        $incidencia = in_array($incidencia, ['irrf', 'inss', 'fgts'], true) ? $incidencia : '';
        $esocial = trim((string) $request->string('esocial'));
        $esocial = in_array($esocial, ['com_codigo', 'sem_codigo'], true) ? $esocial : '';
        $vigencia = trim((string) $request->string('vigencia'));
        $vigencia = in_array($vigencia, ['ativa', 'futura', 'encerrada', 'sem_inicio'], true) ? $vigencia : '';
        $prontidao = trim((string) $request->string('prontidao'));
        $prontidao = in_array($prontidao, ['pronta', 'pendente'], true) ? $prontidao : '';
        $today = Carbon::today()->toDateString();

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
            ->when($tipo !== '', fn ($query) => $query->where('tipo', $tipo))
            ->when($natureza !== '', fn ($query) => $query->where('natureza', $natureza))
            ->when($incidencia !== '', fn ($query) => $query->where("incide_{$incidencia}", true))
            ->when($esocial === 'com_codigo', fn ($query) => $query->whereNotNull('codigo_esocial'))
            ->when($esocial === 'sem_codigo', fn ($query) => $query->whereNull('codigo_esocial'))
            ->when($vigencia !== '', fn ($query) => $this->applyVigenciaFilter($query, $vigencia, $today))
            ->when($prontidao !== '', fn ($query) => $this->applyProntidaoFilter($query, $prontidao, $today))
            ->orderBy('nome')
            ->paginate(12)
            ->withQueryString();

        return view('rubricas.index', [
            'rubricas' => $rubricas,
            'resumo' => [
                'total' => (clone $baseQuery)->count(),
                'ativas' => (clone $baseQuery)->where('ativo', true)->count(),
                'inativas' => (clone $baseQuery)->where('ativo', false)->count(),
                'proventos' => (clone $baseQuery)->where('tipo', 'provento')->count(),
                'descontos' => (clone $baseQuery)->where('tipo', 'desconto')->count(),
                'informativas' => (clone $baseQuery)->where('tipo', 'informativa')->count(),
                'irrf' => (clone $baseQuery)->where('incide_irrf', true)->count(),
                'inss' => (clone $baseQuery)->where('incide_inss', true)->count(),
                'fgts' => (clone $baseQuery)->where('incide_fgts', true)->count(),
                'com_codigo_esocial' => (clone $baseQuery)->whereNotNull('codigo_esocial')->count(),
                'sem_codigo_esocial' => (clone $baseQuery)->whereNull('codigo_esocial')->count(),
                'vigencia_ativa' => $this->countByVigencia(clone $baseQuery, 'ativa', $today),
                'vigencia_futura' => $this->countByVigencia(clone $baseQuery, 'futura', $today),
                'vigencia_encerrada' => $this->countByVigencia(clone $baseQuery, 'encerrada', $today),
                's1010_prontas' => $this->countByProntidao(clone $baseQuery, 'pronta', $today),
                's1010_pendentes' => $this->countByProntidao(clone $baseQuery, 'pendente', $today),
            ],
            'filtros' => [
                'q' => $search,
                'status' => $status,
                'tipo' => $tipo,
                'natureza' => $natureza,
                'incidencia' => $incidencia,
                'esocial' => $esocial,
                'vigencia' => $vigencia,
                'prontidao' => $prontidao,
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

    private function applyVigenciaFilter($query, string $vigencia, string $today)
    {
        return match ($vigencia) {
            'ativa' => $query
                ->whereDate('inicio_validade', '<=', $today)
                ->where(function ($nestedQuery) use ($today) {
                    $nestedQuery
                        ->whereNull('fim_validade')
                        ->orWhereDate('fim_validade', '>=', $today);
                }),
            'futura' => $query->whereDate('inicio_validade', '>', $today),
            'encerrada' => $query->whereNotNull('fim_validade')->whereDate('fim_validade', '<', $today),
            'sem_inicio' => $query->whereNull('inicio_validade'),
            default => $query,
        };
    }

    private function countByVigencia($query, string $vigencia, string $today): int
    {
        return $this->applyVigenciaFilter($query, $vigencia, $today)->count();
    }

    private function applyProntidaoFilter($query, string $prontidao, string $today)
    {
        $applyPronta = function ($nestedQuery) use ($today): void {
            $nestedQuery
                ->where('ativo', true)
                ->whereNotNull('codigo_esocial')
                ->whereDate('inicio_validade', '<=', $today)
                ->where(function ($dateQuery) use ($today) {
                    $dateQuery
                        ->whereNull('fim_validade')
                        ->orWhereDate('fim_validade', '>=', $today);
                });
        };

        return match ($prontidao) {
            'pronta' => $query->where($applyPronta),
            'pendente' => $query->whereNot($applyPronta),
            default => $query,
        };
    }

    private function countByProntidao($query, string $prontidao, string $today): int
    {
        return $this->applyProntidaoFilter($query, $prontidao, $today)->count();
    }
}
