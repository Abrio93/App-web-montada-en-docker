<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Usuarios
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Administrar Usuarios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- BOTON DE ALTA USUARIO -->
    <div class="box">
      <div class="box-header with-border">
        <button type="button" class="btn btn-primary" id="anadirNuevoUsuario" data-toggle="modal" data-target="#modalAgregarUsuario">
          Añadir usuario
        </button>
      </div>

      <!-- TABLA CON LOS USUARIOS -->
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width: 1%;">Nº</th>
              <th style="width: 1%;">Id</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último acceso(año-mes-Día)</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php

              $campo = null;
              $valor = null;

              $mostrarUsuarios = new ControladorUsuarios();
              $usuarios = $mostrarUsuarios->ctrMostrarUsuarios($campo, $valor);

              foreach ($usuarios as $clave => $valor) {
                ?>
                  <tr>
                    <td><?php echo $clave+1 ?></td>
                    <td><?php echo $valor["id"] ?></td>
                    <td><?php echo $valor["nombre"] ?></td>
                    <td><?php echo $valor["usuario"] ?></td>
                    <td>
                      <?php
                        if($valor["foto"] != ""){
                      ?>
                          <img src="<?php echo $valor["foto"]; ?>" alt="foto perfil" class="img-thumbnail" width="35px" /></td>
                      <?php
                        }else{
                      ?>
                          <img src="vistas/img/usuarios/default/anonymous.png" alt="anonimo" class="img-thumbnail" width="35px" /></td>
                      <?php
                        }
                      ?>
                    <td><?php echo $valor["perfil"] ?></td>
                    <?php if($valor["estado"] != 0){ ?>
                            <td><button class="btn btn-success btn-xs btnActivar" estadoUsuario="0" idUsuario="<?php echo $valor["id"] ?>">Activado</button></td>
                    <?php }else{ ?>
                            <td><button class="btn btn-danger btn-xs btnActivar" estadoUsuario="1" idUsuario="<?php echo $valor["id"] ?>">Desactivado</button></td>
                    <?php } ?>
                    <td><?php echo $valor["ultimo_login"] ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarUsuario" idUsuario="<?php echo $valor["id"]; ?>" data-toggle="modal" data-target="#modalEditarUsuario">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn btn-danger btnEliminarUsuario" idUsuario="<?php echo $valor["id"]; ?>" fotoUsuario="<?php echo $valor["foto"]; ?>" usuario="<?php echo $valor["usuario"]; ?>">
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

<!--===================================
=    VENTANA MODAL AGREGAR USUARIO    =
====================================-->

<!-- Modal -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
    <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- CAMPO NUEVO NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Introduzca el nombre" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO USUARIO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Introduzca el usuario" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO PASSWORD -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoPassword" placeholder="Introduzca la contraseña" required="">
              </div>
            </div>
            <!-- TIPO DE PERFIL -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-users"></i>
                </span>
                <select name="nuevoPerfil" class="form-control input-lg">
                  <option value="">Seleccionar el perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- SUBIR FOTO -->
            <div class="form-group">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto" />
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="thumbnail previsualizar2" width="100px" />
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>
        <?php

          $crearusuario = new ControladorUsuarios();
          $crearusuario->ctrCrearUsuario();

        ?>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>

<!--===================================
=    VENTANA MODAL EDITAR USUARIO    =
====================================-->

<!-- Modal -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
    <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- CAMPO EDITAR NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required="">
              </div>
            </div>
            <!-- CAMPO EDITAR USUARIO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
              </div>
            </div>
            <!-- CAMPO EDITAR PASSWORD -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>
            <!-- EDITAR TIPO DE PERFIL -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-users"></i>
                </span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>  
              </div>
            </div>
            <!-- EDITAR FOTO -->
            <div class="form-group">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="thumbnail previsualizar" width="100px" />
              <input type="hidden" id="fotoActual" name="fotoActual">
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar usuario</button>
        </div>
        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario->ctrEditarUsuario();
        ?>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>
<?php

  //? PARA ELIMINAR USUARIOS
  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?>