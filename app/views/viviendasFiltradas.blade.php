@extends('template')
@section('title', 'Listado de viviendas')
@section('content')
    <div class="page-bar row content">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="{{URL::asset('')}}">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Listado de viviendas</span>
            </li>
        </ul>
    </div>
    <div class="row content">
        <div class="section-title-panel">
            <h3><i class="fa fa-building font-grey"></i> Viviendas</h3>
        </div>
        @if(count($viviendas) > 0)
        <?php
            $cont = 0;
                $ultima = end($viviendas);
            //$ultima = $viviendas[count($viviendas)-1];
        ?>
        @foreach($viviendas as $vivienda)
        @if($cont == 0)
                <div class="row">
            @endif
                    <div class="col-md-4 portfolio-item">
                        <a href="{{URL::asset('detalles/vivienda/'.$vivienda->id)}}">
                            @if(!is_null(Imagen::getNombreImagenVivienda($vivienda->id)))
                                <img class="img-responsive" src="{{URL::asset('img/viviendas/'.Imagen::getNombreImagenVivienda($vivienda->id)->nombre)}}" alt="">
                            @else
                                <img class="img-responsive" src="{{URL::asset('img/imagen-no-disponible.png')}}" alt="">
                            @endif
                        </a>
                        <h3>
                            <a href="{{URL::asset('detalles/vivienda/'.$vivienda->id)}}">{{$vivienda->nombre}}</a>
                            <small style="float: right">{{'Capacidad: '.$vivienda->capacidad}}</small>
                            <br>
                            <small style="float: right">
                                {{($vivienda->precio_dia != 0 and $vivienda->precio_persona != 0) ? 'Precio por día: '.$vivienda->precio_dia.' €' : ($vivienda->precio_dia != 0) ? 'Precio por día: '.$vivienda->precio_dia.' €' : 'Precio por persona: '.$vivienda->precio_persona.' €/día'}}
                            </small>
                        </h3>
                        <br>
                        <p>{{$vivienda->descripcion}}</p>
                    </div>
                    <?php $cont++; ?>
            @if($cont == 3 or $ultima->id == $vivienda->id)
                </div>
                <?php $cont = 0;?>
            @endif
        @endforeach
        @else
            <div class="col-md-9 col-xs-12 text-center">

                <h3 style="margin-top: 6%">No hay viviendas disponibles con los parámetros introducidos.</h3>
            </div>
        @endif
    </div>
@stop
