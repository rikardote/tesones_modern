<div class="fade-in max-w-6xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('tesones.index') }}" class="hover:text-blue-600 transition-colors">Mis Tesones</a></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li><a href="{{ route('tesones.show', $teson) }}" class="hover:text-blue-600 transition-colors">Expediente #{{ $teson->id }}</a></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Captura de Cancelaciones</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-red-600 text-white rounded-xl shadow-lg shadow-red-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </span>
                Módulo de Cancelaciones
            </h1>
        </div>
        
        <a href="{{ route('tesones.show', $teson) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-xl shadow-sm border border-slate-200 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Volver al Expediente
        </a>
    </div>

    @if($flashMessage)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition class="flex items-center gap-3 p-4 mb-8 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-800">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div class="text-sm font-bold flex-1">{{ $flashMessage }}</div>
            <button @click="show = false" class="p-1 hover:bg-black/5 rounded-lg">&times;</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Capture Form --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="card p-6 bg-white border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200 rounded-3xl sticky top-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $editingId ? 'Editar Registro' : 'Nueva Captura' }}</h2>
                </div>

                <form wire:submit.prevent="save" class="space-y-5">
                    <div class="mb-6 p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Rango del Tesón</p>
                            <p class="text-xs font-black text-slate-700 font-mono tracking-tighter">{{ $teson->folio_inicial }} — {{ $teson->folio_final }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-slate-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Núm. Empleado</label>
                        <input type="text" wire:model.blur="num_empleado" class="form-input w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 font-mono" placeholder="00000">
                        @error('num_empleado') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Nombre del Beneficiario</label>
                        <input type="text" wire:model.blur="nombre" class="form-input w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 uppercase font-semibold" placeholder="Nombre completo">
                        @error('nombre') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Folio (Cheque / Recibo)</label>
                        <input type="text" wire:model.blur="numero_cheque" class="form-input w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 font-mono" placeholder="Rango: {{ $teson->folio_inicial }} - {{ $teson->folio_final }}">
                        @error('numero_cheque') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Importe ($)</label>
                            <input type="text" wire:model.blur="importe" class="form-input w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 font-mono text-right" placeholder="0.00">
                            @error('importe') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5 block">Clave</label>
                            <select wire:model.blur="clave" class="form-select w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 text-xs font-bold">
                                <option value="">Seleccione...</option>
                                @foreach($claves as $val => $lab)
                                    <option value="{{ $val }}">{{ $lab }}</option>
                                @endforeach
                            </select>
                            @error('clave') <p class="mt-1 text-[10px] font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex gap-2">
                        @if($editingId)
                            <button type="button" wire:click="resetForm" class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all">Cancelar</button>
                        @endif
                        <button type="submit" class="flex-[2] py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transition-all flex items-center justify-center gap-2">
                            <span wire:loading wire:target="save" class="lw-spinner border-white"></span>
                            {{ $editingId ? 'Actualizar' : 'Agregar a Lista' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- List --}}
        <div class="lg:col-span-8">
            <div class="card overflow-hidden border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200 bg-white">
                <div class="px-6 py-4 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest">Cancelaciones Registradas</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-black text-slate-400 uppercase">Total:</span>
                        <span class="text-xs font-black text-slate-900 font-mono">$ {{ number_format($cancelaciones->sum('importe'), 2) }}</span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white">
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Empleado</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nombre</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Folio</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Importe</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($cancelaciones as $cancel)
                                <tr class="group hover:bg-slate-50/50 transition-colors {{ $editingId == $cancel->id ? 'bg-amber-50/50' : '' }}">
                                    <td class="px-6 py-4">
                                        <span class="text-slate-900 font-bold font-mono text-sm tracking-tighter">{{ $cancel->num_empleado }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-slate-700 font-semibold text-xs uppercase">{{ $cancel->nombre }}</span>
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-tighter mt-0.5">Clave: {{ $cancel->clave }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-mono text-[10px] font-bold border border-slate-200/50">{{ $cancel->numero_cheque }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-slate-900 font-black font-mono text-sm">$ {{ number_format($cancel->importe, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button wire:click="edit({{ $cancel->id }})" class="p-1.5 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>
                                            <button wire:click="delete({{ $cancel->id }})" 
                                                    wire:confirm="¿Seguro de eliminar este registro?"
                                                    class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-20 text-center">
                                        <div class="w-16 h-16 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        </div>
                                        <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">No hay cancelaciones capturadas</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
