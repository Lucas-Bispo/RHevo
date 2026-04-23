<?php

namespace App\Http\Requests;

use App\Models\Rubrica;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRubricaRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'codigo' => trim((string) $this->input('codigo')),
            'nome' => trim((string) $this->input('nome')),
            'natureza' => trim((string) $this->input('natureza')),
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
        /** @var Rubrica|null $rubrica */
        $rubrica = $this->route('rubrica');

        return [
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('rubricas', 'codigo')
                    ->ignore($rubrica?->id)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'natureza' => ['required', 'string', 'regex:/^\d{4}$/'],
            'tipo' => ['required', Rule::in(['provento', 'desconto', 'informativa'])],
            'incide_irrf' => ['required', 'boolean'],
            'incide_inss' => ['required', 'boolean'],
            'incide_fgts' => ['required', 'boolean'],
            'codigo_esocial' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('rubricas', 'codigo_esocial')
                    ->ignore($rubrica?->id)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'inicio_validade' => ['required', 'date'],
            'fim_validade' => [
                Rule::requiredIf(fn () => ! $this->boolean('ativo')),
                'nullable',
                'date',
                'after_or_equal:inicio_validade',
                Rule::when($this->boolean('ativo'), ['after_or_equal:today']),
            ],
            'ativo' => ['required', 'boolean'],
        ];
    }

    private function nullableUpperTrimmed(string $key): ?string
    {
        $value = strtoupper(trim((string) $this->input($key)));

        return $value === '' ? null : $value;
    }
}
