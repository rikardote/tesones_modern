<?php

use App\Models\Nomina;
use App\Models\Teson;
use App\Models\User;
use App\Services\TesonService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->nomina = Nomina::create([
        'nomina' => 'ORDINARIA QNA 01',
        'fecha_emision' => '2026-01-15',
    ]);
});

describe('TesonService', function () {
    it('create genera tesón con fecha de hoy', function () {
        $service = app(TesonService::class);
        $teson = $service->create([
            'nomina_id' => $this->nomina->id,
            'tipo_personal' => 1,
            'remision_nomina' => 1,
            'folio_inicial' => 1000000,
            'folio_final' => 1000001,
        ], $this->user->id);

        expect($teson->user_id)->toBe($this->user->id);
        expect($teson->fecha_elaboracion->format('Y-m-d'))->toBe(Carbon::today()->format('Y-m-d'));
        expect($teson->nomina_id)->toBe($this->nomina->id);
    });

    it('listForUser lista solo tesones del usuario', function () {
        $service = app(TesonService::class);
        $service->create([
            'nomina_id' => $this->nomina->id,
            'tipo_personal' => 1,
            'remision_nomina' => 2,
        ], $this->user->id);

        $otherUser = User::factory()->create();
        $service->create([
            'nomina_id' => $this->nomina->id,
            'tipo_personal' => 2,
            'remision_nomina' => 3,
        ], $otherUser->id);

        $tesones = $service->listForUser($this->user->id);
        expect($tesones)->toHaveCount(1);
        expect($tesones->first()->user_id)->toBe($this->user->id);
    });

    it('update modifica datos del tesón', function () {
        $service = app(TesonService::class);
        $teson = $service->create([
            'nomina_id' => $this->nomina->id,
            'tipo_personal' => 1,
            'remision_nomina' => 1,
        ], $this->user->id);

        $service->update($teson, [
            'tipo_personal' => 2,
            'observaciones' => 'Actualizado',
        ]);

        $teson->refresh();
        expect($teson->tipo_personal)->toBe(2);
        expect($teson->observaciones)->toBe('Actualizado');
    });

    it('delete elimina el tesón', function () {
        $service = app(TesonService::class);
        $teson = $service->create([
            'nomina_id' => $this->nomina->id,
            'tipo_personal' => 1,
            'remision_nomina' => 1,
        ], $this->user->id);

        $service->delete($teson);
        expect(Teson::find($teson->id))->toBeNull();
    });

    it('findAllPaginated retorna paginación', function () {
        foreach (range(1, 5) as $i) {
            $service = app(TesonService::class);
            $service->create([
                'nomina_id' => $this->nomina->id,
                'tipo_personal' => 1,
                'remision_nomina' => 1,
            ], $this->user->id);
        }

        $service = app(TesonService::class);
        $result = $service->findAllPaginated(perPage: 3);
        
        expect($result)->toBeInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class);
        expect($result->total())->toBe(5);
        expect($result->perPage())->toBe(3);
    });
});
