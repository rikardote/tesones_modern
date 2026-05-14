<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-700 px-8 py-6">
            <h3 class="text-xl font-bold text-white">
                {{ $workplace ? 'Editar Centro de Trabajo' : 'Nuevo Centro de Trabajo' }}
            </h3>
            <p class="text-indigo-100 text-sm mt-1">
                Completa la información del centro de trabajo para el catálogo global.
            </p>
        </div>

        <form wire:submit="save" class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Adscripción -->
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-1">
                        Adscripción
                        <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="adscripcion" type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                           placeholder="Ej: DELEGACION ESTATAL B.C.">
                    @error('adscripcion') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Unidad -->
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-1">
                        Unidad
                        <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="unidad" type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                           placeholder="Ej: SUBDELEGACION DE ADMINISTRACION">
                    @error('unidad') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Lugar -->
                <div class="space-y-1 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-1">
                        Lugar / Ubicación
                        <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="lugar" type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                           placeholder="Ej: MEXICALI, B.C.">
                    @error('lugar') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 border-t border-gray-100 pt-4">
                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Firmas Predeterminadas</h4>
                </div>

                <!-- Titular -->
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Titular del Área</label>
                    <input wire:model="titular_area" type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                           placeholder="Nombre del Titular">
                    @error('titular_area') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Pagador -->
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Pagador Habilitado</label>
                    <input wire:model="pagador_habilitado" type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                           placeholder="Nombre del Pagador">
                    @error('pagador_habilitado') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.workplaces.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all active:scale-95">
                    {{ $workplace ? 'Actualizar Centro' : 'Guardar Centro' }}
                </button>
            </div>
        </form>
    </div>
</div>
