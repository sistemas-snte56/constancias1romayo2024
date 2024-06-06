
@extends('adminlte::page')

@section('title', 'Consulta')

@section('content_header')
    <h1>RESULTADOS DE BUSQUEDA</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            @php
                $heads = [
                    'ID',
                    'REGIÓN',
                    'DELEGACIÓN',
                    'NOMBRE',
                    // 'APELLIDOS',
                    ['label' => 'IMPRESION', 'no-export' => true, 'width' => 10],
                ];

                $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>';
                $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>';
                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                <i class="fa fa-lg fa-fw fa-eye"></i>
                            </button>';

                $config = [
                    'order' => [[1, 'asc']],
                    'columns' => [null, null, null, ['orderable' => false]],
                    'language' => [
                            'url' => '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json',
                        ],
                    'paging' => false,
                    'lengthMenu' => false,
                    'searching' => false,
                    'info' => false,
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads"  style="width: 100%;" >
                @php $contador = 1; @endphp
                @foreach ($maestros as $maestro)
                    <tr style="text-transform: uppercase;">
                        <td>{{ $contador++}}</td>
                        <td>{{ $maestro->delegacion->region->region}} - {{ $maestro->delegacion->region->sede}}</td>
                        <td>{{ $maestro->delegacion->delegacion}}&nbsp;{{ $maestro->delegacion->nivel}}&nbsp;{{ $maestro->delegacion->sede}}</td>
                        <td>{{ $maestro->nombre }} {{ $maestro->apaterno }} {{ $maestro->amaterno }}</td>
                        <td> 
                            <a href="{{ route('generar.pdf', $maestro->codigo_id)}}" target="_blank" class="btn btn-lg buttons-print btn-success mx-1 btn-block" title="Imprimir hoja">
                                <i class="fas fa-fw fa-lg fa-print"></i> <strong> IMPRIMIR</strong>
                            </a>                             
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>





















            <center>
                <div class="row">
                    <div class="form-group">
                        <a href="{{route('consulta.store')}}" class="btn btn-secondary mx-2 shadow" title="Delete">
                            <i class="fa fa-home" aria-hidden="true"></i>&emsp;REGRESAR
                        </a >

                    </div>
                </div>
            </center>

            <blockquote class="blockquote mb-0 ">
                <p>Confirme su información.</p>
                <footer class="blockquote-footer">Verifique sus datos con su   
                    <cite title="Info">Secretario General Delegacional </cite> o su 
                    <cite>Secretario de Organización</cite>
                </footer>
            </blockquote>


        </div>
    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        @media screen and (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 20px;
                border: 1px solid #ddd;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                left: 6px;
                content: attr(data-label);
                font-weight: bold;
            }
        }

        @media (max-width: 767.98px) {
            table td[data-label]::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
            }
        }        
    </style>
@stop

@section('js')
    
@stop
