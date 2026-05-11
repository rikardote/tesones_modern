@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Registro
        </h1>
    </div>

    <div class="max-w-lg mx-auto">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" name="name"
                               class="form-input @error('name') has-error @enderror"
                               value="{{ old('name') }}" required autofocus>
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input id="email" type="email" name="email"
                               class="form-input @error('email') has-error @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" name="password"
                               class="form-input @error('password') has-error @enderror" required>
                        @error('password')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="form-input" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-full py-2.5">
                        Registrarse
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
