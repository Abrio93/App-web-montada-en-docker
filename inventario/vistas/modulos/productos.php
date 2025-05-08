<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Productos
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
      <li class="active">Administrar Productos</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- BOTON DE ALTA USUARIO -->
    <div class="box">
      <div class="box-header with-border">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
          Añadir producto
        </button>
      </div>

      <!-- TABLA CON LOS USUARIOS -->
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablaProductos">
          <thead>
            <tr>
              <th style="width: 10px;">Nº</th>
              <th style="width: 10px;">Id</th>
              <th style="width: 10px;">Imagen</th>
              <th style="width: 10px;">Código</th>
              <th>Nombre Producto</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de ventas</th>
              <th>Agregado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <!-- <tbody>
          <?php

            // $campo = null;
            // $valor = null;

            // $mostrarProductos = new ControladorProductos();
            // $productos = $mostrarProductos->ctrMostrarProductos($campo, $valor);
            //var_dump($productos);
            //foreach($productos as $clave => $valor){
          ?>
            <tr>
              <td><?php //echo $clave+1; ?></td>
              <td><?php //echo $valor["id"]; ?></td>
              <td>
                <img src="vistas/img/productos/default/anonymous.png" alt="anonimo" class="img-thumbnail" width="35px" /></td>
              <td><?php //echo $valor["codigo"]; ?></td>
              <td><?php //echo $valor["descripcion"]; ?></td>
              <?php

              // $campo = "id";
              // $datos = $valor["id_categoria"];

              // $mostrarCategoria = new ControladorCategorias();
              // $categoria = $mostrarCategoria->ctrMostrarCategorias($campo, $datos);

              ?>
              <td><?php //echo $categoria["categoria"]; ?></td>
              <td><?php //echo $valor["stock"]; ?></td>
              <td><?php //echo $valor["precio_compra"]; ?>€</td>
              <td><?php //echo $valor["precio_venta"]; ?>€</td>
              <td><?php //echo $valor["fecha"]; ?></td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning">
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-danger">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </td>
            </tr>
            <?php
            // }
            ?>
          </tbody> -->
        </table>
      </div>
    </div>
  </section>
</div>

    <!--===================================
    =    VENTANA MODAL AGREGAR USUARIO    =
    ====================================-->

<!-- Modal -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
    <form role="form" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir Productos</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- SELECCIONAR TIPO DE CATEGORIA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-th"></i>
                </span>
                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" required>
                  <option value="">Selecciona una categoría</option>
                  <?php
                    $campo = null;
                    $valor = null;

                    $mostrarCategorias = new ControladorCategorias();
                    $categorias = $mostrarCategorias->ctrMostrarCategorias($campo, $valor);

                    foreach($categorias as $clave => $valor){
                      echo '<option value="'.$valor["id"].'">'.$valor["categoria"].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <!-- CAMPO CODIGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-code"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoCodigo" id="nuevoCodigo" placeholder="Ingresar código" readonly>
              </div>
            </div>
            <!-- CAMPO DESCRIPCION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-product-hunt"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" id="nuevaDescripcion" placeholder="Ingresar descripción" required="">
              </div>
            </div>
            <!-- CAMPO STOCK -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-arrow-up"></i>
                </span>
                <input type="number" class="form-control input-lg" name="nuevoStock" id="nuevoStock" placeholder="Stock" min="0" required="">
              </div>
            </div>                        
            <!-- GRUPO DE CAMPO -->
            <div class="form-group row">
            <!-- CAMPO PRECIO COMPRA, VENTA Y PORCENTAJE -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-arrow-up"></i>
                  </span>
                  <?php
                    //!  El step="any" es para que en los campos number(en la BD tipo float) se puedan poner deimales ¡IMPORTANTE!
                  ?>
                  <input type="number" step="any" class="form-control input-lg" name="nuevoPrecioCompra" id="nuevoPrecioCompra" placeholder="Precio de compra" min="0" required="">
                </div>
              </div>
                <!-- CAMPO PRECIO VENTA, CHECKBOX DE PORCENTAJE Y PORCENTAJE -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-arrow-down"></i>
                  </span>
                  <?php
                    //!  El step="any" es para que en los campos number(en la BD tipo float) se puedan poner deimales ¡IMPORTANTE!
                  ?>
                  <input type="number" step="any" class="form-control input-lg" name="nuevoPrecioVenta" id="nuevoPrecioVenta" placeholder="Precio de venta" min="0" required="">
                </div>
                <br>
                <!-- CHECKBOX PARA PORCENTAJE -->
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="">
                      <input type="checkbox" class="minimal porcentaje_alta" cheked>Utilizar porcentaje
                    </label>
                  </div>
                </div>
                <!-- ENTRADA PARA PORCENTAJE -->
                <div class="col-xs-6" style="padding: 0;">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" VALUE="40" required="">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- TERMINA GRUPO DE CAMPOS -->                      
            <!-- SUBIR FOTO -->
            <div class="form-group">
              <div class="panel">Subir imagen</div>
              <input type="file" class="nuevaImagen" name="nuevaImagen" />
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px" />
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>
        <?php
          $crearProducto = new ControladorProductos();
          $crearProducto->ctrCrearProducto();
        ?> 
    <!-- TERMINA EL FORMULARIO -->
    </form>
  </div>
</div>
</div>

<!--====================================
=    VENTANA MODAL EDITAR PRODUCTO     =
=====================================-->

<!-- Modal -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
      <form role="form" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Producto</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- SELECCIONAR TIPO DE CATEGORIA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-th"></i>
                </span>
                <select class="form-control input-lg" name="editarCategoria" readonly required>
                  <option id="editarCategoria"></option>
                </select>
              </div>
            </div>
            <!-- CAMPO CODIGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-code"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" placeholder="Ingresar código" readonly required>
              </div>
            </div>
            <!-- CAMPO DESCRIPCION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-product-hunt"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
              </div>
            </div>
            <!-- CAMPO STOCK -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-arrow-up"></i>
                </span>
                <input type="number" class="form-control input-lg" name="editarStock" id="editarStock" min="0" required>
              </div>
            </div>                        
            <!-- GRUPO DE CAMPO -->
            <div class="form-group row">
            <!-- CAMPO PRECIO COMPRA, VENTA Y PORCENTAJE -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-arrow-up"></i>
                  </span>
                  <?php
                    //!  El step="any" es para que en los campos number(en la BD tipo float) se puedan poner deimales ¡IMPORTANTE!
                  ?>
                  <input type="number" step="any" class="form-control input-lg" name="editarPrecioCompra" id="editarPrecioCompra" min="0" required="">
                </div>
              </div>
                <!-- CAMPO PRECIO VENTA, CHECKBOX DE PORCENTAJE Y PORCENTAJE -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-arrow-down"></i>
                  </span>
                  <?php
                    //!  El step="any" es para que en los campos number(en la BD tipo float) se puedan poner deimales ¡IMPORTANTE!
                  ?>
                  <input type="number" step="any" class="form-control input-lg" name="editarPrecioVenta" id="editarPrecioVenta" min="0" required="" readonly>
                </div>
                <br>
                <!-- CHECKBOX PARA PORCENTAJE -->
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="">
                      <input type="checkbox" class="minimal porcentaje_editar" cheked>Utilizar porcentaje
                    </label>
                  </div>
                </div>
                <!-- ENTRADA PARA PORCENTAJE -->
                <div class="col-xs-6" style="padding: 0;">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" VALUE="40" required="">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- TERMINA GRUPO DE CAMPOS -->                      
            <!-- SUBIR FOTO -->
            <div class="form-group">
              <div class="panel">Editar imagen</div>
              <input type="file" class="nuevaImagen" name="editarImagen" />
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar_imagen_al_editar" width="100px" />
              <input type="hidden" name="imagenActual" id="imagenActual">
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        <?php
          $editarProducto = new ControladorProductos();
          $editarProducto->ctrEditarProducto();
        ?>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>
<?php

  //? PARA ELIMINAR USUARIOS
  $borrarpRODUCTO = new ControladorProductos();
  $borrarpRODUCTO -> ctrBorrarProducto();

?>