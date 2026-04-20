<?php

namespace App\Services\Lotacoes;

use App\Models\Lotacao;

class AtualizarLotacaoService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Lotacao $lotacao, array $payload): Lotacao
    {
        $lotacao->update([
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'tipo' => $payload['tipo'],
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativa' => (bool) $payload['ativa'],
        ]);

        return $lotacao->fresh();
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
