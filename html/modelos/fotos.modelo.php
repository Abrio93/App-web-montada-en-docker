<?php
require_once("conexion.php");

class ModeloFotos
{

    //? MOSTRAR FOTOS POR PUBLICACION
    static public function mdlSacarFotosPorPublicacion($publicacion_id)
    {

        //? ESTE SE UTILIZA PARA MOSTRAR TODOS LAS PUBLICACIONES EN LA TABLA DEL APARTADO PUBLICACIONES -> PUBLICACIONES DE LA WEB (publicaciones.php)
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("SELECT * FROM fotos WHERE publicacion_id = :publicacion_id");
        
        $sentencia->bindParam(":publicacion_id", $publicacion_id, PDO::PARAM_INT);

        $sentencia->execute();

        return $sentencia->fetchAll();


        $sentencia->close();
        $sentencia = null;
    }
}
