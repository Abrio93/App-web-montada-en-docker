<div class="container-fluid">
  <div class="row">

    <!-- Parte izquierda -->
    <div class="col-md-2 text-center d-flex justify-content-center">
      <div class="row border border-5">
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
        <div class="col-12 mt-5" style="margin-left: 15%;">
        <a href="#" class="btn btn-primary">Nueva publicación</a>
        </div>
      </div>
    </div>

    <!-- Parte central/derecha -->
    <div class="col-md-10">
      <?php
      //? LLAMAMOS A LAS PUBLICACIONES
      $objetoPublicaciones = new ControladorPublicaciones();
      $publicaciones = $objetoPublicaciones->ctrMostrarPublicaciones();

      foreach ($publicaciones as $clavePublicacion => $valorPublicacion) {
          $objetoFotos = new ControladorFotos();
          //? LLAMAMOS A LAS FOTOS DE CADA PUBLICACION
          $fotos = $objetoFotos->ctrSacarFotosPorPublicacion($valorPublicacion["id"]);
          $cantidadFotos = count($fotos);
      ?>
          <div class="row">
              <div class="col-1"></div>
              <div class="col-md-10 my-5 text-center">
                  <div class="card fondo-feed">
                      <div class="row p-3 g-1 my-3"> 
                          <?php 
                          // Solo procedemos si hay fotos
                          if ($cantidadFotos > 0) {
                              $primeraFoto = $fotos[0];
                              $rutaPrimeraFoto = "dist/imagenes/" . $primeraFoto["ruta"];
                              
                              // Determinar las clases de columna.
                              // Si hay solo 1 foto, solo queremos una columna (col-12 o col-6 y centrar)
                              // Si hay más de 1, usaremos col-6 para la foto principal y col-6 para las demás.
                              $claseColumnaPrincipal = ($cantidadFotos > 1) ? 'col-6' : 'col-12';
                          ?>
                              
                              <div class="<?php echo $claseColumnaPrincipal; ?>">
                                  <img 
                                      src="<?php echo $rutaPrimeraFoto; ?>" 
                                      class="img-fluid object-fit-cover rounded" 
                                      alt="Foto Principal"
                                      style="min-height: 250px; max-height: 400px;" 
                                  >
                              </div>
                              
                              <?php if ($cantidadFotos > 1) { ?>
                                  <div class="col-6">
                                      <div class="row g-1"> <?php
                                          // Iteramos sobre las fotos a partir de la segunda (índice 1)
                                          for ($i = 1; $i < $cantidadFotos; $i++) {
                                              $valorFoto = $fotos[$i];
                                              $rutaFoto = "dist/imagenes/" . $valorFoto["ruta"];
                                              
                                              // Aquí usamos col-12 para que las miniaturas se apilen verticalmente
                                              // dentro de esta columna col-6
                                          ?>
                                              <div class="col-4 mb-1">
                                                  <img 
                                                      src="<?php echo $rutaFoto; ?>" 
                                                      class="img-fluid object-fit-cover w-100 rounded" 
                                                      alt="Foto Miniatura"
                                                      style="height: 120px;" 
                                                  >
                                              </div>
                                          <?php
                                          }
                                          ?>
                                      </div>
                                  </div>
                              <?php } // Fin de if ($cantidadFotos > 1) ?>
                          <?php } // Fin de if ($cantidadFotos > 0) ?>
      
                      </div>
                      
                      <div class="card-body text-start">
                          <div class="row mb-2">
                              <div class="col-12">
                                  <?php echo $valorPublicacion["texto"]; ?>
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