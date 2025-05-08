<?php

require_once("../controladores/usuarios.controlador.php");
require_once("../modelos/usuarios.modelo.php");

class AjaxUsuarios{

    //? PROPIEDADES DE LA CLASE
    public $idUsuario;
    public $activarUsuario;
    public $activarId;
    public $validarUsuario;

    public function ajaxEditarUsuario(){
        $campo = "id";
        $valor = $this->idUsuario;

        $editarUsuario = new ControladorUsuarios();
        $respuesta = $editarUsuario -> ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }

    //? ACTIVAR/DESACTIVAR ESTADO DE UN USUARIO
    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

        $campo1 = "estado";
        $valor1 = $this->activarUsuario;

        $campo2 = "id";
        $valor2 = $this->activarId;

        echo $respuesta = ModeloUsuarios::mdlActualizarCampoUsuario($tabla, $campo1, $valor1, $campo2, $valor2);
        
    }

    //? PARA COMPROBAR CUANDO AGREGAMOS UN USUARIO NUEVO QUE EL NOMBRE NO EXISTE
    public function ajaxValidarUsuario(){
        $campo = "usuario";
        $valor = $this->validarUsuario;

        $usuarioValido = new ControladorUsuarios();
        $respuesta = $usuarioValido -> ctrMostrarUsuarios($campo, $valor);

        echo json_encode($respuesta);
    }

}

//? OBJETO PARA EDITAR USUARIO
if(isset($_POST["idUsuario"])){
    $editar=new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}

//? OBJETO PARA ACTIVAR USUARIO
if(isset($_POST["activarUsuario"])){
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}

//?VALIDAR NO REPETIR USUARIO
if(isset($_POST["validarUsuario"])){
    $validarUsuario = new AjaxUsuarios();
    $validarUsuario->validarUsuario = $_POST["validarUsuario"];
    $validarUsuario->ajaxValidarUsuario();
}
?>