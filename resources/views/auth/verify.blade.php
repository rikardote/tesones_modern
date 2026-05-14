@extends('layouts.app')

@section('title', 'Verificar Email')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-xl border border-slate-200">
            <div class="px-5 py-3.5 border-b border-slate-100 bg-slate-50 font-semibold text-slate-700 flex items-center gap-2 text-sm">Verificar Correo Electrónico</div>
            <div class="p-5 space-y-4">
                @if (session('resent'))
                    <div class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm border-l-4 bg-emerald-50 border-emerald-500 text-emerald-800">
                        Se ha enviado un nuevo enlace de verificación a tu correo.
                    </div>
                @endif

                <p class="text-gray-600 text-sm">
                    Antes de continuar, por favor revisa tu correo para el enlace de verificación.
                </p>
                <p class="text-gray-600 text-sm">
                    Si no recibiste el correo,
                </p>
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all">
                        Solicitar otro enlace
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
