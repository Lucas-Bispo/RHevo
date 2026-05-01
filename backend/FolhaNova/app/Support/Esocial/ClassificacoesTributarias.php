<?php

namespace App\Support\Esocial;

final class ClassificacoesTributarias
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            '21' => '21 - Pessoa fisica equiparada / contexto por CPF',
            '85' => '85 - Administracao publica direta, autarquias e fundacoes',
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

    public static function isCompatibleWithTipoInscricao(string $code, string $tipoInscricao): bool
    {
        return match ($tipoInscricao) {
            '1' => $code === '85',
            '2' => $code === '21',
            default => false,
        };
    }
}
