<?php

namespace App\Services\OrgaoPublico;

use App\Models\EventoEsocial;
use App\Models\Tenant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AtualizarParametrosOrgaoService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Tenant $tenant, array $payload): Tenant
    {
        return DB::transaction(function () use ($tenant, $payload) {
            $metadata = $tenant->metadata ?? [];
            $metadata['orgao_publico'] = [
                'tipo_inscricao' => (string) $payload['tipo_inscricao'],
                'numero_inscricao' => (string) $payload['numero_inscricao'],
                'classificacao_tributaria' => $this->nullableString($payload['classificacao_tributaria'] ?? null),
                'natureza_juridica' => $this->nullableString($payload['natureza_juridica'] ?? null),
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

            $eventoPayload = $this->buildEventoPayload($tenant->fresh());
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

    /**
     * @return array<string, mixed>
     */
    private function buildEventoPayload(Tenant $tenant): array
    {
        $parametros = $tenant->metadata['orgao_publico'] ?? [];

        return [
            'evento' => 'S-1000',
            'origem' => 'parametros_orgao_publico',
            'ideEmpregador' => [
                'tpInsc' => $parametros['tipo_inscricao'] ?? null,
                'nrInsc' => $this->onlyDigits($parametros['numero_inscricao'] ?? null),
            ],
            'infoEmpregador' => [
                'inclusao' => [
                    'idePeriodo' => Arr::whereNotNull([
                        'iniValid' => $parametros['inicio_validade'] ?? null,
                        'fimValid' => $parametros['fim_validade'] ?? null,
                    ]),
                    'infoCadastro' => Arr::whereNotNull([
                        'nmRazao' => $tenant->name,
                        'classTrib' => $parametros['classificacao_tributaria'] ?? null,
                        'natJurid' => $parametros['natureza_juridica'] ?? null,
                        'contato' => Arr::whereNotNull([
                            'nmCtt' => $parametros['contato_nome'] ?? null,
                            'cpfCtt' => $this->onlyDigits($parametros['contato_cpf'] ?? null),
                            'email' => $parametros['contato_email'] ?? null,
                            'foneFixo' => $this->onlyDigits($parametros['telefone'] ?? null),
                        ]),
                    ]),
                ],
            ],
            'controle_interno' => [
                'tenant_id' => $tenant->id,
                'slug' => $tenant->slug,
                'ambiente' => $parametros['ambiente_esocial'] ?? null,
                'observacoes' => $parametros['observacoes'] ?? null,
            ],
        ];
    }

    private function onlyDigits(mixed $value): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $value) ?? '';

        return $digits === '' ? null : $digits;
    }
}
