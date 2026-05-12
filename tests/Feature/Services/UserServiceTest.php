<?php

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'Original Name',
        'adscripcion' => '00100',
        'unidad' => 'UNIDAD TEST',
        'lugar' => 'MEXICALI',
        'titular_area' => 'TITULAR TEST',
        'pagador_habilitado' => 'PAGADOR TEST',
    ]);
});

describe('UserService', function () {
    it('updateInfo actualiza los datos del usuario', function () {
        $service = app(UserService::class);
        $service->updateInfo($this->user, [
            'name' => 'Updated Name',
            'adscripcion' => '00200',
            'unidad' => 'NUEVA UNIDAD',
            'lugar' => 'TIJUANA',
            'titular_area' => 'NUEVO TITULAR',
            'pagador_habilitado' => 'NUEVO PAGADOR',
        ]);

        $this->user->refresh();
        expect($this->user->name)->toBe('Updated Name');
        expect($this->user->adscripcion)->toBe('00200');
        expect($this->user->unidad)->toBe('NUEVA UNIDAD');
        expect($this->user->lugar)->toBe('TIJUANA');
    });

    it('updatePassword cambia la contraseña', function () {
        $service = app(UserService::class);
        $service->updatePassword($this->user, 'new-password-123');

        $this->user->refresh();
        expect(Hash::check('new-password-123', $this->user->password))->toBeTrue();
    });

    it('allOrderedByAdscripcion ordena por adscripcion', function () {
        User::factory()->create(['adscripcion' => '00100']);
        User::factory()->create(['adscripcion' => '00050']);
        
        $service = app(UserService::class);
        $users = $service->allOrderedByAdscripcion();
        
        expect($users->first()->adscripcion)->toBe('00050');
    });

    it('delete elimina el usuario', function () {
        $service = app(UserService::class);
        $service->delete($this->user);

        expect(User::find($this->user->id))->toBeNull();
    });
});
