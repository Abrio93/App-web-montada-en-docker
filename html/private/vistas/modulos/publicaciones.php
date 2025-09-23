<div class="container-fluid">
  <div class="card mb-4 mt-5 sortable-chosen" draggable="true">
    <div class="card-body">
      <table class="table table-bordered table-striped dt-responsive mt-3 tablas">
        <thead>
          <tr>
            <th class="text-center" style="width: 1%;">Nº</th>
            <th class="text-center" style="width: 1%;">Id</th>
            <th class="text-center">Usuario</th>
            <th class="text-center">Texto</th>
            <th class="text-center">Privacidad</th>
            <th class="text-center">Me gusta</th>
            <th class="text-center">Comentarios</th>
            <th class="text-center">Fecha creación</th>
            <th class="text-center">Fecha edición</th>
            <th class="text-center">Fecha eliminación</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $objetoPublicaciones = new ControladorPublicaciones();
          $publicaciones = $objetoPublicaciones->ctrMostrarPublicaciones();

          foreach ($publicaciones as $clave => $valor) {
          ?>
            <tr class="text-center">
              <td class="text-center align-middle pt-3"><?php echo $clave + 1 ?></td>
              <td class="text-center align-middle pt-3"><?php echo $valor["id"] ?></td>
              <td class="text-center align-middle pt-3"><?php echo ControladorUsuarios::ctrBuscarUsuarioPorId($valor["usuario_id"]); ?></td>
              <td class="text-center align-middle pt-3"><?php echo $valor["texto"]; ?></td>
              <td class="text-center align-middle pt-3"><?php echo $valor["privacidad"]; ?></td>
              <td class="text-center align-middle pt-3"><?php echo $valor["numero_megusta"]; ?></td>
              <td class="text-center align-middle pt-3"><?php echo $valor["numero_comentarios"]; ?></td>
              <td class="text-center align-middle pt-3"><?php echo $objetoPublicaciones->ctrFormatearFecha($valor["creado_en"]); ?></td>
              <td class="text-center align-middle pt-3"><?php echo $objetoPublicaciones->ctrFormatearFecha($valor["actualizado_en"]); ?></td>
              <td class="text-center align-middle pt-3"><?php echo $objetoPublicaciones->ctrFormatearFecha($valor["borrado_en"]); ?></td>
              <td>
                <div class="text-center align-middle btn-group">
                  <button type="button" class="text-center align-middle mt-1 btn btn-primary btnVerUsuario" title="Ver" idUsuario="<?php echo $valor["id"]; ?>" data-bs-toggle="modal" data-bs-target="#modalVerUsuario">
                    <i class="text-center align-middle bi bi-eye-fill"></i>
                  </button>
                  <button class="text-center align-middle mt-1 btn btn-danger btnEliminarUsuario" title="Eliminar" idUsuario="<?php echo $valor["id"]; ?>" imagenUsuario="<?php echo $valor["id"]; ?>" usuario="<?php echo $valor["usuario_id"]; ?>">
                    <i class="text-center align-middle bi bi-trash-fill"></i>
                  </button>
                </div>
              </td>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--===============================
=    VENTANA MODAL VER USUARIO    =
================================-->

<!-- Modal -->
<div class="modal fade" id="modalVerUsuario" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h4 class="modal-title">Ver Usuario</h4>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="box-body">
          <!-- Imagen -->
          <img width="45%" class="previsualizarVer img-fluid rounded-circle d-block mx-auto" src="" alt="">
          <!-- CAMPO VER NOMBRE -->
          <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-person"></i> </span>
            <div class="info-box-content">
              <span class="info-box-text">Nombre</span>
              <span id="verNombreUsuario" class="info-box-number"></span>
            </div> <!-- /.info-box-content -->
          </div>
          <!-- CAMPO VER USUARIO -->
          <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-person-fill"></i> </span>
            <div class="info-box-content">
              <span class="info-box-text">Usuario</span>
              <span id="verUsuarioUsuario" class="info-box-number"></span>
            </div> <!-- /.info-box-content -->
          </div>
          <!-- CAMPO VER CORREO -->
          <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-envelope-at-fill"></i> </span>
            <div class="info-box-content">
              <span class="info-box-text">Correo</span>
              <span id="verCorreoUsuario" class="info-box-number"></span>
            </div> <!-- /.info-box-content -->
          </div>
          <!-- CAMPO VER PERFIL -->
          <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-menu-button-wide-fill"></i> </span>
            <div class="info-box-content">
              <span class="info-box-text">Perfil</span>
              <span id="verPerfilUsuario" class="info-box-number"></span>
            </div> <!-- /.info-box-content -->
          </div>
          <!-- CAMPO VER BANEADO -->
          <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-arrow-left-right"></i> </span>
            <div class="info-box-content">
              <span class="info-box-text">Estado</span>
              <span id="verBaneadoUsuario" data-value="" class="info-box-number">
                <button id="botonVerEstado" class="btn btn-xs btnVerActivar" estadoUsuario="" idUsuario=""></button>
              </span>
            </div> <!-- /.info-box-content -->
          </div>
        </div>
      </div>
      <!-- FOOTER DEL MODAL -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--===================================
=    VENTANA MODAL AGREGAR USUARIO    =
====================================-->

<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header bg-primary text-light">
          <h4 class="modal-title">Añadir Usuario</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- CAMPO NUEVO NOMBRE -->
            <div class="input-group flex-nowrap mt-2 mb-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-person"></i>
              </span>
              <input type="text" class="form-control" name="nuevoNombre" placeholder="Introduzca el nombre" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- CAMPO NUEVO USUARIO -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-person-fill"></i>
              </span>
              <input type="text" class="form-control" name="nuevoUsuario" id="nuevoUsuario" placeholder="Introduzca el usuario" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- CAMPO NUEVO PASSWORD -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-key-fill"></i>
              </span>
              <input type="text" class="form-control" name="nuevoPassword" placeholder="Introduzca la contraseña" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- CAMPO NUEVO CORREO -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-envelope-at-fill"></i>
              </span>
              <input type="text" class="form-control" name="nuevoCorreo" id="nuevoCorreo" placeholder="Introduzca el correo" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- TIPO DE PERFIL -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-menu-button-wide-fill"></i>
              </span>
              <select name="nuevoPerfil" class="form-select">
                <option value="">Seleccionar el perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
            <!-- SUBIR FOTO -->
            <div class="form-group my-4">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFotoAlta form-control" name="nuevaFotoAlta" />
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="thumbnail previsualizarAlta" width="100px" />
            </div>

          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>
        <input type="hidden" name="formularioAlta">
        <?php

        $crearusuario = new ControladorUsuarios();
        $crearusuario->ctrCrearUsuario();

        ?>
      </form>
      <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>

<!--==================================
=    VENTANA MODAL EDITAR USUARIO    =
===================================-->

<!-- Modal -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header bg-warning text-light">
          <h4 class="modal-title text-dark">Editar Usuario</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- CAMPO EDITAR NOMBRE -->
            <div class="input-group flex-nowrap mt-2 mb-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-person"></i>
              </span>
              <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Introduzca el nombre" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- CAMPO EDITAR USUARIO -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-person-fill"></i>
              </span>
              <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" placeholder="Introduzca el usuario" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- CAMPO EDITAR PASSWORD Y PASSWORD ACTUAL -->
            <input type="hidden" class="form-control" name="editarPasswordActual" id="editarPasswordActual" placeholder="Introduzca la contraseña" aria-label="Username" aria-describedby="addon-wrapping" required="">
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-key-fill"></i>
              </span>
              <input type="text" class="form-control" name="editarPassword" id="editarPassword" placeholder="Introduzca la contraseña" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <!-- CAMPO EDITAR CORREO -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-envelope-at-fill"></i>
              </span>
              <input type="text" class="form-control" name="editarCorreo" id="editarCorreo" placeholder="Introduzca el correo" aria-label="Username" aria-describedby="addon-wrapping" required="">
            </div>
            <!-- TIPO DE PERFIL -->
            <div class="input-group flex-nowrap my-4">
              <span class="input-group-text" id="addon-wrapping">
                <i class="bi bi-menu-button-wide-fill"></i>
              </span>
              <select name="editarPerfil" id="editarPerfil" class="form-select">
                <option value="">Seleccionar el perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Especial">Especial</option>
                <option value="Vendedor">Vendedor</option>
              </select>
            </div>
            <!-- SUBIR FOTO -->
            <div class="form-group my-4">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFotoEditar form-control" name="nuevaFotoEditar" />
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="" class="thumbnail previsualizarEditar" width="100px" />
              <input type="hidden" id="imagenActual" name="imagenActual">
            </div>

          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-warning">Editar usuario</button>
        </div>
        <input type="hidden" name="formularioEditar">
        <input type="hidden" id="idUsuarioEditar" name="idUsuarioEditar">
        <?php

        $crearusuario = new ControladorUsuarios();
        $crearusuario->ctrEditarUsuario();

        ?>
      </form>
      <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>
<?php

$crearusuario = new ControladorUsuarios();
$crearusuario->ctrBorrarUsuario();

?>