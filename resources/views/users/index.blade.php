@extends('layouts.app')

@section('title', 'Mi Perfil de Usuario')

@section('content')
<div class="fade-in max-w-7xl mx-auto py-8 px-4">
    {{-- Page header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <nav class="flex mb-2 text-xs font-medium text-slate-500 uppercase tracking-wider" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><span class="text-slate-400">Sistema</span></li>
                    <li><svg class="w-3 h-3 mx-1 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-800 font-bold">Mi Perfil</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-3">
                <span class="p-2.5 bg-slate-900 text-white rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
                Mi Cuenta
            </h1>
        </div>

        @if (session('status'))
            <div class="px-4 py-2 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-xs font-bold uppercase tracking-widest flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Perfil actualizado
            </div>
        @endif
    </div>

    <form action="{{ route('usuarios.update', $user) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {{-- Left: Profile Summary & Avatar Selection --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="card-premium bg-white overflow-hidden">
                    @php
                        $names = explode(' ', $user->name);
                        $initials = substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : '');
                        $initials = strtoupper($initials);

                        $currentAvatar = $user->getAvatarData();
                    @endphp

                    <div class="h-24 bg-slate-50 border-b border-slate-100 flex items-center justify-center">
                        <div class="w-20 h-20 rounded-2xl {{ $currentAvatar['bg'] }} flex items-center justify-center shadow-xl -mb-16 border-4 border-white transition-all duration-500 overflow-hidden">
                            {!! $currentAvatar['svg'] !!}
                        </div>
                    </div>
                    
                    <div class="pt-16 pb-8 px-6 text-center">
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h2>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="card-premium bg-white p-6">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 block">Elegir Avatar</label>
                    @include('users.avatars', ['user' => $user, 'initials' => $initials])
                </div>
            </div>

            {{-- Right: Edit Form --}}
            <div class="lg:col-span-8">
                <div class="card-premium bg-white overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-black text-slate-800 uppercase tracking-tight">Datos del Perfil</h2>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Actualiza tu información oficial</p>
                        </div>
                    </div>

                    <div class="p-8">
                        @if ($errors->any())
                            <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-xl text-red-700 text-xs font-bold uppercase tracking-widest">
                                Por favor revisa los errores en el formulario
                            </div>
                        @endif

                        <div class="space-y-10">
                            <div>
                                @include('users.form')
                            </div>
                            
                            <div class="pt-6 border-t border-slate-100 flex justify-end">
                                <button type="submit" class="btn-flat btn-flat-primary px-10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
