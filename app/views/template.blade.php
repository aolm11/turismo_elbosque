<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Turismo El Bosque"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    {{HTML::style('/assets/css/font-awesome.min.css')}}
    {{HTML::style('/assets/css/freelancer.css')}}
    {{HTML::style('/assets/css/bootstrap.min.css')}}
    {{HTML::style('/assets/css/estilo-proyecto.css')}}
    {{HTML::style('/assets/js/jquery-ui-1.11.4/themes/smoothness/jquery-ui.css')}}
    {{HTML::style('/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}
    {{HTML::style('/assets/plugins/bootstrap-fileinput/fileinput.min.css')}}

    {{HTML::script('/assets/js/jquery.min.js')}}
    {{HTML::script('/assets/js/jquery-ui-1.11.4/jquery-ui.min.js')}}
    {{HTML::script('/assets/js/bootstrap.min.js')}}
    {{HTML::script('/assets/js/freelancer.js')}}
    {{HTML::script('/assets/js/funciones.js')}}
    {{HTML::script('/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}


    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });
    </script>

    <title>@yield('title') | Turismo El Bosque</title>
</head>

<body id="page-top" class="index">

@include('header')

<div class="main-container">
    <div class="main">
        @if(Session::get('mensaje'))
            @if(Session::get('exito') == true)
                <div id="message">
                    <div style="padding: 5px;">
                        <div id="inner-message" class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{Session::get('mensaje')}}
                        </div>
                    </div>
                </div>
            @else
                <div id="message">
                    <div style="padding: 5px;">
                        <div id="inner-message" class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{Session::get('mensaje')}}
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @yield('content')
    </div>
</div>

</body>