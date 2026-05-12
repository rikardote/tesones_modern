<?php

use App\Enums\FormaPago;
use App\Livewire\Tesones\CancelacionManager;
use App\Livewire\Tesones\TesonForm;
use App\Livewire\Tesones\TesonesIndex;
use App\Models\Nomina;
use App\Models\Teson;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->nomina = Nomina::create([
        'nomina' => 'TEST NOMINA',
        'fecha_emision' => '2026-01-01'
    ]);
});

it('puede cargar el componente cancelacion manager', function () {
    $teson = Teson::create([
        'user_id' => $this->user->id,
        'nomina_id' => $this->nomina->id,
        'tipo_personal' => 1,
        'remision_nomina' => FormaPago::DEBITO_BBVA->value,
        'folio_inicial' => 1000000,
        'folio_final' => 1000100,
        'fecha_elaboracion' => now(),
    ]);

    Livewire::actingAs($this->user)
        ->test(CancelacionManager::class, ['teson' => $teson])
        ->assertStatus(200);
});

it('valida que el folio esté dentro del rango del teson', function () {
    $teson = Teson::create([
        'user_id' => $this->user->id,
        'nomina_id' => $this->nomina->id,
        'tipo_personal' => 1,
        'remision_nomina' => FormaPago::DEBITO_BBVA->value,
        'folio_inicial' => 1000000,
        'folio_final' => 1000100,
        'fecha_elaboracion' => now(),
    ]);

    Livewire::actingAs($this->user)
        ->test(CancelacionManager::class, ['teson' => $teson])
        ->set('numero_cheque', 999999) // Fuera de rango (menor)
        ->call('save')
        ->assertHasErrors(['numero_cheque' => 'between'])
        ->set('numero_cheque', 1000101) // Fuera de rango (mayor)
        ->call('save')
        ->assertHasErrors(['numero_cheque' => 'between'])
        ->set('numero_cheque', 1000050) // En rango
        ->set('nombre', 'PEDRO PEREZ')
        ->set('importe', 500)
        ->set('clave', 50)
        ->set('num_empleado', 123)
        ->call('save')
        ->assertHasNoErrors();
});

it('guarda el nombre del beneficiario en mayúsculas', function () {
    $teson = Teson::create([
        'user_id' => $this->user->id,
        'nomina_id' => $this->nomina->id,
        'tipo_personal' => 1,
        'remision_nomina' => FormaPago::CHEQUES->value,
        'folio_inicial' => 1000,
        'folio_final' => 2000,
        'fecha_elaboracion' => now(),
    ]);

    Livewire::actingAs($this->user)
        ->test(CancelacionManager::class, ['teson' => $teson])
        ->set('nombre', 'juan de la cruz')
        ->set('numero_cheque', 1500)
        ->set('importe', 100)
        ->set('clave', 50)
        ->set('num_empleado', 999)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('cancelaciones', [
        'nombre' => 'JUAN DE LA CRUZ',
        'teson_id' => $teson->id
    ]);
});

it('valida longitud de folios según forma de pago', function () {
    // Caso DÉBITO (7 dígitos)
    $tesonDebito = Teson::create([
        'user_id' => $this->user->id,
        'nomina_id' => $this->nomina->id,
        'tipo_personal' => 1,
        'remision_nomina' => FormaPago::DEBITO_BBVA->value,
        'folio_inicial' => 1000000,
        'folio_final' => 2000000,
        'fecha_elaboracion' => now(),
    ]);

    Livewire::actingAs($this->user)
        ->test(CancelacionManager::class, ['teson' => $tesonDebito])
        ->set('numero_cheque', 123456) // 6 dígitos (inválido para débito)
        ->call('save')
        ->assertHasErrors(['numero_cheque' => 'digits'])
        ->set('numero_cheque', 1234567) // 7 dígitos (válido)
        ->set('nombre', 'TEST')
        ->set('importe', 10)
        ->set('clave', 50)
        ->set('num_empleado', 1)
        ->call('save')
        ->assertHasNoErrors();

    // Caso CHEQUES (mínimo 4 dígitos)
    $tesonCheque = Teson::create([
        'user_id' => $this->user->id,
        'nomina_id' => $this->nomina->id,
        'tipo_personal' => 1,
        'remision_nomina' => FormaPago::CHEQUES->value,
        'folio_inicial' => 100,
        'folio_final' => 9000,
        'fecha_elaboracion' => now(),
    ]);

    Livewire::actingAs($this->user)
        ->test(CancelacionManager::class, ['teson' => $tesonCheque])
        ->set('numero_cheque', 999) // 3 dígitos (inválido, requiere min 1000 / 4 dígitos)
        ->call('save')
        ->assertHasErrors(['numero_cheque' => 'min'])
        ->set('numero_cheque', 1001) // 4 dígitos (válido)
        ->set('nombre', 'TEST')
        ->set('importe', 10)
        ->set('clave', 50)
        ->set('num_empleado', 1)
        ->call('save')
        ->assertHasNoErrors();
});

it('valida el formulario de creación de teson', function () {
    Livewire::actingAs($this->user)
        ->test(TesonForm::class)
        ->set('nomina_id', $this->nomina->id)
        ->set('tipo_personal', 1)
        ->set('remision_nomina', FormaPago::DEBITO_BBVA->value)
        ->set('folio_inicial', '123456') // 6 dígitos (inválido)
        ->call('save')
        ->assertHasErrors(['folio_inicial' => 'digits'])
        ->set('folio_inicial', '1234567') // 7 dígitos (válido)
        ->set('folio_final', '1234560') // Menor que inicial
        ->call('save')
        ->assertHasErrors(['folio_final' => 'gte'])
        ->set('folio_final', '1234600') // Válido
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect();
});

it('puede buscar tesones por nombre de nomina', function () {
    Teson::create([
        'user_id' => $this->user->id,
        'nomina_id' => $this->nomina->id,
        'tipo_personal' => 1,
        'remision_nomina' => FormaPago::DEBITO_BBVA->value,
        'folio_inicial' => 1000000,
        'folio_final' => 1000100,
        'fecha_elaboracion' => now(),
    ]);

    Livewire::actingAs($this->user)
        ->test(TesonesIndex::class)
        ->set('search', 'TEST NOMINA')
        ->assertViewHas('tesones', function ($tesones) {
            return $tesones->count() >= 1;
        })
        ->set('search', 'NONEXISTENT')
        ->assertViewHas('tesones', function ($tesones) {
            return $tesones->count() === 0;
        });
});
