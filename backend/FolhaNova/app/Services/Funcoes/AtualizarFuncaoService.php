<?php

namespace App\Services\Funcoes;

use App\Models\Funcao;

class AtualizarFuncaoService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Funcao $funcao, array $payload): Funcao
    {
        $funcao->update([
            'codigo' => trim((string) $payload['codigo']),
            'nome' => trim((string) $payload['nome']),
            'descricao' => $this->nullableString($payload['descricao'] ?? null),
            'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
            'ativo' => (bool) $payload['ativo'],
        ]);

        return $funcao->fresh();
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
