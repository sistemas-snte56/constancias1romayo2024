@extends('adminlte::page')

@section('title', 'Importa')

@section('content_header')
    <h1>IMPORTAR TU ARCHIVO</h1>
@stop

@section('content')

    <div class="d-flex align-items-center justify-content-center" style="height: 70vh;"> <!-- Ajustamos la altura al 80% de la altura de la ventana -->
        <div class="card col-md-6" style="padding-top: 5em; padding-bottom: 5em;">
            <div class="card-body">
                <form action="{{ route('maestro.import') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    {{-- With multiple slots and multiple files --}}
                    <x-adminlte-input-file id="importar_archivo" name="importar_archivo" label="Upload files"
                        igroup-size="lg" legend="Buscar">
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" label="Cargar" type="submit" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </form>
            </div>
        </div>
    </div>

@stop


@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    @if(session('error_status'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('error_status') }}"
                Swal.fire({
                    icon: 'error',
                    title: mensaje,
                    // text: "no hay resultados",
                    showConfirmButton: false,
                    showDenyButton: true,
                    confirmButtonText: `Cerrar`
                });
            });
        </script>
    @endif
    @if(session('error_upload'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('error_status') }}"
                Swal.fire({
                    icon: 'error',
                    title: mensaje,
                    // text: "no hay resultados",
                    showConfirmButton: false,
                    showDenyButton: true,
                    confirmButtonText: `Cerrar`
                });
            });
        </script>
    @endif
@stop


