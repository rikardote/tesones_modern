@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="card">
            <div class="card-header">Restablecer Contraseña</div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input id="email" type="email" name="email"
                               class="form-input @error('email') has-error @enderror"
                               value="{{ $email ?? old('email') }}" required autofocus>
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input id="password" type="password" name="password"
                               class="form-input @error('password') has-error @enderror" required>
                        @error('password')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="form-input" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-full py-2.5">
                        Restablecer Contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
