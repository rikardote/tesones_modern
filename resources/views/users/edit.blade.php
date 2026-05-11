@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Editar Usuario: <span class="text-blue-700">{{ $user->name }}</span>
        </h1>
    </div>

    <div class="max-w-2xl">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('usuarios.update.admin', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    @include('users.form')
                    <button type="submit" class="btn btn-success w-full py-2.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Actualizar Usuario
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
