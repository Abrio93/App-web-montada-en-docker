<?php

class ControladorPublicaciones
{

    //? INGRESO DE USUARIO (LOGIN)
    public function ctrLogin()
    {

        if (isset($_POST["correo"])) {

            if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["correo"])) {
                if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])) {
                    $tabla = "usuarios";
                    $campo = "correo";

                    //? ENCRIPTAMOS LA CONTRASEÑA PARA COMPARAR LA INTRODUCIDA EN EL LOGIN CON LA ALMACENADA EN LA BD (OBIAMENTE ENCRIPTADA)
                    $encriptada = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    // $encriptada = $_POST["password"];

                    $valor = $_POST["correo"];

                    //? REALIZAMOS UNA CONSULTA QUE NOS DEVUELVE EL NOMBRE DE USUARIO QUE SE HA LOGUEADO
                    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);

                    //? Por si queremos visualizar el nombre que recibimos o el array completo
                    // var_dump($respuesta['nombre']);

                    if (@$respuesta["correo"] == $_POST["correo"]) {
                        if ($respuesta["baneado"] == 0) {
                            if ($respuesta["password"] == $encriptada) {
                                $_SESSION["sesion_iniciada"] = "SI";
                                $_SESSION["nombre"] = $respuesta["nombre"];

                                echo "<script> window.location = 'index.php?ruta=inicio'; </script>";
                            } else {
                                echo "<br /><div class='text-center alert alert-danger'>Error de login, contraseña incorrecta.</div>";
                            }
                        } else {
                            echo "<br /><div class='text-center alert alert-danger'>Este usuario se encuentra desactivado actualmente</div>";
                        }
                    } else {
                        echo "<br /><div class='text-center alert alert-danger'>Error de login, correo incorrecto.</div>";
                    }
                } else {
                    echo "<br /><div class='text-center alert alert-danger'>No se pueden introducir caracteres especiales ni espacios en la contraseña</div>";
                }
            } else {
                echo "<br /><div class='text-center alert alert-danger'>Formato del correo es incorrecto.</div>";
            }
        }
    }

    //? SE UTILIZA PARA MOSTRAR LOS USUARIOS EN LA TABLA (DATATABLE)
    public function ctrMostrarUsuarios($campo, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);

        return $respuesta;
    }

    //? SE UTILIZA PARA FORMATEAR LA FECHA QUE VIENE DE LA BASE DE DATOS Y MOSTRARLA EN EL FORMATO dd/mm/yyyy hh:mm:ss la llamada se hace en usuarios.php
    public function ctrFormatearFecha($fecha)
    {

        //? formateamos la fecha a --> 18/09/2025 11:27:30
        $fecha_formateada = new DateTime($fecha);
        $respuesta = $fecha_formateada->format('d/m/Y H:i:s');

        return $respuesta;
    }

    //? SE UTILIZA PARA CREAR ENTRE 70 Y 100 USUARIOS EN usuarios.php CUANDO SE HACE CLICK EN RELLENAR USUARIOS
    public function ctrRellenarUsuarios()
    {

        $ruta = "vistas/img/usuarios/default/anonymous.png";

        for ($i = 0; $i < $numeroUsuarios = 100; $i++) {

            list($nombre, $usuario, $correo, $perfil) = $this->ctrGenerarAleatorio();

            $encriptada = crypt($usuario, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $datos = array(
                "nombre" => $nombre,
                "usuario" => $usuario,
                "password" => $encriptada,
                "imagen" => $ruta,
                "correo" => $correo,
                "perfil" => $perfil,
                "baneado" => rand(0, rand(0, 1)), //? el valor está puesto así para que haya más probabilidad de que no estén baneados
            );

            $tabla = "usuarios";

            ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
        }

        return [$numeroUsuarios, true];
    }

    private function ctrGenerarAleatorio()
    {

        //? ARRAYS CON LAS OPCIONES QUE SE ESCOGEN MÁS ABAJO
        $perfiles = ['Administrador', 'Especial', 'Vendedor'];
        $nombres = [
            "Alejandro",
            "María",
            "Carlos",
            "Sofía",
            "David",
            "Isabella",
            "Juan",
            "Camila",
            "José",
            "Valentina",
            "Luis",
            "Martina",
            "Miguel",
            "Lucía",
            "Daniel",
            "Paula",
            "Jorge",
            "Elena",
            "Andrés",
            "Carolina",
            "Francisco",
            "Sara",
            "Fernando",
            "Julia",
            "Raúl",
            "Manuela",
            "Pedro",
            "Daniela",
            "Santiago",
            "Natalia",
            "Pablo",
            "Gabriela",
            "Ricardo",
            "Claudia",
            "Ángel",
            "Ángela",
            "Roberto",
            "Andrea",
            "Antonio",
            "Verónica",
            "Eduardo",
            "Patricia",
            "Óscar",
            "Lorena",
            "Víctor",
            "Beatriz",
            "Javier",
            "Rocío",
            "Manuel",
            "Cristina",
            "Alberto",
            "Marta",
            "Ramón",
            "Teresa",
            "Adrián",
            "Susana",
            "Iván",
            "Esther",
            "Hugo",
            "Mónica",
            "Sergio",
            "Alejandra",
            "Diego",
            "Nuria",
            "Jaime",
            "Inés",
            "Bruno",
            "Alicia",
            "Mario",
            "Carmen",
            "Marcos",
            "Lidia",
            "Guillermo",
            "Irene",
            "Enrique",
            "Blanca",
            "Tomás",
            "Marina",
            "Joaquín",
            "Raquel",
            "Sebastián",
            "Silvia",
            "Gabriel",
            "Emma",
            "Rafael",
            "Ana",
            "Emilio",
            "Victoria",
            "Cristóbal",
            "Lourdes",
            "Félix",
            "Nicolás",
            "Santos",
            "Begoña",
            "Marcelo",
            "Sandra",
            "Saúl",
            "Pilar",
            "Ismael",
            "Margarita",
            "Alonso",
            "Aitana",
            "Benjamín",
            "Gloria",
            "Héctor",
            "Estela",
            "Simón",
            "Rosa",
            "Gustavo",
            "Amparo",
            "Eugenio",
            "Tamara",
            "Maximiliano",
            "Leticia",
            "Matías",
            "Noemí",
            "Rodrigo",
            "Mercedes",
            "Vicente",
            "Rosario",
            "Joaquim",
            "Milagros",
            "Elías",
            "Consuelo",
            "Armando",
            "Josefina",
            "Leandro",
            "Amalia",
            "Teodoro",
            "Clara",
            "Román",
            "Celia",
            "Israel",
            "Olga",
            "León",
            "Isabel",
            "Mauricio",
            "Consuelo",
            "Gerardo",
            "Trinidad",
            "Adolfo",
            "Raquel",
            "Hernán",
            "Ágata",
            "Rubén",
            "Juana",
            "Orlando",
            "Magdalena",
            "Facundo",
            "Luz",
            "Salvador",
            "Daniela",
            "Agustín",
            "Miriam",
            "Nicolás",
            "Estefanía",
            "Edgar",
            "Celeste",
            "Adela",
            "Gregorio"
        ];

        do {

            //? elegimos un nombre y generamos un usuario único
            $nombre = $nombres[array_rand($nombres)];
            $usuario = $nombre . rand(1, 99);

            $tabla = "usuarios";
            $campo = "usuario";
            $valor = $usuario;

            //? Consultar si el ususario existe
            $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);
        } while ($respuesta != false); //? Repetir mientras el usuario ya exista

        //? Correo electrónico que termine en @gmail.com
        $correo = $usuario . '@gmail.com';

        //? Seleccionamos aleatoriamente entre Administrador, Especial y Vendedor
        $perfil = $perfiles[array_rand($perfiles)];

        return [$nombre, $usuario, $correo, $perfil];
    }

    //? SE UTILIZA PARA ACTIVAR/DESACTIVAR UN USUARIO EN LA TABLA DE usuarios.php Y EN EL MODAL DE VER USUARIO EN usuarios.php
    public function ctrActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2)
    {

        $respuesta = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);

        return $respuesta;
    }

    //? funcion para las imagenes en alta/editar usuarios
    private function ctrRutaOrigenJpeg($tmpName, $directorio, $nuevoUsuario)
    {

        $ruta = $directorio . "/" . $nuevoUsuario . ".jpg";
        $origen = imagecreatefromjpeg($tmpName);

        return [$origen, $ruta];
    }

    //? funcion para las imagenes en alta/editar usuarios
    private function ctrRutaOrigenPng($tmpName, $directorio, $nuevoUsuario)
    {

        $ruta = $directorio . "/" . $nuevoUsuario . ".png";
        $origen = imagecreatefrompng($tmpName);

        return [$origen, $ruta];
    }

    //? funcion para las imagenes en alta/editar usuarios
    private function ctrRutaOrigenGif($tmpName, $directorio, $nuevoUsuario)
    {

        $ruta = $directorio . "/" . $nuevoUsuario . ".gif";

        return [$tmpName, $ruta];
    }

    private function ctrTratamientoFinal($origen, $nuevoAncho, $nuevoAlto, $ancho, $alto, $tipoArchivo, $ruta)
    {

        $destino = $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

        //? Copia y cambia el tamaño de parte de una imagen
        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

        //? Exportar la imagen según el formato
        $this->ctrExportarImagen($tipoArchivo, $destino, $ruta);
    }

    //? funcion para las imagenes en alta/editar usuarios
    private function ctrExportarImagen($tipoArchivo, $destino, $ruta)
    {

        switch ($tipoArchivo) {
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($destino, $ruta);
                break;
            case "image/png":
                imagepng($destino, $ruta);
                break;
                //! comprobar si hace falta, diría que no
                // case "image/gif":
                //     imagegif($destino, $ruta);
                //     break;
        }
    }

    //? ALTA DE USUARIO
    public function ctrCrearUsuario()
    {

        //? si se envía el formulario
        if (isset($_POST["formularioAlta"])) {
            //? nombre
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"] || !empty($_POST["nuevoNombre"]))) {
                //? usuario
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUsuario"] || !empty($_POST["nuevoUsuario"]))) {
                    //? correo
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"] || !empty($_POST["nuevoPassword"]))) {
                        //? contraseña
                        if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["nuevoCorreo"]) || !empty($_POST["nuevoCorreo"])) {
                            //? Si existe la imagen cargada en el servidor y no viene vacía
                            if (isset($_FILES["nuevaFotoAlta"]["tmp_name"]) && !empty($_FILES["nuevaFotoAlta"]["tmp_name"])) {

                                list($ancho, $alto) = getimagesize($_FILES["nuevaFotoAlta"]["tmp_name"]);

                                $nuevoAncho = 350;
                                $nuevoAlto = 350;

                                //? CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO SI NO EXISTE
                                $directorio = "vistas/img/usuarios/" . $_POST["nuevoUsuario"];

                                //? Si no existe creamos el directorio
                                if (!file_exists($directorio)) {
                                    mkdir($directorio, 0755);
                                }

                                //? OBTENEMOS EL TIPO DE ARCHIVO
                                $tipoArchivo = $_FILES["nuevaFotoAlta"]["type"];
                                $origen = "";
                                $ruta = "";
                                $tmpName = "";

                                //? UTILIZAMOS UN SWITCH SEGÚN EL FORMATO DE LA FOTO
                                switch ($tipoArchivo) {
                                    case "image/jpeg":
                                    case "image/jpg":

                                        list($origen, $ruta) = $this->ctrRutaOrigenJpeg($_FILES["nuevaFotoAlta"]["tmp_name"], $directorio, $_POST["nuevoUsuario"]);

                                        $this->ctrTratamientoFinal($origen, $nuevoAncho, $nuevoAlto, $ancho, $alto, $tipoArchivo, $ruta);

                                        break;

                                    case "image/png":

                                        list($origen, $ruta) = $this->ctrRutaOrigenPng($_FILES["nuevaFotoAlta"]["tmp_name"], $directorio, $_POST["nuevoUsuario"]);

                                        $this->ctrTratamientoFinal($origen, $nuevoAncho, $nuevoAlto, $ancho, $alto, $tipoArchivo, $ruta);

                                        break;

                                    case "image/gif":

                                        list($tmpName, $ruta) = $this->ctrRutaOrigenGif($_FILES["nuevaFotoAlta"]["tmp_name"], $directorio, $_POST["nuevoUsuario"]);

                                        move_uploaded_file($tmpName, $ruta);

                                        break;
                                }
                            } else {
                                //? Asignamos un valor por defecto a la imagen si viene vacía
                                $ruta = "vistas/img/usuarios/default/anonymous.png";
                            }


                            //? ENCRIPTAMOS LA CONTRASEÑA
                            $encriptada = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                            //? Asignamos un valor por defecto a perfil si viene vacío
                            $_POST["nuevoPerfil"] = ($_POST["nuevoPerfil"] == "") ? "Vendedor" : $_POST["nuevoPerfil"];

                            $datos = array(
                                "nombre" => $_POST["nuevoNombre"],
                                "usuario" => $_POST["nuevoUsuario"],
                                "password" => $encriptada,
                                "imagen" => $ruta,
                                "correo" => $_POST["nuevoCorreo"],
                                "perfil" => $_POST["nuevoPerfil"],
                                "baneado" => 0,
                            );

                            $tabla = "usuarios";

                            $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                            //? SI TODO SALE BIEN MOSTRAMOS UN ALERT SUCCESS, SINO UNO DE ERROR
                            if ($respuesta == "OK") {
                                echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "¡El usuario ha sido guardado correctamente!",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false,
                                            allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                            allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "usuarios";
                                            }     
                                        });
                                    </script>';
                            }
                        } else {
                            echo '<script>
                                    Swal.fire({
                                        icon: "error",                                        
                                        title: "¡El correo no puede ir vacío, llevar caracteres especiales o el formato es incorrecto!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                        allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                        allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "usuarios";
                                        }     
                                    });
                                </script>';
                        }
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "error",                                    
                                    title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                    allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                    allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "usuarios";
                                    }     
                                });
                            </script>';
                    }
                } else {
                    echo '<script>
                            Swal.fire({
                                icon: "error",                                
                                title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                                allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                            }).then((result)=>{
                                if(result.value){
                                    window.location = "usuarios";
                                }     
                            });
                        </script>';
                }
            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",                            
                            title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                            allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }     
                        });
                    </script>';
            }
        }
    }


    private function ctrEdicionImagenes($directorio, $imagenActual)
    {

        //? Le decimos si la imagen viene con datos y es distinta a la de anonymous.png la borramos
        if ($imagenActual != "" && $imagenActual != "vistas/img/usuarios/default/anonymous.png") {
            unlink($imagenActual);
        } else {
            mkdir($directorio, 0755);
        }
    }

    //? SE UTILIZA PARA LA EDICION DE USUARIOS
    public function ctrEditarUsuario()
    {
        if (isset($_POST["formularioEditar"])) {
            $id = (int)$_POST["idUsuarioEditar"];
            if (isset($id) && !empty($id) && is_numeric($id)) {
                //? nombre
                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"] || !empty($_POST["editarNombre"]))) {
                    //? usuario
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUsuario"] || !empty($_POST["editarUsuario"]))) {
                        //? contraseña
                        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]) || empty($_POST["editarPassword"])) {
                            //? correo
                            if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $_POST["editarCorreo"]) || !empty($_POST["editarCorreo"])) {
                                //? Si existe la imagen cargada en el servidor y no viene vacía
                                if (isset($_FILES["nuevaFotoEditar"]["tmp_name"]) && !empty($_FILES["nuevaFotoEditar"]["tmp_name"])) {

                                    list($ancho, $alto) = getimagesize($_FILES["nuevaFotoEditar"]["tmp_name"]);

                                    $nuevoAncho = 350;
                                    $nuevoAlto = 350;

                                    //? PREGUNTAMOS SI EXISTE YA UNA IMAGEN, SI ES CIERTO ELIMINAMOS EL CAMPO OCULTO imagenActual
                                    //? SI NO ES CIERTO CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
                                    $directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];

                                    $this->ctrEdicionImagenes($directorio, $_POST["imagenActual"]);

                                    //? OBTENEMOS EL TIPO DE ARCHIVO
                                    $tipoArchivo = $_FILES["nuevaFotoEditar"]["type"];
                                    $origen = "";
                                    $ruta = "";
                                    $tmpName = "";

                                    //? UTILIZAMOS UN SWITCH SEGÚN EL FORMATO DE LA FOTO
                                    switch ($tipoArchivo) {
                                        case "image/jpeg":
                                        case "image/jpg":

                                            list($origen, $ruta) = $this->ctrRutaOrigenJpeg($_FILES["nuevaFotoEditar"]["tmp_name"], $directorio, $_POST["editarUsuario"]);

                                            $this->ctrTratamientoFinal($origen, $nuevoAncho, $nuevoAlto, $ancho, $alto, $tipoArchivo, $ruta);

                                            break;

                                        case "image/png":

                                            list($origen, $ruta) = $this->ctrRutaOrigenPng($_FILES["nuevaFotoEditar"]["tmp_name"], $directorio, $_POST["editarUsuario"]);

                                            $this->ctrTratamientoFinal($origen, $nuevoAncho, $nuevoAlto, $ancho, $alto, $tipoArchivo, $ruta);

                                            break;

                                        case "image/gif":

                                            list($tmpName, $ruta) = $this->ctrRutaOrigenGif($_FILES["nuevaFotoEditar"]["tmp_name"], $directorio, $_POST["editarUsuario"]);

                                            move_uploaded_file($tmpName, $ruta);

                                            break;
                                    }
                                } else {
                                    $ruta = $_POST["imagenActual"];
                                }

                                $encriptada = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                                if ($_POST["editarPassword"] == "" || $encriptada == $_POST["editarPasswordActual"]) {

                                    //? CONTRASEÑA QUE SACAMOS DE LA BASE DE DATOS ENCRIPTADA
                                    $encriptada = $_POST["editarPasswordActual"];
                                }

                                //? Asignamos un valor por defecto a perfil si viene vacío
                                $_POST["editarPerfil"] = ($_POST["editarPerfil"] == "") ? "Vendedor" : $_POST["editarPerfil"];

                                $datos = array(
                                    "id" => $id,
                                    "nombre" => $_POST["editarNombre"],
                                    "usuario" => $_POST["editarUsuario"],
                                    "password" => $encriptada,
                                    "imagen" => $ruta,
                                    "correo" => $_POST["editarCorreo"],
                                    "perfil" => $_POST["editarPerfil"],
                                );

                                $tabla = "usuarios";
                                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                                //? SI TODO SALE BIEN MOSTRAMOS UN ALERT SUCCESS, SINO UNO DE ERROR
                                if ($respuesta == "SI") {
                                    echo '<script>
                                            Swal.fire({
                                                icon: "success",
                                                title: "¡El usuario ha sido editado correctamente!",
                                                showConfirmButton: true,
                                                confirmButtonText: "Cerrar",
                                                closeOnConfirm: false,
                                                allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                                allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                            }).then((result)=>{
                                                if(result.value){
                                                    window.location = "usuarios";
                                                }     
                                            });
                                        </script>';
                                }
                            } else {
                                echo '<script>
                                    Swal.fire({
                                        icon: "error",                                        
                                        title: "¡El correo no puede ir vacío, llevar caracteres especiales o el formato es incorrecto!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                        allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                        allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "usuarios";
                                        }     
                                    });
                                </script>';
                            }
                        } else {
                            echo '<script>
                                    Swal.fire({
                                        icon: "error",                                        
                                        title: "¡La contraseña no puede llevar caracteres especiales!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                        allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                        allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "usuarios";
                                        }     
                                    });
                                </script>';
                        }
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "error",                                    
                                    title: "¡El usuario no puede ir vacía o llevar caracteres especiales!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                    allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                    allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "usuarios";
                                    }     
                                });
                            </script>';
                    }
                } else {
                    echo '<script>
                            Swal.fire({
                                icon: "error",                                        
                                title: "¡El nombre no puede ir vacío ni llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                                allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                                allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
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


    //? SE UTILIZA PARA ELIMINAR LOS USUARIOS
    public function ctrBorrarUsuario()
    {

        if (isset($_GET["idUsuario"])) {
            if ($_GET["imagenUsuario"] && $_GET["imagenUsuario"] != "vistas/img/usuarios/default/anonymous.png") {
                //? BORRAMOS LA FOTO
                unlink($_GET["imagenUsuario"]);
                //? PARA BORRAR EL DIRECTORIO NECESITAMOS EL NOMBRE DE USUARIO (CARPETA)
                rmdir("vistas/img/usuarios/" . $_GET["usuario"]);
            } else if ($_GET["imagenUsuario"] == "") {
                rmdir("vistas/img/usuarios/" . $_GET["usuario"]);
            }

            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "SI") {
                // echo '<script>
                //         Swal.fire({
                //             icon: "success",                
                //             type: "success",
                //             title: "El usuario ha sido borrado correctamente",
                //             showConfirmButton: true,
                //             confirmButtonText: "Cerrar",
                //             closeOnConfirm: false,
                //             showCloseButton: false,    // Muestra la "X" para cerrar en la esquina superior derecha
                //             allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                //             allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                //         }).then((result)=>{
                //             if(result.value){
                //                 window.location = "usuarios";
                //             }     
                //         });
                //     </script>';
                echo '<script>window.location = "usuarios"</script>';
            }
        }
    }

    //? Para eliminar todos los datos de la tabla usuarios
    public function ctrBorrarTodosUsuarios()
    {

        //? Eliminamos todas las carpetas menos copia y default
        $this->ctrEliminarCarpetas();

        $respuesta = ModeloUsuarios::mdlBorrarTodosUsuarios();

        return $respuesta;
    }

    private function ctrEliminarCarpetas()
    {

        $tabla = "usuarios";
        $campo = null;
        $valor = null;

        $usuarios = ModeloUsuarios::mdlMostrarUsuarios($tabla, $campo, $valor);

        foreach ($usuarios as $clave => $valor) {

            if ($valor["imagen"] && $valor["imagen"] != "vistas/img/usuarios/default/anonymous.png") {
                //? BORRAMOS LA FOTO
                unlink($valor["imagen"]);
                //? PARA BORRAR EL DIRECTORIO NECESITAMOS EL NOMBRE DE USUARIO (CARPETA)
                rmdir("vistas/img/usuarios/" . $valor["usuario"]);
            } else if ($valor["imagen"] == "") {
                rmdir("vistas/img/usuarios/" . $valor["usuario"]);
            }
        }
    }
}
