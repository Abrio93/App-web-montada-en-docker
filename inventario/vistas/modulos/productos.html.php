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
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width: 10px;">Nº</th>
              <th style="width: 10px;">Id</th>
              <th>Imagen</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Categoría</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de ventas</th>
              <th>Agregado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>1</td>
              <td>
                <img src="vistas/img/usuarios/default/anonymous.png" alt="anonimo" class="img-thumbnail" width="35px" /></td>
              <td>0001</td>
              <td>Lorem ipsum dolor sit amet</td>
              <td>Lorem ipsum</td>
              <td>20</td>
              <td>35.00 €</td>
              <td>62.50 €</td>
              <td>2018-04-22</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning" >
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-danger" >
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </td>
            </tr>
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
            <!-- CAMPO CODIGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-code"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoCodigo" id="nuevoCodigo" placeholder="Ingresar código" required="">
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
            <!-- SELECCIONAR TIPO DE CATEGORIA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-th"></i>
                </span>
                <select name="nuevaCategoria" class="form-control input-lg">
                  <option value="" id="nuevaCategoria">Selecciona una categoría</option>
                  <option value="Taladros">Taladros</option>
                  <option value="Andamios">Andamios</option>
                  <option value="Pinturas">Pinturas</option>
                </select>
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
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-arrow-up"></i>
                  </span>
                  <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" id="nuevoPrecioCompra" placeholder="Precio de compra" min="0" required="">
                </div>
              </div>
                <!-- CAMPO PRECIO VENTA, CHECKBOX DE PORCENTAJE Y PORCENTAJE -->
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-arrow-down"></i>
                  </span>
                  <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" id="nuevoPrecioVenta" placeholder="Precio de venta" min="0" required="">
                </div>
                <br>
                <!-- CHECKBOX PARA PORCENTAJE -->
                <div class="col-xs-6">
                  <div class="form-group">
                    <label for="">
                      <input type="checkbox" class="minimal" cheked>Utilizar porcentaje
                    </label>
                  </div>
                </div>
                <!-- ENTRADA PARA PORCENTAJE -->
                <div class="col-xs-6" style="padding: 0;">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" min="0" VALUE="40" required="">
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <!-- TERMINA GRUPO DE CAMPOS -->                      
            <!-- SUBIR FOTO -->
            <div class="form-group">
              <div class="panel">Subir imagen</div>
              <input type="file" id="nuevaImagen" name="nuevaImagen" />
              <p class="help-block">Peso máximo de la foto: 2Mb</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="thumbnail" width="100px" />
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Guardar producto</button>
        </div>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>