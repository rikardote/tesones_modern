@extends('layouts.app')

@section('title', 'Cambiar Contraseña')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
            Cambiar Contraseña: <span class="text-blue-700">{{ $user->name }}</span>
        </h1>
    </div>

    <div class="max-w-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('usuarios.update.password', $user) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="form-input" required minlength="6" placeholder="Mínimo 6 caracteres">
                    </div>

                    <div>
                        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-input" required minlength="6" placeholder="Repite la contraseña">
                    </div>

                    <button type="submit" class="btn btn-success w-full py-2.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Actualizar Contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
