@extends('layouts.app')

@section('title', 'Confirmar Contraseña')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="card">
            <div class="card-header">Confirmar Contraseña</div>
            <div class="card-body space-y-4">
                <p class="text-gray-600 text-sm">Por favor confirma tu contraseña antes de continuar.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" name="password"
                                   class="form-input @error('password') has-error @enderror" required>
                            @error('password')<p class="form-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" class="btn btn-primary">
                                Confirmar Contraseña
                            </button>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
