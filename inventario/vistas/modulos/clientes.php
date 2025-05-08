<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Clientes
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Clientes</li>
      </ol>
    </section>

  <!-- Main content -->
  <section class="content">

    <!-- BOTON DE ALTA CLIENTE -->
    <div class="box">
      <div class="box-header with-border">
        <button type="button" class="btn btn-primary" id="anadirNuevoUsuario" data-toggle="modal" data-target="#modalAgregarCliente">
          Añadir cliente
        </button>
      </div>

      <!-- TABLA CON LOS CLIENTES -->
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width: 1%;">Nº</th>
              <th style="width: 1%;">Id</th>
              <th>Nombre</th>
              <th>Documento</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Fecha de nacimiento(año-mes-Día)</th>
              <th>Compras</th>
              <th>Fecha(año-mes-día)</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php

              $campo = null;
              $valor = null;

              $mostrarClientes = new ControladorClientes();
              $clientes = $mostrarClientes->ctrMostrarClientes($campo, $valor);

              foreach ($clientes as $clave => $valor) {
                ?>
                  <tr>
                    <td><?php echo $clave+1 ?></td>
                    <td><?php echo $valor["id"] ?></td>
                    <td><?php echo $valor["nombre"] ?></td>
                    <td><?php echo $valor["documento"] ?></td>
                    <td><?php echo $valor["email"] ?></td>
                    <td><?php echo $valor["telefono"] ?></td>
                    <td><?php echo $valor["direccion"] ?></td>
                    <td><?php echo $valor["fecha_nacimiento"] ?></td>
                    <td><?php echo $valor["compras"] ?></td>
                    <td><?php echo $valor["fecha"] ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarCliente" idCliente="<?php echo $valor["id"]; ?>" data-toggle="modal" data-target="#modalEditarCliente">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn btn-danger btnEliminarCliente" idCliente="<?php echo $valor["id"]; ?>">
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
<div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
    <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir Cliente</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- CAMPO NUEVO NOMBRE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder="Introduzca el nombre" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO DOCUMENTO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-file"></i>
                </span>
                <input type="text" class="form-control input-lg" maxlength="12" id="nuevoDni" name="nuevoDni" placeholder="DNI ejemplo: 23.455.677-Z" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO EMAIL (ES UNICO EN LA BASE DE DATOS) -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-at"></i>
                </span>
                <input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" placeholder="Email ejemplo: hola@hola.com" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO TELEFONO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </span>
                <input type="text" class="form-control input-lg" maxlength="12" id="nuevoTelefono" name="nuevoTelefono" placeholder="Introduzca el teléfono" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO DIRECCION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-home"></i>
                </span>
                <input type="text" class="form-control input-lg" id="nuevoDireccion" name="nuevoDireccion" placeholder="Introduzca la dirección" required="">
              </div>
            </div>
            <!-- CAMPO NUEVO FECHA DE NACIMIENTO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                <input type="date" class="form-control input-lg" id="nuevoNacimiento" name="nuevoNacimiento" placeholder="Introduzca la fecha de nacimiento" required="">
              </div>
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cliente</button>
        </div>
        <?php

          $crearCliente = new ControladorClientes();
          $crearCliente->ctrCrearCliente();

        ?>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>

<!--===================================
=    VENTANA MODAL EDITAR CLIENTE    =
====================================-->

<!-- Modal -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
    <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Cliente</h4>
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
                <input type="hidden" name="editaridCliente" id="editaridCliente">
              </div>
            </div>
            <!-- CAMPO EDITAR DOCUMENTO(DNI) -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-file"></i>
                </span>
                <input type="text" class="form-control input-lg" maxlength="12" id="editarDocumento" name="editarDocumento" value="" required="">
              </div>
            </div>
            <!-- CAMPO EDITAR EMAIL -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-at"></i>
                </span>
                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" placeholder="" readonly>
              </div>
            </div>
            <!-- CAMPO EDITAR TELEFONO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </span>
                <input type="text" class="form-control input-lg" maxlength="12" id="editarTelefono" name="editarTelefono" placeholder="" required="">
              </div>
            </div>
            <!-- CAMPO EDITAR DIRECCION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-home"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" placeholder="" required="">
              </div>
            </div>
            <!-- CAMPO EDITAR FECHA DE NACIMIENTO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                <input type="date" class="form-control input-lg" id="editarNacimiento" name="editarNacimiento" placeholder="" required="">
              </div>
            </div>

          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar cliente</button>
        </div>
        <?php
          $editarCliente = new ControladorClientes();
          $editarCliente->ctrEditarCliente();
        ?>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>
<?php

//? PARA ELIMINAR USUARIOS
$borrarCliente = new ControladorClientes();
$borrarCliente -> ctrBorrarCliente();

?>