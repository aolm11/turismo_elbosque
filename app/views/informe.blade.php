<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Turismo El Bosque - Informes</title>
    <style>
        h1{
            float: left;
        }
        h2{
            text-align: right;
            float: right;
        }
        table{
            width: 100%;
        }
        td{
            text-align: center;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Informe de reservas</h1>
    <h2>Periodo: {{$desde}} hasta {{$hasta}}</h2>

    <table>
        <thead>
            <tr>
                <th>Vivienda</th>
                <th>Cliente</th>
                <th>E-mail</th>
                <th>Teléfono</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{$reserva->nom_vivienda}}</td>
                    <td>{{$reserva->nom_cliente}}</td>
                    <td>{{$reserva->email}}</td>
                    <td>{{$reserva->telefono}}</td>
                    <td>{{Herramientas::formatearFechaFromBD($reserva->fecha_inicio)}}</td>
                    <td>{{Herramientas::formatearFechaFromBD($reserva->fecha_fin)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
