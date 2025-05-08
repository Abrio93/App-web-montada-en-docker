<?php
    require_once("conexion.php");

    class ModeloUsuarios{

        //? MOSTRAR USUARIOS
        static public function mdlMostrarUsuarios($tabla, $campo, $valor){

            if($campo != null or $valor != null){
                
                //? ESTE SE UTILIZA PARA COMPARAR EL USUARIO Y LA CONTRASEÑA DEL LOGIN CON EL DE LA BD (SE UTILIZA PARA EL LOGIN)
                $conexion = Conexion::conectar();
                $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :$campo");

                $sentencia->bindParam(":".$campo, $valor, PDO::PARAM_STR);

                $sentencia->execute();

                return $sentencia->fetch();

            }else{

                //? ESTE SE UTILIZA PARA MOSTRAR TODOS LOS USUARIOS EN LA TABLA DEL APARTADO INICIO -> USUARRIOS DE LA WEB (usuarios.php)
                $conexion = Conexion::conectar();
                $sentencia = $conexion->prepare("SELECT * FROM $tabla");

                $sentencia->execute();

                return $sentencia->fetchAll();

            }

            $sentencia->close();
            $sentencia = null;
            
        }

        //? ALTA DE USUARIOS
        static public function mdlIngresarUsuario($tabla, $datos){

            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");

            $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $sentencia->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $sentencia->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $sentencia->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
            $sentencia->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

            if($sentencia->execute()){
                return "OK";
            }else{
                return "error";
            }

            $sentencia->close();

            $sentencia = null;
        }

        //? EDITAR USUARIOS
        static public function mdlEditarUsuario($tabla, $datos){
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("UPDATE $tabla set nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

            $sentencia->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $sentencia->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $sentencia->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
            $sentencia->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            $sentencia->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            
            if($sentencia->execute()){
                if($_SESSION["usuario"] == $datos["usuario"]){
                    $_SESSION["foto"] = $datos["foto"];
                }
                return "SI";
            }else{
                return "Error";
            }

            $sentencia -> close();

            $sentencia = null;
        }

       //? ACTIVAR/DESACTIVAR ESTADO DE UN USUARIO
        static public function mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2){

            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("UPDATE $tabla SET $campo1= :$campo1, intentos = 0 WHERE $campo2 = :$campo2");

            $sentencia->bindParam(":".$campo1, $valor1, PDO::PARAM_STR);
            $sentencia->bindParam(":".$campo2, $valor2, PDO::PARAM_STR);

            if($sentencia->execute()){
                return "SI";
            }else{
                return "Error";
            }

            $sentencia->close();

            $sentencia = null;
        }

        //? PARA BORRAR EL USUARIO QUE ME LLEGUE DEL CONTROLADOR
        static public function mdlBorrarUsuario($tabla, $datos){

            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("DELETE FROM $tabla WHERE id = :id");

            $sentencia->bindParam(":id", $datos, PDO::PARAM_INT);

            if($sentencia->execute()){
                return "SI";
            }else{
                return "Error";
            }

            $sentencia -> close();
            $sentencia = null;
        }

        //? ESTE METODO ES PARA INCREMENTAR EL NUMERO DE INTENTOS Y PARA PONERLO A 0 EN EL CASO DE QUE LOGRE ENTRAR ANTES DE 5 INTENTOS
        static public function mdlIncrementarIntentosUsuario($tabla, $usuario){

                //? ESTE SE UTILIZA PARA SACAR EL VALOR DE INTENTOS E INCREMENTARLO
                $conexion = Conexion::conectar();
                $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE usuario = :usuario");
                $sentencia->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                $sentencia->execute();
                $valor = $sentencia->fetch();
                $valor = (int)$valor["intentos"];
                //? SI ESTE VALOR ES IGUAL A 4 O MÁS BANEAMOS AL USUARIO PONIENDOLE EL ESTADO A 0 (DESACTIVADO), SI NO SIMPLEMENTE SE INCREMENTA
                if($valor >= 4){
                    $valor = 5;
                    $sentencia_banear = $conexion->prepare("UPDATE $tabla SET intentos = :intentos, estado = 0 WHERE usuario = :usuario");
                    
                    $sentencia_banear->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                    $sentencia_banear->bindParam(":intentos", $valor, PDO::PARAM_STR);
        
                    if($sentencia_banear->execute()){
                        return $valor;
                    }else{
                        return "Error";
                    }
                }else{
                    $valor = $valor+1;
                    $sentencia_actualizar = $conexion->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");
                    
                    $sentencia_actualizar->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                    $sentencia_actualizar->bindParam(":intentos", $valor, PDO::PARAM_STR);
        
                    if($sentencia_actualizar->execute()){
                        return $valor;
                    }else{
                        return "Error";
                    }
                }
        }

    }
?>