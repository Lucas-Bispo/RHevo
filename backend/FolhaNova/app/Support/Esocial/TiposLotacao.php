<?php

namespace App\Support\Esocial;

final class TiposLotacao
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            'setor' => 'Setor',
            'departamento' => 'Departamento',
            'secretaria' => 'Secretaria',
            'unidade' => 'Unidade',
            'gabinete' => 'Gabinete',
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
