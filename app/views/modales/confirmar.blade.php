<div id="{{'modalConfirm'.$propietario->id}}" class="modal fade" tabindex="-1" role="dialog">
    <input type="hidden" name="id" class="my_hidden_field"/>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">Eliminar Propietario</h3>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar a este propietario?</p>
                <?php
                $viviendas = Vivienda::viviendasPropietario($propietario->id);
                $reservas = Alquiler::reservasPropietario($propietario->id);
                ?>
                @if(!empty($viviendas) or !empty($reservas))
                    <p>Tiene {{(empty($reservas)) ? 'viviendas ' : 'viviendas y reservas'}} en la plataforma.</p>
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{URL::asset('propietario/eliminar/'.$propietario->id)}}" id="eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
                <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>