<?php

namespace App\Http\Requests;

use App\Models\Servidor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServidorRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => $this->formatCpf((string) $this->input('cpf')),
            'cep' => $this->formatCep($this->input('cep')),
            'uf' => $this->input('uf') ? strtoupper((string) $this->input('uf')) : null,
            'matricula' => $this->upperTrimmed('matricula'),
            'categoria_esocial' => $this->nullableTrimmed('categoria_esocial'),
        ]);
    }

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $tenantId = $this->user()?->tenant_id;
        /** @var Servidor|null $servidor */
        $servidor = $this->route('servidor');
        $pessoaId = $servidor?->pessoa_id;

        return [
            'nome_completo' => ['required', 'string', 'max:255'],
            'nome_social' => ['nullable', 'string', 'max:255'],
            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('pessoas', 'cpf')
                    ->ignore($pessoaId)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nis' => ['nullable', 'string', 'max:20'],
            'data_nascimento' => ['nullable', 'date', 'before:today'],
            'sexo' => ['nullable', Rule::in(['feminino', 'masculino', 'nao_informado'])],
            'estado_civil' => ['nullable', Rule::in(['solteiro', 'casado', 'divorciado', 'viuvo', 'uniao_estavel'])],
            'email' => ['nullable', 'email:rfc', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:20'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:120'],
            'cidade' => ['nullable', 'string', 'max:120'],
            'uf' => ['nullable', 'string', 'size:2'],
            'cep' => ['nullable', 'string', 'max:9'],
            'matricula' => [
                'required',
                'string',
                'max:30',
                Rule::unique('servidores', 'matricula')
                    ->ignore($servidor?->id)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'tipo_vinculo' => ['required', Rule::in(['estatutario', 'celetista', 'comissionado', 'temporario', 'eletivo', 'estagiario'])],
            'categoria_esocial' => ['nullable', 'string', 'max:10'],
            'regime_previdenciario' => ['nullable', Rule::in(['rpps', 'rgps', 'outro'])],
            'lotacao_id' => ['nullable', Rule::exists('lotacoes', 'id')->where(fn ($query) => $query->where('tenant_id', $tenantId))],
            'cargo_id' => ['nullable', Rule::exists('cargos', 'id')->where(fn ($query) => $query->where('tenant_id', $tenantId))],
            'funcao_id' => ['nullable', Rule::exists('funcoes', 'id')->where(fn ($query) => $query->where('tenant_id', $tenantId))],
            'data_admissao' => ['required', 'date'],
            'salario_base' => ['required', 'numeric', 'min:0'],
            'situacao' => ['required', Rule::in(['ativo', 'afastado', 'desligado'])],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nome_completo' => 'nome completo',
            'nome_social' => 'nome social',
            'data_nascimento' => 'data de nascimento',
            'estado_civil' => 'estado civil',
            'tipo_vinculo' => 'tipo de vinculo',
            'categoria_esocial' => 'categoria eSocial',
            'regime_previdenciario' => 'regime previdenciario',
            'lotacao_id' => 'lotacao',
            'cargo_id' => 'cargo',
            'funcao_id' => 'funcao',
            'data_admissao' => 'data de admissao',
            'salario_base' => 'salario base',
        ];
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

    private function upperTrimmed(string $key): string
    {
        return strtoupper(trim((string) $this->input($key)));
    }

    private function nullableTrimmed(string $key): ?string
    {
        $value = trim((string) $this->input($key));

        return $value === '' ? null : $value;
    }
}
