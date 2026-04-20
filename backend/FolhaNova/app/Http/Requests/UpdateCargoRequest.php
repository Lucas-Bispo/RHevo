<?php

namespace App\Http\Requests;

use App\Models\Cargo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCargoRequest extends FormRequest
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
        /** @var Cargo|null $cargo */
        $cargo = $this->route('cargo');

        return [
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('cargos', 'codigo')
                    ->ignore($cargo?->id)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'codigo_esocial' => ['nullable', 'string', 'max:30'],
            'ativo' => ['required', 'boolean'],
        ];
    }
}
