<?php

class Imagen extends Eloquent {

	protected $table = 'imagenes';
	protected $fillable = array('id', 'id_vivienda','nombre');
	public $timestamps = true;

	public function vivienda()
	{
		return $this->belongsTo('Vivienda');
	}

	/**
	 * Consulta que devuelve las imágenes de una vivienda
	 */
	public static function imagenesVivienda($id_vivienda){

		$viviendas = DB::table('imagenes')->where('id_vivienda', '=', $id_vivienda)->get();

		return $viviendas;
	}
	/**
	 * Consulta que devuelve el nombre de una imagen de una vivienda.
	 */
	public static function getNombreImagenVivienda($id_vivienda){

		$nombre = DB::table('imagenes')->where('id_vivienda', '=', $id_vivienda)->select('nombre')->first();

		return $nombre;
	}

	/**
	 * Método para eliminar una imagen.
	 */
	public static function borrar($id_imagen){

		$respuesta = array();

		$imagen = Imagen::find($id_imagen);

		if(!is_null($imagen)){

			File::delete(public_path('img/viviendas/'.$imagen->nombre));

			$imagen->delete();

			$respuesta['mensaje'] = 'Imagen eliminada';
			$respuesta['error'] = false;
			$respuesta['data'] = $imagen;
			$respuesta['exito'] = true;

		}else{
			$respuesta['mensaje'] = 'La imagen no existe';
			$respuesta['error'] = false;
			$respuesta['data'] = $imagen;
			$respuesta['exito'] = false;
		}

		return $respuesta;


	}





}