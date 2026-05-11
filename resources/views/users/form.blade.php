<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="adscripcion" class="form-label">Adscripción</label>
        <input type="text" name="adscripcion" id="adscripcion" class="form-input"
               value="{{ old('adscripcion', $user->adscripcion) }}" required>
    </div>
    <div>
        <label for="unidad" class="form-label">Unidad</label>
        <input type="text" name="unidad" id="unidad" class="form-input"
               value="{{ old('unidad', $user->unidad) }}" required>
    </div>
    <div>
        <label for="lugar" class="form-label">Lugar</label>
        <input type="text" name="lugar" id="lugar" class="form-input"
               value="{{ old('lugar', $user->lugar) }}" required>
    </div>
    <div>
        <label for="titular_area" class="form-label">Titular del área</label>
        <input type="text" name="titular_area" id="titular_area" class="form-input"
               value="{{ old('titular_area', $user->titular_area) }}" required>
    </div>
    <div class="md:col-span-2">
        <label for="pagador_habilitado" class="form-label">Pagador Habilitado</label>
        <input type="text" name="pagador_habilitado" id="pagador_habilitado" class="form-input"
               value="{{ old('pagador_habilitado', $user->pagador_habilitado) }}" required>
    </div>
</div>
