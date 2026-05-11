<?php

namespace App\Enums;

enum TipoPersonal: int
{
    case FUNCIONARIO = 1;
    case OPERATIVO = 2;
    case HONORARIOS = 3;
    case TEMPORALES = 4;

    public function label(): string
    {
        return match ($this) {
            self::FUNCIONARIO => 'FUNCIONARIO',
            self::OPERATIVO => 'OPERATIVO',
            self::HONORARIOS => 'HONORARIOS',
            self::TEMPORALES => 'TEMPORALES',
        };
    }

    public static function selectOptions(): array
    {
        return [
            1 => 'FUNCIONARIOS',
            2 => 'OPERATIVOS',
            3 => 'HONORARIOS',
            4 => 'TEMPORALES',
        ];
    }
}
