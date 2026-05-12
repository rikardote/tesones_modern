<style>
    @page {
        size: letter landscape;
        margin: 25pt 30pt 115pt 30pt;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 8pt;
        margin: 0;
        padding: 0;
        color: #000;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td,
    th {
        border: 1px solid #000;
        padding: 2px 3px;
        vertical-align: middle;
    }

    .sin-borde {
        border: none !important;
    }

    .texto-centro {
        text-align: center;
    }

    .texto-derecha {
        text-align: right;
    }

    .texto-izquierda {
        text-align: left;
    }

    .negrita {
        font-weight: bold;
    }

    .logo {
        width: 180px;
        background-color: #fff;
    }

    .titulo {
        font-size: 11pt;
        font-weight: bold;
        margin-top: 6px;
        margin-bottom: 6px;
    }

    .datos td {
        height: 20px;
    }

    .cancelaciones th {
        background: #f3f3f3;
        font-size: 7pt;
    }

    .cancelaciones td {
        font-size: 7pt;
        height: 22px;
    }

    .cancelaciones tr {
        page-break-inside: avoid;
    }

    .cancelaciones thead {
        display: table-header-group;
    }

    .footer {
        position: fixed;
        bottom: -82pt;
        left: 0;
        right: 0;
        height: 88pt;
    }

    .firma {
        text-align: center;
        vertical-align: bottom;
    }

    .firma-linea {
        border-top: 1px solid #000;
        display: inline-block;
        min-width: 220px;
        padding-top: 2px;
    }

    .nota {
        font-size: 5.8pt;
        line-height: 1.15;
        text-align: justify;
    }

    .page-number:before {
        content: counter(page);
    }

    .espacio-footer {
        height: 90pt;
    }
</style>

{{-- ================= HEADER ================= --}}
<table>

    <tr>

        <td class="sin-borde" width="50%">

            <img src="{{ public_path('fotos/60issste.png') }}"
                 class="logo">

        </td>

        <td class="sin-borde" width="50%" valign="top">

            <table>

                <tr>

                    <th colspan="3" class="texto-centro">
                        FECHA DE ELABORACIÓN
                    </th>

                </tr>

                <tr>

                    <td class="texto-centro">
                        DÍA: {{ getDay($teson->fecha_elaboracion) }}
                    </td>

                    <td class="texto-centro">
                        MES: {{ getMonth($teson->fecha_elaboracion) }}
                    </td>

                    <td class="texto-centro">
                        AÑO: {{ getYear($teson->fecha_elaboracion) }}
                    </td>

                </tr>

            </table>

        </td>

    </tr>

</table>

<div class="titulo">
    REMISIÓN DE LA NÓMINA DE {{ $teson->forma_pago_label }}
</div>

{{-- ================= DATOS ================= --}}
<table class="datos">

    <tr>

        <td width="18%">
            <span class="negrita">TIPO DE PERSONAL:</span>
        </td>

        <td width="32%">
            {{ $teson->tipo_personal_label }}
        </td>

        <td width="18%">
            <span class="negrita">FECHA DE EMISIÓN:</span>
        </td>

        <td width="32%">

            {{ getDay($teson->nomina->fecha_emision) }}
            DE
            {{ getMonth($teson->nomina->fecha_emision) }}
            DE
            {{ getYear($teson->nomina->fecha_emision) }}

        </td>

    </tr>

    <tr>

        <td>
            <span class="negrita">TIPO DE NÓMINA:</span>
        </td>

        <td>
            {{ $teson->nomina->nomina }}
        </td>

        <td>
            <span class="negrita">CLAVE DE ADSCRIPCIÓN:</span>
        </td>

        <td>
            {{ $teson->user->adscripcion }}
        </td>

    </tr>

    <tr>

        <td>
            <span class="negrita">FOLIOS:</span>
        </td>

        <td>

            @if(in_array($teson->remision_nomina,[1,2,4,7]))
                DEL {{ $teson->folio_inicial }}
                AL {{ $teson->folio_final }}
            @endif

        </td>

        <td>
            <span class="negrita">LUGAR:</span>
        </td>

        <td>
            {{ $teson->user->lugar }}
        </td>

    </tr>

    <tr>

        <td>
            <span class="negrita">UNIDAD:</span>
        </td>

        <td>
            {{ $teson->user->unidad }}
        </td>

        <td>
            <span class="negrita">DEPENDENCIA:</span>
        </td>

        <td>
            DELEGACIÓN ESTATAL B.C.
        </td>

    </tr>

</table>

{{-- ================= TABLA ================= --}}
<table class="cancelaciones" style="margin-top:5px;">

    <thead>

        <tr>

            <th rowspan="2" width="12%">
                NÚMERO DE EMPLEADO
            </th>

            <th rowspan="2" width="28%">
                NOMBRE
            </th>

            <th rowspan="2" width="16%">

                @if($teson->remision_nomina == 1)
                    NÚMERO DE RECIBO
                @else
                    NÚMERO DE CHEQUE
                @endif

            </th>

            <th rowspan="2" width="14%">
                IMPORTE
            </th>

            <th colspan="2" width="30%">
                MOTIVO DE CANCELACIÓN
            </th>

        </tr>

        <tr>

            <th width="8%">
                CLAVE
            </th>

            <th width="22%">
                DESCRIPCIÓN
            </th>

        </tr>

    </thead>

    <tbody>

        @forelse($cancelaciones as $cancelacion)

            <tr>

                <td class="texto-centro">
                    {{ $cancelacion->num_empleado }}
                </td>

                <td>
                    {{ $cancelacion->nombre }}
                </td>

                <td class="texto-centro">
                    {{ $cancelacion->numero_cheque }}
                </td>

                <td class="texto-derecha">
                    $ {{ number_format($cancelacion->importe, 2) }}
                </td>

                <td class="texto-centro">
                    {{ $cancelacion->clave }}
                </td>

                <td>
                    {{ $cancelacion->clave_label }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="texto-centro negrita"
                    style="font-size:14pt; padding:15px;">

                    PAGADA EN SU TOTALIDAD

                </td>

            </tr>

        @endforelse

    </tbody>

</table>

<div class="espacio-footer"></div>

{{-- ================= FOOTER ================= --}}
<div class="footer">

    {{-- OBSERVACIONES --}}
    <table>

        <tr>

            <td>

                <span class="negrita">OBSERVACIONES:</span>

                {{ $teson->observaciones ?? 'Ninguna' }}

            </td>

        </tr>

    </table>

    {{-- FIRMAS --}}
    <table style="margin-top:8px;">

        <tr>

            <td width="5%"
                class="sin-borde nota"
                valign="top">

                <span class="negrita">NOTA:</span>

            </td>

            <td width="31%"
                class="sin-borde nota"
                valign="top"
                style="padding-right:8px;">

                "DECLARO BAJO PROTESTA; DECIR LA VERDAD QUE LOS DATOS Y FIRMAS CONTENIDOS
                EN ESTE FORMATO, SON VERÍDICAS Y MANIFESTAMOS TENER CONOCIMIENTO DE LAS
                SANCIONES QUE SE APLICARÁN EN CASO CONTRARIO"

            </td>

            <td width="32%"
                class="sin-borde firma">

                <span class="negrita">
                    ATENTAMENTE
                </span>

                <br>

                TITULAR DEL ÁREA

                <br><br><br>

                <span class="firma-linea">
                    {{ $teson->user->titular_area }}
                </span>

            </td>

            <td width="32%"
                class="sin-borde firma">

                <span class="negrita">
                    ATENTAMENTE
                </span>

                <br>

                PAGADOR HABILITADO

                <br><br><br>

                <span class="firma-linea">
                    {{ $teson->user->pagador_habilitado }}
                </span>

            </td>

        </tr>

    </table>



</div>
