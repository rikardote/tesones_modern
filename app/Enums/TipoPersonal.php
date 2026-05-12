<?php

namespace App\Enums;

enum TipoPersonal: int
{
    case FUNCIONARIO = 1;
    case OPERATIVO = 2;
    case HONORARIOS = 3;
    case TEMPORALES = 4;
    case EVENTUALES_OPERATIVOS = 5;
    case EVENTUALES_FUNCIONARIOS = 6;
    case RESIDENTES = 7;

    public function label(): string
    {
        return match ($this) {
            self::FUNCIONARIO => 'FUNCIONARIO',
            self::OPERATIVO => 'OPERATIVO',
            self::HONORARIOS => 'HONORARIOS',
            self::TEMPORALES => 'TEMPORALES',
            self::EVENTUALES_OPERATIVOS => 'EVENTUALES OPERATIVOS',
            self::EVENTUALES_FUNCIONARIOS => 'EVENTUALES FUNCIONARIOS',
            self::RESIDENTES => 'RESIDENTES',
        };
    }

    public static function selectOptions(): array
    {
        return [
            1 => 'FUNCIONARIOS',
            2 => 'OPERATIVOS',
            3 => 'HONORARIOS',
            4 => 'TEMPORALES',
            5 => 'EVENTUALES OPERATIVOS',
            6 => 'EVENTUALES FUNCIONARIOS',
            7 => 'RESIDENTES',
        ];
    }
}
