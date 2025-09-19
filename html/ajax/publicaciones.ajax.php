<?php

require_once("../controladores/usuarios.controlador.php");
require_once("../modelos/usuarios.modelo.php");

class AjaxPublicaciones
{

    //? PROPIEDADES DE LA CLASE
    public $idUsuario;
    public $activarUsuario;
    public $activarId;
    public $validarUsuario;
    public $validarCorreo;

    public function ajaxVerEditarUsuario()
    {

        $campo = "id";
        $valor = $this->idUsuario;

        $editarUsuario = new ControladorUsuarios();
        $respuesta = $editarUsuario->ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }

    //? ACTIVAR/DESACTIVAR ESTADO DE UN USUARIO
    public function ajaxActivarUsuario()
    {

        $tabla = "usuarios";

        $campo1 = "baneado";
        $valor1 = $this->activarUsuario;

        $campo2 = "id";
        $valor2 = $this->activarId;

        $actualizarCampo = new ControladorUsuarios();
        $respuesta = $actualizarCampo->ctrActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);

        echo json_encode($respuesta);
    }

    //? PARA COMPROBAR CUANDO AGREGAMOS UN USUARIO NUEVO QUE EL NOMBRE NO EXISTE
    public function ajaxValidarUsuario()
    {

        $campo = "usuario";
        $valor = $this->validarUsuario;

        $usuarioValido = new ControladorUsuarios();
        $respuesta = $usuarioValido->ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }

    //? PARA COMPROBAR CUANDO AGREGAMOS UN USUARIO NUEVO QUE EL CORREO NO EXISTE
    public function ajaxValidarCorreo()
    {

        $campo = "correo";
        $valor = $this->validarCorreo;

        $correoValido = new ControladorUsuarios();
        $respuesta = $correoValido->ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }

    //? PARA COMPROBAR CUANDO AGREGAMOS UN USUARIO NUEVO QUE EL CORREO NO EXISTE
    public function ajaxRellenarUsuarios()
    {

        $usuariosRellenar = new ControladorUsuarios();
        $respuesta = $usuariosRellenar->ctrRellenarUsuarios();

        echo json_encode($respuesta);
    }

    //? PARA COMPROBAR CUANDO AGREGAMOS UN USUARIO NUEVO QUE EL CORREO NO EXISTE
    public function ajaxBorrarTodosUsuarios()
    {

        $usuariosEliminar = new ControladorUsuarios();
        $respuesta = $usuariosEliminar->ctrBorrarTodosUsuarios();

        echo json_encode($respuesta);
    }
}

//? OBJETO PARA VER/EDITAR USUARIO
if (isset($_POST["idUsuario"])) {
    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxVerEditarUsuario();
}

//? OBJETO PARA ACTIVAR USUARIO
if (isset($_POST["activarUsuario"])) {
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}

//? OBJETO PARA VALIDAR NO REPETIR USUARIO
if (isset($_POST["validarUsuario"])) {
    $validarUsuario = new AjaxUsuarios();
    $validarUsuario->validarUsuario = $_POST["validarUsuario"];
    $validarUsuario->ajaxValidarUsuario();
}

//? OBJETO PARA VALIDAR NO REPETIR CORREO
if (isset($_POST["validarCorreo"])) {
    $validarCorreo = new AjaxUsuarios();
    $validarCorreo->validarCorreo = $_POST["validarCorreo"];
    $validarCorreo->ajaxValidarCorreo();
}

//? OBJETO PARA RELLENAR LA TABLA USUARIOS
if (isset($_POST["rellenarUsuarios"]) &&  $_POST["rellenarUsuarios"] == "rellenarUsuarios") {
    $rellenarUsuarios = new AjaxUsuarios();
    $rellenarUsuarios->ajaxRellenarUsuarios();
}

//? OBJETO PARA RELLENAR LA TABLA USUARIOS
if (isset($_POST["eliminarUsuarios"]) &&  $_POST["eliminarUsuarios"] == "eliminarUsuarios") {
    $eliminarUsuarios = new AjaxUsuarios();
    $eliminarUsuarios->ajaxBorrarTodosUsuarios();
}
