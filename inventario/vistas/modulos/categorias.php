<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Categorías
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Categorias</li>
      </ol>
    </section>

<!-- Main content -->
<section class="content">

<!-- BOTON DE ALTA CATEGORIA -->
<div class="box">
  <div class="box-header with-border">
    <button type="button" class="btn btn-primary" id="anadirNuevoUsuario" data-toggle="modal" data-target="#modalAgregarCategoria">
      Añadir categoría
    </button>
  </div>

  <!-- TABLA CON LAS CATEGORIAS -->
  <div class="box-body">
    <table class="table table-bordered table-striped dt-responsive tablas">
      <thead>
        <tr>
          <th style="width: 1%;">Nº</th>
          <th style="width: 1%;">Id</th>
          <th>Nombre</th>
          <th>Fecha(año-mes-día)</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          
          $campo = null;
          $valor = null;
          $mostrarCategorias = new ControladorCategorias();
          $categorias = $mostrarCategorias->ctrMostrarCategorias($campo, $valor);

          foreach ($categorias as $clave => $valor) {
            ?>
              <tr>
                <td style="width: 4%;"><?php echo $clave+1 ?></td>
                <td style="width: 4%;"><?php echo $valor["id"] ?></td>
                <td style="width: 41%;"><?php echo $valor["categoria"] ?></td>
                <td style="width: 41%;"><?php echo $valor["fecha"] ?></td>
                <td style="width: 10%;">
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarCategoria" idCategoria="<?php echo $valor["id"]; ?>" data-toggle="modal" data-target="#modalEditarCategoria">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <button class="btn btn-danger btnEliminarCategoria" idCategoria="<?php echo $valor["id"]; ?>">
                      <i class="fa fa-times"></i>
                    </button>
                  </div>
                </td>
              </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
</section>
</div>

<!--=====================================
=    VENTANA MODAL AGREGAR CATEGORIA    =
======================================-->

<!-- Modal -->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- VENTANA MODAL-->
<div class="modal-content">
  <!-- EMPIEZA EL FORMULARIO -->
<form role="form" method="POST" action="" enctype="multipart/form-data">
    <div class="modal-header" style="background: #3c8dbc; color: white;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Añadir Categoría</h4>
    </div>
    <div class="modal-body">
      <div class="box-body">
        <!-- CAMPO NUEVO NOMBRE -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-folder"></i>
            </span>
            <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Introduzca el nombre de la categoría" required="">
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER DEL MODAL -->
    <div class="modal-footer">        
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Guardar categoría</button>
    </div>
    <?php

      $crearCategoria = new ControladorCategorias();
      $crearCategoria->ctrCrearCategoria();

    ?>
</form>
<!-- TERMINA EL FORMULARIO -->
</div>
</div>
</div>

<!--====================================
=    VENTANA MODAL EDITAR CATEGORIA    =
=====================================-->

<!-- Modal -->
<div id="modalEditarCategoria" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- VENTANA MODAL-->
<div class="modal-content">
  <!-- EMPIEZA EL FORMULARIO -->
<form role="form" method="POST" action="" enctype="multipart/form-data">
    <div class="modal-header" style="background: #3c8dbc; color: white;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Editar Categoría</h4>
    </div>
    <div class="modal-body">
      <div class="box-body">
        <!-- CAMPO EDITAR NOMBRE -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-folder"></i>
            </span>
            <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required="">
            <input type="hidden" id="idCategoria" name="idCategoria">
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER DEL MODAL -->
    <div class="modal-footer">        
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Editar categoria</button>
    </div>
    <?php
      $editarCategoria = new ControladorCategorias();
      $editarCategoria->ctrEditarCategoria();
    ?>
</form>
<!-- TERMINA EL FORMULARIO -->
</div>
</div>
</div>
<?php

//? PARA ELIMINAR USUARIOS
$borrarCategoria = new ControladorCategorias();
$borrarCategoria -> ctrBorrarCategoria();

?>