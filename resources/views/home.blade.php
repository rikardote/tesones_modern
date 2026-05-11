@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card text-center py-12">
        <svg class="w-16 h-16 mx-auto text-emerald-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <h2 class="text-xl font-semibold text-gray-900">Has iniciado sesión</h2>
        <p class="text-gray-500 mt-2">Bienvenido al Generador de Tesones</p>
        <a href="{{ route('tesones.index') }}" class="btn btn-primary mt-6">
            Ir a Mis Tesones
        </a>
    </div>
@endsection
