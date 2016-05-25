<?php


class Herramientas
{

    public static function formatearFechaBD($fecha)
    {
        $fecha = date("Y-m-d", strtotime($fecha));
        return $fecha;
    }

    public static function formatearFechaFromBD($fecha)
    {
        $fecha = date("d-m-Y", strtotime($fecha));
        return $fecha;
    }
}