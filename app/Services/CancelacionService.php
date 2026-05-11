<?php

namespace App\Services;

use App\Models\Cancelacion;
use App\Models\Teson;

readonly class CancelacionService
{
    public function __construct(private FlashService $flash) {}

    public function listForTeson(Teson $teson)
    {
        return $teson->cancelaciones;
    }

    public function findOrFail(int $id): Cancelacion
    {
        return Cancelacion::findOrFail($id);
    }

    public function create(array $data, int $tesonId): Cancelacion
    {
        $cancelacion = new Cancelacion($data);
        $cancelacion->teson_id = $tesonId;
        $cancelacion->save();

        $this->flash->info('Cancelación agregada exitosamente');

        return $cancelacion;
    }

    public function update(Cancelacion $cancelacion, array $data): Cancelacion
    {
        $cancelacion->update($data);
        $this->flash->success('Actualización exitosa');

        return $cancelacion;
    }

    public function delete(Cancelacion $cancelacion): int
    {
        $tesonId = $cancelacion->teson_id;
        $cancelacion->delete();

        $this->flash->error('Cancelación borrada exitosamente');

        return $tesonId;
    }
}
