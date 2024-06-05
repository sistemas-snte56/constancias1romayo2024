@extends('adminlte::page')

@section('title', 'Inicio')

@section('plugins.Datatables', true)

@section('content_header')
    <div class="mytitle">
        ADMINISTRACIÓN DE REGIONES
    </div>    
@stop

@section('content')


    <div class="card">
        <h5 class="card-header">TOTAL DE REGISTROS <strong>{{ $totalMaestros }}</strong></h5>
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
                <div class="row">
                    @foreach ($regiones as $region)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <x-adminlte-info-box title="{{ $region->delegaciones_count }} Delegaciones" 
                                text="{{ $region->region}} - {{ $region->sede}}" 
                                icon="fas fa-lg fa-users text-orange"
                                theme="gradient-warning" 
                                icon-theme="white"
                                url="{{ route('region.show', $region) }}" 
                                url-text="Ver todas las delegaciones" />
                        </div>
                    @endforeach
                </div>
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