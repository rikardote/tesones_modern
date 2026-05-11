@extends('layouts.app')

@section('title', 'Mis Tesones')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-700 rounded-xl">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-900">{{ $user->adscripcion }}</h1>
                <p class="text-sm text-gray-500">{{ $user->unidad }}</p>
            </div>
        </div>
    </div>

    @if($tesones->isEmpty())
        <div class="card text-center py-16">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            <p class="text-gray-500 mb-4">No hay tesones registrados</p>
            <a href="{{ route('tesones.create') }}" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Crear primero
            </a>
        </div>
    @else
        <div class="card overflow-hidden">
            <div class="card-header">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Mis Tesones
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>FECHA DE EMISIÓN</th>
                            <th>TIPO DE NÓMINA</th>
                            <th>TIPO DE PERSONAL</th>
                            <th>FORMA DE PAGO</th>
                            <th class="text-center">ACCIONES</th>
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
                                <td>
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('tesones.edit', $teson) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </a>
                                        <a href="{{ route('tesones.destroy', $teson) }}"
                                           onclick="return confirm('¿Seguro de borrar este Tesón?');"
                                           class="btn btn-sm btn-danger" title="Eliminar">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
