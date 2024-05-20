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
                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable with-footer with-buttons  bordered >
                    @php $contador = 1; @endphp
                    @foreach ($maestros as $maestro)
                        <tr>
                            <td>{{ $contador++}}</td>
                            <td>{{ $maestro->delegacion->region->region}}&emsp;—&emsp; {{ $maestro->delegacion->region->sede}}</td>
                            <td>{{ $maestro->delegacion->delegacion }} 
                            <td>{{ $maestro->nombre }} 
                                {{ $maestro->apaterno }}
                                {{ $maestro->amaterno }}
                            {{-- <td>{{ $maestro->rfc }}</td> --}}
                            <td>{{ $maestro->npersonal }}</td>
                            <td>{{ $maestro->email }}</td>
                            {{-- <td>{{ $maestro->telefono }}</td> --}}
                            {{-- <td>{!! $btnEdit !!}</td> --}}
                            <td>
                                <a href="{{route('maestro.show', $maestro)}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Mostrar">
                                    <i class="fa fa-lg fa-fw fa-eye"></i>
                                </a>                            
                                <a href="{{route('maestro.edit',$maestro)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                <form action="{{route('maestro.destroy',$maestro)}}" method="post" class="formEliminar" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    {!! $btnDelete !!}
                                </form>
                                <a href="{{ route('generar.pdf', $maestro->codigo_id)}}" target="_blank" class="btn btn-xs buttons-print btn-default  mx-1 " title="Imprimir hoja">
                                    <i class="fas fa-fw fa-lg fa-print"></i>
                                </a>  
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>
                <br>
                <h4>SE REALIZO UNA MODIFICACION DESDE EQUIPO DELL</h4>
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
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borrarlo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    }
                });
            })
        });
    </script>

delete_ok




    @if(session('delete_ok'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('delete_ok') }}"
                Swal.fire({
                    title: "¡Eliminado!",
                    text: mensaje,
                    icon: 'success',
                });
            });
        </script>
    @endif



    @if(session('success'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('success') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                });
            });
        </script>
    @endif
    @if(session('status'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('status') }}"
                Swal.fire({
                    icon: 'success',
                    title: mensaje,
                    // text: "no hay resultados",
                    showConfirmButton: false,
                    showDenyButton: true,
                    confirmButtonText: `Cerrar`
                });
            });
        </script>
    @endif
    @if(session('update_ok'))
        <script>
            $(document).ready(function(){
                let mensaje = "{{ session ('update_ok') }}"
                Swal.fire({
                    title: mensaje,
                    //text: "Your file has been deleted.",
                    icon: "success"
                });                

            });
        </script>
    @endif
@stop