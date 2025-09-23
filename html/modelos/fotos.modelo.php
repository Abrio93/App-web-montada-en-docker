<?php
require_once("conexion.php");

class ModeloFotos
{

    //? MOSTRAR FOTOS
    static public function mdlMostrarFotos()
    {

        //? ESTE SE UTILIZA PARA MOSTRAR TODOS LAS FOTOS EN LA TABLA DEL APARTADO FOTOS -> FOTOS DE LA WEB (fotos.php)
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM fotos");

        $sentencia->execute();

        return $sentencia->fetchAll();


        $sentencia->close();
        $sentencia = null;
    }
}
