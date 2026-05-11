@extends('layouts.app')

@section('title', 'Nóminas')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6" x-data="nominaManager">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
            Nóminas
        </h1>
        <button @click="openCreate()" class="btn btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Crear nómina
        </button>

        {{-- MODAL CREAR/EDITAR NÓMINA --}}
        <div x-show="modal" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
             @click.away="modal = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden"
                 @click.stop>
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5" :class="editing ? 'text-amber-500' : 'text-blue-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span x-text="editing ? 'Editar Nómina' : 'Nueva Nómina'"></span>
                    </h2>
                    <button @click="modal = false" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <form :action="formAction" method="POST">
                        @csrf
                        <input type="hidden" name="_method" :value="editing ? 'PATCH' : 'POST'">
                        <div class="space-y-4">
                            <div>
                                <label for="nomina" class="form-label">Nómina</label>
                                <input type="text" name="nomina" id="nomina" class="form-input" x-model="form.nomina" required>
                                <p class="text-xs text-gray-400 mt-1">Ejemplo: ORDINARIA, QNA 01 DEL 2017</p>
                            </div>
                            <div>
                                <label for="fecha_emision" class="form-label">Fecha de emisión</label>
                                <input type="date" name="fecha_emision" id="fecha_emision" class="form-input" x-model="form.fecha_emision" required>
                            </div>
                            <div>
                                <label for="comentario" class="form-label">Comentario</label>
                                <input type="text" name="comentario" id="comentario" class="form-input" x-model="form.comentario">
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-6">
                            <button type="button" @click="modal = false" class="btn btn-outline">Cancelar</button>
                            <button type="submit" class="btn btn-success">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                <span x-text="editing ? 'Actualizar Nómina' : 'Crear Nómina'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>FECHA DE EMISIÓN</th>
                        <th>NÓMINA</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($nominas as $nomina)
                        <tr>
                            <td><span class="font-medium">{{ fecha_dmy($nomina->fecha_emision) }}</span></td>
                            <td>{{ $nomina->nomina }}</td>
                            <td>
                                <div class="flex justify-center gap-1">
                                    <button @click="openEdit({{ $nomina->id }}, '{{ $nomina->nomina }}', '{{ $nomina->fecha_emision?->format('Y-m-d') }}', '{{ $nomina->comentario ?? '' }}')"
                                            class="btn btn-sm btn-warning" title="Editar">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </button>
                                    <a href="{{ route('admin.info_nominas.destroy', $nomina) }}"
                                       onclick="return confirm('¿Seguro de borrar esta Nómina?');"
                                       class="btn btn-sm btn-danger">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('nominaManager', () => ({
            modal: false,
            editing: false,
            form: {
                nomina: '',
                fecha_emision: '',
                comentario: '',
            },
            editId: null,
            get formAction() {
                return this.editing ? `/info_nominas/${this.editId}` : '/info_nominas';
            },
            openCreate() {
                this.editing = false;
                this.editId = null;
                this.form.nomina = '';
                this.form.fecha_emision = '';
                this.form.comentario = '';
                this.modal = true;
            },
            openEdit(id, nomina, fecha, comentario) {
                this.editing = true;
                this.editId = id;
                this.form.nomina = nomina;
                this.form.fecha_emision = fecha;
                this.form.comentario = comentario;
                this.modal = true;
            },
        }));
    });
    </script>
@endsection
