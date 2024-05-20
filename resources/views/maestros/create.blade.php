@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
<div class="mytitle">
    NUEVO REGISTRO

</div>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form action=" {{ route('maestro.store') }} " method="post">
            @csrf

            

            <div class="row">
                <x-adminlte-select name="selecciona_region" label="REGIÓN" fgroup-class="col-md-6">
                    <option value="">Selecciona una...</option>
                    @foreach ($regiones as $region)
                        <option value="{{ $region->id }}" @if(old('selecciona_region') == $region->id) selected @endif >{{ $region->region }} - {{ $region->sede }}</option>
                    @endforeach
                </x-adminlte-select>
                
                <x-adminlte-select name="selecciona_delegacion" label="DELEGACIÓN" fgroup-class="col-md-6">
                    <option value="">Selecciona una...</option>
                    @foreach ($delegaciones as $delegacion)
                    <option value="{{ $delegacion->id }}"  @if(old('selecciona_delegacion') == $delegacion->id) selected @endif>
                        {{$delegacion->delegacion}} / 
                        {{$delegacion->nivel}} / 
                        {{$delegacion->sede}} 
                    </option>
                    @endforeach
                </x-adminlte-select>
            </div>            
            
            <div class="row">
                <x-adminlte-select name="selecciona_genero" label="GENERO" fgroup-class="col-md-2">
                    <option value="">Selecciona una...</option>
                    @foreach ($generos as $genero)
                        <option value="{{ $genero->id }}" @if(old('selecciona_genero') == $genero->id) selected @endif >{{ $genero->genero }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-input name="nombre" label="NOMBRE (S)" type="text" placeholder="Ingresa Nombre"  fgroup-class="col-md-4" label-class="text-lightorange" value="{{ old('nombre')}}"  />

                <x-adminlte-input name="apellido_paterno" label="PRIMER APELLIDO" type="text" placeholder="Ingresa apellido paterno"  fgroup-class="col-md-3" label-class="text-lightorange"  value="{{ old('apellido_paterno')}}"  />

                <x-adminlte-input name="apellido_materno" label="SEGUNDO APELLIDO" type="text" placeholder="Ingresa apellido materno"  fgroup-class="col-md-3" label-class="text-lightorange"   value="{{ old('apellido_materno')}}" />
            </div>

            <div class="row">
                <x-adminlte-input name="email" label="CORREO ELECTRÓNICO" type="email" placeholder="Agrega tu email"  fgroup-class="col-md-3" label-class="text-lightorange"  value="{{ old('email')}}"  />

                <x-adminlte-input name="telefono" label="TELÉFONO" type="text" placeholder="Ingresa tu teléfono"  fgroup-class="col-md-3" label-class="text-lightorange"  value="{{ old('telefono')}}"  />
                
                <x-adminlte-input name="rfc" label="RFC" type="text" placeholder="Agrega tu RFC"  fgroup-class="col-md-3" label-class="text-lightorange"  value="{{ old('rfc')}}"  />

                <x-adminlte-input name="numero_personal" label="¿CÚAL ES SU NÚMERO DE PERSONAL?" type="text" placeholder="Ingresa npersonal"  fgroup-class="col-md-3" label-class="text-lightorange" value="{{ old('numero_personal')}}"   />
            </div>



            <div class="row justify-content-between" style="padding-right:7px">
                <a href="{{ route('maestro.index') }}" class="btn btn-secondary float-left ml-2">
                    <i class="fa fa-undo"></i>&emsp;Regresar
                </a>
                <x-adminlte-button type="submit" label="Guardar" theme="success" icon="fas fa-lg fa-save"/>
            </div>

                        
        </form>
    </div>
</div>

@stop


@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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