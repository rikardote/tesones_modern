<?php

use App\Models\Cancelacion;
use App\Models\Nomina;
use App\Models\Teson;
use App\Models\User;
use App\Services\CancelacionService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create();
    $nomina = Nomina::create(['nomina' => 'TEST', 'fecha_emision' => '2026-01-15']);
    
    $this->teson = new Teson([
        'nomina_id' => $nomina->id,
        'remision_nomina' => 1,
        'tipo_personal' => 1,
        'fecha_elaboracion' => now(),
    ]);
    $this->teson->user_id = $user->id;
    $this->teson->save();

    $this->cancelacion = new Cancelacion([
        'num_empleado' => 12345,
        'nombre' => 'JUAN PÉREZ',
        'numero_cheque' => 10000,
        'importe' => 1500.50,
        'clave' => 50,
    ]);
    $this->cancelacion->teson_id = $this->teson->id;
    $this->cancelacion->save();
});

describe('CancelacionService', function () {
    it('listForTeson retorna cancelaciones del tesón', function () {
        $service = app(CancelacionService::class);
        $cancelaciones = $service->listForTeson($this->teson);

        expect($cancelaciones)->toHaveCount(1);
        expect($cancelaciones->first()->nombre)->toBe('JUAN PÉREZ');
    });

    it('create agrega cancelación al tesón', function () {
        $service = app(CancelacionService::class);
        $cancelacion = $service->create([
            'num_empleado' => 67890,
            'nombre' => 'MARÍA GARCÍA',
            'numero_cheque' => 20000,
            'importe' => 2500.00,
            'clave' => 51,
        ], $this->teson->id);

        expect($cancelacion->teson_id)->toBe($this->teson->id);
        expect($cancelacion->nombre)->toBe('MARÍA GARCÍA');

        expect($this->teson->cancelaciones()->count())->toBe(2);
    });

    it('update modifica la cancelación', function () {
        $service = app(CancelacionService::class);
        $service->update($this->cancelacion, [
            'num_empleado' => 99999,
            'nombre' => 'NOMBRE ACTUALIZADO',
            'numero_cheque' => 30000,
            'importe' => 5000.00,
            'clave' => 55,
        ]);

        $this->cancelacion->refresh();
        expect($this->cancelacion->nombre)->toBe('NOMBRE ACTUALIZADO');
        expect((float) $this->cancelacion->importe)->toBe(5000.0);
    });

    it('delete elimina y retorna teson_id', function () {
        $service = app(CancelacionService::class);
        $tesonId = $service->delete($this->cancelacion);

        expect($tesonId)->toBe($this->teson->id);
        expect(Cancelacion::find($this->cancelacion->id))->toBeNull();
    });
});
