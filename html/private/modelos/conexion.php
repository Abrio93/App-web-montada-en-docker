<?php

    class Conexion{

        static public function conectar(){

            $conexion = new PDO("mysql:host=mysql;dbname=adminlte", "root", "rootpassword");
            $conexion->exec("set names utf8");
            return $conexion;
        }
    }
?>