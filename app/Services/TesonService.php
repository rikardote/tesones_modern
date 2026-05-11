<?php

namespace App\Services;

use App\Models\Teson;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

readonly class TesonService
{
    public function __construct(private FlashService $flash) {}

    public function listForUser(int $userId): Collection
    {
        return Teson::where('user_id', $userId)
            ->with('nomina')
            ->withCount('cancelaciones')
            ->orderBy('fecha_elaboracion', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function listForUserView(int $userId): Collection
    {
        return Teson::with('nomina')
            ->withCount('cancelaciones')
            ->where('user_id', $userId)
            ->orderBy('fecha_elaboracion', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function findAllPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return Teson::with(['nomina', 'user'])
            ->withCount('cancelaciones')
            ->orderBy('fecha_elaboracion', 'desc')
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function findOrFail(int $id, array $with = []): Teson
    {
        $query = Teson::query();
        if (! empty($with)) {
            $query->with($with);
        }

        return $query->findOrFail($id);
    }

    public function create(array $data, int $userId): Teson
    {
        $teson = new Teson($data);
        $teson->user_id = $userId;
        $teson->fecha_elaboracion = Carbon::today();
        $teson->save();

        $this->flash->info('Tesón generado exitosamente');

        return $teson;
    }

    public function update(Teson $teson, array $data): Teson
    {
        $teson->update($data);
        $this->flash->info('Tesón modificado exitosamente');

        return $teson;
    }

    public function delete(Teson $teson): void
    {
        $teson->delete();
        $this->flash->error('El tesón se ha eliminado exitosamente');
    }
}
