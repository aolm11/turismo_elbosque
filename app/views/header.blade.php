    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top"> Turismo El Bosque</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="{{URL::asset('inicio')}}"><i class="fa fa-home"></i> Inicio</a>
                    </li>
                    <!-- Si el usuario es admin crear enlace a panel de control.-->
                    <li class="page-scroll">
                        <a href="{{URL::asset('viviendas')}}"><i class="fa fa-building"></i> Viviendas</a>
                    </li>

                    <li class="dropdown">
                        @if(Auth::check())
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>{{Auth::user()->nombre.' '.Auth::user()->apellidos}}</b> <span class="caret"></span></a>

                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{URL::asset('perfil/usuario/'.Auth::id())}}">
                                        <i class="fa fa-user" aria-hidden="true"></i> Mi perfil </a>
                                </li>
                                <li>
                                    @if(Usuario::esAdmin())
                                        <a href="{{URL::asset('admin')}}">
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                            <i class="fa fa-users" aria-hidden="true"></i> Gestión de propietarios</a>
                                    @elseif(Usuario::esPropietario())
                                        <a href="{{URL::asset('propietario')}}">
                                            <i class="fa fa-cogs" aria-hidden="true"></i>
                                            <i class="fa fa-home" aria-hidden="true"></i> Gestión de viviendas</a>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{URL::asset('logout')}}">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> Salir </a>
                                </li>
                            </ul>
                        @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Acceso propietarios<span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" action="{{URL::asset('login')}}" role="form" method="post" name="login" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <!-- <label class="sr-only" for="exampleInputEmail2">Email</label> -->
                                                <input type="email" class="form-control" name="email" id="idEmail" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <!--  <label class="sr-only" for="exampleInputPassword2">Contraseña</label> -->
                                                <input type="password" class="form-control" name="password" id="idPassword" placeholder="Contraseña" required>
                                                <div class="help-block text-center"><a href="javascript;">¿Olvidó su contraseña?</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="btnLogin" class="btn btn-primary btn-block">Entrar</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </li>
                        </ul>
                        @endif
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
