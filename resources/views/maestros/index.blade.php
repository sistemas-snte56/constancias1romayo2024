@extends('adminlte::page')

@section('title', 'Inicio')

@section('plugins.Datatables', true)

@section('content_header')
    <div class="mytitle">
        ADMINISTRACIÓN DE USUARIO
    </div>    
@stop

@section('content')
    @php
        $heads = [
            'ID',
            'REGIÓN',
            'DELEGACIÓN',
            'NOMBRE',
            // 'RFC',
            ['label' => 'NO. PERSONAL', 'width' => 10],
            'EMAIL',
            // 'TELÉFONO',
            ['label' => 'EDICION', 'no-export' => true, 'width' => 10]
        ];

        $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

        $config = [
            //'order' => [[1, 'asc']],
            //'columns' => [null, null, null, ['orderable' => false]],
            'columns' => [
                null,
                null,
                null,
                null,
                // ['orderable' => false],
                null,
                ['orderable' => false],
                // ['orderable' => false],                
                ['orderable' => false],                
            ],
            // 'language' => ['url' => '//cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json']        
            'language' => ['url' => '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',],
            'lengthMenu' => [50,100,500],
            // 'order' => [[4, 'asc']],
            // 'searching' => true,
            // 'paging' => true,
            // 'info' => true,
        ];


    @endphp

    <div class="card">
        <h5 class="card-header">LISTADO DE REGISTRO</h5>
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('maestro.import')}}" class="btn btn-success float-right">
                    <i class="fa fa-pen"></i>&emsp;Importar archivo
                </a>                

                <a href="{{route('maestro.create')}}" class="btn btn-primary float-right mr-2">
                    <i class="fa fa-user"></i>&emsp;Nuevo usuario
                </a>

                <a href="{{route('consulta.index')}}" class="btn btn-info float-right mr-2">
                    <i class="fa fa-file"></i>&emsp;Buscar constancia
                </a>


            </h5>
            <p class="card-text">
                
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable with-footer with-buttons  bordered >
                    @php $contador = 1; @endphp
                    @foreach ($regiones as $region)
                        <tr>
                            <td>{{ $contador++}}</td>
                            <td>{{ $region->id }}</td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
            </p>
        </div>
    </div>

@stop

@section('css')
<style>
    .mytitle {
        font-weight: bold;
        font-size: x-large;
        color: #ee7a00;
    }
</style>
@stop

@section('js')

@stop