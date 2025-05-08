//?============================
//*=     EDITAR CLIENTES      =
//?==========================*/

$(document).on("click", ".btnEditarCliente", function(){
    
    var idCliente = $(this).attr("idCliente");
    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarDocumento").val(respuesta["documento"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarNacimiento").val(respuesta["fecha_nacimiento"]);
            $("#editaridCliente").val(respuesta["id"]);
        }
    });
});

//?===================================================================================================
//*=     COMPROBAR SI EXISTE EL EMAIL (SOLO CUANDO LO CREAMOS YA QUE EN LA BD ES UN CAMPO UNICO)     =
//?=================================================================================================*/


$("#nuevoEmail").change(function(){

    $(".alert").remove();

    var email = $(this).val();

    var datos = new FormData();
    datos.append("validarCliente", email);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            if(respuesta != false){
                $("#nuevoEmail").parent().after("<div class='alert alert-warning'>Este email ya existe</div>");
                $("#nuevoEmail").val("");
                $("#nuevoEmail").focus();
            }
        }
    })
})

//?==============================
//*=      ELIMINAR CLIENTE      =
//?============================*/

$(document).on("click", ".btnEliminarCliente", function(){

    var idCliente = $(this).attr("idCliente");

        swal({
            type: "warning",
            title: "¿Está seguro de borrar el cliente?",
            text: "¡Si no lo está puede cancelar la acción!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, borrar el cliente",
        }).then((result)=>{
            if(result.value){
                window.location = "index.php?ruta=clientes&idCliente="+idCliente;
            }  
        });

});
