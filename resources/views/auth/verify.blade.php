@extends('layouts.app')

@section('title', 'Verificar Email')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="card">
            <div class="card-header">Verificar Correo Electrónico</div>
            <div class="card-body space-y-4">
                @if (session('resent'))
                    <div class="alert alert-success">
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
                    <button type="submit" class="btn btn-primary">
                        Solicitar otro enlace
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
