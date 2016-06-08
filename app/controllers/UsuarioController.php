<?php 

class UsuarioController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function __construct()
  {
    $this->beforeFilter('csrf', array('on' => 'post'));
  }

  public function admin()
  {
    $propietarios = Usuario::getPropietarios();
    return View::make('admin')->with(['propietarios' => $propietarios]);
  }

  public function propietario(){

    $propietario = Usuario::find(Auth::id());

    $reservasNoConfirmadas = Alquiler::reservasPropietarioSinConfirmar($propietario->id);

    $reservasConfirmadas = Alquiler::reservasPropietarioConfirmadas($propietario->id);

    $viviendas = Vivienda::viviendasPropietario($propietario->id);

    return View::make('propietario')->with(['reservasNoConfirmadas' => $reservasNoConfirmadas, 'reservasConfirmadas' => $reservasConfirmadas, 'viviendas' => $viviendas]);

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

  public function darDeBajaPropietario($id_propietario){

    $respuesta = Usuario::darDeBajaPropietario($id_propietario);

    return Redirect::back()
        ->with('mensaje', ($respuesta['mensaje']))
        ->with('exito', ($respuesta['exito']));
  }

  public function darDeAltaPropietario($id_propietario){

    $respuesta = Usuario::darDeAltaPropietario($id_propietario);

    return Redirect::back()
        ->with('mensaje', ($respuesta['mensaje']))
        ->with('exito', ($respuesta['exito']));
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

  public function edicionPerfil($id_usuario){
    $usuario = Usuario::find($id_usuario);
    return View::make('perfil')->with(['usuario' => $usuario]);
  }

  public function editarPerfil($id_usuario){
    $respuesta =Usuario::editarPerfil($id_usuario,Input::all());

    if ($respuesta['error'] == true) {
      return Redirect::back()->withErrors($respuesta['mensaje'])->withInput();
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