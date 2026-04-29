<?php

namespace App\Http\Controllers;

use App\Models\EventoEsocial;
use App\Models\Lotacao;
use App\Models\Rubrica;
use App\Models\Servidor;
use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $tenantId = $request->user()?->tenant_id;
        $today = Carbon::today()->toDateString();

        $servidores = Servidor::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));
        $rubricas = Rubrica::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));
        $lotacoes = Lotacao::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));
        $eventos = EventoEsocial::query()
            ->when($tenantId, fn ($query) => $query->where('tenant_id', $tenantId));
        $tenant = $tenantId !== null ? Tenant::query()->find($tenantId) : null;

        return view('dashboard', [
            'resumo' => [
                'servidores_ativos' => (clone $servidores)->where('situacao', 'ativo')->count(),
                'eventos_pendentes' => (clone $eventos)->where('status', 'pendente')->count(),
                'rubricas_ativas' => (clone $rubricas)->where('ativo', true)->count(),
                'eventos_com_erro' => (clone $eventos)->where('status', 'erro')->count(),
                'rubricas_sem_codigo' => (clone $rubricas)->whereNull('codigo_esocial')->count(),
                'eventos_com_retorno' => (clone $eventos)->whereNotNull('mensagem_retorno')->count(),
                'rubricas_vigencia_ativa' => $this->countRubricasByVigencia(clone $rubricas, 'ativa', $today),
                'rubricas_vigencia_futura' => $this->countRubricasByVigencia(clone $rubricas, 'futura', $today),
                'rubricas_vigencia_encerrada' => $this->countRubricasByVigencia(clone $rubricas, 'encerrada', $today),
                'rubricas_s1010_prontas' => $this->countRubricasByProntidao(clone $rubricas, 'pronta', $today),
                'rubricas_s1010_pendentes' => $this->countRubricasByProntidao(clone $rubricas, 'pendente', $today),
                'lotacoes_s1005_prontas' => $this->countLotacoesByProntidao(clone $lotacoes, 'pronta'),
                'lotacoes_s1005_pendentes' => $this->countLotacoesByProntidao(clone $lotacoes, 'pendente'),
            ],
            'orgaoPublicoResumo' => $this->resolveOrgaoPublicoResumo($tenant),
        ]);
    }

    private function countRubricasByVigencia($query, string $vigencia, string $today): int
    {
        return match ($vigencia) {
            'ativa' => $query
                ->whereDate('inicio_validade', '<=', $today)
                ->where(function ($nestedQuery) use ($today) {
                    $nestedQuery
                        ->whereNull('fim_validade')
                        ->orWhereDate('fim_validade', '>=', $today);
                })
                ->count(),
            'futura' => $query->whereDate('inicio_validade', '>', $today)->count(),
            'encerrada' => $query->whereNotNull('fim_validade')->whereDate('fim_validade', '<', $today)->count(),
            default => 0,
        };
    }

    private function countRubricasByProntidao($query, string $prontidao, string $today): int
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
            'pronta' => $query->where($applyPronta)->count(),
            'pendente' => $query->whereNot($applyPronta)->count(),
            default => 0,
        };
    }

    private function countLotacoesByProntidao($query, string $prontidao): int
    {
        $applyPronta = function ($nestedQuery): void {
            $nestedQuery
                ->where('ativa', true)
                ->whereNotNull('codigo_esocial');
        };

        return match ($prontidao) {
            'pronta' => $query->where($applyPronta)->count(),
            'pendente' => $query->whereNot($applyPronta)->count(),
            default => 0,
        };
    }

    /**
     * @return array{nome: string, ambiente: string, vigencia_label: string, vigencia_detail: string, evento_status: string, prontidao_label: string, prontidao_detail: string, prontidao_pendencias: int}|null
     */
    private function resolveOrgaoPublicoResumo(?Tenant $tenant): ?array
    {
        if ($tenant === null) {
            return null;
        }

        $parametros = $tenant->metadata['orgao_publico'] ?? [];
        $inicio = trim((string) ($parametros['inicio_validade'] ?? ''));
        $fim = trim((string) ($parametros['fim_validade'] ?? ''));
        $competenciaAtual = now()->format('Y-m');

        $vigencia = match (true) {
            $inicio === '' => [
                'label' => 'Vigencia nao definida',
                'detail' => 'Informe o inicio de validade do S-1000',
            ],
            $inicio > $competenciaAtual => [
                'label' => 'Vigencia futura',
                'detail' => "Inicio previsto para {$inicio}",
            ],
            $fim !== '' && $fim < $competenciaAtual => [
                'label' => 'Vigencia encerrada',
                'detail' => "Encerrada em {$fim}",
            ],
            default => [
                'label' => 'Vigencia ativa',
                'detail' => $fim !== '' ? "Ativa ate {$fim}" : 'Ativa sem fim informado',
            ],
        };

        $evento = EventoEsocial::query()
            ->where('tenant_id', $tenant->id)
            ->whereNull('servidor_id')
            ->where('evento', 'S-1000')
            ->latest('id')
            ->first();
        $prontidao = $this->resolveProntidaoS1000($parametros, $evento);

        return [
            'nome' => $tenant->name,
            'ambiente' => ucfirst((string) ($parametros['ambiente_esocial'] ?? 'homologacao')),
            'vigencia_label' => $vigencia['label'],
            'vigencia_detail' => $vigencia['detail'],
            'evento_status' => $evento?->status ? ucfirst($evento->status) : 'Nao gerado',
            'prontidao_label' => $prontidao['label'],
            'prontidao_detail' => $prontidao['detail'],
            'prontidao_pendencias' => count($prontidao['pendencias']),
        ];
    }

    /**
     * @param  array<string, mixed>  $parametros
     * @return array{label: string, detail: string, pendencias: array<int, string>}
     */
    private function resolveProntidaoS1000(array $parametros, ?EventoEsocial $eventoS1000): array
    {
        $pendencias = [];
        $tipoInscricao = (string) ($parametros['tipo_inscricao'] ?? '');
        $classificacaoTributaria = (string) ($parametros['classificacao_tributaria'] ?? '');
        $inicioValidade = trim((string) ($parametros['inicio_validade'] ?? ''));
        $fimValidade = trim((string) ($parametros['fim_validade'] ?? ''));
        $competenciaAtual = now()->format('Y-m');

        if (! in_array($tipoInscricao, ['1', '2'], true)) {
            $pendencias[] = 'tipo_inscricao';
        }

        if (blank($parametros['numero_inscricao'] ?? null)) {
            $pendencias[] = 'numero_inscricao';
        }

        if ($classificacaoTributaria === '') {
            $pendencias[] = 'classificacao_tributaria';
        }

        if ($tipoInscricao === '1' && blank($parametros['natureza_juridica'] ?? null)) {
            $pendencias[] = 'natureza_juridica';
        }

        if ($inicioValidade === '') {
            $pendencias[] = 'inicio_validade';
        }

        if ($inicioValidade !== '' && $inicioValidade > $competenciaAtual) {
            $pendencias[] = 'vigencia_futura';
        }

        if ($fimValidade !== '' && $fimValidade < $competenciaAtual) {
            $pendencias[] = 'vigencia_encerrada';
        }

        if ($eventoS1000 === null) {
            $pendencias[] = 'evento_local';
        }

        if ($pendencias !== []) {
            return [
                'label' => 'Base S-1000 com pendencias',
                'detail' => 'Revise o orgao publico antes da integracao futura.',
                'pendencias' => $pendencias,
            ];
        }

        return [
            'label' => 'Base S-1000 pronta',
            'detail' => 'Parametros institucionais e evento local estao consistentes.',
            'pendencias' => [],
        ];
    }
}
