<?php

class ControladorFotos
{

    //? SE UTILIZA PARA MOSTRAR LAS FOTOS EN LA TABLA DEL APARTADO FOTOS -> FOTOS DE LA WEB (fotos.php)
    public function ctrMostrarFotos()
    {
        $respuesta = ModeloFotos::mdlMostrarFotos();

        return $respuesta;
    }

    //? SE UTILIZA PARA FORMATEAR LA FECHA QUE VIENE DE LA BASE DE DATOS Y MOSTRARLA EN EL FORMATO dd/mm/yyyy hh:mm:ss la llamada se hace en fotos.php
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