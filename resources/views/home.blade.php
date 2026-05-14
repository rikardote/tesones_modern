@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="card-premium bg-white overflow-hidden">
        <div class="py-12 text-center">
            <svg class="w-16 h-16 mx-auto text-emerald-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <h2 class="text-xl font-bold text-slate-900 tracking-tight">Has iniciado sesión</h2>
            <p class="text-slate-500 mt-2 font-medium">Bienvenido al Generador de Tesones</p>
            <a href="{{ route('tesones.index') }}" class="btn-flat btn-flat-primary mt-8">
                Ir a Mis Tesones
            </a>
        </div>
    </div>
@endsection
