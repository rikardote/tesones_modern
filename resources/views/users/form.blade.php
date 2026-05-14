<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Nombre Completo</label>
        <input type="text" name="name" id="name" 
               class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase"
               value="{{ old('name', $user->name) }}" required>
    </div>
    <div>
        <label for="adscripcion" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Adscripción</label>
        <input type="text" name="adscripcion" id="adscripcion" 
               class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase"
               value="{{ old('adscripcion', $user->adscripcion) }}" required>
    </div>
    <div>
        <label for="unidad" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Unidad</label>
        <input type="text" name="unidad" id="unidad" 
               class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase"
               value="{{ old('unidad', $user->unidad) }}" required>
    </div>
    <div>
        <label for="lugar" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Lugar / Ubicación</label>
        <input type="text" name="lugar" id="lugar" 
               class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase"
               value="{{ old('lugar', $user->lugar) }}" required>
    </div>
    <div>
        <label for="titular_area" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Titular del área</label>
        <input type="text" name="titular_area" id="titular_area" 
               class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase"
               value="{{ old('titular_area', $user->titular_area) }}" required>
    </div>
    <div class="md:col-span-2">
        <label for="pagador_habilitado" class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Pagador Habilitado</label>
        <input type="text" name="pagador_habilitado" id="pagador_habilitado" 
               class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase"
               value="{{ old('pagador_habilitado', $user->pagador_habilitado) }}" required>
    </div>
</div>
