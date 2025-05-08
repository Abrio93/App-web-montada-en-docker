<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nueva Venta
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Nueva Venta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- FORMULARIO ALTA VENTA (PARTE IZQUIERDA)-->
        <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box-header width-border"></div>
            <form metohd="post" role="form" class="formularioVenta">
              <div class="box-body">
                <div class="box">
                  <!-- ENTRADA DEL VENDEDOR -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                    </div>
                  </div>
                  <!-- ENTRADA DE LA VENTA -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <?php
                        $campo = null;
                        $valor = null;

                        $mostrarVentas =  new ControladorVentas();
                        $ventas = $mostrarVentas->ctrMostrarVentas($campo, $valor);

                        if(!$ventas){
                          echo '<input type="text" class="form-control" name="nuevaVenta" value="10001" readonly>';
                        }else{
                          foreach($ventas as $clave => $valor){
                            // Lo recorremos hasta el final para coger el ultimo codigo insertado en la bd
                          }
                          $codigo = $valor["codigo"] + 1;
                          echo '<input type="text" class="form-control" name="nuevaVenta" value="'.$codigo.'" readonly>';
                        }
                      ?>
                    </div>
                  </div>
                  <!-- ENTRADA DEL CLIENTE -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control" name="seleccionarCliente" required>
                        <option value="">Seleccionar cliente</option>
                        <?php
                          $campo = null;
                          $valor = null;

                          $mostrarClientes = new ControladorClientes();
                          $clientes = $mostrarClientes->ctrMostrarClientes($campo, $valor);

                          foreach($clientes as $clave => $valor){
                            echo '<option value="'.$valor["id"].'">'.$valor["nombre"].'</option>';
                          }
                        ?>
                      </select>
                      <span class="input-group-addon"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Añadir cliente</button></span>
                    </div>
                  </div>
                  <!-- ENTRADA DEL PRODUCTO EN LA VENTA -->
                  <div class="form-group row nuevoProducto">
                    
                  </div>
                  <!-- BOTON PARA AÑADIR PRODUCTO -->
                  <button type="button" class="btn btn-default hidden-lg">Añadir producto</button>
                  <hr>
                  <div class="row">
                    <!-- ENTRADA DE IMPUESTOS Y TOTAL -->
                    <div class="col-xs-8 pull-right">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>IVA</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width: 50%;">
                              <div class="input-group">
                                <input type="number" class="form-control" min="0" name="nuevoImpuestoVenta" placeholder="21%" required>
                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>
                            <td style="width: 50%;">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-euro"></i></span>
                                <input type="number" min="1" class="form-control" name="nuevoTotalVenta" placeholder="00000" readonly required>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <!-- ENTRADA METODO DE PAGO -->
                  <div class="form-group row">
                    <div class="col-xs-6" style="padding-right: 0px;">
                      <div class="input-group">
                        <select class="form-control" name="nuevoMetodoPago" required>
                          <option value="">Seleccione el método de pago</option>
                          <option value="efectivo">Efectivo</option>
                          <option value="trajetaCredito">Tarjeta de Crédito</option>
                          <option value="tarjetaDebito">Tarjeta de Débito</option>
                          <option value="transferenciaBancaria">Transferencia Bancaria</option>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                      </div>
                    </div>
                    <div class="col-xs-6" style="padding-left: 0px;">
                      <div class="input-group">
                        <input type="text" class="form-control" name="nuevoCodigoTransaccion" placeholder="Código de transacción" required>
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Venta</button>
              </div>
            </form>
          </div>
        </div>

        <!-- LA TABLA DE PRODUCTOS (LA PARTE DERECHA)-->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header width-border"></div>
            <div class="box-body">
              <table class="table table-bordered table-striped dt-responsive tablaVentas">
                <thead>
                  <tr>
                    <th style="width: 10px;">Nº</th>
                    <th style="width: 10px;">Id</th>
                    <th>Imagen</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <!-- <tbody>
                  <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>
                      <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="35px">
                    </td>
                    <td>12345</td>
                    <td>Lorem ipsum dolor</td>
                    <td>20</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Añadir</button>
                      </div>
                    </td>
                  </tr>
                </tbody> -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!--===================================
=    VENTANA MODAL AGREGAR CLIENTE    =
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