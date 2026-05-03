<?php

namespace App\Services\Funcoes;

use App\Models\EventoEsocial;
use App\Models\Funcao;
use App\Models\Tenant;
use Illuminate\Support\Facades\Schema;

class SincronizarEventoFuncaoService
{
    public function execute(Funcao $funcao): void
    {
        if (! $funcao->ativo || blank($funcao->codigo_esocial)) {
            return;
        }

        $payload = $this->payload($funcao);
        $eventoPendente = EventoEsocial::query()
            ->where('tenant_id', $funcao->tenant_id)
            ->whereNull('servidor_id')
            ->where('evento', 'S-1040')
            ->where('status', 'pendente')
            ->where('payload->funcao->id', $funcao->id)
            ->latest('id')
            ->first();

        if ($eventoPendente) {
            $eventoPendente->update([
                'ambiente' => $this->ambiente($funcao),
                'payload' => $payload,
            ]);

            return;
        }

        EventoEsocial::query()->create([
            'tenant_id' => $funcao->tenant_id,
            'servidor_id' => null,
            'evento' => 'S-1040',
            'status' => 'pendente',
            'ambiente' => $this->ambiente($funcao),
            'payload' => $payload,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function payload(Funcao $funcao): array
    {
        return [
            'evento' => 'S-1040',
            'origem' => 'funcoes',
            'funcao' => [
                'id' => $funcao->id,
                'codigo' => $funcao->codigo,
                'nome' => $funcao->nome,
                'descricao' => $funcao->descricao,
                'codigo_esocial' => $funcao->codigo_esocial,
                'ativo' => $funcao->ativo,
            ],
        ];
    }

    private function ambiente(Funcao $funcao): string
    {
        if (! Schema::hasTable('tenants')) {
            return 'homologacao';
        }

        $tenant = Tenant::query()->find($funcao->tenant_id);

        return (string) data_get($tenant?->metadata, 'orgao_publico.ambiente_esocial', 'homologacao');
    }
}
