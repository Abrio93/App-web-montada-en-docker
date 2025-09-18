<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image--> <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">SnapCircle</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item <?php echo ($_GET["ruta"] == "inicio")? "menu-open":""; ?>">
                    <a href="index.php?ruta=inicio" class="nav-link"> <i class="nav-icon bi bi-house"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($_GET["ruta"] == "usuarios")? "menu-open":""; ?>">
                    <a href="index.php?ruta=usuarios" class="nav-link"> <i class="nav-icon bi bi-person-vcard"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($_GET["ruta"] == "publicaciones")? "menu-open":""; ?>">
                    <a href="index.php?ruta=publicaciones" class="nav-link"> <i class="nav-icon bi bi-file-post"></i>
                        <p>Publicaciones</p>
                    </a>
                </li>
            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->