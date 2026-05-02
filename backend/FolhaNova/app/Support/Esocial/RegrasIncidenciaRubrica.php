<?php

namespace App\Support\Esocial;

final class RegrasIncidenciaRubrica
{
    /**
     * @return array<string, array{tipo: string, incidencias: array<string, bool>, descricao: string}>
     */
    public static function rules(): array
    {
        return [
            '1000' => [
                'tipo' => 'provento',
                'incidencias' => [
                    'incide_irrf' => true,
                    'incide_inss' => true,
                    'incide_fgts' => false,
                ],
                'descricao' => 'Vencimento base deve ser provento, com incidencia de IRRF e INSS e sem FGTS no recorte local atual.',
            ],
            '9201' => [
                'tipo' => 'desconto',
                'incidencias' => [
                    'incide_irrf' => false,
                    'incide_inss' => true,
                    'incide_fgts' => false,
                ],
                'descricao' => 'Desconto previdenciario oficial deve ser desconto, vinculado ao INSS e sem IRRF ou FGTS.',
            ],
            '9219' => [
                'tipo' => 'desconto',
                'incidencias' => [
                    'incide_irrf' => false,
                    'incide_inss' => false,
                    'incide_fgts' => false,
                ],
                'descricao' => 'Outros descontos consignados devem ser desconto sem incidencia de IRRF, INSS ou FGTS no recorte local atual.',
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return list<string>
     */
    public static function errors(array $payload): array
    {
        $natureza = trim((string) ($payload['natureza'] ?? ''));
        $rule = self::rules()[$natureza] ?? null;

        if ($rule === null) {
            return [];
        }

        $errors = [];

        if (($payload['tipo'] ?? null) !== $rule['tipo']) {
            $errors[] = "A natureza {$natureza} deve usar tipo {$rule['tipo']}.";
        }

        foreach ($rule['incidencias'] as $field => $expected) {
            if (self::toBool($payload[$field] ?? null) !== $expected) {
                $label = self::labels()[$field] ?? $field;
                $state = $expected ? 'Sim' : 'Nao';
                $errors[] = "A natureza {$natureza} deve usar {$label} = {$state}.";
            }
        }

        return $errors;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function isValid(array $payload): bool
    {
        return self::errors($payload) === [];
    }

    public static function description(?string $natureza): ?string
    {
        $natureza = trim((string) $natureza);

        return self::rules()[$natureza]['descricao'] ?? null;
    }

    /**
     * @return array<string, string>
     */
    private static function labels(): array
    {
        return [
            'incide_irrf' => 'Incide IRRF',
            'incide_inss' => 'Incide INSS',
            'incide_fgts' => 'Incide FGTS',
        ];
    }

    private static function toBool(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOL);
    }
}
