<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

readonly class UserService
{
    public function __construct(private FlashService $flash) {}

    public function updateInfo(User $user, array $data): User
    {
        $user->update($data);
        $this->flash->info('Información actualizada exitosamente');

        return $user;
    }

    public function updatePassword(User $user, string $password): User
    {
        $user->update(['password' => Hash::make($password)]);
        $this->flash->info('Contraseña actualizada exitosamente');

        return $user;
    }

    public function allOrderedByAdscripcion()
    {
        return User::orderBy('adscripcion')->get();
    }

    public function delete(User $user): void
    {
        $user->delete();
        $this->flash->error('El usuario se ha eliminado exitosamente');
    }
}
