<div class="container-fluid">
  <div class="row">

  <!-- Parte izquierda -->
    <div class="col-md-2 text-center d-flex justify-content-center">
      <div class="row">
        <div class="col-12 mt-5" style="margin-left: 15%;">
          <div class="card fondo-feed" style="width: 20rem;">
            <div class=" pt-3">
              <img src="https://webevolmind.b-cdn.net/wp-content/uploads/2019/07/%C2%BFPor-que-es-util-la-imagen-como-recurso-educativo.webp" class="card-img-top img-redonda " alt="...">
            </div>
            <div class="card-body text-center">
              <h5 class="card-title">Perfil</h5>
              <p class="card-text">Aquí un poco de info tuya</p>
              <a href="#" class="btn btn-primary">Ver perfil</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Parte central/derecha -->
    <div class="col-md-10">
      <?php
      //? LLAMAMOS A LAS PUBLICACIONES
      $publicaciones = new ControladorPublicaciones();
      $publicaciones = $publicaciones->ctrMostrarPublicaciones();

      foreach ($publicaciones as $clave => $valor) {
        $fotos = new ControladorFotos();
        //? PASAMOS EL ID DE LA PUBLICACION PARA QUE NOS TRAIGA LAS FOTOS DE ESA PUBLICACION
        $fotos = $fotos->ctrMostrarFotos($valor["id"]);

      ?>
        <div class="row">
          <div class="col-1"></div>
          <div class="col-md-10 my-5 text-center">
            <div class="card fondo-feed">
              <div class="d-flex justify-content-center pt-3">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/af/33/14/el-mejor-bar-playero.jpg?w=900&h=500&s=1" class="card-img-top img-feed img-fluid px-2" alt="...">
              </div>
              <div class="card-body text-start">
                <div class="row mb-2">
                  <div class="col-12">
                    <?php echo $valor["texto"]; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <img src="vistas/img/plantilla/heart.svg" width="25px" class="me-3 cursor" title="Me gusta">
                    <img src="vistas/img/plantilla/chat.svg" width="25px" class="me-3 cursor" title="Comentar">
                    <img src="vistas/img/plantilla/send.svg" width="25px" class="cursor" title="Compartir">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1"></div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>