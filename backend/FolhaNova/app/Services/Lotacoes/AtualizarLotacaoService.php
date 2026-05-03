<?php

namespace App\Services\Lotacoes;

use App\Models\Lotacao;
use Illuminate\Support\Facades\DB;

class AtualizarLotacaoService
{
    public function __construct(
        private readonly SincronizarEventoLotacaoService $sincronizarEventoLotacaoService,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Lotacao $lotacao, array $payload): Lotacao
    {
        return DB::transaction(function () use ($lotacao, $payload): Lotacao {
            $lotacao->update([
                'codigo' => trim((string) $payload['codigo']),
                'nome' => trim((string) $payload['nome']),
                'tipo' => $payload['tipo'],
                'codigo_esocial' => $this->nullableString($payload['codigo_esocial'] ?? null),
                'ativa' => (bool) $payload['ativa'],
            ]);

            $lotacao = $lotacao->fresh();
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
