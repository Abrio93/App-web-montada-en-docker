<header class="main-header">
    <!-- Logo -->
    <a href="inicio" class="logo">
        <!-- logo mini -->
        <span class="logo-mini">
            <img src="vistas/img/plantillas/logo-mini.png" alt="" class="img-responsive" />
        </span>
        <!-- logo maxi -->
        <span class="logo-lg">
            <img src="vistas/img/plantillas/logo.png" alt="" class="img-responsive" style="padding: 3px;" /> 
        </span>
    </a>
    <!-- BARRA DE NAVEGACION -->
    <nav class="navbar navbar-static-top">
        <!-- BOTON NAVEGACION -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <!-- PERFIL DE USUARIO -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php

                    if($_SESSION["foto"] != ""){
                        echo '<img src="'.$_SESSION["foto"].'" class="user-image img-responsive" alt="Imagen de usuario" />';
                    }else{
                        echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image img-responsive" alt="Imagen de usuario" />';
                    }
                    ?>
                        <span class="hidden-xs"><?php echo $_SESSION["usuario"]; ?></span>
                    </a>
                    <!-- SALIR -->
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="salir" class="btn btn-default btn-flat" style="background-color: #D73925; color: white;">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>