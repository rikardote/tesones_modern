<?php

use App\Models\Cancelacion;
use App\Models\Nomina;
use App\Models\Teson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User model', function () {
    it('isAdmin retorna true para admin', function () {
        $user = User::factory()->create(['type' => 'admin']);
        expect($user->isAdmin())->toBeTrue();
    });

    it('isAdmin retorna false para usuario normal', function () {
        $user = User::factory()->create(['type' => 'member']);
        expect($user->isAdmin())->toBeFalse();
    });

    it('tiene relación con tesones', function () {
        $user = User::factory()->create();
        $nomina = Nomina::create(['nomina' => 'T', 'fecha_emision' => '2026-01-15']);
        
        $teson = new Teson([
            'nomina_id' => $nomina->id,
            'remision_nomina' => 1,
            'tipo_personal' => 1,
            'fecha_elaboracion' => now(),
        ]);
        $teson->user_id = $user->id;
        $teson->save();

        expect($user->tesones)->toHaveCount(1);
    });
});

describe('Teson model', function () {
    it('tiene accessors para labels', function () {
        $user = User::factory()->create();
        $nomina = Nomina::create(['nomina' => 'T', 'fecha_emision' => '2026-01-15']);
        
        $teson = new Teson([
            'nomina_id' => $nomina->id,
            'remision_nomina' => 1,
            'tipo_personal' => 2,
            'fecha_elaboracion' => now(),
        ]);
        $teson->user_id = $user->id;
        $teson->save();

        expect($teson->tipo_personal_label)->toBe('OPERATIVO');
        expect($teson->forma_pago_label)->toBe('DÉBITO BBVA');
    });

    it('tiene relación con cancelaciones', function () {
        $user = User::factory()->create();
        $nomina = Nomina::create(['nomina' => 'T', 'fecha_emision' => '2026-01-15']);
        
        $teson = new Teson([
            'nomina_id' => $nomina->id,
            'remision_nomina' => 1,
            'tipo_personal' => 1,
            'fecha_elaboracion' => now(),
        ]);
        $teson->user_id = $user->id;
        $teson->save();

        $cancelacion = new Cancelacion([
            'num_empleado' => 111,
            'nombre' => 'TEST',
            'numero_cheque' => 1000,
            'importe' => 100,
            'clave' => 50,
        ]);
        $cancelacion->teson_id = $teson->id;
        $cancelacion->save();

        expect($teson->cancelaciones)->toHaveCount(1);
    });
});

describe('Nomina model', function () {
    it('getFullnominaAttribute formatea correctamente', function () {
        $nomina = Nomina::create([
            'nomina' => 'ORDINARIA',
            'fecha_emision' => '2026-01-15',
        ]);

        expect($nomina->Fullnomina)->toContain('15/01/2026');
        expect($nomina->Fullnomina)->toContain('ORDINARIA');
    });
});

describe('Cancelacion model', function () {
    it('getClaveLabelAttribute retorna descripción', function () {
        $cancelacion = new Cancelacion(['clave' => 59]);
        expect($cancelacion->clave_label)->toContain('CESE');
    });

    it('getClaveLabelAttribute retorna DESCONOCIDO para clave inválida', function () {
        $cancelacion = new Cancelacion(['clave' => 999]);
        expect($cancelacion->clave_label)->toBe('DESCONOCIDO');
    });
});
