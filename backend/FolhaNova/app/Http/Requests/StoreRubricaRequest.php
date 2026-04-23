<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRubricaRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'codigo' => trim((string) $this->input('codigo')),
            'nome' => trim((string) $this->input('nome')),
            'natureza' => trim((string) $this->input('natureza')),
            'codigo_esocial' => $this->nullableTrimmed('codigo_esocial'),
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
                Rule::unique('rubricas', 'codigo')->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'natureza' => ['required', 'string', 'regex:/^\d{4}$/'],
            'tipo' => ['required', Rule::in(['provento', 'desconto', 'informativa'])],
            'incide_irrf' => ['required', 'boolean'],
            'incide_inss' => ['required', 'boolean'],
            'incide_fgts' => ['required', 'boolean'],
            'codigo_esocial' => ['nullable', 'string', 'max:30'],
            'inicio_validade' => ['required', 'date'],
            'fim_validade' => ['nullable', 'date', 'after_or_equal:inicio_validade'],
            'ativo' => ['required', 'boolean'],
        ];
    }

    private function nullableTrimmed(string $key): ?string
    {
        $value = trim((string) $this->input($key));

        return $value === '' ? null : $value;
    }
}
