<?php

namespace App\Services\Servidores;

use App\Models\Servidor;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AtualizarServidorService
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function execute(Servidor $servidor, array $payload): Servidor
    {
        return DB::transaction(function () use ($servidor, $payload) {
            $servidor->pessoa()->update([
                'nome_completo' => trim((string) $payload['nome_completo']),
                'nome_social' => $this->nullableString($payload['nome_social'] ?? null),
                'cpf' => $payload['cpf'],
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
                'cep' => $payload['cep'] ?? null,
            ]);

            $servidor->update([
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

            $eventoPendente = $servidor->eventosEsocial()
                ->where('evento', 'S-2200')
                ->where('status', 'pendente')
                ->latest('id')
                ->first();

            if ($eventoPendente) {
                $eventoPendente->update([
                    'payload' => $this->buildEventoPayload(
                        $servidor->pessoa()->firstOrFail()->toArray(),
                        $servidor->fresh()->toArray(),
                    ),
                ]);
            }

            return $servidor->fresh(['pessoa', 'lotacao', 'cargo', 'funcao', 'eventosEsocial']);
        });
    }

    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value === '' ? null : $value;
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
