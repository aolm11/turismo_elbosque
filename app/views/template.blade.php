<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Turismo El Bosque"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    {{HTML::style('/assets/css/fonts.css')}}
    {{HTML::style('/assets/css/font-awesome.min.css')}}
    {{HTML::style('/assets/css/freelancer.css')}}
    {{HTML::style('/assets/css/bootstrap.min.css')}}
    {{HTML::style('/assets/css/estilo-proyecto.css')}}
    {{HTML::style('/assets/js/jquery-ui-1.11.4/themes/smoothness/jquery-ui.css')}}
    {{HTML::style('/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}
    {{HTML::style('/assets/plugins/bootstrap-fileinput/fileinput.min.css')}}
    {{HTML::style('/assets/plugins/fullcalendar/fullcalendar.min.css')}}

    {{HTML::script('/assets/js/jquery.min.js')}}
    {{HTML::script('/assets/js/jquery-ui-1.11.4/jquery-ui.min.js')}}
    {{HTML::script('/assets/js/bootstrap.min.js')}}
    {{HTML::script('/assets/js/freelancer.js')}}
    {{HTML::script('/assets/js/funciones.js')}}
    {{HTML::script('/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}
    {{HTML::script('/assets/plugins/fullcalendar/moment.min.js')}}
    {{HTML::script('/assets/plugins/fullcalendar/fullcalendar.min.js')}}
    {{HTML::script('/assets/plugins/fullcalendar/lang/es.js')}}

    <title>@yield('title') | Turismo El Bosque</title>
</head>


<body id="page-top" class="index">

@include('header')

<div class="main-container">
    <div class="alertas">
        @yield('alertas')
    </div>
    <div class="main">
        @yield('content')
    </div>
</div>

<footer class="footer foo">
    <div class="container">
        <div class="col-md-6">
            <p class="font-white font-15">© 2016 Turismo El Bosque</p>
        </div>
        <div class="pull-right">
            <h4>  <a class="font-white" href=""><i class="fa fa-facebook"></i></a>
                    <a class="font-white" href=""><i class="fa fa-twitter"></i></a>
                    <a class="font-white" href=""><i class="fa fa-pinterest"></i></a>
                        <a class="font-white" href=""><i class="fa fa-google-plus"></i></a>
            </h4>

        </div>
    </div>

</footer>
<script>
    alertas();
</script>
</body>

