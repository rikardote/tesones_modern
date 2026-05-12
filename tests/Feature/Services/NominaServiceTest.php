<?php

use App\Models\Nomina;
use App\Services\NominaService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->nomina = Nomina::create([
        'nomina' => 'ORDINARIA QNA 01',
        'fecha_emision' => '2026-01-15',
        'comentario' => 'Test',
    ]);
});

describe('NominaService', function () {
    it('all retorna todas las nóminas', function () {
        Nomina::create(['nomina' => 'EXTRAORDINARIA', 'fecha_emision' => '2026-02-01']);
        
        $service = app(NominaService::class);
        expect($service->all())->toHaveCount(2);
    });

    it('forSelect retorna array id => fullnomina', function () {
        $service = app(NominaService::class);
        $options = $service->forSelect();
        
        expect($options)->toHaveKey($this->nomina->id);
        expect($options[$this->nomina->id])->toContain('15/01/2026');
        expect($options[$this->nomina->id])->toContain('ORDINARIA QNA 01');
    });

    it('create crea una nómina con fecha convertida', function () {
        $service = app(NominaService::class);
        $nomina = $service->create([
            'nomina' => 'NUEVA',
            'fecha_emision' => '20/02/2026',
        ]);

        expect($nomina->nomina)->toBe('NUEVA');
        expect($nomina->fecha_emision->format('Y-m-d'))->toBe('2026-02-20');
    });

    it('update actualiza y convierte fecha', function () {
        $service = app(NominaService::class);
        $service->update($this->nomina, [
            'nomina' => 'ACTUALIZADA',
            'fecha_emision' => '15/03/2026',
        ]);

        $this->nomina->refresh();
        expect($this->nomina->nomina)->toBe('ACTUALIZADA');
        expect($this->nomina->fecha_emision->format('Y-m-d'))->toBe('2026-03-15');
    });

    it('delete elimina la nómina', function () {
        $service = app(NominaService::class);
        $service->delete($this->nomina);

        expect(Nomina::find($this->nomina->id))->toBeNull();
    });
});
