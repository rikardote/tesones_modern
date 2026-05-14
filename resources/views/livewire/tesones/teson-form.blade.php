<div class="fade-in max-w-7xl mx-auto py-8 px-4">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8 px-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('tesones.index') }}" class="hover:text-blue-600 transition-colors">Tesones</a></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold uppercase tracking-widest text-[10px]">{{ $isEdit ? 'Edición' : 'Nuevo Registro' }}</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 {{ $isEdit ? 'bg-amber-500' : 'bg-blue-600' }} text-white rounded-xl shadow-lg shadow-{{ $isEdit ? 'amber' : 'blue' }}-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($isEdit)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        @endif
                    </svg>
                </span>
                {{ $isEdit ? 'Editar Tesón' : 'Crear Nuevo Tesón' }}
            </h1>
        </div>
        
        <a href="{{ url()->previous() }}" class="group flex items-center gap-2 px-6 py-3 text-sm font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Regresar
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Form Side --}}
        <div class="lg:col-span-8 space-y-6">
            {{-- Section 0: Centro de Trabajo --}}
            <div class="card overflow-hidden border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200">
                <div class="p-1 bg-gradient-to-r from-emerald-500 to-teal-600"></div>
                <div class="card-body p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xs">0</div>
                        <h2 class="text-lg font-black text-slate-800 uppercase tracking-tight">Centro de Trabajo</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 block">Seleccionar Centro Autorizado</label>
                            <select wire:model.live="workplace_id" 
                                    class="form-select w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 font-bold @error('workplace_id') ring-2 ring-red-500 @enderror">
                                <option value="">--- Seleccione su centro de adscripción ---</option>
                                @foreach($workplaces as $w)
                                    <option value="{{ $w->id }}">{{ $w->adscripcion }} - {{ $w->lugar }}</option>
                                @endforeach
                            </select>
                            @error('workplace_id') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        @if($workplace_id)
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase block">Adscripción</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $adscripcion_snapshot }}</span>
                                </div>
                                <div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase block">Unidad</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $unidad_snapshot }}</span>
                                </div>
                                <div>
                                    <span class="text-[9px] font-black text-slate-400 uppercase block">Lugar</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $lugar_snapshot }}</span>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Titular del Área</label>
                                <input type="text" wire:model="titular_area_snapshot" 
                                       class="form-input w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 font-bold">
                                @error('titular_area_snapshot') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Pagador Habilitado</label>
                                <input type="text" wire:model="pagador_habilitado_snapshot" 
                                       class="form-input w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 font-bold">
                                @error('pagador_habilitado_snapshot') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Section 1: Nomina --}}
            <div class="card overflow-hidden border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200">
                <div class="p-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                <div class="card-body p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-black text-xs">1</div>
                        <h2 class="text-lg font-black text-slate-800 uppercase tracking-tight">Selección de Nómina</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="relative">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 block">Base de Datos de Nóminas</label>
                            <div class="relative group">
                                <select wire:model="nomina_id" 
                                        class="form-select w-full h-56 rounded-2xl border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold @error('nomina_id') ring-2 ring-red-500 @enderror" 
                                        size="6">
                                    <option value="" disabled class="py-3 text-slate-400">--- Seleccione el periodo de nómina correspondiente ---</option>
                                    @foreach($nominas as $id => $nomina)
                                        <option value="{{ $id }}" class="py-3 px-5 hover:bg-blue-50 cursor-pointer border-b border-slate-50 last:border-0">{{ $nomina }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('nomina_id') <p class="mt-2 text-xs font-bold text-red-500 flex items-center gap-1 uppercase tracking-tighter">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2: Detalles --}}
            <div class="card overflow-hidden border-none shadow-xl shadow-slate-200/60 ring-1 ring-slate-200">
                <div class="p-1 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                <div class="card-body p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xs">2</div>
                        <h2 class="text-lg font-black text-slate-800 uppercase tracking-tight">Detalles del Documento</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Tipo de Personal</label>
                            <select wire:model="tipo_personal" class="form-select w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 font-bold @error('tipo_personal') ring-2 ring-red-500 @enderror">
                                <option value="">Selecciona...</option>
                                @foreach($tiposPersonal as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('tipo_personal') <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Modalidad de Pago</label>
                            <select wire:model.live="remision_nomina" class="form-select w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 font-bold @error('remision_nomina') ring-2 ring-red-500 @enderror">
                                <option value="">Selecciona...</option>
                                @foreach($formasPago as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('remision_nomina') <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        @php
                            $placeholder = 'Mín. 1 dígito';
                            if (in_array((string)$remision_nomina, ['1', '7'])) {
                                $placeholder = '7 dígitos exactos';
                            } elseif (in_array((string)$remision_nomina, ['2', '4'])) {
                                $placeholder = 'Mín. 4 dígitos';
                            }
                        @endphp

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Folio Inicial</label>
                            <input type="number" 
                                   wire:model.live.debounce.500ms="folio_inicial" 
                                   class="form-input w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all font-mono text-lg @error('folio_inicial') ring-2 ring-red-500 @enderror" 
                                   placeholder="{{ $placeholder }}">
                            @error('folio_inicial') <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Folio Final</label>
                            <input type="number" 
                                   wire:model.live.debounce.500ms="folio_final" 
                                   class="form-input w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all font-mono text-lg @error('folio_final') ring-2 ring-red-500 @enderror" 
                                   placeholder="{{ $placeholder }}">
                            @error('folio_final') <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Observaciones Especiales</label>
                            <textarea wire:model="observaciones" 
                                      rows="4"
                                      class="form-input w-full rounded-2xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 font-medium" 
                                      placeholder="Agregue comentarios adicionales si es necesario..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Summary --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="card bg-slate-900 border-none shadow-2xl shadow-slate-300 text-white overflow-hidden sticky top-8">
                <div class="p-8">
                    <h3 class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] mb-8">Validación de Envío</h3>
                    
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Nómina</span>
                            <span class="text-sm font-black mt-1 line-clamp-2 leading-snug">
                                {{ $nomina_id ? ($nominas[$nomina_id] ?? '...') : 'No seleccionada' }}
                            </span>
                        </div>
                        
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Personal / Pago</span>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="px-2 py-0.5 rounded bg-slate-800 text-[10px] font-black uppercase tracking-widest text-slate-300">{{ $tipo_personal ? ($tiposPersonal[$tipo_personal] ?? '...') : 'Pendiente' }}</span>
                                <span class="px-2 py-0.5 rounded bg-blue-900/40 text-[10px] font-black uppercase tracking-widest text-blue-400 border border-blue-500/20">{{ $remision_nomina ? ($formasPago[$remision_nomina] ?? '...') : 'Pendiente' }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Rango de Folios</span>
                            @if($folio_inicial || $folio_final)
                                <div class="flex items-center gap-3 mt-2 bg-slate-800/50 p-3 rounded-xl border border-white/5">
                                    <span class="text-blue-400 font-black font-mono text-sm tracking-tighter">{{ $folio_inicial ?: '0000' }}</span>
                                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    <span class="text-blue-400 font-black font-mono text-sm tracking-tighter">{{ $folio_final ?: '0000' }}</span>
                                </div>
                            @else
                                <span class="text-xs font-bold mt-2 text-slate-600 italic">Folios no definidos</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-10 pt-8 border-t border-white/5">
                        <button wire:click="save"
                                class="w-full bg-blue-600 hover:bg-blue-500 active:scale-95 text-white font-black uppercase tracking-widest text-xs py-4 rounded-2xl shadow-xl shadow-blue-900/40 transition-all duration-300 flex items-center justify-center gap-3 group">
                            <span wire:loading wire:target="save" class="lw-spinner border-white"></span>
                            <span wire:loading.remove wire:target="save" class="flex items-center gap-3">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $isEdit ? 'Guardar Cambios' : 'Generar Registro' }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Help Card --}}
            <div class="bg-indigo-50/50 rounded-2xl p-6 border border-indigo-100/50 flex gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-white rounded-xl shadow-sm border border-indigo-100 flex items-center justify-center text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black text-indigo-900 uppercase tracking-widest">Protocolo de Control</h4>
                    <p class="text-[11px] text-indigo-700/70 mt-1.5 leading-relaxed font-medium">
                        La numeración debe ser correlativa. Si existe un salto de folio, repórtelo en el área de observaciones.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
