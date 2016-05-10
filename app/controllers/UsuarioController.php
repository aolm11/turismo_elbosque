<?php 

class UsuarioController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function admin()
  {
    $propietarios = Usuario::getPropietarios();
    return View::make('admin')->with(['propietarios' => $propietarios]);
  }

  public function propietario(){

    $propietario = Usuario::find(Auth::id());

    $reservas = Alquiler::reservasPropietario($propietario->id);

    $viviendas = Vivienda::viviendasPropietario($propietario->id);

    return View::make('propietario')->with(['reservas' => $reservas, 'viviendas' => $viviendas]);

  }

  public function logout(){
    Auth::logout();
    return Redirect::to('/');
  }

  public function crearPropietario(){

    $respuesta =Usuario::crearPropietario(Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function editarPropietario($id){

    $respuesta =Usuario::editarPropietario($id, Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
  }

  public function eliminarPropietario($id_propietario){

    $respuesta = Usuario::eliminarPropietario($id_propietario);

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje']);
    } else {
      return Redirect::back()
          ->with('mensaje', ($respuesta['mensaje']))
          ->with('exito', ($respuesta['exito']));
    }
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