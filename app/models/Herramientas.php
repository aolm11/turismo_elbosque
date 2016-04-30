<?php


class Herramientas
{

    public static function formatearFechaBD($fecha)
    {

        $fecha = date("Y-m-d", strtotime($fecha));
        return $fecha;
    }
}