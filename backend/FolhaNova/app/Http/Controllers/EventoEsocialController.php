<?php

namespace App\Http\Controllers;

use App\Models\EventoEsocial;
use App\Services\EventosEsocial\ReprocessarEventoEsocialService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventoEsocialController extends Controller
{
    public function __construct()
    {
        // SECURITY: aplica policy nas rotas de listagem e detalhe do painel eSocial.
        $this->authorizeResource(EventoEsocial::class, 'eventoEsocial');
    }

    public function index(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $search = trim((string) $request->string('q'));
        $evento = trim((string) $request->string('evento'));
        $status = trim((string) $request->string('status'));
        $ambiente = trim((string) $request->string('ambiente'));
        $origem = trim((string) $request->string('origem'));
        $retorno = trim((string) $request->string('retorno'));
        $retorno = in_array($retorno, ['com_mensagem', 'sem_mensagem'], true) ? $retorno : '';
        $contexto = trim((string) $request->string('contexto'));
        $contexto = in_array($contexto, ['institucional', 'vinculado'], true) ? $contexto : '';
        $servidor = $request->integer('servidor');
        $servidor = $servidor > 0 ? $servidor : 0;
        $data = trim((string) $request->string('data'));
        $dataSelecionada = null;

        if ($data !== '') {
            try {
                $dataSelecionada = Carbon::createFromFormat('Y-m-d', $data)->startOfDay();
            } catch (\Throwable) {
                $data = '';
            }
        }

        $baseQuery = EventoEsocial::query()
            ->with(['servidor.pessoa'])
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));

        $servidoresDisponiveis = (clone $baseQuery)
            ->whereNotNull('servidor_id')
            ->get()
            ->pluck('servidor')
            ->filter()
            ->unique('id')
            ->sortBy(fn ($servidorItem) => $servidorItem->pessoa?->nome_completo ?? $servidorItem->matricula)
            ->values();

        $servidorSelecionado = $servidor > 0
            ? $servidoresDisponiveis->firstWhere('id', $servidor)
            : null;

        $eventos = (clone $baseQuery)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('evento', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('protocolo', 'like', "%{$search}%")
                        ->orWhere('recibo', 'like', "%{$search}%")
                        ->orWhere('payload->origem', 'like', "%{$search}%")
                        ->orWhereHas('servidor', fn ($servidorQuery) => $servidorQuery
                            ->where('matricula', 'like', "%{$search}%")
                            ->orWhereHas('pessoa', fn ($personQuery) => $personQuery
                                ->where('nome_completo', 'like', "%{$search}%")
                                ->orWhere('cpf', 'like', "%{$search}%")));
                });
            })
            ->when($evento !== '', fn ($query) => $query->where('evento', $evento))
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($ambiente !== '', fn ($query) => $query->where('ambiente', $ambiente))
            ->when($origem !== '', fn ($query) => $query->where('payload->origem', $origem))
            ->when($retorno === 'com_mensagem', fn ($query) => $query->whereNotNull('mensagem_retorno'))
            ->when($retorno === 'sem_mensagem', fn ($query) => $query->whereNull('mensagem_retorno'))
            ->when($contexto === 'institucional', fn ($query) => $query->whereNull('servidor_id'))
            ->when($contexto === 'vinculado', fn ($query) => $query->whereNotNull('servidor_id'))
            ->when($servidorSelecionado, fn ($query) => $query->where('servidor_id', $servidorSelecionado->id))
            ->when($dataSelecionada, fn ($query) => $query->whereDate('updated_at', $dataSelecionada->toDateString()))
            ->latest('updated_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return view('eventos-esocial.index', [
            'eventos' => $eventos,
            'resumo' => [
                'hoje' => now()->toDateString(),
                'total' => (clone $baseQuery)->count(),
                'pendentes' => (clone $baseQuery)->where('status', 'pendente')->count(),
                'processados' => (clone $baseQuery)->where('status', 'processado')->count(),
                'erros' => (clone $baseQuery)->where('status', 'erro')->count(),
                'pendentes_hoje' => (clone $baseQuery)
                    ->where('status', 'pendente')
                    ->whereDate('updated_at', now()->toDateString())
                    ->count(),
                'erros_hoje' => (clone $baseQuery)
                    ->where('status', 'erro')
                    ->whereDate('updated_at', now()->toDateString())
                    ->count(),
                'com_retorno' => (clone $baseQuery)->whereNotNull('mensagem_retorno')->count(),
                'sem_retorno' => (clone $baseQuery)->whereNull('mensagem_retorno')->count(),
                's1000' => (clone $baseQuery)->where('evento', 'S-1000')->count(),
                's1010' => (clone $baseQuery)->where('evento', 'S-1010')->count(),
                's2200' => (clone $baseQuery)->where('evento', 'S-2200')->count(),
                'homologacao' => (clone $baseQuery)->where('ambiente', 'homologacao')->count(),
                'producao' => (clone $baseQuery)->where('ambiente', 'producao')->count(),
                'institucionais' => (clone $baseQuery)->whereNull('servidor_id')->count(),
                'vinculados' => (clone $baseQuery)->whereNotNull('servidor_id')->count(),
            ],
            'filtros' => [
                'q' => $search,
                'evento' => $evento,
                'status' => $status,
                'ambiente' => $ambiente,
                'origem' => $origem,
                'retorno' => $retorno,
                'contexto' => $contexto,
                'servidor' => $servidorSelecionado?->id,
                'servidor_label' => $servidorSelecionado
                    ? trim(($servidorSelecionado->pessoa?->nome_completo ?? 'Servidor').' - '.$servidorSelecionado->matricula)
                    : '',
                'data' => $dataSelecionada?->toDateString() ?? '',
                'data_label' => $dataSelecionada?->format('d/m/Y') ?? '',
            ],
            'eventosDisponiveis' => (clone $baseQuery)
                ->select('evento')
                ->distinct()
                ->orderBy('evento')
                ->pluck('evento'),
            'origensDisponiveis' => (clone $baseQuery)
                ->get()
                ->pluck('payload.origem')
                ->filter()
                ->unique()
                ->sort()
                ->values(),
            'servidoresDisponiveis' => $servidoresDisponiveis,
        ]);
    }

    public function show(Request $request, EventoEsocial $eventoEsocial): View
    {
        $eventoEsocial = $this->resolveEvento($request, $eventoEsocial)
            ->load(['servidor.pessoa', 'servidor.lotacao', 'servidor.cargo', 'servidor.funcao']);

        return view('eventos-esocial.show', [
            'eventoEsocial' => $eventoEsocial,
            'payloadFormatado' => json_encode($eventoEsocial->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        ]);
    }

    public function reprocessar(
        Request $request,
        EventoEsocial $eventoEsocial,
        ReprocessarEventoEsocialService $service
    ): RedirectResponse {
        $this->authorize('update', $eventoEsocial);
        $eventoEsocial = $this->resolveEvento($request, $eventoEsocial);

        if ($eventoEsocial->status !== 'erro') {
            return redirect()
                ->route('eventos-esocial.show', $eventoEsocial)
                ->with('warning', 'Apenas eventos com erro podem ser reenfileirados nesta etapa.');
        }

        $service->execute($eventoEsocial);

        return redirect()
            ->route('eventos-esocial.show', $eventoEsocial)
            ->with('status', 'Evento reenfileirado como pendente para reprocessamento local.');
    }

    private function resolveEvento(Request $request, EventoEsocial $eventoEsocial): EventoEsocial
    {
        return EventoEsocial::query()
            ->whereKey($eventoEsocial->id)
            ->when($request->user()?->tenant_id, fn ($query, $tenantId) => $query->where('tenant_id', $tenantId))
            ->firstOrFail();
    }
}
