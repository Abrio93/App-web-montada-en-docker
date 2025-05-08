<?php

    class ControladorUsuarios{

        //? INGRESO DE USUARIO (LOGIN)
        public function ctrIngresoUsuario(){

            if(isset($_POST["usuario"])){

                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])){
                    
                    $tabla = "usuarios";
                    $campo = "usuario";

                    //? ENCRIPTAMOS LA CONTRASEÑA PARA COMPARAR LA INTRODUCIDA EN EL LOGIN CON LA ALMACENADA EN LA BD (OBIAMENTE ENCRIPTADA)
                    $encriptada = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $valor = $_POST["usuario"];

                    //? REALIZAMOS UNA CONSULTA QUE NOS DEVUELVE EL NOMBRE DE USUARIO QUE SE HA LOGUEADO
                    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);
                    
                    //? Por si queremos visualizar el nombre que recibimos o el array completo
                    // var_dump($respuesta['nombre']);

                    if($respuesta["usuario"] == $_POST["usuario"]){
                        if($respuesta["estado"] == 1){
                            if($respuesta["password"] == $encriptada){
                                $_SESSION["sesion_iniciada"] = "SI";
                                $_SESSION["id"] = $respuesta["id"];
                                $_SESSION["nombre"] = $respuesta["usuario"];
                                $_SESSION["usuario"] = $respuesta["usuario"];
                                $_SESSION["foto"] = $respuesta["foto"];
                                $_SESSION["perfil"] = $respuesta["perfil"];
                            
                                //? ALMACENAR FECHA PARA SABE EL ÚLTIMO LOGIN Y PONIENDO EL NUMERO DE INTENTOS A "0" YA QUE EL USUARIO SE HA LOGUEADO CORRECTAMENTE.
                                $fecha = date("Y-m-d");
                                $hora = date("H:i:s");
                                $fechaActual = $fecha." ".$hora;
    
                                $campo1 = "ultimo_login";
                                $valor1 = $fechaActual;
    
                                $campo2 = "id";
                                $valor2 = $respuesta["id"];
    
                                $ultimoLogin = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);
    
                                if($ultimoLogin == "SI"){
                                    //? Lo podemos hacer mediante php o mediante javascript (un script vaya)
                                    // header("Location: inicio");
                                    echo "<script> window.location = 'inicio'; </script>";
                                }

                            }else{
                                $tabla = "usuarios";
                                $usuario = $respuesta["usuario"];
                                $incrementar_intentos = ModeloUsuarios::mdlIncrementarIntentosUsuario($tabla, $usuario);
                                //var_dump($incrementar_intentos);
                                if($incrementar_intentos == 5){
                                    echo "<br /><div class='alert alert-danger'>Se ha desactivado el usuario. Si quiere volver a acceder pongase en contacto con su administrador.</div>";
                                }else{
                                     echo "<br /><div class='alert alert-danger'>Error de login, contraseña incorrecta. Le quedan ".(5-$incrementar_intentos)." intentos.</div>";
                                }
                               
                            }
                        }else{
                            echo "<br /><div class='alert alert-danger'>Este usuario se encuentra desactivado actualmente</div>";
                        }
                    }else{
                        echo "<br /><div class='alert alert-danger'>Error de login, usuario incorrecto.</div>";
                    }
                }
            }
        }
        
        //? ALTA DE USUARIO
        public function ctrCrearUsuario(){
            
            if(isset($_POST["nuevoNombre"])){
                
                //? preg_match — Realiza una comparación con una expresión regular.
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){
                    

                    $ruta = "";

                    if(isset($_FILES["nuevaFoto"]["tmp_name"])){
                        list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                        $nuevoAncho = 350;
                        $nuevoAlto = 350;

                        //? CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
                        $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
                        mkdir($directorio, 0755);

                        //! SEGUN EL FORMATO (jpg o png) DE LA FOTO APLICAMOS UNAS FUNCIONES UNAS U OTRAS

                        if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

                            //? GUARDAMOS LA IMAGEN EN SU DIRECTORIO(ANTES CREADO UN POCO MAS ARRIBA)
                            $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$_POST["nuevoUsuario"].".jpg";

                            //todo | "imagecreatefromjpeg" — Crea una nueva imagen a partir de un fichero o de una URL
                            $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                            //todo | "imagecreatetruecolor" — Crear una nueva imagen de color verdadero
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            //todo | "imagecopyresized" — Copia y cambia el tamaño de parte de una imagen
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            //todo | "imagejpeg" — Exportar la imagen al navegador o a un fichero
                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["nuevaFoto"]["type"] == "image/png"){

                            //? GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                            $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$_POST["nuevoUsuario"].".png";

                            //todo | "imagecreatefrompng" — Crea una nueva imagen a partir de un fichero o de una URL
                            $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                            //todo | "imagecreatetruecolor" — Crear una nueva imagen de color verdadero
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            //todo | "imagecopyresized" — Copia y cambia el tamaño de parte de una imagen
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            //todo | "imagepng" — Exportar la imagen al navegador o a un fichero
                            imagepng($destino, $ruta);
                        }

                    }

                    $tabla = "usuarios";

                    //? ENCRIPTAMOS LA CONTRASEÑA
                    $encriptada = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datos = array("nombre" => $_POST["nuevoNombre"],
                                   "usuario" => $_POST["nuevoUsuario"],
                                   "password" => $encriptada,
                                   "perfil" => $_POST["nuevoPerfil"],
                                   "foto" => $ruta);
                    
                    $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
                    
                    //? SI TODO SALE BIEN MOSTRAMOS UN ALERT SUCCESS, SINO UNO DE ERROR
                    if($respuesta == "OK"){
                        echo '<script>
                                swal({
                                    type: "success",
                                    title: "¡El usuario ha sido guardado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "usuarios";
                                    }     
                                });
                            </script>';
                    }

                   }else{
                       echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "usuarios";
                                    }     
                                });
                            </script>';
                   }
            }
        }

        //? SE UTILIZA PARA MOSTRAR LOS USUARIOS EN LA TABLA (DATATABLE)
        public function ctrMostrarUsuarios($campo, $valor){
            
            $tabla = "usuarios";

            $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);

            return $respuesta;
            
        }

        //? SE UTILIZA PARA LA EDICION DE USUARIOS
        public function ctrEditarUsuario(){

            if(isset($_POST["editarUsuario"])){
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && !empty($_POST["editarNombre"])){
                    //? VALIDAR IMAGEN
                    $ruta = $_POST["fotoActual"];

                    if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

                        list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                        $nuevoAncho = 350;
                        $nuevoAlto = 350;

                        //? PREGUNTAMOS SI EXISTE YA UNA IMAGEN, SI ES CIERTO ELIMINAMOS EL CAMPO OCULTO fotoActual
                        //? SI NO ES CIERTO CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
                        $directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];
                        if($_POST["fotoActual"] != ""){
                            unlink($_POST["fotoActual"]);
                        }else{
                            mkdir($directorio, 0755);
                        }

                        //! SEGUN EL FORMATO (jpg o png) DE LA FOTO APLICAMOS UNAS FUNCIONES UNAS U OTRAS

                        if($_FILES["editarFoto"]["type"] == "image/jpeg"){

                            //? GUARDAMOS LA IMAGEN EN SU DIRECTORIO (ANTES CREADO UN POCO MAS ARRIBA)
                            $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$_POST["editarUsuario"].".jpg";

                            $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destino, $ruta);
                        }

                        if($_FILES["editarFoto"]["type"] == "image/png"){

                            //? GUARDAMOS LA IMAGEN EN EL DIRECTORIO (ANTES CREADO UN POCO MAS ARRIBA)
                            $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$_POST["editarUsuario"].".png";

                            $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagepng($destino, $ruta);
                        }

                    }
                

                $tabla = "usuarios";

                if($_POST["editarPassword"] != ""){
                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
                        $encriptada = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                        $datos = array("nombre" => $_POST["editarNombre"],
                               "usuario" => $_POST["editarUsuario"],
                               "password" => $encriptada,
                               "perfil" => $_POST["editarPerfil"],
                               "foto" => $ruta);

                        $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                        if($respuesta == "SI"){
                            echo '<script>
                                        swal({
                                            type: "success",
                                            title: "El usuario ha sido editado correctamente",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "usuarios";
                                            }     
                                        });
                                </script>';
                        }
                    }else{
                        echo '<script>
                                swal({
                                    type: "error",
                                    title: "¡La contraseña no puede llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "usuarios";
                                    }     
                                });
                            </script>';
                    }
                }else{
                    $encriptada = $_POST["passwordActual"];

                    $datos = array("nombre" => $_POST["editarNombre"],
                               "usuario" => $_POST["editarUsuario"],
                               "password" => $encriptada,
                               "perfil" => $_POST["editarPerfil"],
                               "foto" => $ruta);

                    $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                    if($respuesta == "SI"){
                        echo '<script>
                                    swal({
                                        type: "success",
                                        title: "El usuario ha sido editado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "usuarios";
                                        }     
                                    });
                            </script>';
                    }
                } 
            }else{
                echo '<script>
                        swal({
                            type: "error",
                            title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }     
                        });
                    </script>';
            }
        }
    }

    //? SE UTILIZA PARA ELIMINAR LOS USUARIOS
    public function ctrBorrarUsuario(){

        if(isset($_GET["idUsuario"])){
            if($_GET["fotoUsuario"]){
                //? BORRAMOS LA FOTO
                unlink($_GET["fotoUsuario"]);
                //? PARA BORRAR EL DIRECTORIO NECESITAMOS EL NOMBRE DE USUARIO (CARPETA)
                rmdir("vistas/img/usuarios/".$_GET["usuario"]);
            }else if($_GET["fotoUsuario"] == ""){
                rmdir("vistas/img/usuarios/".$_GET["usuario"]);
            }

            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            IF($respuesta == "SI"){
                echo '<script>
                        swal({
                            type: "success",
                            title: "El usuario ha sido borrado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }     
                        });
                    </script>';
            }

        }
    }

}
?>