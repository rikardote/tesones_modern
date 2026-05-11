<?php

namespace App\Services;

use App\Models\Nomina;
use Illuminate\Database\Eloquent\Collection;

readonly class NominaService
{
    public function __construct(private FlashService $flash) {}

    public function all(): Collection
    {
        return Nomina::all();
    }

    public function forSelect(): array
    {
        return Nomina::all()
            ->sortByDesc('fecha_emision')
            ->pluck('Fullnomina', 'id')
            ->toArray();
    }

    public function create(array $data): Nomina
    {
        $data['fecha_emision'] = fecha_ymd($data['fecha_emision']);
        $nomina = Nomina::create($data);

        $this->flash->info('Nómina generada exitosamente');

        return $nomina;
    }

    public function update(Nomina $nomina, array $data): Nomina
    {
        $data['fecha_emision'] = fecha_ymd($data['fecha_emision']);
        $nomina->fill($data)->save();

        $this->flash->info('Nómina editada exitosamente');

        return $nomina;
    }

    public function delete(Nomina $nomina): void
    {
        $nomina->delete();
        $this->flash->error("La nómina {$nomina->nomina} ha sido borrada con éxito");
    }
}
