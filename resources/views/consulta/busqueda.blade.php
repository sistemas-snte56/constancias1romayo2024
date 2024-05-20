@extends('adminlte::page')

@section('title', 'Consulta')

@section('content_header')
    <h1>CONSULTA TU CONSTANCIA</h1>
@stop

@section('content')

    <div class="d-flex align-items-center justify-content-center" style="height: 70vh;"> <!-- Ajustamos la altura al 80% de la altura de la ventana -->
        <div class="card col-md-6" style="padding-top: 5em; padding-bottom: 5em;">
            @php
                if (session()) {
                    if (session('message') == 'error') {
                        echo '<x-adminlte-alert theme="danger" title="Sin resultados">
                            No se encontró información
                            </x-adminlte-alert>
                        ';
                    }
                }
            @endphp

            {{-- <div class="card-body">
                <form action="{{ route('consulta.store') }}" method="post">
                    @csrf
                    
                    <x-adminlte-input type="text" name="numero_de_personal" label="¿CUÁL ES TU NÚMERO DE PERSONAL?" placeholder="Ingresa la información" label-class="text-orange" value="{{ old('numero_de_personal') }}">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-orange"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <x-adminlte-button type="submit" label="Buscar" theme="secondary" icon="fas fa-search"></x-adminlte-button>
                </form>
            </div> --}}

            <blockquote class="blockquote mb-0 ">
                <p>Dudas o aclaraciones.</p>
                <footer class="blockquote-footer">Envíenos un correo a  <cite title="Correo electrónico">innovacion.tecnologica.snte56@gmail.com</cite></footer>
            </blockquote>

        </div>
    </div>

@stop


@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @if(session('error'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('error') }}"
                Swal.fire({
                    //position: 'top-end',
                    icon: 'error',
                    title: mensaje,
                    text: "no hay resultados",
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: `Cerrar`
                });
            });
        </script>
    @endif
@stop


