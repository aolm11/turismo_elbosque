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
      return Response::view('401', array(), 401);
    }else {

      $respuesta = Imagen::borrar($id_imagen);


      if ($respuesta['error'] == true) {
        return Redirect::back()->withErrors($respuesta['mensaje']);
      } else {
        return Redirect::back()->with('mensaje', $respuesta['mensaje']);
      }
    }

  }

}

?>