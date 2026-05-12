<div class="fade-in max-w-6xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><span class="text-slate-400">Administración</span></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Catálogo de Nóminas</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </span>
                Gestión de Nóminas
            </h1>
        </div>
        
        <button wire:click="openCreate" class="group inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all duration-200 hover:scale-[1.02] active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Nómina
        </button>
    </div>

    {{-- Notifications --}}
    @if($flashMessage)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition class="flex items-center gap-3 p-4 mb-8 bg-blue-50 border border-blue-100 rounded-2xl text-blue-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-sm font-semibold flex-1">{{ $flashMessage }}</div>
            <button @click="show = false" class="p-1 hover:bg-black/5 rounded-lg">&times;</button>
        </div>
    @endif

    {{-- Main Table Card --}}
    <div class="card overflow-hidden border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200 bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100">Fecha Emisión</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100">Descripción de la Nómina</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-slate-100 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($nominas as $nomina)
                        <tr class="group hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <span class="text-slate-900 font-bold text-sm">{{ fecha_dmy($nomina->fecha_emision) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-slate-700 font-medium text-sm">{{ $nomina->nomina }}</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="openEdit({{ $nomina->id }})" class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all" title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $nomina->id }})" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-20 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                                </div>
                                <p class="text-slate-400 font-bold uppercase text-xs tracking-widest">No hay nóminas en el catálogo</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($nominas->hasPages())
            <div class="p-6 border-t border-slate-100 bg-slate-50/30">
                {{ $nominas->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    {{-- Modals --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-data x-transition>
            <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full border border-slate-100 slide-up">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-red-50 text-red-600 mb-6 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 text-center mb-2">¿Eliminar Nómina?</h3>
                <p class="text-slate-500 text-center mb-8 px-4">Si esta nómina ya tiene Tesones generados, el sistema impedirá su eliminación por integridad de datos.</p>
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

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md" x-data x-transition>
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100 slide-up">
                <div class="p-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
                    <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        {{ $isEditing ? 'Editar Nómina' : 'Nueva Nómina' }}
                    </h2>
                    <button wire:click="closeModal" class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 transition-colors">&times;</button>
                </div>
                <div class="px-8 py-8 space-y-6">
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Nombre Descriptivo</label>
                        <input type="text" wire:model="nominaNombre" class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold uppercase" placeholder="Ej: ORDINARIA, QNA 01 DEL 2026">
                        <p class="mt-1.5 text-[10px] text-slate-400 italic">Sugerencia: TIPO, QNA [XX] DEL [AÑO]</p>
                        @error('nominaNombre') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Fecha de Emisión Oficial</label>
                        <input type="date" wire:model="fechaEmision" class="form-input w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                        @error('fechaEmision') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50 flex justify-end gap-3">
                    <button wire:click="closeModal" class="px-4 py-2 text-slate-600 font-bold text-sm">Cancelar</button>
                    <button wire:click="save" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
                        <span wire:loading wire:target="save" class="lw-spinner border-white"></span>
                        {{ $isEditing ? 'Guardar Cambios' : 'Crear Registro' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
