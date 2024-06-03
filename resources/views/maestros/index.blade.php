<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maestros DataTable</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <!-- DataTables Buttons JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
</head>
<body>
    <h1>Lista de Maestros</h1>
    <table id="maestrosTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Campo 1</th>
                <th>Campo 2</th>
                <th>Campo 3</th>
                <th>Campo 4</th>
                <th>Campo 5</th>
                <!-- Agrega más encabezados según los campos de tu modelo -->
            </tr>
        </thead>
    </table>

    <script>
        $(document).ready(function() {
            $('#maestrosTable').DataTable({
                "ajax": "/api/maestros",
                "columns": [
                    { "data": "id" },
                    { "data": "delegacion.region.region" },
                    { "data": "delegacion.delegacion" },
                    { "data": "nombre" },
                    { "data": "apaterno" },
                    { "data": "amaterno" },
                    // Agrega más columnas según los campos de tu modelo
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>
</html>
