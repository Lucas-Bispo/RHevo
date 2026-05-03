<?php

namespace App\Services\Lotacoes;

use App\Models\Lotacao;
use Illuminate\Support\Facades\DB;

class RegistrarLotacaoService
{
    public function __construct(
        private readonly SincronizarEventoLotacaoService $sincronizarEventoLotacaoService,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(array $payload, ?int $tenantId): Lotacao
    {
        return DB::transaction(function () use ($payload, $tenantId): Lotacao {
            $lotacao = Lotacao::query()->create([
                'tenant_id' => $tenantId,
                'codigo' => trim((string) $payload['codigo']),
                'nome' => trim((string) $payload['nome']),
                'tipo' => $payload['tipo'],
                'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
                'ativa' => (bool) $payload['ativa'],
            ]);

            $this->sincronizarEventoLotacaoService->execute($lotacao);

            return $lotacao;
        });
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
