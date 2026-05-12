@extends('layouts.app')

@section('title', 'Mi Información')

@section('content')
    <div x-data="{ modal: false }">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Mi Información
            </h1>
            <button @click="modal = true" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                Editar
            </button>
        </div>

        {{-- Info actual del usuario --}}
        <div class="max-w-2xl">
            <div class="card">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</span>
                        <p class="text-gray-800 font-medium mt-1">{{ $user->name }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</span>
                        <p class="text-gray-800 font-medium mt-1">{{ $user->email }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Adscripción</span>
                        <p class="text-gray-800 mt-1">{{ $user->adscripcion }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Unidad</span>
                        <p class="text-gray-800 mt-1">{{ $user->unidad }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Lugar</span>
                        <p class="text-gray-800 mt-1">{{ $user->lugar }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Titular del área</span>
                        <p class="text-gray-800 mt-1">{{ $user->titular_area }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pagador Habilitado</span>
                        <p class="text-gray-800 mt-1">{{ $user->pagador_habilitado }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL EDITAR --}}
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
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Editar Información
                    </h2>
                    <button @click="modal = false" class="p-1 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="px-6 py-4">
                    <form action="{{ route('usuarios.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        @include('users.form')
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="modal = false" class="btn btn-outline">Cancelar</button>
                            <button type="submit" class="btn btn-success">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
