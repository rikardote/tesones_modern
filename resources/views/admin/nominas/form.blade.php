<div class="space-y-5">
    <div>
        <label for="nomina" class="form-label">Nómina</label>
        <input type="text" name="nomina" id="nomina" class="form-input"
               value="{{ old('nomina', $nomina->nomina ?? '') }}" required>
        <p class="text-xs text-gray-400 mt-1">Ejemplo: ORDINARIA, QNA 01 DEL 2017</p>
    </div>

    <div>
        <label for="fecha_emision" class="form-label">Fecha de emisión</label>
        <input type="text" name="fecha_emision" id="fecha_emision" class="form-input"
               placeholder="dd/mm/aaaa"
               value="{{ old('fecha_emision', isset($nomina) ? fecha_dmy($nomina->fecha_emision) : '') }}" required>
    </div>

    <div>
        <label for="comentario" class="form-label">Comentario</label>
        <input type="text" name="comentario" id="comentario" class="form-input"
               value="{{ old('comentario', $nomina->comentario ?? '') }}">
    </div>

    <button type="submit" class="btn btn-success w-full py-2.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
        {{ isset($nomina) && $nomina->id ? 'Actualizar Nómina' : 'Crear Nómina' }}
    </button>
</div>
