<div class="space-y-4">
    <div class="pb-2 border-b border-slate-100 mb-4">
        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Asignación de Centros de Trabajo</h3>
        <p class="text-xs text-slate-500">Selecciona los centros que este usuario tiene autorizados para operar.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-96 overflow-y-auto p-1">
        @forelse($allWorkplaces as $workplace)
            <label class="relative flex items-start p-4 rounded-xl border-2 transition-all cursor-pointer group {{ in_array($workplace->id, $selectedWorkplaces) ? 'border-indigo-500 bg-indigo-50/50' : 'border-slate-100 hover:border-slate-200' }}">
                <div class="flex items-center h-5">
                    <input type="checkbox" 
                           value="{{ $workplace->id }}"
                           wire:click="toggleWorkplace({{ $workplace->id }})"
                           @if(in_array($workplace->id, $selectedWorkplaces)) checked @endif
                           class="w-5 h-5 text-indigo-600 border-slate-300 rounded-md focus:ring-indigo-500 transition-all">
                </div>
                <div class="ml-3 text-sm">
                    <span class="block font-bold {{ in_array($workplace->id, $selectedWorkplaces) ? 'text-indigo-900' : 'text-slate-700' }}">
                        {{ $workplace->adscripcion }}
                    </span>
                    <span class="block text-xs text-slate-500 group-hover:text-slate-600 transition-colors">
                        {{ $workplace->unidad }}
                    </span>
                    <span class="block text-[10px] text-slate-400 mt-1 italic">
                        {{ $workplace->lugar }}
                    </span>
                </div>
                
                @if(in_array($workplace->id, $selectedWorkplaces))
                    <div class="absolute top-2 right-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif
            </label>
        @empty
            <div class="col-span-2 py-8 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200">
                <p class="text-sm text-slate-500 italic">No hay centros de trabajo registrados en el catálogo.</p>
                <a href="{{ route('admin.workplaces.index') }}" class="text-xs text-indigo-600 font-bold hover:underline mt-2 inline-block">Ir al Catálogo</a>
            </div>
        @endforelse
    </div>
</div>
