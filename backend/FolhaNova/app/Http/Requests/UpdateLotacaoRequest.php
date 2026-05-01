<?php

namespace App\Http\Requests;

use App\Models\Lotacao;
use App\Support\Esocial\TiposLotacao;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLotacaoRequest extends FormRequest
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
        /** @var Lotacao|null $lotacao */
        $lotacao = $this->route('lotacao');

        return [
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('lotacoes', 'codigo')
                    ->ignore($lotacao?->id)
                    ->where(fn ($query) => $query->where('tenant_id', $tenantId)),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'tipo' => ['required', Rule::in(TiposLotacao::codes())],
            'codigo_esocial' => ['nullable', 'string', 'max:30'],
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
}
