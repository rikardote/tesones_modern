@extends('layouts.app')

@section('title', 'Editar Nómina')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Editar Nómina
        </h1>
    </div>

    <div class="max-w-lg">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('info_nominas.update', $nomina ?? null) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('admin.nominas.form')
                </form>
            </div>
        </div>
    </div>
@endsection
