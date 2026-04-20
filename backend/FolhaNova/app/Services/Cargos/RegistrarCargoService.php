<?php

namespace App\Services\Cargos;

use App\Models\Cargo;

class RegistrarCargoService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(array $payload, ?int $tenantId): Cargo
    {
        return Cargo::query()->create([
            'tenant_id' => $tenantId,
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'descricao' => $this->nullableString($payload['descricao'] ?? null),
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativo' => (bool) $payload['ativo'],
        ]);
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
