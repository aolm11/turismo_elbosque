@extends('template')
@section('title', 'Eh!')


@section('content')

    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->

            <div class="clearfix"></div>

            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="col-md-12 caption" style="text-align: center">
                        <span class="caption-subject font-blue-dark bold uppercase"> </span>
                        <p class="font-green-seagreen">HTTP Error 401 - Unauthorized</p>
                        <p>Lo sentimos...</p>
                        <img src="{{URL::asset('img/AccesoDenegado.png')}}" style="max-width: 10%">
                        <p>...no tienes permisos para ver este contenido.</p>
                    </div>

                </div>


            </div>
        </div>
    </div>
@stop