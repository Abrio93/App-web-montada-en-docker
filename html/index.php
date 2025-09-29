<?php
    require_once('controladores/plantilla.controlador.php');

    require_once('controladores/publicaciones.controlador.php');
    require_once('controladores/fotos.controlador.php');

    require_once('modelos/publicaciones.modelo.php');
    require_once('modelos/fotos.modelo.php');

    $plantilla = new ControladorPlantilla();

    $plantilla->ctrPlantilla();
?>