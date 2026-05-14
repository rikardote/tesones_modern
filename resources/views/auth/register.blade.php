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
        <div class="bg-white rounded-xl border border-slate-200">
            <div class="p-5">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                        <input id="name" type="text" name="name"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('name') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                               value="{{ old('name') }}" required autofocus>
                        @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico</label>
                        <input id="email" type="email" name="email"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('email') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                        <input id="password" type="password" name="password"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('password') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror" required>
                        @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-medium text-slate-700 mb-1">Confirmar contraseña</label>
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0" required>
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-base font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all w-full">
                        Registrarse
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
