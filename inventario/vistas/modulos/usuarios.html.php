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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Añadir usuario
        </button>
      </div>

      <!-- TABLA CON LOS USUARIOS -->
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último acceso</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Usuario Administrador</td>
              <td>admin</td>
              <td>
                <img src="vistas/img/usuarios/default/anonymous.png" alt="anonimo" class="img-thumbnail" width="35px" /></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>45646456</td>
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
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- VENTANA MODAL-->
    <div class="modal-content">
      <!-- EMPIEZA EL FORMULARIO -->
    <form role="form" method="post" action="" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- CAMPO USUARIO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Introduzca el nombre" required="">
              </div>
            </div>
            <!-- CAMPO PASSWORD -->
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
              <input type="file" id="nuevaFoto" name="nuevaFoto" />
              <p class="help-block">Peso máximo de la foto: 5Mb</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="thumbnail" width="100px" />
            </div>
          </div>
        </div>
        <!-- FOOTER DEL MODAL -->
        <div class="modal-footer">        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Guardar usuario</button>
        </div>
    </form>
    <!-- TERMINA EL FORMULARIO -->
    </div>
  </div>
</div>