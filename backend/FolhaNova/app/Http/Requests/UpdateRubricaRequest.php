<?php

namespace App\Http\Requests;

use App\Models\Rubrica;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRubricaRequest extends FormRequest
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
            'natureza' => ['required', 'string', 'max:30'],
            'tipo' => ['required', Rule::in(['provento', 'desconto', 'informativa'])],
            'incide_irrf' => ['required', 'boolean'],
            'incide_inss' => ['required', 'boolean'],
            'incide_fgts' => ['required', 'boolean'],
            'codigo_esocial' => ['nullable', 'string', 'max:30'],
            'ativo' => ['required', 'boolean'],
        ];
    }
}
