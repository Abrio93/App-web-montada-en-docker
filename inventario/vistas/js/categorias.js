//?==============================
//*=     EDITAR CATEGORIAS      =
//?============================*/

$(document).on("click", ".btnEditarCategoria", function(){
    
    var idCategoria = $(this).attr("idCategoria");
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            $("#idCategoria").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["categoria"]);
        }
    });
});

//?===========================================================================
//*=     COMPROBAR SI EXISTE LA CATEGORÍA (CUANDO LO CREAMOS Y EDITAMOS)     =
//?=========================================================================*/

$("#nuevoNombre").change(function(){

    $(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();
    datos.append("validarCategoria", usuario);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            if(respuesta != false){
                $("#nuevoNombre").parent().after("<div class='alert alert-warning'>Este nombre de categoría ya existe</div>");
                $("#nuevoNombre").val("");
                $("#nuevoNombre").focus();
            }
        }
    })
})

$("#editarNombre").change(function(){

    $(".alert").remove();

    var usuario = $(this).val();

    var datos = new FormData();
    datos.append("validarCategoria", usuario);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            if(respuesta != false){
                $("#editarNombre").parent().after("<div class='alert alert-warning'>Este nombre de categoría ya existe</div>");
                $("#editarNombre").val("");
                $("#editarNombre").focus();
            }
        }
    })
})

//?================================
//*=      ELIMINAR CATEGORIA      =
//?==============================*/

$(document).on("click", ".btnEliminarCategoria", function(){

    var idCategoria = $(this).attr("idCategoria");

        swal({
            type: "warning",
            title: "¿Está seguro de borrar la categoría?",
            text: "¡Si no lo está puede cancelar la acción!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, borrar la categoría",
        }).then((result)=>{
            if(result.value){
                window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
            }  
        });

});
