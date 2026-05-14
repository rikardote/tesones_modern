<div class="max-w-4xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.workplaces.index') }}" class="hover:text-blue-600 transition-colors">Administración</a></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Centros</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-slate-900 text-white rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011v5m-4 0h4"/>
                    </svg>
                </span>
                {{ $workplace ? 'Editar Centro' : 'Nuevo Centro' }}
            </h1>
        </div>
        
        <a href="{{ route('admin.workplaces.index') }}" class="btn-flat btn-flat-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Cancelar
        </a>
    </div>

    <div class="card-premium bg-white overflow-hidden">

        <form wire:submit="save" class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Adscripción -->
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700 flex items-center gap-1">
                        Adscripción
                        <span class="text-red-500">*</span>
                    </label>
                    <input wire:model="adscripcion" type="text" 
                           class="input-flat"
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
                           class="input-flat"
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
                           class="input-flat"
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
                           class="input-flat"
                           placeholder="Nombre del Titular">
                    @error('titular_area') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Pagador -->
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-gray-700">Pagador Habilitado</label>
                    <input wire:model="pagador_habilitado" type="text" 
                           class="input-flat"
                           placeholder="Nombre del Pagador">
                    @error('pagador_habilitado') <span class="text-xs text-red-600 font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.workplaces.index') }}" 
                   class="btn-flat btn-flat-white">
                    Cancelar
                </a>
                <button type="submit" 
                        class="btn-flat btn-flat-primary">
                    {{ $workplace ? 'Actualizar Centro' : 'Guardar Centro' }}
                </button>
            </div>
        </form>
    </div>
</div>
