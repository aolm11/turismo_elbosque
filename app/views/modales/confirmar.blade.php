@if(isset($propietario))
    <div id="{{'modalConfirm'.$propietario->id}}" class="modal fade" tabindex="-1" role="dialog">
@else
    <div id="{{'modalConfirm'.$vivienda->id}}" class="modal fade" tabindex="-1" role="dialog">
@endif
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{(isset($propietario)) ? 'Eliminar Propietario': 'Eliminar Vivienda'}}</h4>
            </div>
            <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar {{(isset($propietario)) ? 'a este propietario' : 'esta vivienda'}} ?</p>
                @if(isset($propietario))
                    <?php
                    $viviendas = Vivienda::viviendasPropietario($propietario->id);
                    $reservas = Alquiler::reservasPropietarioSinConfirmar($propietario->id);
                    ?>
                    @if(!empty($viviendas) or !empty($reservas))
                        <p>Tiene {{(empty($reservas)) ? 'viviendas ' : 'viviendas y reservas'}} en la plataforma.</p>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{(isset($propietario)) ? URL::asset('propietario/eliminar/'.$propietario->id) : URL::asset('vivienda/eliminar/'.$vivienda->id)}}" id="eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i> Eliminar</a>
                <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>