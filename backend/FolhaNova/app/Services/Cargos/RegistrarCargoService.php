<?php

namespace App\Services\Cargos;

use App\Models\Cargo;

class RegistrarCargoService
{
    public function __construct(
        private readonly SincronizarEventoCargoService $sincronizarEventoCargoService,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(array $payload, ?int $tenantId): Cargo
    {
        $cargo = Cargo::query()->create([
            'tenant_id' => $tenantId,
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'descricao' => $this->nullableString($payload['descricao'] ?? null),
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativo' => (bool) $payload['ativo'],
        ]);

        $this->sincronizarEventoCargoService->execute($cargo);

        return $cargo;
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
