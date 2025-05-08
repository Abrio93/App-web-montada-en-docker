<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventario 1.0</title>
    <!-- VALORES DEL CONTENT PARA HACERLO RESPONSIVE -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="vistas/img/plantillas/logo-mini.png">
    <!--=============================
    =        PLUGINS DE CSS         =
    ==============================-->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. -->
    <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

    <!--=============================
    =     PLUGINS DE JAVASCRIPT     =
    ==============================-->
    <!-- jQuery 3 -->
    <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="vistas/dist/js/adminlte.min.js"></script>
    <!-- DataTables -->
    <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="vistas/plugins/iCheck/icheck.min.js"></script>

</head>
    <!--=============================
    =      CUERPO DEL DOCUMENTO     =
    ==============================-->
    <body class="hold-transition skin-blue sidebar-mini login-page">
        <?php
            if(isset($_SESSION["sesion_iniciada"]) && $_SESSION["sesion_iniciada"] == "SI"){
                //? abro el div del WRAPPER
                echo "<div class='wrapper'>"; 

                //? CABECERA
                include('modulos/cabecera.php');

                //? MENU
                include('modulos/menu.php');

                //? CONTENIDO DEL WRAPPER
                if(isset($_GET['ruta'])){
                    if( $_GET['ruta'] == 'inicio' ||
                        $_GET['ruta'] == 'usuarios' ||
                        $_GET['ruta'] == 'categorias' ||
                        $_GET['ruta'] == 'productos' ||
                        $_GET['ruta'] == 'clientes' ||
                        $_GET['ruta'] == 'nueva-venta' ||
                        $_GET['ruta'] == 'ventas' ||
                        $_GET['ruta'] == 'informes' ||
                        $_GET['ruta'] == 'salir'){
                        include('modulos/'.$_GET['ruta'].'.php');
                    }else{
                        include('modulos/error404.php');
                    }
                }else{
                    include('modulos/inicio.php');
                }
                
                //? FOOTER
                include('modulos/footer.php');

                //? cierro el div del WRAPPER
                echo "</div>";
            }else{
                include('modulos/login.php');
            }
        ?>
    <!-- ./wrapper -->
    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/categorias.js"></script>
    <script src="vistas/js/clientes.js"></script>
    <script src="vistas/js/productos.js"></script>
    <script src="vistas/js/ventas.js"></script>
    </body>
</html>
