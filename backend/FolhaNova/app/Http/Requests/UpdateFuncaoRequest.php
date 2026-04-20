<?php

namespace App\Http\Requests;

use App\Models\Funcao;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFuncaoRequest extends FormRequest
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
        /** @var Funcao|null $funcao */
        $funcao = $this->route('funcao');

        return [
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('funcoes', 'codigo')
                    ->ignore($funcao?->id)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'codigo_esocial' => ['nullable', 'string', 'max:30'],
            'ativo' => ['required', 'boolean'],
        ];
    }
}
