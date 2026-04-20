<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateOrgaoPublicoRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'tipo_inscricao' => $this->input('tipo_inscricao') ? (string) $this->input('tipo_inscricao') : null,
            'numero_inscricao' => $this->formatDocumento($this->input('tipo_inscricao'), $this->input('numero_inscricao')),
            'classificacao_tributaria' => $this->nullableTrimmed('classificacao_tributaria'),
            'natureza_juridica' => $this->nullableTrimmed('natureza_juridica'),
            'inicio_validade' => $this->nullableTrimmed('inicio_validade'),
            'fim_validade' => $this->nullableTrimmed('fim_validade'),
            'ambiente_esocial' => $this->nullableTrimmed('ambiente_esocial'),
            'contato_nome' => $this->nullableTrimmed('contato_nome'),
            'contato_cpf' => $this->formatCpf($this->input('contato_cpf')),
            'contato_email' => $this->nullableTrimmed('contato_email'),
            'telefone' => $this->nullableTrimmed('telefone'),
            'observacoes' => $this->nullableTrimmed('observacoes'),
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'tipo_inscricao' => ['required', 'in:1,2'],
            'numero_inscricao' => ['required', 'string', 'max:18'],
            'classificacao_tributaria' => ['nullable', 'string', 'max:4'],
            'natureza_juridica' => ['nullable', 'string', 'max:4'],
            'inicio_validade' => ['required', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
            'fim_validade' => ['nullable', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
            'ambiente_esocial' => ['required', 'in:homologacao,producao'],
            'contato_nome' => ['nullable', 'string', 'max:255'],
            'contato_cpf' => ['nullable', 'string', 'max:14'],
            'contato_email' => ['nullable', 'email:rfc', 'max:255'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'observacoes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $tipoInscricao = (string) $this->input('tipo_inscricao');
            $numeroInscricao = preg_replace('/\D+/', '', (string) $this->input('numero_inscricao')) ?? '';
            $contatoCpf = preg_replace('/\D+/', '', (string) $this->input('contato_cpf')) ?? '';

            if ($tipoInscricao === '1' && ! in_array(strlen($numeroInscricao), [8, 14], true)) {
                $validator->errors()->add('numero_inscricao', 'Informe um CNPJ valido para o orgao publico.');
            }

            if ($tipoInscricao === '2' && strlen($numeroInscricao) !== 11) {
                $validator->errors()->add('numero_inscricao', 'Informe um CPF valido para o orgao publico.');
            }

            if ($contatoCpf !== '' && strlen($contatoCpf) !== 11) {
                $validator->errors()->add('contato_cpf', 'Informe um CPF valido para o contato responsavel.');
            }

            if ($this->filled('fim_validade') && (string) $this->input('fim_validade') < (string) $this->input('inicio_validade')) {
                $validator->errors()->add('fim_validade', 'O fim de validade nao pode ser anterior ao inicio.');
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome do orgao',
            'tipo_inscricao' => 'tipo de inscricao',
            'numero_inscricao' => 'numero de inscricao',
            'classificacao_tributaria' => 'classificacao tributaria',
            'natureza_juridica' => 'natureza juridica',
            'inicio_validade' => 'inicio de validade',
            'fim_validade' => 'fim de validade',
            'ambiente_esocial' => 'ambiente eSocial',
            'contato_nome' => 'nome do contato',
            'contato_cpf' => 'CPF do contato',
            'contato_email' => 'e-mail do contato',
        ];
    }

    private function nullableTrimmed(string $key): ?string
    {
        $value = trim((string) $this->input($key));

        return $value === '' ? null : $value;
    }

    private function formatDocumento(mixed $tipoInscricao, mixed $numeroInscricao): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $numeroInscricao) ?? '';

        if ($digits === '') {
            return null;
        }

        if ((string) $tipoInscricao === '1' && strlen($digits) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $digits) ?: $digits;
        }

        if ((string) $tipoInscricao === '2' && strlen($digits) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits) ?: $digits;
        }

        return (string) $numeroInscricao;
    }

    private function formatCpf(mixed $cpf): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $cpf) ?? '';

        if ($digits === '') {
            return null;
        }

        if (strlen($digits) !== 11) {
            return (string) $cpf;
        }

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits) ?: (string) $cpf;
    }
}
