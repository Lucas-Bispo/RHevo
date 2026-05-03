<?php

namespace App\Services\OrgaoPublico;

use App\Models\EventoEsocial;
use App\Models\Tenant;
use App\Services\Esocial\Payloads\S1000PayloadBuilder;
use Illuminate\Support\Facades\DB;

class AtualizarParametrosOrgaoService
{
    public function __construct(
        private readonly S1000PayloadBuilder $s1000PayloadBuilder,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Tenant $tenant, array $payload): Tenant
    {
        return DB::transaction(function () use ($tenant, $payload) {
            $metadata = $tenant->metadata ?? [];
            $tipoInscricao = (string) $payload['tipo_inscricao'];
            $metadata['orgao_publico'] = [
                'tipo_inscricao' => $tipoInscricao,
                'numero_inscricao' => (string) $payload['numero_inscricao'],
                'classificacao_tributaria' => $this->nullableString($payload['classificacao_tributaria'] ?? null),
                'natureza_juridica' => $tipoInscricao === '1'
                    ? $this->nullableString($payload['natureza_juridica'] ?? null)
                    : null,
                'inicio_validade' => (string) $payload['inicio_validade'],
                'fim_validade' => $this->nullableString($payload['fim_validade'] ?? null),
                'ambiente_esocial' => (string) $payload['ambiente_esocial'],
                'contato_nome' => $this->nullableString($payload['contato_nome'] ?? null),
                'contato_cpf' => $this->nullableString($payload['contato_cpf'] ?? null),
                'contato_email' => $this->nullableString($payload['contato_email'] ?? null),
                'telefone' => $this->nullableString($payload['telefone'] ?? null),
                'observacoes' => $this->nullableString($payload['observacoes'] ?? null),
            ];

            $tenant->update([
                'name' => trim((string) $payload['name']),
                'metadata' => $metadata,
            ]);

            $eventoPayload = $this->s1000PayloadBuilder->internalPayload($tenant->fresh());
            $eventoPendente = EventoEsocial::query()
                ->where('tenant_id', $tenant->id)
                ->whereNull('servidor_id')
                ->where('evento', 'S-1000')
                ->where('status', 'pendente')
                ->latest('id')
                ->first();

            if ($eventoPendente) {
                $eventoPendente->update([
                    'ambiente' => $metadata['orgao_publico']['ambiente_esocial'],
                    'payload' => $eventoPayload,
                    'xml_gerado' => null,
                    'xml_hash' => null,
                    'xml_validacao_status' => null,
                    'xml_validacao_mensagem' => null,
                    'xml_gerado_em' => null,
                    'xml_validado_em' => null,
                ]);
            } else {
                EventoEsocial::create([
                    'tenant_id' => $tenant->id,
                    'servidor_id' => null,
                    'evento' => 'S-1000',
                    'status' => 'pendente',
                    'ambiente' => $metadata['orgao_publico']['ambiente_esocial'],
                    'payload' => $eventoPayload,
                ]);
            }

            return $tenant->fresh();
        });
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}
