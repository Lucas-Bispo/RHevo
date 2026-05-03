<?php

namespace App\Services\Cargos;

use App\Models\Cargo;

class AtualizarCargoService
{
    public function __construct(
        private readonly SincronizarEventoCargoService $sincronizarEventoCargoService,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Cargo $cargo, array $payload): Cargo
    {
        $cargo->update([
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'descricao' => $this->nullableString($payload['descricao'] ?? null),
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativo' => (bool) $payload['ativo'],
        ]);

        $cargo = $cargo->fresh();

        $this->sincronizarEventoCargoService->execute($cargo);

        return $cargo;
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
