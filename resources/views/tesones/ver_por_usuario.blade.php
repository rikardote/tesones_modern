@extends('layouts.app')

@section('title', 'Tesones por Usuario')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="flex items-center justify-center w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-900">{{ $user->adscripcion }} — {{ $user->unidad }}</h1>
                <p class="text-sm text-gray-500">{{ $user->name }}</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Tesones del usuario
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>FECHA</th>
                        <th>NÓMINA</th>
                        <th>PERSONAL</th>
                        <th>PAGO</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($tesones as $teson)
                        <tr class="@if($teson->cancelaciones_count > 0) bg-red-50 hover:bg-red-100 @endif">
                            <td>
                                <a href="{{ route('tesones.show', $teson) }}" class="text-blue-600 hover:text-blue-800 font-medium"
                                   title="@if($teson->cancelaciones_count > 0){{ $teson->cancelaciones_count }} cancelacione(s)@else Sin cancelaciones @endif">
                                    {{ fecha_dmy($teson->nomina->fecha_emision) }}
                                </a>
                            </td>
                            <td>{{ $teson->nomina->nomina }}</td>
                            <td><span class="badge badge-gray">{{ $teson->tipo_personal_label }}</span></td>
                            <td><span class="badge badge-info whitespace-nowrap">{{ $teson->forma_pago_label }}</span></td>
                        </tr>
                    @endforeach
                    @if($tesones->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-400">Este usuario no tiene tesones.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
