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
        $eventoS1000 = $this->resolveEventoS1000($tenant);

        return view('orgao-publico.show', [
            'tenant' => $tenant,
            'parametros' => $parametros,
            'eventoS1000' => $eventoS1000,
            'vigenciaStatus' => $this->resolveVigenciaStatus($parametros),
            'prontidaoS1000' => $this->resolveProntidaoS1000($parametros, $eventoS1000),
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

    /**
     * @param  array<string, mixed>  $parametros
     * @return array{label: string, detail: string, tone: string, pendencias: array<int, string>}
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
            $pendencias[] = 'Informe o tipo de inscricao do empregador.';
        }

        if (blank($parametros['numero_inscricao'] ?? null)) {
            $pendencias[] = 'Informe o numero de inscricao do empregador.';
        }

        if ($classificacaoTributaria === '') {
            $pendencias[] = 'Informe a classificacao tributaria.';
        }

        if ($tipoInscricao === '1' && blank($parametros['natureza_juridica'] ?? null)) {
            $pendencias[] = 'Informe a natureza juridica para inscricoes por CNPJ.';
        }

        if ($inicioValidade === '') {
            $pendencias[] = 'Informe o inicio de validade do S-1000.';
        }

        if ($inicioValidade !== '' && $inicioValidade > $competenciaAtual) {
            $pendencias[] = 'A vigencia do S-1000 ainda esta futura.';
        }

        if ($fimValidade !== '' && $fimValidade < $competenciaAtual) {
            $pendencias[] = 'A vigencia do S-1000 esta encerrada.';
        }

        if ($eventoS1000 === null) {
            $pendencias[] = 'Gere ou sincronize o evento S-1000 local.';
        } elseif ($eventoS1000->status === 'erro') {
            $pendencias[] = 'Corrija ou reprocesse o evento S-1000 com erro.';
        }

        if ($pendencias !== []) {
            return [
                'label' => 'Base S-1000 com pendencias',
                'detail' => 'Revise os itens antes de preparar transmissao futura.',
                'tone' => 'text-amber-300',
                'pendencias' => $pendencias,
            ];
        }

        return [
            'label' => 'Base S-1000 pronta',
            'detail' => 'Parametros minimos e evento local estao consistentes.',
            'tone' => 'text-emerald-300',
            'pendencias' => [],
        ];
    }
}
