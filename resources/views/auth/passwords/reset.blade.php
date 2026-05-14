@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-xl border border-slate-200">
            <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 font-semibold text-slate-700 flex items-center gap-2 text-sm">Restablecer Contraseña</div>
            <div class="p-5">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico</label>
                        <input id="email" type="email" name="email"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('email') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                               value="{{ $email ?? old('email') }}" required autofocus>
                        @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Nueva Contraseña</label>
                        <input id="password" type="password" name="password"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('password') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror" required>
                        @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-medium text-slate-700 mb-1">Confirmar Contraseña</label>
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0" required>
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-base font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all w-full">
                        Restablecer Contraseña
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
