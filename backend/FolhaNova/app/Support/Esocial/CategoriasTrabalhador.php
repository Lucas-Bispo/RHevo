<?php

namespace App\Support\Esocial;

final class CategoriasTrabalhador
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            '301' => '301 - Servidor publico efetivo',
            '302' => '302 - Servidor publico em cargo exclusivo em comissao',
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
