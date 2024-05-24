
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
            <x-adminlte-datatable id="table1" :heads="$heads"  style="width: 70%;" >
                @php $contador = 1; @endphp
                @foreach ($maestros as $maestro)
                    <tr style="text-transform: uppercase;">
                        <td>{{ $contador++}}</td>
                        <td>{{ $maestro->delegacion->region->region}} - {{ $maestro->delegacion->region->sede}}</td>
                        <td>{{ $maestro->delegacion->delegacion}}&nbsp;{{ $maestro->delegacion->nivel}}&nbsp;{{ $maestro->delegacion->sede}}</td>
                        <td>{{ $maestro->nombre }} {{ $maestro->apaterno }} {{ $maestro->amaterno }}</td>
                        <td> 
                            <a href="{{ route('generar.pdf', $maestro->codigo_id)}}" target="_blank" class="btn btn-sm buttons-print btn-success mx-1 " title="Imprimir hoja">
                                <i class="fas fa-fw fa-lg fa-print"></i> IMPRIMIR
                            </a>                             
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>

            <center>
                <div class="row">
                    <div class="form-group">
                        <a href="{{route('consulta.store')}}" class="btn btn-secondary mx-2 shadow" title="Delete">
                            <i class="fa fa-lg fa-fw fa-undo"></i> Regresar
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
@stop

@section('js')
    
@stop
