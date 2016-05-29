<?php 

class ImagenController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function borrar($id_imagen){

    $imagen = Imagen::find($id_imagen);
    $vivienda = Vivienda::find(($imagen->id_vivienda));

    if(Auth::id() != $vivienda->id_usuario){
      return Redirect::to('401');
    }else {

      $respuesta = Imagen::borrar($id_imagen);


      if ($respuesta['error'] == true) {
        return Redirect::back()->withErrors($respuesta['mensaje']);
      } else {
        return Redirect::back()->with('mensaje', $respuesta['mensaje']);
      }
    }

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