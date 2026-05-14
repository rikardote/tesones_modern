<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Nombre Completo</label>
        <input type="text" name="name" id="name" 
               class="input-flat font-semibold uppercase"
               value="{{ old('name', $user->name) }}" required>
    </div>
    <div>
        <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Correo Electrónico</label>
        <input type="email" name="email" id="email" 
               class="input-flat font-semibold lowercase"
               value="{{ old('email', $user->email) }}" required>
    </div>
    <div>
        <label for="adscripcion" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Adscripción</label>
        <input type="text" name="adscripcion" id="adscripcion" 
               class="input-flat font-semibold uppercase"
               value="{{ old('adscripcion', $user->adscripcion) }}" required>
    </div>
    <div>
        <label for="unidad" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Unidad</label>
        <input type="text" name="unidad" id="unidad" 
               class="input-flat font-semibold uppercase"
               value="{{ old('unidad', $user->unidad) }}" required>
    </div>
    <div>
        <label for="lugar" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Lugar / Ubicación</label>
        <input type="text" name="lugar" id="lugar" 
               class="input-flat font-semibold uppercase"
               value="{{ old('lugar', $user->lugar) }}" required>
    </div>
    <div>
        <label for="titular_area" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Titular del área</label>
        <input type="text" name="titular_area" id="titular_area" 
               class="input-flat font-semibold uppercase"
               value="{{ old('titular_area', $user->titular_area) }}" required>
    </div>
    <div class="md:col-span-2">
        <label for="pagador_habilitado" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Pagador Habilitado</label>
        <input type="text" name="pagador_habilitado" id="pagador_habilitado" 
               class="input-flat font-semibold uppercase"
               value="{{ old('pagador_habilitado', $user->pagador_habilitado) }}" required>
    </div>
</div>
