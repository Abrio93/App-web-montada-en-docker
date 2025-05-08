<tbody>
          <?php

            $campo = null;
            $valor = null;

            $mostrarProductos = new ControladorProductos();
            $productos = $mostrarProductos->ctrMostrarProductos($campo, $valor);
            //var_dump($productos);
            foreach($productos as $clave => $valor){
          ?>
            <tr>
              <td><?php echo $clave+1; ?></td>
              <td><?php echo $valor["id"]; ?></td>
              <td>
                <img src="vistas/img/usuarios/default/anonymous.png" alt="anonimo" class="img-thumbnail" width="35px" /></td>
              <td><?php echo $valor["codigo"]; ?></td>
              <td><?php echo $valor["descripcion"]; ?></td>
              <?php

              $campo = "id";
              $datos = $valor["id_categoria"];

              $mostrarCategoria = new ControladorCategorias();
              $categoria = $mostrarCategoria->ctrMostrarCategorias($campo, $datos);

              ?>
              <td><?php echo $categoria["categoria"]; ?></td>
              <td><?php echo $valor["stock"]; ?></td>
              <td><?php echo $valor["precio_compra"]; ?>€</td>
              <td><?php echo $valor["precio_venta"]; ?>€</td>
              <td><?php echo $valor["fecha"]; ?></td>
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
            <?php
            }
            ?>
          </tbody>