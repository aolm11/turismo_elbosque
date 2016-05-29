<?php 

class AlquilerController extends BaseController {

  public function __construct()
  {
    $this->beforeFilter('csrf', array('on' => 'post'));
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

  public function editarReserva($id){
    $respuesta = Alquiler::editarReserva($id, Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function detallesReserva($id){
    $reserva = Alquiler::find($id);
    $vivienda = Vivienda::find($reserva->id_vivienda);
    $viviendasPropietario = Vivienda::viviendasPropietario(Usuario::find($vivienda->id_usuario)->id);
    $cliente = Cliente::find($reserva->id_cliente);

    $reservasVivienda = Vivienda::getTodasFechasReservadas($vivienda->id, true, $reserva);

    return View::make('detallesReserva')->with(['reserva' => $reserva, 'vivienda' => $vivienda, 'viviendasPropietario' => $viviendasPropietario, 'cliente' => $cliente, 'reservasVivienda' => $reservasVivienda]);
  }


  public function eliminarReservaConfirmada($id_reserva){
    $respuesta = Alquiler::eliminarReservaConfirmada($id_reserva);

      return Redirect::to('propietario')
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
  }


    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>