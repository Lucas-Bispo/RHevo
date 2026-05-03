<?php

namespace App\Services\Lotacoes;

use App\Models\EventoEsocial;
use App\Models\Lotacao;
use App\Models\Tenant;
use Illuminate\Support\Facades\Schema;

class SincronizarEventoLotacaoService
{
    public function execute(Lotacao $lotacao): void
    {
        if (! $lotacao->ativa || blank($lotacao->codigo_esocial)) {
            return;
        }

        $payload = $this->payload($lotacao);
        $eventoPendente = EventoEsocial::query()
            ->where('tenant_id', $lotacao->tenant_id)
            ->whereNull('servidor_id')
            ->where('evento', 'S-1020')
            ->where('status', 'pendente')
            ->where('payload->lotacao->id', $lotacao->id)
            ->latest('id')
            ->first();

        if ($eventoPendente) {
            $eventoPendente->update([
                'ambiente' => $this->ambiente($lotacao),
                'payload' => $payload,
            ]);

            return;
        }

        EventoEsocial::query()->create([
            'tenant_id' => $lotacao->tenant_id,
            'servidor_id' => null,
            'evento' => 'S-1020',
            'status' => 'pendente',
            'ambiente' => $this->ambiente($lotacao),
            'payload' => $payload,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function payload(Lotacao $lotacao): array
    {
        return [
            'evento' => 'S-1020',
            'origem' => 'lotacoes',
            'lotacao' => [
                'id' => $lotacao->id,
                'codigo' => $lotacao->codigo,
                'nome' => $lotacao->nome,
                'tipo' => $lotacao->tipo,
                'codigo_esocial' => $lotacao->codigo_esocial,
                'ativa' => $lotacao->ativa,
            ],
        ];
    }

    private function ambiente(Lotacao $lotacao): string
    {
        if (! Schema::hasTable('tenants')) {
            return 'homologacao';
        }

        $tenant = Tenant::query()->find($lotacao->tenant_id);

        return (string) data_get($tenant?->metadata, 'orgao_publico.ambiente_esocial', 'homologacao');
    }
}
