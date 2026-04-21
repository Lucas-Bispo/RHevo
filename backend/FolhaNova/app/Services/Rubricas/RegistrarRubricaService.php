<?php

namespace App\Services\Rubricas;

use App\Models\Rubrica;

class RegistrarRubricaService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(array $payload, ?int $tenantId): Rubrica
    {
        return Rubrica::query()->create([
            'tenant_id' => $tenantId,
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'natureza' => $this->numericCode($payload['natureza']),
            'tipo' => $payload['tipo'],
            'incide_irrf' => (bool) $payload['incide_irrf'],
            'incide_inss' => (bool) $payload['incide_inss'],
            'incide_fgts' => (bool) $payload['incide_fgts'],
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativo' => (bool) $payload['ativo'],
        ]);
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function numericCode(mixed $value): string
    {
        return preg_replace('/\D+/', '', (string) $value) ?? '';
    }
}
