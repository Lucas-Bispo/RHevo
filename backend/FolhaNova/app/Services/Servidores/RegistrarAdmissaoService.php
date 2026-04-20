<?php

namespace App\Services\Servidores;

use App\Models\EventoEsocial;
use App\Models\Pessoa;
use App\Models\Servidor;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RegistrarAdmissaoService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(array $payload, ?int $tenantId): Servidor
    {
        return DB::transaction(function () use ($payload, $tenantId) {
            $pessoa = Pessoa::create([
                'tenant_id' => $tenantId,
                'nome_completo' => trim((string) $payload['nome_completo']),
                'nome_social' => $this->nullableString($payload['nome_social'] ?? null),
                'cpf' => $this->formatCpf((string) $payload['cpf']),
                'nis' => $this->nullableString($payload['nis'] ?? null),
                'data_nascimento' => $payload['data_nascimento'] ?? null,
                'sexo' => $payload['sexo'] ?? null,
                'estado_civil' => $payload['estado_civil'] ?? null,
                'email' => $this->nullableString($payload['email'] ?? null),
                'telefone' => $this->nullableString($payload['telefone'] ?? null),
                'logradouro' => $this->nullableString($payload['logradouro'] ?? null),
                'numero' => $this->nullableString($payload['numero'] ?? null),
                'complemento' => $this->nullableString($payload['complemento'] ?? null),
                'bairro' => $this->nullableString($payload['bairro'] ?? null),
                'cidade' => $this->nullableString($payload['cidade'] ?? null),
                'uf' => isset($payload['uf']) && $payload['uf'] !== '' ? strtoupper((string) $payload['uf']) : null,
                'cep' => $this->formatCep($payload['cep'] ?? null),
            ]);

            $servidor = Servidor::create([
                'tenant_id' => $tenantId,
                'pessoa_id' => $pessoa->id,
                'lotacao_id' => $payload['lotacao_id'] ?? null,
                'cargo_id' => $payload['cargo_id'] ?? null,
                'funcao_id' => $payload['funcao_id'] ?? null,
                'matricula' => trim((string) $payload['matricula']),
                'tipo_vinculo' => $payload['tipo_vinculo'],
                'categoria_esocial' => $this->nullableString($payload['categoria_esocial'] ?? null),
                'regime_previdenciario' => $payload['regime_previdenciario'] ?? null,
                'data_admissao' => $payload['data_admissao'],
                'salario_base' => $payload['salario_base'],
                'situacao' => $payload['situacao'],
            ]);

            EventoEsocial::create([
                'tenant_id' => $tenantId,
                'servidor_id' => $servidor->id,
                'evento' => 'S-2200',
                'status' => 'pendente',
                'ambiente' => $payload['ambiente_esocial'],
                'payload' => $this->buildEventoPayload($pessoa->toArray(), $servidor->toArray()),
            ]);

            return $servidor->load(['pessoa', 'lotacao', 'cargo', 'funcao', 'eventosEsocial']);
        });
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function formatCpf(string $cpf): string
    {
        $digits = preg_replace('/\D+/', '', $cpf) ?? '';

        if (strlen($digits) !== 11) {
            return $cpf;
        }

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits) ?: $cpf;
    }

    private function formatCep(mixed $cep): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $cep) ?? '';

        if ($digits === '') {
            return null;
        }

        if (strlen($digits) !== 8) {
            return (string) $cep;
        }

        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $digits) ?: (string) $cep;
    }

    /**
     * @param  array<string, mixed>  $pessoa
     * @param  array<string, mixed>  $servidor
     * @return array<string, mixed>
     */
    private function buildEventoPayload(array $pessoa, array $servidor): array
    {
        return [
            'evento' => 'S-2200',
            'origem' => 'cadastro_inicial_servidor',
            'trabalhador' => Arr::only($pessoa, [
                'nome_completo',
                'nome_social',
                'cpf',
                'nis',
                'data_nascimento',
                'sexo',
                'estado_civil',
                'email',
                'telefone',
            ]),
            'vinculo' => Arr::only($servidor, [
                'matricula',
                'tipo_vinculo',
                'categoria_esocial',
                'regime_previdenciario',
                'data_admissao',
                'salario_base',
                'situacao',
                'lotacao_id',
                'cargo_id',
                'funcao_id',
            ]),
        ];
    }
}
