@extends('adminlte::page')

@section('title', 'Inicio')

@section('plugins.Datatables', true)

@section('content_header')
    <div class="mytitle">
        @if(isset($maestrosCountPorDelegacion[$delegacion->id]))
            {{ $maestrosCountPorDelegacion[$delegacion->id] }} MAESTROS DE LA DELEGACION {{$delegacion->delegacion}}
        @else
            0 MAESTROS DE LA DELEGACION {{$delegacion->delegacion}}
        @endif
    </div>    
@stop

@section('content')

        @php
            $heads = [
                'ID',
                'NOMBRE',
                ['label' => 'NO. PERSONAL', 'width' => 15],
                'TELEFONO',
                'EMAIL',
                ['label' => 'EDICION', 'no-export' => true, 'width' => 15]
            ];
            $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>';

            $config = [
                'order' => [[1, 'asc']],
                //'columns' => [null, null, null, ['orderable' => false]],
                'columns' => [
                    null,
                    null,
                    null,
                    null,
                    null,
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
    
            <div class="card-header">
                <div class="row justify-content-between" style="padding-right:7px">            
                    <a href="{{ url()->previous() }}" class="btn btn-secondary float-right ml-2">
                        <i class="fa fa-undo"></i>&emsp;Regresar
                    </a>
                </div>
            </div>
            
            
            
            
            
            <div class="card-body">
                <p class="card-text">
                    
                    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable with-footer with-buttons  bordered >
                        @php $contador = 1; @endphp

                        @if(isset($maestrosPorDelegacion[$delegacion->id]))
                            @foreach($maestrosPorDelegacion[$delegacion->id] as $maestro)
                                <tr>
                                    <td>{{ $contador++}}</td>
                                    <td>{{ $maestro->nombre }} {{ $maestro->apaterno }} {{ $maestro->amaterno }}</td>
                                    <td>{{ $maestro->npersonal }}</td>
                                    <td>{{ $maestro->telefono }}</td>
                                    <td>{{ $maestro->email }}</td>
                                    <td>
                                        <a href="{{route('maestro.show', $maestro->id)}}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Mostrar">
                                            <i class="fa fa-lg fa-fw fa-eye"></i>
                                        </a>                            
                                        <a href="{{route('maestro.edit',$maestro->id)}}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </a>
                                        <form action="{{route('maestro.destroy',$maestro->id)}}" method="post" class="formEliminar" style="display: inline">
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
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center;">No hay datos disponibles en esta tabla.</td>
                            </tr>
                        @endif










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
    @if(!isset($maestrosCountPorDelegacion[$delegacion->id]))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay maestros asociados para esta delegación',
            });
        </script>
    @endif
@stop