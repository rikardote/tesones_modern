@extends('layouts.app')

@section('title', 'Ver Tesón #' . $teson->id)

@section('content')
    {{-- Action buttons --}}
    <div class="flex flex-wrap gap-2 mb-6 skip-print">
        <a href="{{ url('/cancelar/' . $teson->id) }}" class="btn btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Agregar Cancelaciones
        </a>
        <a href="{{ route('tesones.edit', $teson) }}" class="btn btn-warning">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            Modificar TESÓN
        </a>
        <a href="{{ url('/tesones/' . $teson->id . '/imprimir') }}" class="btn btn-success">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            Generar PDF
        </a>
    </div>

    {{-- Main content card --}}
    <div class="card">
        <div class="card-body space-y-6">
            {{-- Header: Logo + Fecha --}}
            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                <div>
                    <img src="{{ asset('fotos/60issste.png') }}" alt="ISSSTE" class="logo-header">
                </div>
                <div class="text-right">
                    <span class="badge badge-gray mb-2">(T-SON 19.1)</span>
                    <table class="table text-sm border border-gray-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr><th class="text-center" colspan="3">FECHA DE ELABORACIÓN</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">DÍA: <strong>{{ getDay($teson->fecha_elaboracion) }}</strong></td>
                                <td class="text-center">MES: <strong>{{ getMonth($teson->fecha_elaboracion) }}</strong></td>
                                <td class="text-center">AÑO: <strong>{{ getYear($teson->fecha_elaboracion) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Title --}}
            <h2 class="text-lg font-bold text-gray-900">
                REMISIÓN DE LA NÓMINA DE {{ $teson->forma_pago_label }}
            </h2>

            {{-- Info grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-0 border border-gray-200 rounded-lg overflow-hidden text-sm">
                <div class="p-3 bg-gray-50 font-semibold border-r border-b border-gray-200">TIPO DE PERSONAL:</div>
                <div class="p-3 border-b border-gray-200">{{ $teson->tipo_personal_label }}</div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-b border-gray-200">FECHA DE EMISIÓN:</div>
                <div class="p-3 border-b border-gray-200">
                    {{ getDay($teson->nomina->fecha_emision) }} DE
                    {{ getMonth($teson->nomina->fecha_emision) }} DE
                    {{ getYear($teson->nomina->fecha_emision) }}
                </div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-b border-gray-200">TIPO DE NÓMINA:</div>
                <div class="p-3 border-b border-gray-200">{{ $teson->nomina->nomina }}</div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-b border-gray-200">CLAVE DE ADSCRIPCIÓN:</div>
                <div class="p-3 border-b border-gray-200">{{ $teson->user->adscripcion }}</div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-b border-gray-200">FOLIOS:</div>
                <div class="p-3 border-b border-gray-200">
                    @if(in_array($teson->remision_nomina, [1,2,4,7]))
                        DEL {{ $teson->folio_inicial }} AL {{ $teson->folio_final }}
                    @else
                        —
                    @endif
                </div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-b border-gray-200">LUGAR:</div>
                <div class="p-3 border-b border-gray-200">{{ $teson->user->lugar }}</div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-gray-200">UNIDAD:</div>
                <div class="p-3 border-r border-gray-200">{{ $teson->user->unidad }}</div>
                <div class="p-3 bg-gray-50 font-semibold border-r border-gray-200">DEPENDENCIA:</div>
                <div class="p-3">DELEGACIÓN ESTATAL B.C.</div>
            </div>

            {{-- Cancelaciones table --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center">NÚMERO DE<br>EMPLEADO</th>
                            <th rowspan="2">NOMBRE</th>
                            <th rowspan="2" class="text-center">
                                {{ $teson->remision_nomina == 1 ? 'NÚMERO DE RECIBO' : 'NÚMERO DE CHEQUE' }}
                            </th>
                            <th rowspan="2" class="text-center">IMPORTE</th>
                            <th colspan="2" class="text-center">MOTIVO DE CANCELACIÓN</th>
                        </tr>
                        <tr>
                            <th class="text-center">CLAVE</th>
                            <th>DESCRIPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($cancelaciones as $cancelacion)
                            <tr>
                                <td class="text-center font-mono">{{ $cancelacion->num_empleado }}</td>
                                <td>{{ $cancelacion->nombre }}</td>
                                <td class="text-center font-mono">{{ $cancelacion->numero_cheque }}</td>
                                <td class="text-right font-mono">$ {{ number_format($cancelacion->importe, 2) }}</td>
                                <td class="text-center">{{ $cancelacion->clave }}</td>
                                <td class="text-xs">{{ $cancelacion->clave_label }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8">
                                    <span class="text-2xl font-bold text-gray-300">
                                        PAGADA EN SU TOTALIDAD
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Observaciones --}}
            <div class="border border-gray-200 rounded-lg p-4">
                <strong class="text-sm text-gray-600">OBSERVACIONES:</strong>
                <p class="mt-1 text-gray-800">{{ $teson->observaciones ?: 'Ninguna' }}</p>
            </div>

            {{-- Signatures --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                <div class="text-xs text-gray-500 leading-relaxed protesta">
                    "DECLARO BAJO PROTESTA; DECIR LA VERDAD QUE LOS DATOS Y FIRMAS CONTENIDOS
                    EN ESTE FORMATO, SON VERÍDICAS Y MANIFESTAMOS TENER CONOCIMIENTO DE LAS
                    SANCIONES QUE SE APLICARÁN EN CASO CONTRARIO"
                </div>
                <div class="text-center">
                    <p class="text-sm font-semibold text-gray-700 mb-8">TITULAR DEL ÁREA</p>
                    <strong class="border-t border-gray-800 pt-2 inline-block text-sm">
                        {{ $teson->user->titular_area }}
                    </strong>
                </div>
                <div class="text-center">
                    <p class="text-sm font-semibold text-gray-700 mb-8">PAGADOR HABILITADO</p>
                    <strong class="border-t border-gray-800 pt-2 inline-block text-sm">
                        {{ $teson->user->pagador_habilitado }}
                    </strong>
                </div>
            </div>
        </div>
    </div>
@endsection
