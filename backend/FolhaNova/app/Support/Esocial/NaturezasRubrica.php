<?php

namespace App\Support\Esocial;

final class NaturezasRubrica
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            '1000' => '1000 - Vencimento, salario ou soldo',
            '9201' => '9201 - Desconto previdenciario oficial',
            '9219' => '9219 - Outros descontos consignados ou retencoes',
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function codes(): array
    {
        return array_keys(self::options());
    }

    public static function label(?string $code): ?string
    {
        if ($code === null || $code === '') {
            return null;
        }

        return self::options()[$code] ?? null;
    }
}
