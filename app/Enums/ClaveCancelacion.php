<?php

namespace App\Enums;

enum ClaveCancelacion: int
{
    case CAMBIO_NOMBRAMIENTO = 50;
    case TERMINO_CONTRATACION = 51;
    case DEFUNCION = 52;
    case RENUNCIA = 53;
    case LICENCIA_SIN_SUELDO = 54;
    case DUPLICIDAD_EMPLEADO = 55;
    case EXCESO_INCAPACIDADES = 56;
    case RENUNCIA_PENSION = 57;
    case NO_TOMO_POSESION = 58;
    case CESE = 59;
    case NO_COBRAR_A_TIEMPO = 60;
    case PAGO_IMPROCEDENTE = 61;
    case ERROR_IMPRESION = 62;
    case CANCELADO_INDEBIDAMENTE = 63;
    case NO_LABORA_UNIDAD = 64;
    case TERMINO_BECA = 65;
    case CAMBIO_RESIDENCIA = 66;
    case TERMINO_VIGENCIA = 67;
    case ROBO_EXTRAVIO = 68;
    case DETERIORO_MALTRATO = 69;
    case AJUSTE_SUELDO = 70;
    case CHEQUE_DESTRUIDO = 80;
    case EXTRAVIO = 81;

    public function label(): string
    {
        return match ($this) {
            self::CAMBIO_NOMBRAMIENTO => 'CAMBIO DE TIPO DE NOMBRAMIENTO O CON CONTRATACION, CAMBIO DE PLAZA',
            self::TERMINO_CONTRATACION => 'TERMINO DE CONTRATACION, COMISION O PROVISIONALIDAD',
            self::DEFUNCION => 'DEFUNCION',
            self::RENUNCIA => 'RENUNCIA',
            self::LICENCIA_SIN_SUELDO => 'LICENCIA SIN SUELDO',
            self::DUPLICIDAD_EMPLEADO => 'DUPLICIDAD DE NUMERO DE EMPLEADO',
            self::EXCESO_INCAPACIDADES => 'EXCESO DE INCAPACIDADES',
            self::RENUNCIA_PENSION => 'RENUNCIA POR PENSION O JUBILACION',
            self::NO_TOMO_POSESION => 'POR NO TOMAR POSESION DEL CARGO',
            self::CESE => 'CESE',
            self::NO_COBRAR_A_TIEMPO => 'POR NO PRESENTARSE A COBRAR A TIEMPO',
            self::PAGO_IMPROCEDENTE => 'PAGO IMPROCEDENTE PARCIAL, TRAMITE JURIDICO',
            self::ERROR_IMPRESION => 'ERROR DE IMPRESION',
            self::CANCELADO_INDEBIDAMENTE => 'CANCELADO INDEBIDAMENTE',
            self::NO_LABORA_UNIDAD => 'NO LABORA EN LA UNIDAD',
            self::TERMINO_BECA => 'TERMINO DE BECA',
            self::CAMBIO_RESIDENCIA => 'CAMBIO DE RESIDENCIA (MEDICOS RESIDENTES)',
            self::TERMINO_VIGENCIA => 'TERMINO DE VIGENCIA',
            self::ROBO_EXTRAVIO => 'POR ROBO O EXTRAVIO',
            self::DETERIORO_MALTRATO => 'DETERIORO O MALTRATO',
            self::AJUSTE_SUELDO => 'AJUSTE DE SUELDO',
            self::CHEQUE_DESTRUIDO => 'CHEQUE DESTRUIDO',
            self::EXTRAVIO => 'EXTRAVIO',
        };
    }

    public static function selectOptions(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = "{$case->value} - {$case->label()}";
        }
        return $options;
    }
}
