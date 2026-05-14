@extends('layouts.app')

@section('title', 'Seguridad de Usuario')

@section('content')
<div class="fade-in max-w-2xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.users_all.index') }}" class="hover:text-blue-600 transition-colors">Usuarios</a></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Gestión de Claves</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-indigo-600 text-white rounded-xl shadow-lg shadow-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </span>
                Seguridad: {{ $user->name }}
            </h1>
        </div>
    </div>

    {{-- Password Reset Card --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        <div class="p-8 md:p-10">
            <div class="mb-8 p-4 bg-indigo-50 rounded-2xl border border-indigo-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white text-indigo-600 flex items-center justify-center text-xl font-black shadow-sm">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Restableciendo para:</p>
                    <p class="text-sm font-black text-indigo-900 uppercase tracking-tight">{{ $user->email }}</p>
                </div>
            </div>

            <form action="{{ route('usuarios.update.password', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="space-y-5">
                    <div>
                        <label for="password" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Nueva Contraseña Maestra</label>
                        <input type="password" name="password" id="password" 
                               class="block bg-white w-full rounded-2xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 py-4 transition-all" 
                               required minlength="6" placeholder="Mínimo 6 caracteres">
                    </div>

                    <div>
                        <label for="password-confirm" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 block">Confirmar Identidad de Clave</label>
                        <input type="password" name="password_confirmation" id="password-confirm" 
                               class="block bg-white w-full rounded-2xl border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 py-4 transition-all" 
                               required minlength="6" placeholder="Repita la nueva contraseña">
                    </div>
                </div>

                <div class="pt-6 flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-xl shadow-indigo-100 transition-all transform hover:scale-[1.01] active:scale-95 flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 21a11.959 11.959 0 01-9.618-7.016m19.236 0h-19.236m19.236 0a11.959 11.959 0 01-9.618-7.016A11.955 11.955 0 0112 3a11.955 11.955 0 019.618 7.016z"/></svg>
                        Confirmar Nueva Contraseña
                    </button>
                    <a href="{{ route('admin.users_all.index') }}" class="w-full py-4 bg-slate-50 hover:bg-slate-100 text-slate-500 font-bold uppercase tracking-widest text-[10px] rounded-2xl text-center transition-colors">
                        Cancelar Operación
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
