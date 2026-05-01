<?php

namespace App\Http\Requests;

use App\Support\Esocial\TiposLotacao;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLotacaoRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'codigo' => trim((string) $this->input('codigo')),
            'nome' => trim((string) $this->input('nome')),
            'codigo_esocial' => $this->nullableUpperTrimmed('codigo_esocial'),
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

        return [
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('lotacoes', 'codigo')->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'tipo' => ['required', Rule::in(TiposLotacao::codes())],
            'codigo_esocial' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('lotacoes', 'codigo_esocial')->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'ativa' => ['required', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tipo.in' => 'Selecione um tipo de lotacao suportado pelo recorte atual do S-1005/S-1020.',
        ];
    }

    private function nullableUpperTrimmed(string $key): ?string
    {
        $value = strtoupper(trim((string) $this->input($key)));

        return $value === '' ? null : $value;
    }
}
