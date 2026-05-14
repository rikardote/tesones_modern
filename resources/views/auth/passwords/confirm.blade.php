@extends('layouts.app')

@section('title', 'Confirmar Contraseña')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-xl border border-slate-200">
            <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 font-semibold text-slate-700 flex items-center gap-2 text-sm">Confirmar Contraseña</div>
            <div class="p-5 space-y-4">
                <p class="text-gray-600 text-sm">Por favor confirma tu contraseña antes de continuar.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                            <input id="password" type="password" name="password"
                                   class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('password') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror" required>
                            @error('password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
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
