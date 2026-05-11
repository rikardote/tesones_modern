<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNominaRequest;
use App\Models\Nomina;
use App\Services\NominaService;
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

    public function edit(Nomina $nomina): View
    {
        return view('admin.nominas.edit', compact('nomina'));
    }

    public function update(StoreNominaRequest $request, Nomina $nomina): RedirectResponse
    {
        $this->nominaService->update($nomina, $request->validated());

        return redirect()->route('info_nominas.index');
    }

    public function destroy(Nomina $nomina): RedirectResponse
    {
        $this->nominaService->delete($nomina);

        return redirect()->route('info_nominas.index');
    }
}
