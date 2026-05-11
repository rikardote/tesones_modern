<?php

namespace App\Enums;

enum FormaPago: int
{
    case DEBITO_BBVA = 1;
    case CHEQUES = 2;
    case VALES = 3;
    case PENSION_ALIMENTICIA = 4;
    case FONAC_DIE = 5;
    case FONAC_DEBITO = 6;
    case DEBITO_SPEI = 7;

    public function label(): string
    {
        return match ($this) {
            self::DEBITO_BBVA => 'DÉBITO BBVA',
            self::CHEQUES => 'CHEQUES',
            self::VALES => 'VALES',
            self::PENSION_ALIMENTICIA => 'PENSIÓN ALIMENTICIA',
            self::FONAC_DIE => 'FONAC DIE',
            self::FONAC_DEBITO => 'FONAC DÉBITO',
            self::DEBITO_SPEI => 'DÉBITO SPEI',
        };
    }

    public static function selectOptions(): array
    {
        return [
            1 => 'DÉBITO BBVA',
            7 => 'DÉBITO SPEI',
            2 => 'CHEQUES',
            3 => 'VALES',
            4 => 'PENSIÓN ALIMENTICIA',
            5 => 'FONAC DIE',
            6 => 'FONAC DÉBITO',
        ];
    }
}
