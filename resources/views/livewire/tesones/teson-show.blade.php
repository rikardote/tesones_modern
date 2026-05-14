<div class="fade-in max-w-6xl mx-auto py-8 px-4">
    {{-- Breadcrumbs & Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 skip-print">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('tesones.index') }}" class="hover:text-blue-600 transition-colors">Mis Tesones</a></li>
                    <li><svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Detalle de Registro</li>
                </ol>
            </nav>
            @php
                $creatorAvatar = $teson->user->getAvatarData();
            @endphp
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl {{ $creatorAvatar['bg'] }} flex items-center justify-center shadow-lg overflow-hidden border-2 border-white shrink-0">
                    <div class="p-1.5 w-full h-full">
                        {!! $creatorAvatar['svg'] !!}
                    </div>
                </div>
                Tesón #{{ $teson->id }}
            </h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ url('/tesones/' . $teson->id . '/imprimir') }}" class="btn-flat bg-emerald-600 text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Imprimir PDF
            </a>
            <div class="h-8 w-px bg-slate-200 mx-2"></div>
            <button wire:click="confirmDeleteTeson" class="p-2.5 text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Eliminar este tesón">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg>
            </button>
        </div>
    </div>

    {{-- Action Bar --}}
    <div class="flex flex-wrap items-center gap-3 mb-6 skip-print">
        <a href="{{ url('/cancelar/' . $teson->id) }}" class="btn-flat btn-flat-white">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Agregar Cancelación
        </a>
        <a href="{{ route('tesones.edit', $teson) }}" class="btn-flat btn-flat-white">
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Editar Datos Base
        </a>
    </div>

    {{-- The Document Card --}}
    <div class="card-premium bg-white">

        
        <div class="p-8 space-y-8">
            {{-- Header: Logo + Internal Control Info --}}
            <div class="flex flex-col md:flex-row justify-between items-start gap-6 border-b border-slate-100 pb-8">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('fotos/60issste.png') }}" alt="ISSSTE" class="h-16 w-auto">
                    <div class="h-12 w-px bg-slate-100"></div>
                    <div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight leading-tight uppercase">Remisión de Nómina</h2>
                        <p class="text-xs font-bold text-indigo-600 tracking-widest uppercase mt-1">{{ $teson->forma_pago_label }}</p>
                    </div>
                </div>
                
                <div class="flex flex-col items-end">
                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest mb-3 italic">T-SON 19.1</span>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex gap-6 text-center">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Día</span>
                            <span class="text-lg font-black text-slate-800 leading-none">{{ getDay($teson->fecha_elaboracion) }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Mes</span>
                            <span class="text-lg font-black text-slate-800 leading-none">{{ getMonth($teson->fecha_elaboracion) }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Año</span>
                            <span class="text-lg font-black text-slate-800 leading-none">{{ getYear($teson->fecha_elaboracion) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Data Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 bg-slate-50/50 p-6 rounded-3xl border border-slate-100">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tipo de Personal</span>
                    <p class="text-sm font-bold text-slate-800 uppercase">{{ $teson->tipo_personal_label }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Fecha de Emisión</span>
                    <p class="text-sm font-bold text-slate-800 uppercase">{{ getDay($teson->nomina->fecha_emision) }} DE {{ getMonth($teson->nomina->fecha_emision) }} DE {{ getYear($teson->nomina->fecha_emision) }}</p>
                </div>
                <div class="space-y-1 lg:col-span-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nómina Asociada</span>
                    <p class="text-sm font-bold text-slate-800 truncate uppercase">{{ $teson->nomina->nomina }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Clave Adscripción</span>
                    <p class="text-sm font-bold text-slate-800 uppercase">{{ $teson->adscripcion_snapshot }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rango de Folios</span>
                    <p class="text-sm font-bold text-slate-800 uppercase">
                        @if(in_array($teson->remision_nomina, [1,2,4,7]))
                            DEL <span class="font-mono">{{ $teson->folio_inicial }}</span> AL <span class="font-mono">{{ $teson->folio_final }}</span>
                        @else
                            <span class="text-slate-400 italic font-normal">Sin folios</span>
                        @endif
                    </p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lugar</span>
                    <p class="text-sm font-bold text-slate-800 uppercase">{{ $teson->lugar_snapshot }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Unidad</span>
                    <p class="text-sm font-bold text-slate-800 uppercase">{{ $teson->unidad_snapshot }}</p>
                </div>
            </div>

            {{-- Table: Cancelaciones --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                        Relación de Cancelaciones
                    </h3>
                    <span class="text-[10px] font-bold text-slate-400 uppercase px-3 py-1 bg-slate-100 rounded-full">Total: {{ $cancelaciones->count() }}</span>
                </div>
                
                <div class="overflow-hidden rounded-2xl border border-slate-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900 text-white uppercase text-[10px] tracking-widest font-bold">
                                <th class="px-6 py-4 text-center">Núm. Emp</th>
                                <th class="px-6 py-4">Nombre del Beneficiario</th>
                                <th class="px-6 py-4 text-center">
                                    {{ $teson->remision_nomina == 1 ? 'Núm. Recibo' : 'Núm. Cheque' }}
                                </th>
                                <th class="px-6 py-4 text-right">Importe</th>
                                <th class="px-6 py-4 text-center">Clave</th>
                                <th class="px-6 py-4 skip-print text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($cancelaciones as $cancelacion)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-center font-mono text-sm text-slate-700">{{ $cancelacion->num_empleado }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-800 font-medium">{{ $cancelacion->nombre }}</td>
                                    <td class="px-6 py-4 text-center font-mono text-sm text-slate-700">{{ $cancelacion->numero_cheque }}</td>
                                    <td class="px-6 py-4 text-right font-mono text-sm font-bold text-slate-900">$ {{ number_format($cancelacion->importe, 2) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="group relative cursor-help">
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold">{{ $cancelacion->clave }}</span>
                                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-2 bg-slate-900 text-white text-[10px] rounded-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 pointer-events-none shadow-xl">
                                                {{ $cancelacion->clave_label }}
                                            </div>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 skip-print">
                                        <div class="flex justify-center gap-2">
                                            <button wire:click="openEditCancelacion({{ $cancelacion->id }})" class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                            <button wire:click="confirmDeleteCancelacion({{ $cancelacion->id }})" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-20 text-center">
                                        <div class="w-16 h-16 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <p class="text-emerald-800 font-black text-2xl tracking-tighter uppercase">Pagada en su totalidad</p>
                                        <p class="text-slate-400 text-xs font-bold uppercase mt-2">No se registraron cancelaciones en esta remisión</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Observaciones --}}
            <div class="pt-6 border-t border-slate-100">
                <div class="bg-amber-50 p-4 rounded-2xl border border-amber-100">
                    <span class="text-[10px] font-black text-amber-700 uppercase tracking-widest block mb-2">Observaciones</span>
                    <p class="text-sm text-amber-900 leading-relaxed italic">{{ $teson->observaciones ?: 'Ninguna observación registrada.' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirmation Modals (Portals-like) --}}
    @if ($deleteId)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-data x-transition>
            <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-md w-full border border-slate-100 slide-up">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-red-50 text-red-600 mb-6 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 text-center mb-2">
                    {{ $deleteTarget === 'teson' ? '¿Eliminar este Tesón?' : '¿Eliminar esta Cancelación?' }}
                </h3>
                <p class="text-slate-500 text-center mb-8 px-4">Esta acción es irreversible y eliminará permanentemente la información del servidor.</p>
                <div class="grid grid-cols-2 gap-4">
                    <button wire:click="cancelDelete" class="py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors">Cancelar</button>
                    <button wire:click="deleteConfirmed" class="py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transition-all flex items-center justify-center gap-2">
                        <span wire:loading wire:target="deleteConfirmed" class="lw-spinner border-white"></span>
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Edit Cancelacion Modal --}}
    @if ($showEditModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md" x-data x-transition>
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100 slide-up">

                <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
                    <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Editar Cancelación
                    </h2>
                    <button wire:click="closeEditModal" class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 transition-colors">&times;</button>
                </div>
                <div class="px-8 py-8">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Nombre del Beneficiario</label>
                            <input type="text" wire:model="edit_nombre" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all font-semibold">
                            @error('edit_nombre') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Núm. Empleado</label>
                            <input type="number" wire:model="edit_num_empleado" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 font-mono">
                            @error('edit_num_empleado') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">{{ $teson->remision_nomina == 1 ? 'Núm. Recibo' : 'Núm. Cheque' }}</label>
                            <input type="number" wire:model="edit_numero_cheque" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 font-mono">
                            @error('edit_numero_cheque') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Importe ($)</label>
                            <input type="number" step="0.01" wire:model="edit_importe" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 font-bold">
                            @error('edit_importe') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Motivo (Clave)</label>
                            <select wire:model="edit_clave" class="form-select w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 text-xs">
                                <option value="">Selecciona...</option>
                                @foreach($claves as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('edit_clave') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50 flex justify-end gap-3">
                    <button wire:click="closeEditModal" class="px-4 py-2 text-slate-600 font-bold text-sm">Cancelar</button>
                    <button wire:click="updateCancelacion" class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow-lg shadow-amber-200 transition-all flex items-center gap-2">
                        <span wire:loading wire:target="updateCancelacion" class="lw-spinner border-white"></span>
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
