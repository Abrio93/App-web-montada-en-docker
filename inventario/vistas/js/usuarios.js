//?===========================================
//*=     SUBIENDO LA FOTO DE UN USUARIO Y PREVISUALIZAR LA MINIATURA AL EDITAR       =
//?=========================================*/

//? El evento "change" es para cuando cambie de valor del input tipo file con la clase nuevaFoto
$(".nuevaFoto").change(function(){
    
    //? "this.files[0]" son los datos de la imagen que hemos seleccionado en el formulario
    var imagen = this.files[0];

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaFoto").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen debe de estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    //? El tamaño no debe de superar los 2Mb
    }else if(imagen["size"] > 2000000){

        $(".nuevaFoto").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen no puede pesar más de 2Mb!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }else{

        //? Esta parte es para previsualizar la imagen seleccionada en la etiqueta <img> (con la clase previsualizar) del formulario
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        })
    }

})

//? El evento "change" es para cuando cambie de valor del input tipo file con la clase nuevaFoto
$(".nuevaFoto").change(function(){
    
    //? "this.files[0]" son los datos de la imagen que hemos seleccionado en el formulario
    var imagen = this.files[0];

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaFoto").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen debe de estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    //? El tamaño no debe de superar los 2Mb
    }else if(imagen["size"] > 2000000){

        $(".nuevaFoto").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen no puede pesar más de 2Mb!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }else{

        //? Esta parte es para previsualizar la imagen seleccionada en la etiqueta <img> (con la clase previsualizar) del formulario
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;

            $(".previsualizar2").attr("src", rutaImagen);
        })
    }

})

//?============================
//*=     EDITAR USUARIOS      =
//?==========================*/

$(document).on("click", ".btnEditarUsuario", function(){
    
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
        success: function(respuesta){
            console.log("respuesta", respuesta);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#passwordActual").val(respuesta["password"]);
            $("#fotoActual").val(respuesta["foto"]);
            if(respuesta["foto"] != ""){
                $(".previsualizar").attr("src", respuesta["foto"]);
            }else{
                $(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");
            }
        }
    });
});

//?=========================================
//*=     ACTIVAR/DESACTIVAR USUARIOS      =
//?=======================================*/

$(document).on("click", ".btnActivar", function(){
    
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();

    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    
    if(estadoUsuario != 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario',1);
    }else{
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario',0);
    }
    
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //? PONEMOS "dataType: 'text'" POR QUE SINÓ NO RECIBE EL STRING QUE RETORNA EL MODELO AL CONTROLADOR Y ESTE A "respuesta"
        dataType: "text",
        success: function(respuesta){
            if(window.matchMedia("(max-width:767px)").matches){
                swal({
                    type: "success",
                    title: "El usuario ha sido actualizado",
                    confirmButtonText: "¡Cerrar!",
                }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }  
                })
            }else{
                if(respuesta == "SI"){
                    window.location = 'usuarios';
                }
            }
        }
    })
});

//?==============================================================
//*=     COMPROBAR SI EXISTE EL USUARIO (CUANDO LO CREAMOS)     =
//?============================================================*/


$("#nuevoUsuario").change(function(){

    $(".alert").remove();

    var usuario = $(this).val();

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
        success: function(respuesta){
            console.log("respuesta", respuesta);
            if(respuesta != false){
                $("#nuevoUsuario").parent().after("<div class='alert alert-warning'>Este nombre de usuario ya existe</div>");
                $("#nuevoUsuario").val("");
                $("#nuevoUsuario").focus();
            }
        }
    })
})

//?==============================
//*=      ELIMINAR USUARIO      =
//?============================*/

$(document).on("click", ".btnEliminarUsuario", function(){

    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");

        swal({
            type: "warning",
            title: "¿Está seguro de borrar el usuario?",
            text: "¡Si no lo está puede cancelar la acción!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, borrar el usuario",
        }).then((result)=>{
            if(result.value){
                window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
            }  
        });

});
