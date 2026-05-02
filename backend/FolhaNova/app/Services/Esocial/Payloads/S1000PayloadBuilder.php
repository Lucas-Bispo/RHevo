<?php

namespace App\Services\Esocial\Payloads;

use App\Models\Tenant;
use Illuminate\Support\Arr;
use stdClass;

class S1000PayloadBuilder
{
    /**
     * @return array<string, mixed>
     */
    public function internalPayload(Tenant $tenant): array
    {
        $parametros = $tenant->metadata['orgao_publico'] ?? [];
        $contato = Arr::whereNotNull([
            'nmCtt' => $parametros['contato_nome'] ?? null,
            'cpfCtt' => $this->onlyDigits($parametros['contato_cpf'] ?? null),
            'email' => $parametros['contato_email'] ?? null,
            'foneFixo' => $this->onlyDigits($parametros['telefone'] ?? null),
        ]);
        $infoCadastro = Arr::whereNotNull([
            'nmRazao' => $tenant->name,
            'classTrib' => $parametros['classificacao_tributaria'] ?? null,
            'natJurid' => ($parametros['tipo_inscricao'] ?? null) === '1'
                ? ($parametros['natureza_juridica'] ?? null)
                : null,
            'contato' => $contato === [] ? null : $contato,
        ]);

        return [
            'evento' => 'S-1000',
            'origem' => 'parametros_orgao_publico',
            'ideEmpregador' => [
                'tpInsc' => $parametros['tipo_inscricao'] ?? null,
                'nrInsc' => $this->nrInsc($parametros),
            ],
            'infoEmpregador' => [
                'inclusao' => [
                    'idePeriodo' => Arr::whereNotNull([
                        'iniValid' => $parametros['inicio_validade'] ?? null,
                        'fimValid' => $parametros['fim_validade'] ?? null,
                    ]),
                    'infoCadastro' => $infoCadastro,
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

    public function std(Tenant $tenant): stdClass
    {
        $parametros = $tenant->metadata['orgao_publico'] ?? [];
        $tipoInscricao = (string) ($parametros['tipo_inscricao'] ?? '');

        $infoCadastro = [
            'classTrib' => (string) ($parametros['classificacao_tributaria'] ?? ''),
            'indDesFolha' => 0,
            'indOptRegEletron' => 1,
        ];

        if ($tipoInscricao === '1') {
            $infoCadastro['indCoop'] = 0;
            $infoCadastro['indConstr'] = 0;
        }

        return $this->toObject([
            'sequencial' => 1,
            'modo' => 'INC',
            'idePeriodo' => Arr::whereNotNull([
                'iniValid' => $parametros['inicio_validade'] ?? null,
                'fimValid' => $parametros['fim_validade'] ?? null,
            ]),
            'infoCadastro' => $infoCadastro,
        ]);
    }

    public function config(Tenant $tenant): string
    {
        $parametros = $tenant->metadata['orgao_publico'] ?? [];

        return json_encode([
            'tpAmb' => ($parametros['ambiente_esocial'] ?? 'homologacao') === 'producao' ? 1 : 2,
            'verProc' => 'FolhaNova-0.1',
            'eventoVersion' => 'S.1.3.0',
            'empregador' => [
                'tpInsc' => (int) ($parametros['tipo_inscricao'] ?? 1),
                'nrInsc' => $this->nrInsc($parametros),
                'nmRazao' => $tenant->name,
            ],
        ], JSON_THROW_ON_ERROR);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function toObject(array $payload): stdClass
    {
        return json_decode(json_encode($payload, JSON_THROW_ON_ERROR), false, 512, JSON_THROW_ON_ERROR);
    }

    private function onlyDigits(mixed $value): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $value) ?? '';

        return $digits === '' ? null : $digits;
    }

    /**
     * @param  array<string, mixed>  $parametros
     */
    private function nrInsc(array $parametros): ?string
    {
        $digits = $this->onlyDigits($parametros['numero_inscricao'] ?? null);

        if ($digits === null) {
            return null;
        }

        return (string) ($parametros['tipo_inscricao'] ?? '') === '1'
            ? substr($digits, 0, 8)
            : $digits;
    }
}
