<?php

namespace App\Services\Lotacoes;

use App\Models\Lotacao;

class RegistrarLotacaoService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(array $payload, ?int $tenantId): Lotacao
    {
        return Lotacao::query()->create([
            'tenant_id' => $tenantId,
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'tipo' => $payload['tipo'],
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativa' => (bool) $payload['ativa'],
        ]);
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
