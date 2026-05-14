<div class="fade-in max-w-7xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><span class="text-slate-400">Panel Maestro</span></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Control Global de Tesones</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-slate-900 text-white rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </span>
                Administración General
            </h1>
        </div>
        
        <div class="flex items-center gap-3">
            <span class="btn-flat btn-flat-white pointer-events-none">
                Total registros: {{ $tesones->total() }}
            </span>
        </div>
    </div>

    {{-- Filters Toolbar --}}
    <div class="card-premium bg-white p-6 mb-8">
        <div class="flex flex-col lg:flex-row items-center gap-4">
            <div class="relative flex-1 w-full">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/></svg>
                </div>
                <input type="search" 
                       wire:model.live.debounce.300ms="search"
                       class="input-flat pl-12 py-3" 
                       placeholder="Buscar por nómina, usuario o adscripción...">
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                <select wire:model.live="filterTipo" class="input-flat text-xs font-bold py-3 pr-10">
                    <option value="">Tipo de Personal</option>
                    @foreach(\App\Enums\TipoPersonal::selectOptions() as $val => $lab)
                        <option value="{{ $val }}">{{ $lab }}</option>
                    @endforeach
                </select>

                <select wire:model.live="filterPago" class="input-flat text-xs font-bold py-3 pr-10">
                    <option value="">Forma de Pago</option>
                    @foreach(\App\Enums\FormaPago::selectOptions() as $val => $lab)
                        <option value="{{ $val }}">{{ $lab }}</option>
                    @endforeach
                </select>

                @if($search || $filterTipo || $filterPago)
                    <button wire:click="$set('search', ''); $set('filterTipo', ''); $set('filterPago', '')"
                            class="p-3 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all"
                            title="Limpiar filtros">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card-premium bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase text-[10px] tracking-widest font-black border-b border-slate-100">
                        <th class="px-6 py-4">Fecha / Nómina</th>
                        <th class="px-6 py-4 text-center">Clasificación</th>
                        <th class="px-6 py-4">Unidad de Adscripción</th>
                        <th class="px-6 py-4">Generado Por</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" wire:loading.class="opacity-50 transition-opacity">
                    @forelse($tesones as $teson)
                        <tr class="group hover:bg-slate-50/80 transition-colors {{ $teson->cancelaciones_count > 0 ? 'bg-red-50/30' : '' }}">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="flex flex-col">
                                        <a href="{{ route('tesones.show', $teson) }}" class="text-indigo-600 font-black text-sm hover:underline tracking-tight">{{ fecha_dmy($teson->nomina->fecha_emision) }}</a>
                                        <span class="text-slate-500 text-[11px] font-medium mt-0.5 line-clamp-1 max-w-[200px]" title="{{ $teson->nomina->nomina }}">{{ $teson->nomina->nomina }}</span>
                                        @if($teson->cancelaciones_count > 0)
                                            <span class="mt-1 inline-flex items-center gap-1 text-[9px] font-black text-red-500 uppercase tracking-tighter">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                {{ $teson->cancelaciones_count }} cancelaciones
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col items-center gap-1.5">
                                    <span class="px-2.5 py-0.5 rounded-lg bg-slate-100 text-slate-600 text-[9px] font-black uppercase tracking-widest">{{ $teson->tipo_personal_label }}</span>
                                    <span class="px-2.5 py-0.5 rounded-lg bg-indigo-50 text-indigo-600 text-[9px] font-black uppercase tracking-widest">{{ $teson->forma_pago_label }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-slate-800 font-bold text-xs uppercase tracking-tight line-clamp-1" title="{{ $teson->user->adscripcion }}">{{ $teson->user->adscripcion }}</span>
                                    <span class="text-slate-400 text-[10px] font-medium mt-0.5">{{ $teson->user->unidad }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $userAvatar = $teson->user->getAvatarData();
                                @endphp
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg {{ $userAvatar['bg'] }} flex items-center justify-center shadow-md overflow-hidden shrink-0 border border-white">
                                        <div class="p-1.5 w-full h-full">
                                            {!! $userAvatar['svg'] !!}
                                        </div>
                                    </div>
                                    <span class="text-slate-700 font-semibold text-xs tracking-tight">{{ $teson->user->name ?? 'Usuario Desconocido' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('tesones.edit', $teson) }}" 
                                       class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all"
                                       title="Editar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button wire:click="confirmDelete({{ $teson->id }})" 
                                            class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                            title="Eliminar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-20 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/></svg>
                                </div>
                                <p class="text-slate-800 font-bold">No se encontraron resultados</p>
                                <p class="text-slate-400 text-xs mt-1">Intente ajustar los filtros de búsqueda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="p-6 border-t border-slate-100 bg-slate-50/30">
            {{ $tesones->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    {{-- Delete Modal --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-data x-transition>
            <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full border border-slate-100 slide-up">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-red-50 text-red-600 mb-6 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 text-center mb-2">¿Eliminar este Tesón?</h3>
                <p class="text-slate-500 text-center mb-8 px-4 font-medium">Esta acción como administrador eliminará el registro de la base de datos central. No se puede revertir.</p>
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
</div>
