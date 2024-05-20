<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plantilla básica de Bootstrap</title>

    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <h1>Resultados de la Consulta para RFC: {{ $npersonal }}</h1>
        @if ($maestros->isEmpty())
            <p>No se encontraron maestros con el RFC proporcionado.</p>
        @else
            <ul>
                @foreach ($maestros as $maestro)
                    <li>
                        {{ $maestro->delegacion->region->region}} - {{ $maestro->delegacion->region->sede}}&emsp; 
                        {{ $maestro->delegacion->delegacion}}&nbsp;
                        {{ $maestro->delegacion->nivel}}&nbsp;
                        {{ $maestro->delegacion->sede}}&nbsp; <br>
                        <strong>
                            {{ $maestro->nombre }} {{ $maestro->apaterno }} {{ $maestro->amaterno }}</li>
                        </strong>
                    <!-- Agrega más información que quieras mostrar -->
                @endforeach
            </ul>
        @endif

    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>

    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>