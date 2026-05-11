@extends('layouts.app')

@section('title', 'Todos los Tesones')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Todos los Tesones
        </h1>
    </div>

    <div class="card">
        <div style="overflow-x: hidden;">
            <table class="table" style="table-layout: auto; width: 100%;">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">FECHA</th>
                        <th>NÓMINA</th>
                        <th>PERSONAL</th>
                        <th class="w-28">PAGO</th>
                        <th>UNIDAD</th>
                        <th>USUARIO</th>
                        <th class="text-center w-20">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @foreach($tesones as $teson)
                        <tr class="@if($teson->cancelaciones_count > 0) bg-red-50 hover:bg-red-100 @endif">
                            <td class="whitespace-nowrap">
                                <a href="{{ route('tesones.show', $teson) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ fecha_dmy($teson->nomina->fecha_emision) }}
                                </a>
                            </td>
                            <td title="@if($teson->cancelaciones_count > 0){{ $teson->cancelaciones_count }} cancelacione(s)@else Sin cancelaciones @endif" class="cursor-default">{{ $teson->nomina->nomina }}</td>
                            <td><span class="badge badge-gray">{{ $teson->tipo_personal_label }}</span></td>
                            <td><span class="badge badge-info whitespace-nowrap">{{ $teson->forma_pago_label }}</span></td>
                            <td class="max-w-0 truncate text-gray-500" title="{{ $teson->user->adscripcion ?? 'N/A' }}">{{ $teson->user->adscripcion ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap text-gray-500">{{ $teson->user->name ?? 'N/A' }}</td>
                            <td>
                                <div class="flex justify-center gap-0.5">
                                    <a href="{{ route('tesones.edit', $teson) }}" class="btn btn-sm btn-warning !px-2" title="Editar">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <a href="{{ route('teson.borrar', $teson) }}"
                                       onclick="return confirm('¿Seguro de borrar este Tesón?');"
                                       class="btn btn-sm btn-danger !px-2" title="Eliminar">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($tesones->hasPages())
            <div class="card-body border-t border-gray-100">
                {{ $tesones->links() }}
            </div>
        @endif
    </div>
@endsection
