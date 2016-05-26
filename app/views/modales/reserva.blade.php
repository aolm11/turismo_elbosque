<div id="{{'modalReserva'.$reserva->id_alquiler}}" class="modal fade prueba" tabindex="-1" role="dialog" data-remote="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Detalles de la reserva</h4>
            </div>
            <div class="modal-body">
                <?php
                    $reserva = Alquiler::find($reserva->id_alquiler);
                    $cliente = Cliente::find($reserva->id_cliente);
                ?>
                <h4>Nombre: <small>{{$cliente->nombre}}</small></h4>
                <h4>Teléfono: <small>{{$cliente->telefono}}</small></h4>
                <h4>E-mail: <small>{{$cliente->email}}</small></h4>
                <h4>Vivienda: <small>{{Vivienda::find($reserva->id_vivienda)->nombre}}</small></h4>
                <h4>Entrada: <small>{{$reserva->fecha_inicio}}</small></h4>
                <h4>Salida: <small>{{$reserva->fecha_fin}}</small></h4>
            </div>
            <div class="modal-footer">
                <a href="{{URL::asset('eliminar/reserva/'.$reserva->id)}}" id="eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
                <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>