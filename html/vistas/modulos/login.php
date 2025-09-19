<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="login-logo"> <a href="../index2.html"><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Iniciar sesión</p>
        <form action="" method="post">
          <div class="input-group mb-3"> <input type="email" name="correo" class="form-control" placeholder="Correo electrónico">
            <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
          </div>
          <div class="input-group mb-3"> <input type="password" name="password" class="form-control" placeholder="Contraseña">
            <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
          </div> <!--begin::Row-->
          <div class="row">
            <div class="col-12 my-2">
              <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Iniciar Sesión</button> </div>
            </div> <!-- /.col -->
          </div> <!--end::Row-->
          <?php
          $objetoUsuarios = new ControladorUsuarios();
          $objetoUsuarios->ctrLogin();
          ?>
        </form>
        <center>
          <p class="my-2"> <a href="#">Olvidé mi contraseña</a> </p>
          <p class="my-2"> <a href="#">Registrarme</a> </p>
        </center>
      </div> <!-- /.login-card-body -->
    </div>
  </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="../../../dist/js/adminlte.js"></script> <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
      scrollbarTheme: "os-theme-light",
      scrollbarAutoHide: "leave",
      scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (
        sidebarWrapper &&
        typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script> <!--end::OverlayScrollbars Configure--> <!--end::Script-->

</body>

</html>