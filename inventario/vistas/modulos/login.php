<div class="login-box">
  <div class="login-logo">
    <center>
      <img src="vistas/img/plantillas/logo.png" alt="Logo" class="img-responsive" style="padding: 30px 100px 0px 100px;" />
    </center>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Accede al sistema</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
        </div>
        <!-- /.col -->
      </div>
      <?php
        $login = new ControladorUsuarios();
        $login->ctrIngresoUsuario();
      ?>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->