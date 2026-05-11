<?php

namespace App\Http\Controllers;

use App\Enums\FormaPago;
use App\Enums\TipoPersonal;
use App\Http\Requests\StoreCancelacionRequest;
use App\Http\Requests\StoreTesonRequest;
use App\Models\Teson;
use App\Services\CancelacionService;
use App\Services\NominaService;
use App\Services\TesonService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class TesonesController extends Controller
{
    public function __construct(
        private readonly TesonService $tesonService,
        private readonly CancelacionService $cancelacionService,
        private readonly NominaService $nominaService,
    ) {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user = auth()->user();
        $tesones = $this->tesonService->listForUser($user->id);

        return view('tesones.index', compact('tesones', 'user'));
    }

    public function show(int $id): View
    {
        $teson = $this->tesonService->findOrFail($id, ['nomina', 'user']);
        $cancelaciones = $this->cancelacionService->listForTeson($teson);

        return view('tesones.show', compact('teson', 'cancelaciones'));
    }

    public function create(): View
    {
        return view('tesones.create', [
            'teson' => new Teson(),
            'nominas' => $this->nominaService->forSelect(),
            'tiposPersonal' => TipoPersonal::selectOptions(),
            'formasPago' => FormaPago::selectOptions(),
        ]);
    }

    public function store(StoreTesonRequest $request): RedirectResponse
    {
        $teson = $this->tesonService->create($request->validated(), auth()->id());

        return redirect()->route('tesones.show', $teson->id);
    }

    public function edit(int $id): View
    {
        $teson = $this->tesonService->findOrFail($id);

        return view('tesones.edit', [
            'teson' => $teson,
            'nominas' => $this->nominaService->forSelect(),
            'tiposPersonal' => TipoPersonal::selectOptions(),
            'formasPago' => FormaPago::selectOptions(),
        ]);
    }

    public function update(StoreTesonRequest $request, int $id): RedirectResponse
    {
        $teson = $this->tesonService->findOrFail($id);
        $this->tesonService->update($teson, $request->validated());

        return redirect()->route('tesones.show', $teson->id);
    }

    public function destroy(int $id): RedirectResponse
    {
        $teson = $this->tesonService->findOrFail($id);
        $this->tesonService->delete($teson);

        return redirect()->route('tesones.index');
    }

    public function borrar(int $id): RedirectResponse
    {
        $teson = $this->tesonService->findOrFail($id);
        $this->tesonService->delete($teson);

        return redirect()->route('todas.index');
    }

    public function cancelar(int $tesonId): View
    {
        $teson = $this->tesonService->findOrFail($tesonId);
        $cancelaciones = $this->cancelacionService->listForTeson($teson);

        return view('tesones.cancelaciones', compact('teson', 'cancelaciones'));
    }

    public function cancelarStore(StoreCancelacionRequest $request, int $tesonId): RedirectResponse
    {
        $this->cancelacionService->create($request->validated(), $tesonId);

        return redirect()->route('cancelar.teson', $tesonId);
    }

    public function printTeson(int $id)
    {
        $teson = $this->tesonService->findOrFail($id, ['nomina', 'user']);
        $cancelaciones = $this->cancelacionService->listForTeson($teson);

        $fecha = Carbon::parse($teson->nomina->fecha_emision);
        $archivo = "Tson_emision_del_{$fecha->day}_" . getMonth($fecha->toDateString()) . "_{$fecha->year}.pdf";

        $pdf = Pdf::loadView('tesones.print_teson', compact('teson', 'cancelaciones'))
            ->setPaper('letter', 'landscape');

        return $pdf->download($archivo);
    }

    public function todas(): View
    {
        $tesones = $this->tesonService->findAllPaginated();

        return view('admin.todas.index', compact('tesones'));
    }

    public function borrarCancelacion(int $id): RedirectResponse
    {
        $cancelacion = $this->cancelacionService->findOrFail($id);
        $tesonId = $this->cancelacionService->delete($cancelacion);

        return redirect()->route('cancelar.teson', $tesonId);
    }

    public function editarCancelacion(int $id): View
    {
        $cancelacion = $this->cancelacionService->findOrFail($id);

        return view('tesones.cancelaciones_edit', compact('cancelacion'));
    }

    public function updateCancelacion(StoreCancelacionRequest $request, int $id): RedirectResponse
    {
        $cancelacion = $this->cancelacionService->findOrFail($id);
        $this->cancelacionService->update($cancelacion, $request->validated());

        return redirect()->route('cancelar.teson', $cancelacion->teson_id);
    }
}
