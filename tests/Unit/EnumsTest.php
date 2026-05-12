<?php

use App\Enums\ClaveCancelacion;
use App\Enums\FormaPago;
use App\Enums\TipoPersonal;

describe('TipoPersonal', function () {
    it('tiene 7 casos', function () {
        expect(TipoPersonal::cases())->toHaveCount(7);
    });

    it('retorna label correcto para FUNCIONARIO', function () {
        expect(TipoPersonal::FUNCIONARIO->label())->toBe('FUNCIONARIO');
    });

    it('retorna label correcto para RESIDENTES', function () {
        expect(TipoPersonal::RESIDENTES->label())->toBe('RESIDENTES');
    });

    it('selectOptions contiene todas las opciones', function () {
        $options = TipoPersonal::selectOptions();
        expect($options)->toHaveKey(1, 'FUNCIONARIOS');
        expect($options)->toHaveKey(5, 'EVENTUALES OPERATIVOS');
        expect($options)->toHaveKey(7, 'RESIDENTES');
        expect($options)->toHaveCount(7);
    });
});

describe('FormaPago', function () {
    it('tiene 7 casos', function () {
        expect(FormaPago::cases())->toHaveCount(7);
    });

    it('retorna label correcto', function () {
        expect(FormaPago::DEBITO_BBVA->label())->toBe('DÉBITO BBVA');
        expect(FormaPago::DEBITO_SPEI->label())->toBe('DÉBITO SPEI');
        expect(FormaPago::CHEQUES->label())->toBe('CHEQUES');
    });

    it('selectOptions tiene orden personalizado', function () {
        $options = FormaPago::selectOptions();
        expect(array_keys($options)[0])->toBe(1);
        expect(array_keys($options)[1])->toBe(7);
    });
});

describe('ClaveCancelacion', function () {
    it('tiene 23 casos', function () {
        expect(ClaveCancelacion::cases())->toHaveCount(23);
    });

    it('retorna label descriptivo', function () {
        expect(ClaveCancelacion::CESE->label())->toContain('CESE');
        expect(ClaveCancelacion::DEFUNCION->label())->toContain('DEFUNCION');
    });

    it('selectOptions incluye clave + descripción', function () {
        $options = ClaveCancelacion::selectOptions();
        expect($options[50])->toContain('50');
        expect($options[50])->toContain('CAMBIO');
    });
});
