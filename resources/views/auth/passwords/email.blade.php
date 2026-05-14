@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-xl border border-slate-200">
            <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 font-semibold text-slate-700 flex items-center gap-2 text-sm">Restablecer Contraseña</div>
            <div class="p-5 space-y-4">
                @if (session('status'))
                    <div class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm border-l-4 bg-emerald-50 border-emerald-500 text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico</label>
                            <input id="email" type="email" name="email"
                                   class="block w-full rounded-lg border-slate-200 bg-white text-sm transition-colors focus:border-blue-500 focus:ring-0 @error('email') border-red-400 focus:border-red-500 focus:ring-red-500 @enderror"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all w-full py-2.5">
                            Enviar enlace de restablecimiento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
