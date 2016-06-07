@extends('template')
@section('title', 'Inicio')
@include('notificaciones')
@section('content')
    <div class="row content">
        <div class="row carousel-holder">

            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li class="item1 active"></li>
                        <li class="item2"></li>
                        <li class="item3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" style="min-height: 450px; max-height: 450px;"
                                 src="{{URL::asset('img/slider/elbosque.jpg')}}">

                            <div class="carousel-caption">
                                <h3>El Bosque</h3>

                                <p>Puerta de la Sierra de Cádiz</p>
                            </div>
                        </div>
                        <div class="item">
                            <img class="img-responsive" style="min-height: 450px; max-height: 450px;  min-width: 100%"
                                 src="{{URL::asset('http://www.cadiz-turismo.com/municipios/elbosque/10_El_Bosque.jpg')}}">
                        </div>

                        <div class="item">
                            <img class="img-responsive" style="min-height: 450px; max-height: 450px; min-width: 100%"
                                 src="{{URL::asset('http://www.cadiz-turismo.com/municipios/elbosque/4_Parque_Natural_Sierra_de_Grazalema_El_Bosque.jpg')}}">
                        </div>
                    </div>
                    <form class="form-inline " role="form" id="busqueda" method="POST" action="{{URL::asset('viviendas/filtradas')}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class='input-group date' >
                            <input type="text" class="form-control" id='entrada' name="entrada" placeholder="Entrada">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
                        </div>
                        <div class='input-group date' >
                            <input type="text" class="form-control" id='salida' name="salida" placeholder="Salida">
								<span class="input-group-addon">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</span>
                        </div>
                        <div class='input-group' >
                            <input type="number" class="form-control" id='personas' name="personas" placeholder="Personas" min="1">
								<span class="input-group-addon">
									<i class="fa fa-users" aria-hidden="true"></i>
								</span>
                        </div>
                        <button type="submit" class="btn btn-default"> <i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                    </form>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <br>
    <div class="row content">
        <div class="row multi-columns-row alt-features-grid">

            <!-- Features Item -->
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="alt-features-item align-center">
                    <h3 class="alt-features-title font-alt"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Ofertas</h3>

                    <div class="alt-features-descr align-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla purus justo, tristique at mi eget, dapibus pretium urna. Ut placerat nec lorem eget ultricies. Integer sit amet arcu vel neque convallis eleifend quis sed nulla. Donec iaculis orci est, ac maximus ipsum convallis vel. Phasellus facilisis lectus nulla, quis mollis erat convallis nec. Vivamus non odio sed magna bibendum pellentesque. Phasellus efficitur ut nisl id vulputate.
                    </div>
                </div>
            </div>
            <!-- End Features Item -->

            <!-- Features Item -->
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="alt-features-item align-center">
                    <h3 class="alt-features-title font-alt"><i class="fa fa-star-o" aria-hidden="true"></i> Mejor valoradas</h3>

                    <div class="alt-features-descr align-left">
                        Quisque non tortor ornare, congue dui id, sodales augue. In eu elit vitae lectus pretium interdum. Nullam accumsan nibh nulla, quis faucibus lectus rutrum eget. Sed placerat justo vel lectus aliquet sodales. Ut rutrum nunc non dolor elementum, a tempor purus tempus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque accumsan lobortis tortor at consectetur.
                    </div>
                </div>
            </div>
            <!-- End Features Item -->

            <!-- Features Item -->
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="alt-features-item align-center">
                    <h3 class="alt-features-title font-alt"><i class="fa fa-calendar" aria-hidden="true"></i> Eventos</h3>

                    <div class="alt-features-descr align-left">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed iaculis tortor lorem, nec luctus massa consectetur at. Aliquam quis tempus nisl. Aliquam imperdiet auctor consectetur. Vestibulum aliquet arcu vitae ultrices ultrices. Integer et egestas velit. Proin justo tellus, lobortis at risus sit amet, fringilla varius sapien. Nulla vel ligula posuere, efficitur libero id, imperdiet sem. Vestibulum et eleifend enim. Phasellus non ante eu velit pharetra lacinia eu eget turpis.
                    </div>
                </div>
            </div>
            <!-- End Features Item -->

        </div>
    </div>
    <script>
        $(function(){
            $( "#entrada" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: new Date()
            });
            $( "#salida" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: new Date((new Date()).valueOf() + 1000*3600*24),
            });

            $("#entrada").change(function () {
                var select = $("#entrada").val();
                var result = select.split('-');
                var fecha = result[2]+'-'+result[1]+'-'+result[0];
                fecha = new Date(fecha);
                var man = fecha.setDate(fecha.getDate() + 1);
                man = new Date(man);
                $('#salida').datepicker("destroy");
                $( "#salida" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: man
                });
            });
        });
    </script>
@stop