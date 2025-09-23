
//?=================================================================================
//*=     SUBIENDO LA FOTO DE UN USUARIO Y PREVISUALIZAR LA MINIATURA AL ALTA       =
//?===============================================================================*/

//? El evento "change" es para cuando cambie de valor del input tipo file con la clase nuevaFotoAlta
$(".nuevaFotoAlta").change(function () {

    //? "this.files[0]" son los datos de la imagen que hemos seleccionado en el formulario
    var imagen = this.files[0];

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/jpg" && imagen["type"] != "image/png" && imagen["type"] != "image/gif") {

        $(".nuevaFotoAlta").val("");

        Swal.fire({

            title: "Error al subir la imagen",
            text: "¡La imagen debe de estar en formato JPEG, JPG, PNG o GIF!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

        //? El tamaño no debe de superar los 2Mb
    } else if (imagen["size"] > 2000000) {

        $(".nuevaFotoAlta").val("");

        Swal.fire({

            title: "Error al subir la imagen",
            text: "¡La imagen no puede pesar más de 2Mb!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    } else {

        //? Esta parte es para previsualizar la imagen seleccionada en la etiqueta <img> (con la clase previsualizar) del formulario
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function (event) {

            var rutaImagen = event.target.result;

            $(".previsualizarAlta").attr("src", rutaImagen);
        })
    }

})


//?=========================
//*=     VER USUARIOS      =
//?=======================*/

$(document).on("click", ".btnVerUsuario", function () {

    var idUsuario = $(this).attr("idUsuario");
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    // console.log(idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta", respuesta);
            $("#verNombreUsuario").html(respuesta["nombre"]);
            $("#verUsuarioUsuario").html(respuesta["usuario"]);
            $("#verCorreoUsuario").html(respuesta["correo"]);
            $("#verPerfilUsuario").html(respuesta["perfil"]);
            $("#botonVerEstado").attr("idUsuario", respuesta["id"]);

            //? PARA MOSTRAR LA IMAGEN
            if (respuesta["imagen"] != "") {
                $(".previsualizarVer").attr("src", respuesta["imagen"]);
            } else {
                $(".previsualizarVer").attr("src", "vistas/img/usuarios/default/anonymous.png");
            }

            //? PARA ASIGNAR UN VALOR AL ESTADO DEL USUARIO EN EL HTML
            if (respuesta["baneado"] != 0) {
                $("#verBaneadoUsuario").attr("data-value", 0);
            } else {
                $("#verBaneadoUsuario").attr("data-value", 1);
            }

            //? Obtén el valor del atributo 'data-value' del span
            var estadoBaneado = Number($("#verBaneadoUsuario").attr("data-value"));
            // console.log("estadoBaneado "+estadoBaneado);

            //? Seleccionamos el botón por la clase o por su id si es necesario
            var $botonVer = $("#botonVerEstado");

            if (estadoBaneado !== 1) {
                $botonVer.removeClass('btn-success');
                $botonVer.addClass('btn-danger');
                $botonVer.html('Desactivado');
                $botonVer.attr('estadoUsuario', 0);
            } else {
                $botonVer.addClass('btn-success');
                $botonVer.removeClass('btn-danger');
                $botonVer.html('Activado');
                $botonVer.attr('estadoUsuario', 1);
            }

        }
    });
});

//?============================
//*=     EDITAR USUARIOS      =
//?==========================*/

$(document).on("click", ".btnEditarUsuario", function () {

    var idUsuario = $(this).attr("idUsuario");
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta", respuesta);
            // console.log(respuesta["id"]);
            $("#idUsuarioEditar").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPasswordActual").val(respuesta["password"]);
            $("#editarCorreo").val(respuesta["correo"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#imagenActual").val(respuesta["imagen"]);

            if (respuesta["imagen"] != "") {
                $(".previsualizarEditar").attr("src", respuesta["imagen"]);
            } else {
                $(".previsualizarEditar").attr("src", "vistas/img/usuarios/default/anonymous.png");
            }
        }
    });
});

//?===================================================
//*=     ACTIVAR/DESACTIVAR USUARIOS EN LA TABLA     =
//?=================================================*/

$(document).on("click", ".btnTablaActivar", function () {

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();

    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    if (estadoUsuario != 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 0);
    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 1);
    }

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

        }
    })
});

//?=====================================================
//*=     ACTIVAR/DESACTIVAR USUARIOS EN VER PERFIL     =
//?===================================================*/

$(document).on("click", ".btnVerActivar", function () {

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();

    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    var $botonTabla = $(".btnTablaEstado" + idUsuario);

    // console.log("botonTabla "+$botonTabla);
    // console.log("idUsuario "+idUsuario);

    if (estadoUsuario != 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 0);

        $botonTabla.removeClass('btn-success');
        $botonTabla.addClass('btn-danger');
        $botonTabla.html('Desactivado');
        $botonTabla.attr('estadoUsuario', 0);

    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 1);

        $botonTabla.addClass('btn-success');
        $botonTabla.removeClass('btn-danger');
        $botonTabla.html('Activado');
        $botonTabla.attr('estadoUsuario', 1);

    }

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

        }
    })
});

//?==============================================================
//*=     COMPROBAR SI EXISTE EL USUARIO (CUANDO LO CREAMOS)     =
//?============================================================*/

$("#nuevoUsuario, #editarUsuario").change(function () {

    $(".alert").remove();  //? Elimina cualquier alerta previa

    var usuario = $(this).val();
    var inputId = $(this).attr("id"); //? Obtener el id del input para saber si es 'nuevoUsuario' o 'editarUsuario'

    var datos = new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta", respuesta);
            if (respuesta != false) {
                if (inputId === "nuevoUsuario") {
                    $("#nuevoUsuario").parent().after("<div class='alert alert-warning'>Este nombre de usuario ya existe</div>");
                    $("#nuevoUsuario").val("");
                    $("#nuevoUsuario").focus();
                } else if (inputId === "editarUsuario") {
                    $("#editarUsuario").parent().after("<div class='alert alert-warning'>Este nombre de usuario ya existe</div>");
                    $("#editarUsuario").val("");
                    $("#editarUsuario").focus();
                }
            }
        }
    })
})

//?==============================================================
//*=     COMPROBAR SI EXISTE EL CORREO (CUANDO LO CREAMOS)     =
//?============================================================*/

$("#nuevoCorreo, #editarCorreo").change(function () {

    $(".alert").remove();

    var correo = $(this).val();
    var inputId = $(this).attr("id"); //? Obtener el id del input para saber si es 'nuevoCorreo' o 'editarCorreo'

    var datos = new FormData();
    datos.append("validarCorreo", correo);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta", respuesta);
            if (respuesta != false) {
                if (inputId === "nuevoCorreo") {
                    $("#nuevoCorreo").parent().after("<div class='alert alert-warning'>Este correo ya existe</div>");
                    $("#nuevoCorreo").val("");
                    $("#nuevoCorreo").focus();
                } else if (inputId === "editarCorreo") {
                    $("#editarCorreo").parent().after("<div class='alert alert-warning'>Este correo ya existe</div>");
                    $("#editarCorreo").val("");
                    $("#editarCorreo").focus();
                }
            }
        }
    })
})

//?==============================
//*=      ELIMINAR USUARIO      =
//?============================*/

$(document).on("click", ".btnEliminarUsuario", function () {

    var idUsuario = $(this).attr("idUsuario");
    var imagenUsuario = $(this).attr("imagenUsuario");
    var usuario = $(this).attr("usuario");

    Swal.fire({
        type: "warning",
        title: "¿Está seguro de borrar el usuario?",
        text: "¡Si no lo está puede cancelar la acción!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar el usuario",
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario + "&usuario=" + usuario + "&imagenUsuario=" + imagenUsuario;
        }
    });

}); eliminarUsuarios

//?=========================================
//*=      ELIMINAR TODOS LOS USUARIOS      =
//?=======================================*/

$(document).on("click", "#eliminarUsuarios", function () {

    Swal.fire({
        type: "warning",
        title: "¿Está seguro de borrar todos los usuarios?",
        text: "¡Si no lo está puede cancelar la acción!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar todos los usuarios",
    }).then((result) => {
        if (result.value) {

            var eliminarUsuarios = "eliminarUsuarios";

            var datos = new FormData();
            datos.append("eliminarUsuarios", eliminarUsuarios);

            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {

                    if (respuesta == true) {

                        Swal.fire({
                            icon: "success",
                            title: "¡Se han eliminado todos los usuarios correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                            allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                        }).then((result) => {
                            if (result.value) {
                                window.location = "usuarios";
                            }
                        });

                    } else {

                        Swal.fire({
                            icon: "error",
                            title: "¡Ha ocurrido un error al eliminar todos los usuarios!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                            allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                        }).then((result) => {
                            if (result.value) {
                                window.location = "usuarios";
                            }
                        });

                    }

                }
            })

        }
    });

});

//?===============================
//*=      RELLENAR USUARIOS      =
//?=============================*/

$(document).on("click", "#rellenarUsuarios", function () {

    var rellenarUsuarios = "rellenarUsuarios";

    var datos = new FormData();
    datos.append("rellenarUsuarios", rellenarUsuarios);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            // respuesta[0] número de usuarios creados 
            if ($.isNumeric(respuesta[0]) && respuesta[1] == true) {

                Swal.fire({
                    icon: "success",
                    title: "¡Se ha rellenado con 100 usuarios correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    allowOutsideClick: false,  // Deshabilita el cierre al hacer clic fuera de la alerta
                    allowEscapeKey: false      // Deshabilita el cierre al presionar la tecla Escape
                }).then((result) => {
                    if (result.value) {
                        window.location = "usuarios";
                    }
                });

            }

        }
    })

});