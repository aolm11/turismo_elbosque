<?php 

class ViviendaController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function __construct()
  {
    $this->beforeFilter('csrf', array('on' => 'post'));
  }

  public function viviendas(){
    $viviendas = Vivienda::getTodasViviendas();

    return View::make('viviendas')->with(['viviendas' => $viviendas]);

  }

  public function viviendasFiltradas(){
    $viviendas = Vivienda::buscarViviendas(Input::all());

    if (isset($viviendas['error'])) {
      return Redirect::back()->withErrors($viviendas['mensaje']);
    } else {
      return View::make('viviendasFiltradas')->with(['viviendas' => $viviendas]);
    }
  }

  public function detallesVivienda($id){
    $vivienda = Vivienda::find($id);
    $imagenes = Imagen::imagenesVivienda($id);
    $reservas = Vivienda::getTodasFechasReservadas($id, true);

    return View::make('detallesVivienda')->with(['vivienda' => $vivienda, 'imagenes' => $imagenes, 'reservas' => $reservas]);
  }

  public function crear(){
    $respuesta = Vivienda::crear(Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function edicion($id){

    $propietario = Auth::user();

    $vivienda = Vivienda::find($id);

    $imagenes = Imagen::imagenesVivienda($vivienda->id);

    if($propietario->id != $vivienda->id_usuario){
      return Redirect::to('401');
    }else{
      return View::make('editarVivienda')->with(['vivienda' => $vivienda, 'imagenes' => $imagenes]);
    }

  }

  public function editar($id){
    $respuesta = Vivienda::editar($id, Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function addImagen($id_vivienda){

    $vivienda = Vivienda::find($id_vivienda);

    if(Auth::id() != $vivienda->id_usuario){
      return Redirect::to('401');
    }else {

      $respuesta = Vivienda::addImagen($id_vivienda, Input::all());

      if ($respuesta['error'] == true) {
        return Redirect::back()->withErrors($respuesta['mensaje']);
      } else {
        return Redirect::back()
            ->with('mensaje', ($respuesta['mensaje']))
            ->with('exito', ($respuesta['exito']));
      }
    }
  }

  public function borrar($id_vivienda){
    $vivienda = Vivienda::find($id_vivienda);

    if(Auth::id() != $vivienda->id_usuario){
      return Redirect::to('401');
    }else {
      $respuesta = Vivienda::borrar($id_vivienda);

      if ($respuesta['error'] == true) {
        return Redirect::back()->withErrors($respuesta['mensaje']);
      } else {
        return Redirect::back()
            ->with('mensaje', ($respuesta['mensaje']))
            ->with('exito', ($respuesta['exito']));
      }
    }
  }

  public function fechasReservadasVivienda(){
    $reserva = Alquiler::find(Input::get('id_reserva'));
    $reservas = Vivienda::getTodasFechasReservadas(Input::get('id'), true, $reserva);

    return $reservas;
  }

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