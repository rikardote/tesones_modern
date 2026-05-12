@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="fade-in max-w-4xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.users_all.index') }}" class="hover:text-blue-600 transition-colors">Usuarios</a></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Edición de Perfil</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-amber-500 text-white rounded-xl shadow-lg shadow-amber-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </span>
                Editar: {{ $user->name }}
            </h1>
        </div>
        
        <a href="{{ route('admin.users_all.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-xl shadow-sm border border-slate-200 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Cancelar y Volver
        </a>
    </div>

    {{-- Main Form Card --}}
    <div class="card overflow-hidden border-none shadow-2xl shadow-slate-200/60 ring-1 ring-slate-200 bg-white">
        <div class="p-1 bg-gradient-to-r from-amber-500 to-orange-500"></div>
        <div class="p-8 md:p-12">
            <form action="{{ route('usuarios.update.admin', $user) }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')
                
                <div class="space-y-6">
                    <div class="pb-4 border-b border-slate-50 mb-6">
                        <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight">Información de Adscripción</h2>
                        <p class="text-slate-400 text-xs mt-1">Modifique los datos de oficina y firmas del usuario.</p>
                    </div>
                    
                    @include('users.form')
                </div>

                <div class="pt-8 border-t border-slate-50 flex justify-end">
                    <button type="submit" class="px-10 py-4 bg-slate-900 hover:bg-black text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-xl shadow-slate-200 transition-all transform hover:scale-[1.02] active:scale-95 flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
