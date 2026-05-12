<?php

use Carbon\Carbon;

describe('fecha_ymd', function () {
    it('convierte d/m/Y a Y-m-d', function () {
        expect(fecha_ymd('15/01/2026'))->toBe('2026-01-15');
    });

    it('no modifica Y-m-d', function () {
        expect(fecha_ymd('2026-01-15'))->toBe('2026-01-15');
    });

    it('retorna null para string vacío', function () {
        expect(fecha_ymd(''))->toBeNull();
    });

    it('retorna null para null', function () {
        expect(fecha_ymd(null))->toBeNull();
    });
});

describe('fecha_dmy', function () {
    it('convierte Y-m-d a d/m/Y', function () {
        expect(fecha_dmy('2026-01-15'))->toBe('15/01/2026');
    });

    it('retorna null para null', function () {
        expect(fecha_dmy(null))->toBeNull();
    });
});

describe('getMonth', function () {
    it('retorna ENERO para enero', function () {
        expect(getMonth(Carbon::parse('2026-01-15')))->toBe('ENERO');
    });

    it('retorna DICIEMBRE para diciembre', function () {
        expect(getMonth('2026-12-01'))->toBe('DICIEMBRE');
    });

    it('retorna string vacío para fecha inválida', function () {
        expect(getMonth(''))->toBe('');
    });
});

describe('getDay', function () {
    it('retorna el día correcto', function () {
        expect(getDay(Carbon::parse('2026-01-15')))->toBe(15);
    });
});

describe('getYear', function () {
    it('retorna el año correcto', function () {
        expect(getYear(Carbon::parse('2026-01-15')))->toBe(2026);
    });
});

describe('flash', function () {
    it('retorna una instancia de FlashService', function () {
        $flash = flash();
        expect($flash)->toBeInstanceOf(\App\Services\FlashService::class);
    });
});
