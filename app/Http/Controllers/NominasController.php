<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNominaRequest;
use App\Models\Nomina;
use App\Services\NominaService;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class NominasController extends Controller
{
    public function __construct(
        private readonly NominaService $nominaService,
    ) {
        $this->middleware('auth');
    }

    public function index(): View|RedirectResponse
    {
        if (! auth()->user()->isAdmin()) {
            return redirect()->route('tesones.index');
        }

        return view('admin.nominas.index', [
            'nominas' => $this->nominaService->all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.nominas.create', [
            'nomina' => new Nomina(),
        ]);
    }

    public function store(StoreNominaRequest $request): RedirectResponse
    {
        $this->nominaService->create($request->validated());

        return redirect()->route('info_nominas.index');
    }

    public function edit(Nomina $info_nomina): View
    {
        return view('admin.nominas.edit', ['nomina' => $info_nomina]);
    }

    public function update(StoreNominaRequest $request, Nomina $info_nomina): RedirectResponse
    {
        $this->nominaService->update($info_nomina, $request->validated());

        return redirect()->route('info_nominas.index');
    }

    public function destroy(Nomina $info_nomina): RedirectResponse
    {
        try {
            $this->nominaService->delete($info_nomina);
        } catch (QueryException $e) {
            if ($e->getCode() === "23000") { // Integrity constraint violation
                $this->nominaService->flashError("No se puede eliminar la nómina porque tiene Tesones asociados. Debe eliminar o reasignar los Tesones primero.");
            } else {
                $this->nominaService->flashError("Error al intentar eliminar la nómina: " . $e->getMessage());
            }
        }

        return redirect()->route('info_nominas.index');
    }
}
