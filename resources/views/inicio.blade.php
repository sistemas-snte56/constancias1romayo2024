@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Contenido</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <h4>página de inicio</h4>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi,"); </script>
@stop

