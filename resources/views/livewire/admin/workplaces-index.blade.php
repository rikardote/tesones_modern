<div class="fade-in max-w-7xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><span class="text-slate-400">Administración</span></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Centros de Trabajo</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-slate-900 text-white rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011v5m-4 0h4"/>
                    </svg>
                </span>
                Catálogo de Centros
            </h1>
        </div>
        
        <a href="{{ route('admin.workplaces.create') }}" class="btn-flat btn-flat-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Centro
        </a>
    </div>

    <div class="card-premium bg-white overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50/50">
            <div>
                <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">Listado de Unidades</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Gestión global de adscripciones</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input wire:model.live="search" 
                           type="text" 
                           placeholder="Buscar centro..." 
                           class="input-flat pl-10 w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    <div class="overflow-x-auto overflow-y-hidden">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50 text-slate-500 uppercase text-[10px] tracking-widest font-black border-b border-slate-100">
                    <th class="px-6 py-4 text-left">Adscripción / Unidad</th>
                    <th class="px-6 py-4 text-left">Lugar</th>
                    <th class="px-6 py-4 text-left">Titular / Pagador</th>
                    <th class="px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-50">
                @forelse($workplaces as $workplace)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $workplace->adscripcion }}</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase mt-0.5">{{ $workplace->unidad }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-600 uppercase">
                            {{ $workplace->lugar }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-black text-slate-700 uppercase tracking-tighter"><span class="text-slate-400">Tit:</span> {{ $workplace->titular_area ?? 'N/A' }}</div>
                            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter"><span class="text-slate-400">Pag:</span> {{ $workplace->pagador_habilitado ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex justify-end gap-1">
                                <a href="{{ route('admin.workplaces.edit', $workplace) }}" 
                                   class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all"
                                   title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                
                                <button wire:click="delete({{ $workplace->id }})" 
                                        wire:confirm="¿Estás seguro de eliminar este centro de trabajo? Esta acción no se puede deshacer."
                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all"
                                        title="Eliminar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                            No se encontraron centros de trabajo.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $workplaces->links() }}
    </div>
</div>
