@extends('layouts.app')

@section('title', 'Administración de Usuarios')

@section('content')
<div class="fade-in max-w-7xl mx-auto py-8 px-4" x-data="userManager()">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><span class="text-slate-400">Administración</span></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Control de Accesos</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-slate-900 text-white rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </span>
                Gestión de Usuarios
            </h1>
        </div>
        
        <div class="flex items-center gap-3 bg-white p-2 rounded-2xl border border-slate-100 shadow-sm px-4">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total activos:</span>
            <span class="text-sm font-black text-blue-600">{{ count($users) }}</span>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Identidad</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Adscripción / Unidad</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $user)
                        <tr class="group hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    @php $userAvatar = $user->getAvatarData(); @endphp
                                    <div class="w-10 h-10 rounded-xl {{ $userAvatar['bg'] }} flex items-center justify-center shadow-md overflow-hidden shrink-0 border border-white">
                                        <div class="p-2 w-full h-full">
                                            {!! $userAvatar['svg'] !!}
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-slate-900 font-black text-sm tracking-tight leading-tight">{{ $user->name }}</span>
                                        <span class="text-slate-400 text-[11px] font-medium">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-wider w-fit">{{ $user->adscripcion }}</span>
                                    <span class="text-slate-400 text-[10px] font-bold mt-1 uppercase">{{ $user->unidad ?: 'Sin unidad asignada' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.usuarios.edit', $user) }}"
                                       class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all" title="Editar Perfil">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <button
                                        data-uid="{{ $user->id }}"
                                        data-uname="{{ $user->name }}"
                                        data-uavatar="{{ $user->avatar ?: 'av-1' }}"
                                        @click="openPassword($event.currentTarget.dataset)"
                                        class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Seguridad / Password">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                    </button>
                                    <a href="{{ route('usuario.ver', $user) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Expediente / Tesones">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('usuario.destroy', $user) }}"
                                       onclick="return confirm('¿Seguro de borrar este Usuario?');"
                                       class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Eliminar Acceso">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL EDITAR USUARIO --}}
    <div x-show="editModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md"
         @keydown.escape.window="editModal = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100 slide-up"
             @click.away="editModal = false">

            <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
                <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Editar Perfil de Usuario
                </h2>
                <button @click="editModal = false" class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 transition-colors">&times;</button>
            </div>
            <div class="px-8 py-8">
                <form :action="editAction" method="POST" id="editUserForm">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Nombre Completo</label>
                            <input type="text" name="name" x-model="form.name" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all font-semibold" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Adscripción</label>
                            <input type="text" name="adscripcion" x-model="form.adscripcion" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 uppercase" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Unidad</label>
                            <input type="text" name="unidad" x-model="form.unidad" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 uppercase" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Lugar / Ubicación</label>
                            <input type="text" name="lugar" x-model="form.lugar" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 uppercase" required>
                        </div>
                        <div class="md:col-span-2 border-t border-slate-50 pt-4 mt-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Titular del Área (Firma)</label>
                            <input type="text" name="titular_area" x-model="form.titular_area" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 uppercase" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Pagador Habilitado (Firma)</label>
                            <input type="text" name="pagador_habilitado" x-model="form.pagador_habilitado" class="form-input w-full rounded-xl border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 uppercase" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50 flex justify-end gap-3">
                <button type="button" @click="editModal = false" class="px-4 py-2 text-slate-600 font-bold text-sm">Cancelar</button>
                <button type="submit" form="editUserForm" class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow-lg shadow-amber-200 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Actualizar Datos
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL CAMBIAR CONTRASEÑA --}}
    <div x-show="passwordModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md"
         @keydown.escape.window="passwordModal = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden border border-slate-100 slide-up"
             @click.away="passwordModal = false">

            <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
                <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                    Credenciales de Acceso
                </h2>
                <button @click="passwordModal = false" class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 transition-colors">&times;</button>
            </div>
            <div class="px-8 py-8">
                <div class="mb-6 p-4 bg-indigo-50 rounded-2xl border border-indigo-100 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xs font-black shadow-sm overflow-hidden"
                         :class="avatarIcons[passwordUserAvatar]?.bg || 'bg-slate-100'"
                         x-html="avatarIcons[passwordUserAvatar]?.svg || ''">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Cambiando clave para:</span>
                        <span class="text-xs font-black text-indigo-900" x-text="passwordUserName"></span>
                    </div>
                </div>
                <form :action="passwordAction" method="POST" id="passwordForm">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-5">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Nueva Contraseña</label>
                            <input type="password" name="password" class="form-input w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10" required minlength="6" placeholder="Mínimo 6 caracteres">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Verificación de Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-input w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10" required minlength="6" placeholder="Repita la nueva contraseña">
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50 flex justify-end gap-3">
                <button type="button" @click="passwordModal = false" class="px-4 py-2 text-slate-600 font-bold text-sm">Cancelar</button>
                <button type="submit" form="passwordForm" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 21a11.959 11.959 0 01-9.618-7.016m19.236 0h-19.236m19.236 0a11.959 11.959 0 01-9.618-7.016A11.955 11.955 0 0112 3a11.955 11.955 0 019.618 7.016z"/></svg>
                    Confirmar Nueva Clave
                </button>
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
            passwordUserAvatar: 'av-1',
            avatarIcons: @json(App\Models\User::avatarIcons()),
            passwordUserId: null,
            passwordUserName: '',
            passwordUserAvatar: 'av-1',
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
                this.passwordUserAvatar = d.uavatar || 'av-1';
                this.passwordModal = true;
            },
        };
    }
    </script>
@endsection
