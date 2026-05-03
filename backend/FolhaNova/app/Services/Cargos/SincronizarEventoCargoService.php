<?php

namespace App\Services\Cargos;

use App\Models\Cargo;
use App\Models\EventoEsocial;
use App\Models\Tenant;
use Illuminate\Support\Facades\Schema;

class SincronizarEventoCargoService
{
    public function execute(Cargo $cargo): void
    {
        if (! $cargo->ativo || blank($cargo->codigo_esocial)) {
            return;
        }

        $payload = $this->payload($cargo);
        $eventoPendente = EventoEsocial::query()
            ->where('tenant_id', $cargo->tenant_id)
            ->whereNull('servidor_id')
            ->where('evento', 'S-1030')
            ->where('status', 'pendente')
            ->where('payload->cargo->id', $cargo->id)
            ->latest('id')
            ->first();

        if ($eventoPendente) {
            $eventoPendente->update([
                'ambiente' => $this->ambiente($cargo),
                'payload' => $payload,
            ]);

            return;
        }

        EventoEsocial::query()->create([
            'tenant_id' => $cargo->tenant_id,
            'servidor_id' => null,
            'evento' => 'S-1030',
            'status' => 'pendente',
            'ambiente' => $this->ambiente($cargo),
            'payload' => $payload,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function payload(Cargo $cargo): array
    {
        return [
            'evento' => 'S-1030',
            'origem' => 'cargos',
            'cargo' => [
                'id' => $cargo->id,
                'codigo' => $cargo->codigo,
                'nome' => $cargo->nome,
                'descricao' => $cargo->descricao,
                'codigo_esocial' => $cargo->codigo_esocial,
                'ativo' => $cargo->ativo,
            ],
        ];
    }

    private function ambiente(Cargo $cargo): string
    {
        if (! Schema::hasTable('tenants')) {
            return 'homologacao';
        }

        $tenant = Tenant::query()->find($cargo->tenant_id);

        return (string) data_get($tenant?->metadata, 'orgao_publico.ambiente_esocial', 'homologacao');
    }
}
