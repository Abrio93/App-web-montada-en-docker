<?php

class ControladorPublicaciones
{

    //? SE UTILIZA PARA MOSTRAR LAS PUBLICACIONES EN LA TABLA DEL APARTADO PUBLICACIONES -> PUBLICACIONES DE LA WEB (publicaciones.php)
    public function ctrMostrarPublicaciones()
    {
        $respuesta = ModeloPublicaciones::mdlMostrarPublicaciones();

        return $respuesta;
    }

    //? SE UTILIZA PARA FORMATEAR LA FECHA QUE VIENE DE LA BASE DE DATOS Y MOSTRARLA EN EL FORMATO dd/mm/yyyy hh:mm:ss la llamada se hace en publicaciones.php
    public function ctrFormatearFecha($fecha)
    {

        if($fecha == null || $fecha == "" || $fecha == "0000-00-00 00:00:00"){
            return "Sin fecha";
        }
        
        //? formateamos la fecha a --> 18/09/2025 11:27:30
        $fecha_formateada = new DateTime($fecha);
        $respuesta = $fecha_formateada->format('d/m/Y H:i:s');

        return $respuesta;
    }
}
