<?php 

class AlquilerController extends BaseController {

  public function __construct()
  {
    $this->beforeFilter('csrf', array('on' => 'post'));
  }

  /*
   * Dependiendo del resultado de llamada al mismo método de la clase Alquiler,
   * se redirecciona a la vista anterior con un mensaje de éxito, o con mensaje de error
   * y el contenido que haya introducido el usuario en los inputs del formulario.
   */
  public function crearNotificacion(){
    $respuesta = Alquiler::crearNotificacion(Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function crearReserva(){
    $respuesta = Alquiler::crearReserva(Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  /*
   * Se comprueba si la vivienda a la que pertenece la reserva es del propietario logueado,
   * si no lo es se redirecciona a página de prohibición, en caso contrario, se redirecciona
   * a página de propietario con mensaje de éxito
    */
  public function confirmarReserva($id_reserva){

    $reserva = Alquiler::find($id_reserva);
    $vivienda = Vivienda::find(($reserva->id_vivienda));

    if(Auth::id() != $vivienda->id_usuario){
      return Response::view('401', array(), 401);
    }else{
      $respuesta = Alquiler::confirmarReserva($id_reserva);
      return Redirect::to('propietario')
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function editarReserva($id){
    $reserva = Alquiler::find($id);
    $vivienda = Vivienda::find(($reserva->id_vivienda));

    if(Auth::id() != $vivienda->id_usuario){
      return Response::view('401', array(), 401);
    }else {
      $respuesta = Alquiler::editarReserva($id, Input::all());

      if ($respuesta['error'] == true) {
        return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
      } else {
        return Redirect::back()
            ->with('mensaje', ($respuesta['mensaje']))
            ->with('exito', ($respuesta['exito']));
      }
    }
  }

  /*
   * Se comprueba si la vivienda a la que pertenece la reserva es del propietario logueado,
   * si no lo es se redirecciona a página de prohibición, en caso contrario, se crea la vista
   * detallesReserva, a la que se le pasa las variables.
    */
  public function detallesReserva($id){
    $reserva = Alquiler::find($id);
    $vivienda = Vivienda::find($reserva->id_vivienda);
    $viviendasPropietario = Vivienda::viviendasPropietario(Usuario::find($vivienda->id_usuario)->id);
    $cliente = Cliente::find($reserva->id_cliente);

    $reservasVivienda = Vivienda::getTodasFechasReservadas($vivienda->id, true, $reserva);

    if(Auth::id() != $vivienda->id_usuario){
      return Response::view('401', array(), 401);
    }else{
      return View::make('detallesReserva')->with(['reserva' => $reserva, 'vivienda' => $vivienda, 'viviendasPropietario' => $viviendasPropietario, 'cliente' => $cliente, 'reservasVivienda' => $reservasVivienda]);
    }

  }


  public function eliminarReserva($id_reserva){

    $reserva = Alquiler::find($id_reserva);
    $vivienda = Vivienda::find(($reserva->id_vivienda));

    if(Auth::id() != $vivienda->id_usuario){
      return Response::view('401', array(), 401);
    }else{
      $respuesta = Alquiler::eliminarReserva($id_reserva);
      return Redirect::to('propietario')
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function generarInforme(){
    $respuesta = Alquiler::generarInforme(Input::all());

    if(isset($respuesta['error'])){
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    }else{
      if(isset($respuesta['mensaje'])){
        return Redirect::back()->with('mensaje',$respuesta['mensaje'])->withInput();
      }

      $pdf = PDF::loadView('informe', array('reservas' => $respuesta, 'desde' => Input::get('desde'), 'hasta' => Input::get('hasta')));
      return $pdf->setPaper('a4')->setOrientation('landscape')->stream('informe.pdf');
    }

  }

  
}

?>