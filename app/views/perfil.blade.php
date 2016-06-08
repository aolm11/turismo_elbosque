@extends('template')
@section('title', 'Mi perfil')
@include('notificaciones')
@section('content')
    <div class="page-bar row content">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home" aria-hidden="true"></i>
                <a href="{{URL::asset('')}}">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{(Usuario::esPropietario())? URL::asset('propietario') : URL::asset('admin')}}">{{(Usuario::esPropietario())? 'Propietario' : 'Admin'}}</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Perfil</span>
            </li>
        </ul>
    </div>
    <div class="row content">
        <div class="section-title-panel">
            <h3>Mi perfil</h3>
        </div>
        <form role="form" class="form-horizontal" name="editarUsuario" id="editarUsuario" method="POST" action="{{URL::asset('usuario/editar/'.$usuario->id)}}">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="col-md-6 col-sm-6">
            <div class='form-group'>
                <label class='control-label col-sm-2' for='nombre'>Nombre:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$usuario->nombre}}' id='nombre' name='nombre'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-2' for='apellidos'>Apellidos:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$usuario->apellidos}}' id='apellidos' name='apellidos'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-2' for='telefono'>Teléfono:</label>
                <div class='col-sm-8'>
                    <input type='text' class='form-control' value='{{$usuario->telefono}}' id='telefono' name='telefono'>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class='form-group'>
                <label class='control-label col-sm-3' for='email'>E-mail:</label>
                <div class='col-sm-7'>
                    <input type='text' class='form-control' value='{{$usuario->email}}' id='email' name='email'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-3' for='password'>Nueva contraseña:</label>
                <div class='col-sm-7'>
                    <input type='password' class='form-control' id='password' name='password'>
                </div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-3' for='password2'>Repita contraseña:</label>
                <div class='col-sm-7'>
                    <input type='password' class='form-control' id='password2' name='password2'>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class='form-group'>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
        </form>
    </div>
@stop
