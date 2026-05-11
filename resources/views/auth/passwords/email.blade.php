@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="card">
            <div class="card-header">Restablecer Contraseña</div>
            <div class="card-body space-y-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" name="email"
                                   class="form-input @error('email') has-error @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-full py-2.5">
                            Enviar enlace de restablecimiento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
