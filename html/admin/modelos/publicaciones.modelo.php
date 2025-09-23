<?php
require_once("conexion.php");

class ModeloPublicaciones
{

    //? MOSTRAR PUBLICACIONES
    static public function mdlMostrarPublicaciones()
    {

        //? ESTE SE UTILIZA PARA MOSTRAR TODOS LAS PUBLICACIONES EN LA TABLA DEL APARTADO PUBLICACIONES -> PUBLICACIONES DE LA WEB (publicaciones.php)
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM publicaciones");

        $sentencia->execute();

        return $sentencia->fetchAll();


        $sentencia->close();
        $sentencia = null;
    }
}
