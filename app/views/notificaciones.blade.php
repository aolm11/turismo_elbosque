@section('alertas')
    @if( $errors->has('nombre') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('nombre') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if( $errors->has('apellidos') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('apellidos') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('telefono') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('telefono') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('email') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('email') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('password') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('password') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('direccion') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('direccion') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('num_habitaciones') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('num_habitaciones') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('num_banos') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('num_banos') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('capacidad') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('capacidad') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('descripcion') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('descripcion') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('vivienda') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('vivienda') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('entrada') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('entrada') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if( $errors->has('salida') )
        <div class="message">
            <div style="padding: 5px;">
                <div id="inner-message" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    @foreach($errors->get('salida') as $error )
                        * {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@stop