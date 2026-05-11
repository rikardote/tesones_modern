@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Modificar Usuarios
        </h1>
    </div>

    <div class="card" x-data="userManager()">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Adscripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                        <tr>
                            <td class="font-medium">{{ $user->name }}</td>
                            <td class="text-gray-500">{{ $user->email }}</td>
                            <td><span class="badge badge-gray">{{ $user->adscripcion }}</span></td>
                            <td>
                                <div class="flex justify-center gap-1">
                                    <button
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-adscripcion="{{ $user->adscripcion }}"
                                            data-unidad="{{ $user->unidad }}"
                                            data-lugar="{{ $user->lugar }}"
                                            data-titular="{{ $user->titular_area }}"
                                            data-pagador="{{ $user->pagador_habilitado }}"
                                            @click="openEdit($event.currentTarget.dataset)"
                                            class="btn btn-sm btn-warning" title="Editar">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </button>
                                    <button
                                            data-uid="{{ $user->id }}"
                                            data-uname="{{ $user->name }}"
                                            @click="openPassword($event.currentTarget.dataset)"
                                            class="btn btn-sm btn-secondary" title="Cambiar contraseña">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    </button>
                                    <a href="{{ route('usuario.ver', $user) }}" class="btn btn-sm btn-secondary" title="Ver tesones">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('usuario.destroy', $user) }}"
                                       onclick="return confirm('¿Seguro de borrar este Usuario?');"
                                       class="btn btn-sm btn-danger" title="Eliminar">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- MODAL EDITAR USUARIO --}}
        <div x-show="editModal" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
             @click.away="editModal = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden"
                 @click.stop>
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Editar Usuario
                    </h2>
                    <button @click="editModal = false" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <form :action="editAction" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" x-model="form.name" class="form-input" required>
                            </div>
                            <div>
                                <label class="form-label">Adscripción</label>
                                <input type="text" name="adscripcion" x-model="form.adscripcion" class="form-input" required>
                            </div>
                            <div>
                                <label class="form-label">Unidad</label>
                                <input type="text" name="unidad" x-model="form.unidad" class="form-input" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label">Lugar</label>
                                <input type="text" name="lugar" x-model="form.lugar" class="form-input" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label">Titular del área</label>
                                <input type="text" name="titular_area" x-model="form.titular_area" class="form-input" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label">Pagador Habilitado</label>
                                <input type="text" name="pagador_habilitado" x-model="form.pagador_habilitado" class="form-input" required>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-6">
                            <button type="button" @click="editModal = false" class="btn btn-outline">Cancelar</button>
                            <button type="submit" class="btn btn-success">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL CAMBIAR CONTRASEÑA --}}
        <div x-show="passwordModal" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
             @click.away="passwordModal = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden"
                 @click.stop>
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        Cambiar Contraseña
                        <span class="text-sm font-normal text-gray-500">— <span x-text="passwordUserName"></span></span>
                    </h2>
                    <button @click="passwordModal = false" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <form :action="passwordAction" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-4">
                            <div>
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" name="password" id="password" class="form-input" required minlength="6" placeholder="Mínimo 6 caracteres">
                            </div>
                            <div>
                                <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" id="password-confirm" class="form-input" required minlength="6" placeholder="Repite la contraseña">
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-6">
                            <button type="button" @click="passwordModal = false" class="btn btn-outline">Cancelar</button>
                            <button type="submit" class="btn btn-success">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                Actualizar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
    function userManager() {
        return {
            editModal: false,
            passwordModal: false,
            editUserId: null,
            passwordUserId: null,
            passwordUserName: '',
            form: {
                name: '',
                adscripcion: '',
                unidad: '',
                lugar: '',
                titular_area: '',
                pagador_habilitado: '',
            },
            get editAction() {
                return this.editUserId ? `/usuarios/${this.editUserId}/actualizar` : '#';
            },
            get passwordAction() {
                return this.passwordUserId ? `/usuarios/${this.passwordUserId}/password` : '#';
            },
            openEdit(d) {
                this.editUserId = d.id;
                this.form.name = d.name;
                this.form.adscripcion = d.adscripcion;
                this.form.unidad = d.unidad;
                this.form.lugar = d.lugar;
                this.form.titular_area = d.titular;
                this.form.pagador_habilitado = d.pagador;
                this.editModal = true;
            },
            openPassword(d) {
                this.passwordUserId = d.uid;
                this.passwordUserName = d.uname;
                this.passwordModal = true;
            },
        };
    }
    </script>
@endsection
