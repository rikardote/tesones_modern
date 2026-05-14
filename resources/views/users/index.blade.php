@extends('layouts.app')

@section('title', 'Mi Perfil de Usuario')

@section('content')
<div class="fade-in max-w-4xl mx-auto py-8 px-4" x-data="{ modal: @if($errors->any()) true @else false @endif }">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><span class="text-slate-400">Sistema</span></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Mi Configuración</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
                Perfil de Usuario
            </h1>
        </div>

        @if ($errors->any())
            <div class="px-6 py-4 bg-red-50 border border-red-100 rounded-2xl flex flex-col gap-2 text-red-800 mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg bg-red-500 text-white flex items-center justify-center shadow-lg shadow-red-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-sm font-black uppercase tracking-tight">Se encontraron errores:</div>
                </div>
                <ul class="list-disc list-inside text-xs font-bold pl-12">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <button @click="modal = true" class="group inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-slate-50 text-slate-900 font-bold rounded-xl shadow-sm border border-slate-200 transition-all duration-200 hover:scale-[1.02] active:scale-95">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Editar Información
        </button>
    </div>

    {{-- Main Profile Card --}}
    <div class="card overflow-hidden border-none shadow-2xl shadow-slate-200/60 ring-1 ring-slate-200 bg-white">
        <div class="relative h-32 bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="absolute -bottom-12 left-8 p-1 bg-white rounded-2xl shadow-lg">
                <div class="w-24 h-24 rounded-xl bg-slate-900 text-white flex items-center justify-center text-3xl font-black">
                    {{ substr($user->name, 0, 1) }}
                </div>
            </div>
        </div>
        
        <div class="pt-16 pb-8 px-8">
            <div class="flex flex-col mb-8">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h2>
                <p class="text-slate-500 font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $user->email }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8 border-t border-slate-50 pt-8">
                <div class="space-y-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Adscripción Oficial</span>
                    <p class="text-slate-900 font-bold uppercase tracking-tight">{{ $user->adscripcion ?: 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Unidad Administrativa</span>
                    <p class="text-slate-900 font-bold uppercase tracking-tight">{{ $user->unidad ?: 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ubicación / Lugar</span>
                    <p class="text-slate-900 font-bold uppercase tracking-tight">{{ $user->lugar ?: 'N/A' }}</p>
                </div>
                <div class="space-y-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Titular Responsable</span>
                    <p class="text-slate-900 font-bold uppercase tracking-tight">{{ $user->titular_area ?: 'N/A' }}</p>
                </div>
                <div class="md:col-span-2 space-y-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-blue-600">Pagador Habilitado</span>
                    <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 mt-2">
                        <p class="text-blue-900 font-black uppercase tracking-widest text-sm">{{ $user->pagador_habilitado ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div x-show="modal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md"
         @keydown.escape.window="modal = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100 slide-up"
             @click.away="modal = false">
            <div class="p-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            <div class="flex items-center justify-between px-8 py-6 border-b border-slate-50">
                <h2 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Actualizar Mis Datos
                </h2>
                <button @click="modal = false" class="p-2 hover:bg-slate-50 rounded-xl text-slate-400 transition-colors">&times;</button>
            </div>
            <div class="px-8 py-8">
                <form action="{{ route('usuarios.update', $user) }}" method="POST" id="editProfileForm">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-6">
                        @include('users.form')
                    </div>
                </form>
            </div>
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50 flex justify-end gap-3">
                <button type="button" @click="modal = false" class="px-4 py-2 text-slate-600 font-bold text-sm">Cancelar</button>
                <button type="submit" form="editProfileForm" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
