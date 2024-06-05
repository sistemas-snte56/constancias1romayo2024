@extends('adminlte::page')

@section('title', 'Inicio')

@section('plugins.Datatables', true)

@section('content_header')
    <div class="mytitle">
        {{$region->region}} - {{ $region->sede }}
    </div>    
@stop

@section('content')


<div class="card">
        <div class="card-header">
            <div class="col-sm-6 col-md-4 col-lg-3">
                <x-adminlte-small-box title="{{ $totalMaestros }}" text="Maestros Registrados" icon="fas fa-user-plus text-teal" icon-theme="white"
                theme="info" url="#" url-text="Ver todos los maestros"/>
            </div>
        </div>
    
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
            $heads = [
                'ID',
                'DELEGACION',
                'NIVEL',
                'SEDE',
                'PARTICIPANTES',
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
                'columns' => [['orderable' => false], null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
                'lengthMenu' => [50,100,500],
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                @foreach($region->delegaciones as $delegacion)
                    <tr>
                        <td>{{ $delegacion->id }}</td>
                        <td>{{ $delegacion->delegacion }}</td>
                        <td>{{ $delegacion->sede }}</td>
                        <td>{{ $delegacion->nivel }}</td>
                        <td>
                            <a href="#" class="btn btn-outline-info">
                                <i class="fa fa-xs fa-fw fa-eye"></i>
                                <span class="badge badge-light">{{ $delegacion->maestros_count }}</span>
                                Maestros
                                <span class="sr-only">unread messages</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>

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