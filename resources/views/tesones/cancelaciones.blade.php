@extends('layouts.app')

@section('title', 'Capturar Cancelaciones')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            Cancelaciones — Tesón #{{ $teson->id }}
        </h1>
    </div>

    {{-- Form --}}
    <div class="card mb-6">
        <div class="card-body">
            <form action="{{ route('cancelar.teson.store', $teson) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="num_empleado" class="form-label">Número de empleado</label>
                        <input type="text" name="num_empleado" id="num_empleado" class="form-input"
                               placeholder="Ingresa número de empleado" required
                               onkeypress="return isNumberKey(event)">
                    </div>
                    <div>
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-input"
                               placeholder="Ingresa el nombre" required>
                    </div>
                    <div>
                        <label for="numero_cheque" class="form-label">Número de Cheque / Recibo</label>
                        <input type="text" name="numero_cheque" id="numero_cheque" class="form-input"
                               placeholder="Ingresa número" required
                               onkeypress="return isNumberKey(event)">
                    </div>
                    <div>
                        <label for="importe" class="form-label">Importe</label>
                        <input type="text" name="importe" id="importe" class="form-input"
                               placeholder="0.00" required
                               onkeypress="return isNumberKeyAndDot(event)">
                    </div>
                    <div>
                        <label for="clave" class="form-label">Clave</label>
                        <select name="clave" id="clave" class="form-select" required>
                            <option value="">Selecciona...</option>
                            @foreach(\App\Enums\ClaveCancelacion::selectOptions() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="btn btn-success w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Agregar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Cancelaciones list --}}
    <div class="card mb-6">
        <div class="card-header">
            Cancelaciones registradas
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Núm. Empleado</th>
                        <th>Nombre</th>
                        <th>Núm. Cheque</th>
                        <th class="text-right">Importe</th>
                        <th>Clave</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($cancelaciones as $cancelacion)
                        <tr>
                            <td class="font-mono">{{ $cancelacion->num_empleado }}</td>
                            <td>{{ $cancelacion->nombre }}</td>
                            <td class="font-mono">{{ $cancelacion->numero_cheque }}</td>
                            <td class="text-right font-mono">$ {{ number_format($cancelacion->importe, 2) }}</td>
                            <td>{{ $cancelacion->clave }}</td>
                            <td>
                                <div class="flex justify-center gap-1">
                                    <a href="{{ route('cancelar.teson.edit', $cancelacion) }}" class="btn btn-sm btn-warning">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <a href="{{ route('cancelar.destroy', $cancelacion) }}"
                                       onclick="return confirm('¿Esta seguro de eliminarlo?')"
                                       class="btn btn-sm btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if($cancelaciones->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-400">No hay cancelaciones registradas</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('tesones.show', $teson) }}" class="btn btn-secondary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Regresar
    </a>
@endsection

@section('js')
<script>
function isNumberKey(evt) { var cc = evt.which || event.keyCode; return cc <= 31 || (cc >= 48 && cc <= 57); }
function isNumberKeyAndDot(evt) { var cc = evt.which || event.keyCode; return cc <= 31 || cc == 46 || (cc >= 48 && cc <= 57); }
</script>
@endsection
