<div class="fade-in max-w-6xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li class="text-slate-800 font-bold">Mis Tesones</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>
                {{ $user->adscripcion }}
            </h1>
            <p class="mt-2 text-slate-500 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $user->unidad }}
            </p>
        </div>
        
        <a href="{{ route('tesones.create') }}" class="group inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all duration-200 hover:scale-[1.02] active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Crear Nuevo Tesón
        </a>
    </div>

    {{-- Flash messages --}}
    @if (session('flash_message'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 5000)"
             x-transition
             class="flex items-center gap-3 p-4 mb-8 bg-{{ session('flash_level', 'blue') === 'info' ? 'blue' : (session('flash_level') === 'danger' ? 'red' : 'emerald') }}-50 border border-{{ session('flash_level', 'blue') === 'info' ? 'blue' : (session('flash_level') === 'danger' ? 'red' : 'emerald') }}-100 rounded-2xl text-{{ session('flash_level', 'blue') === 'info' ? 'blue' : (session('flash_level') === 'danger' ? 'red' : 'emerald') }}-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-sm font-semibold flex-1">{{ session('flash_message') }}</div>
            <button @click="show = false" class="p-1 hover:bg-black/5 rounded-lg">&times;</button>
        </div>
    @endif

    {{-- Delete confirmation --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-data x-transition>
            <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full border border-slate-100 slide-up">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-red-50 text-red-600 mb-6 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 text-center mb-2">¿Eliminar este Tesón?</h3>
                <p class="text-slate-500 text-center mb-8 px-4">Esta acción eliminará permanentemente el registro y sus cancelaciones asociadas. No se puede revertir.</p>
                <div class="grid grid-cols-2 gap-4">
                    <button wire:click="cancelDelete" class="py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Cancelar</button>
                    <button wire:click="delete" class="py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transition-all flex items-center justify-center gap-2">
                        <span wire:loading wire:target="delete" class="lw-spinner border-white"></span>
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content Card --}}
    <div class="card overflow-hidden border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200 bg-white">
        {{-- Card Header --}}
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Registros Generados</h2>
                    <p class="text-xs text-slate-500 font-medium">{{ $tesones->total() }} documentos encontrados</p>
                </div>
            </div>

            <div class="relative w-full sm:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/></svg>
                </div>
                <input type="search" 
                       wire:model.live.debounce.300ms="search"
                       class="form-input w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" 
                       placeholder="Buscar por nómina...">
            </div>
        </div>

        {{-- Table --}}
        @if($tesones->isEmpty())
            <div class="p-20 text-center">
                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h3 class="text-slate-800 font-bold text-lg">No se encontraron registros</h3>
                <p class="text-slate-500 mt-1 max-w-xs mx-auto">No hay documentos que coincidan con los criterios de búsqueda actuales.</p>
                @if($search)
                    <button wire:click="$set('search', '')" class="mt-6 px-4 py-2 bg-slate-900 text-white rounded-lg font-bold text-sm hover:bg-slate-800 transition-colors">Limpiar búsqueda</button>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100">Fecha Emisión</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100">Tipo de Nómina</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100 text-center">Personal</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100 text-center">Forma de Pago</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($tesones as $teson)
                            <tr class="group hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <a href="{{ route('tesones.show', $teson) }}" class="flex items-center gap-3 group">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xs group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                            {{ \Carbon\Carbon::parse($teson->nomina->fecha_emision)->format('d') }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-slate-900 font-bold text-sm">{{ \Carbon\Carbon::parse($teson->nomina->fecha_emision)->translatedFormat('M Y') }}</span>
                                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-tighter">{{ fecha_dmy($teson->nomina->fecha_emision) }}</span>
                                        </div>
                                    </a>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col max-w-md">
                                        <span class="text-slate-700 font-medium text-sm line-clamp-1">{{ $teson->nomina->nomina }}</span>
                                        @if($teson->cancelaciones_count > 0)
                                            <span class="mt-1 flex items-center gap-1.5 text-red-500 text-[10px] font-bold uppercase tracking-widest">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                                {{ $teson->cancelaciones_count }} Cancelaciones
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-[10px] font-bold uppercase tracking-wider">
                                        {{ $teson->tipo_personal_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider">
                                        {{ $teson->forma_pago_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('tesones.edit', $teson) }}" 
                                           class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all duration-200"
                                           title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <button wire:click="confirmDelete({{ $teson->id }})" 
                                                class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200"
                                                title="Eliminar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination footer --}}
            <div class="p-6 border-t border-slate-100 bg-slate-50/30">
                {{ $tesones->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</div>
