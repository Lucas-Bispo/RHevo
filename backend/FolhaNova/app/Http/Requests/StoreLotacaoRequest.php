<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLotacaoRequest extends FormRequest
{
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
            'tipo' => ['required', Rule::in(['setor', 'departamento', 'secretaria', 'unidade', 'gabinete'])],
            'codigo_esocial' => ['nullable', 'string', 'max:30'],
            'ativa' => ['required', 'boolean'],
        ];
    }
}
