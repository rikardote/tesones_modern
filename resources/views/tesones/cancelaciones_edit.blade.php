@extends('layouts.app')

@section('title', 'Modificar Cancelación')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Modificar Cancelación
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('cancelar.teson.update', $cancelacion) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="num_empleado" class="form-label">Número de empleado</label>
                        <input type="text" name="num_empleado" id="num_empleado" class="form-input"
                               value="{{ old('num_empleado', $cancelacion->num_empleado) }}" required
                               onkeypress="return isNumberKey(event)">
                    </div>
                    <div>
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-input"
                               value="{{ old('nombre', $cancelacion->nombre) }}" required>
                    </div>
                    <div>
                        <label for="numero_cheque" class="form-label">Núm. Cheque / Recibo</label>
                        <input type="text" name="numero_cheque" id="numero_cheque" class="form-input"
                               value="{{ old('numero_cheque', $cancelacion->numero_cheque) }}" required
                               onkeypress="return isNumberKey(event)">
                    </div>
                    <div>
                        <label for="importe" class="form-label">Importe</label>
                        <input type="text" name="importe" id="importe" class="form-input"
                               value="{{ old('importe', $cancelacion->importe) }}" required
                               onkeypress="return isNumberKeyAndDot(event)">
                    </div>
                    <div class="md:col-span-2">
                        <label for="clave" class="form-label">Clave</label>
                        <select name="clave" id="clave" class="form-select" required>
                            <option value="">Selecciona...</option>
                            @foreach(\App\Enums\ClaveCancelacion::selectOptions() as $value => $label)
                                <option value="{{ $value }}" {{ old('clave', $cancelacion->clave) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="btn btn-success w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            Modificar Cancelación
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
function isNumberKey(evt) { var cc = evt.which || event.keyCode; return cc <= 31 || (cc >= 48 && cc <= 57); }
function isNumberKeyAndDot(evt) { var cc = evt.which || event.keyCode; return cc <= 31 || cc == 46 || (cc >= 48 && cc <= 57); }
</script>
@endsection
