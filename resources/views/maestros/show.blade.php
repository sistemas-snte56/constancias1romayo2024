@extends('adminlte::page')

@section('title', 'Información')

@section('plugins.Datatables', true)

@section('content_header')
    <div class="mytitle">
        INFORMACIÓN DE {{ $maestro->nombre }} 
        {{ $maestro->apaterno }}
        {{ $maestro->amaterno }}        
    </div>
@stop

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="region">REGIÓN</label>
                    <p id="region" class="with-border">
                        {{ $maestro->delegacion->region->region}}&emsp;—&emsp; {{ $maestro->delegacion->region->sede}} &nbsp;
                    </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="delegacion">DELEGACIÓN</label>
                    <p id="delegacion" class="with-border">
                        {{ $maestro->delegacion->delegacion }} <strong>/</strong>
                        {{ $maestro->delegacion->nivel }} <strong>/</strong>
                        {{ $maestro->delegacion->sede }} &nbsp;
                    </p>
                </div>
            </div>


            <div class="row">
                    <div class="form-group col-md-2">
                        <label for="nombre">GENERO</label>
                        <p id="genero" class="with-border">{{ $maestro->genero->genero }} &nbsp; </p>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nombre">NOMBRE (S)</label>
                        <p id="nombre" class="with-border">{{ $maestro->nombre }} &nbsp; </p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="apellido_paterno">APELLIDO PATERNO</label>
                        <p id="apellido_paterno" class="with-border">{{ $maestro->apaterno }} &nbsp;</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="apellido_materno">APELLIDO MATERNO</label>
                        <p id="apellido_materno" class="with-border"> {{ $maestro->amaterno }} &nbsp;</p>
                    </div>                
            </div>

            <div class="row">
                    <div class="form-group col-md-3">
                        <label for="email">CORREO ELECTRÓNICO</label>
                        <p id="email" class="with-border"> {{ $maestro->email }} &nbsp;</p>
                    </div>      
                    <div class="form-group col-md-3">
                        <label for="telefono">TELÉFONO</label>
                        <p id="telefono" class="with-border"> {{ $maestro->telefono }} &nbsp;</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="rfc">RFC</label>
                        <p id="rfc" class="with-border"> {{ $maestro->rfc }} &nbsp;</p>
                    </div>     
                    <div class="form-group col-md-3">
                        <label for="numero_personal">NÚMERO DE PERSONAL</label>
                        <p id="numero_personal" class="with-border"> {{ $maestro->npersonal }} &nbsp;</p>
                    </div>                                                                                     
            </div>

            <div class="form-group row">
                <label for="folio" class="col-md-2 col-form-label">FOLIO</label>
                <div class="col-md-10">
                    <p id="folio" class="with-border">{{ $maestro->folio }}</p>
                </div>
            </div>

            <div class="row justify-content-between" style="padding-right:7px">
                <a href="{{ route('maestro.index') }}" class="btn btn-secondary float-left ml-2">
                    <i class="fa fa-undo"></i>&emsp;Regresar
                </a>
                <a href="{{ route('maestro.edit', $maestro) }}" class="btn btn-success">
                    <i class="fa fa-pen"></i>&emsp;Editar usuario
                </a>                
            </div>














        </div>
    </div>

@stop

@section('css')
    <style>
        .with-border {
            background-color: #F4F6F9;
            border: 1px solid #e6e6e6; 
            padding: 0.3em;
        }
        .mytitle {
            font-weight: bold;
            font-size: x-large;
            color: #ee7a00;
        }
    </style>

@stop

@section('js')

@stop