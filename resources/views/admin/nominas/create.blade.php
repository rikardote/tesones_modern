@extends('layouts.app')

@section('title', 'Crear Nómina')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nueva Nómina
        </h1>
    </div>

    <div class="max-w-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('info_nominas.store') }}" method="POST">
                    @csrf
                    @include('admin.nominas.form')
                </form>
            </div>
        </div>
    </div>
@endsection
