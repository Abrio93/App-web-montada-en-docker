//? PARA VER EL ARRAY EN JSON(EN CONSOLA) QUE TRAE LA CONSULTA PARA MOSTRAR LA TABLA
// $.ajax({
//     url: "ajax/datatable-productos.ajax.php",
//     success:function(respuesta){
//         console.log("respuesta", respuesta);
//     }
// })

//? APLICAR ORIGEN DATOS JSON A LA TABLA DINÁMICA DE PRODUCTOS
$('.tablaProductos').DataTable( {
        "ajax": "ajax/datatable-productos.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {
        
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }

);

//? CAPTURANDO LA CATEGORÍA PARA ASIGNARLE UN CODIGO DEPENDIENDO DEL ID DE LA CATEGORIA Y EL ULTIMO PRODUCTO EJEMPLO -> 5+45 = 545 
//? 5(NUMERO DE LA CATEGORIA) 45(EL ÚLTIMO REGISTRO ERA EL 44), SI YA HAY PRODUCTOS EN ESA CATEGORÍA SE COGE EL ULTIMO ID DE PRODUCTO
//? DE ESA CATEGORIA Y SE LE SUMA UNO AL QUE SE VA A INSERTAR
$("#nuevaCategoria").change(function(){
     var idCategoria = $(this).val();

     var datos = new FormData();
     datos.append("idCategoria", idCategoria);

     $.ajax({
         url:"ajax/productos.ajax.php",
         method: "POST",
         data: datos,
         cache: false,
         contentType: false,
         processData: false,
         dataType:"json",
         success:function(respuesta){

            if(!respuesta){
                var nuevoCodigo = idCategoria+"01";
                $("#nuevoCodigo").val(nuevoCodigo);
            }else{
                var codigo = parseInt(respuesta["codigo"]);
                var nuevoCodigo = Number(codigo+1);
                $("#nuevoCodigo").val(nuevoCodigo);
            }
             //console.log("nuevoCodigo", nuevoCodigo);
         }
     });
});


//? AGREGANDO PRECIO DE VENTA ALTA/EDITAR
$("#nuevoPrecioCompra, #editarPrecioCompra").blur(function(){
    //? PARA COMPROBAR QUE EL CHECK DE % ESTA ACTIVADO(CHEQUEADO)
    //* ALTA
    if($(".porcentaje_alta").prop("checked")){
        var valorPorcentaje = $(".nuevoPorcentaje").val();
        //console.log("valorPorcentaje", valorPorcentaje);
        var precio = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
        //console.log("precio", precio);

        $("#nuevoPrecioVenta").val(precio);
        $("#nuevoPrecioVenta").prop("readonly", true);
    }
    //* EDITAR
    if($(".porcentaje_editar").prop("checked")){
        var valorPorcentaje = $(".nuevoPorcentaje").val();
        var precio_editado = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

        $("#editarPrecioVenta").val(precio_editado);
        $("#editarPrecioVenta").prop("readonly", true);
    }
});

//? CAMBIO DE PORCENTAJE ALTA/EDITAR (AL SALIR DEL FOCO)
$(".nuevoPorcentaje").blur(function(){
    //? PARA COMPROBAR QUE EL CHECK DE % ESTA ACTIVADO(CHEQUEADO)
    //* ALTA
    if($(".porcentaje_alta").prop("checked")){

        var valorPorcentaje = $(this).val();

        var precio = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

        $("#nuevoPrecioVenta").val(precio);
        $("#nuevoPrecioVenta").prop("readonly", true);
    }
    //* EDITAR
    if($(".porcentaje_editar").prop("checked")){

        var valorPorcentaje = $(this).val();

        var precio_editado = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

        $("#editarPrecioVenta").val(precio_editado);
        $("#editarPrecioVenta").prop("readonly", true);
    }
});
//? CAMBIO DE PORCENTAJE ALTA/EDITAR (AL CAMBIAR EL VALOR)
$(".nuevoPorcentaje").change(function(){
    //? PARA COMPROBAR QUE EL CHECK DE % ESTA ACTIVADO(CHEQUEADO)
    //* ALTA
    if($(".porcentaje_alta").prop("checked")){

        var valorPorcentaje = $(this).val();

        var precio = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

        $("#nuevoPrecioVenta").val(precio);
        $("#nuevoPrecioVenta").prop("readonly", true);
    }
    //* EDITAR
    if($(".porcentaje_editar").prop("checked")){

        var valorPorcentaje = $(this).val();

        var precio_editado = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

        $("#editarPrecioVenta").val(precio_editado);
        $("#editarPrecioVenta").prop("readonly", true);
    }
});

//? PARA DESBLOQUEAR PRECIO VENTA CUANDO SE PULSA EL CHECK DE ALTA DE PRODUCTOS
$(".porcentaje_alta").on("ifUnchecked",function(){
    $("#nuevoPrecioVenta").prop("readonly", false);
})
//? PARA BLOQUEAR PRECIO VENTA CUANDO SE PULSA EL CHECK DE ALTA DE PRODUCTOS
$(".porcentaje_alta").on("ifChecked",function(){
    $("#nuevoPrecioVenta").prop("readonly", true);
})

//? PARA DESBLOQUEAR PRECIO VENTA CUANDO SE PULSA EL CHECK DE EDITAR PRODUCTOS
$(".porcentaje_editar").on("ifUnchecked",function(){
    $("#editarPrecioVenta").prop("readonly", false);
})
//? PARA BLOQUEAR PRECIO VENTA CUANDO SE PULSA EL CHECK DE EDITAR PRODUCTOS
$(".porcentaje_editar").on("ifChecked",function(){
    $("#editarPrecioVenta").prop("readonly", true);
})

//?============================================
//*=     SUBIENDO LA FOTO DE UN PRODUCTO      =
//?==========================================*/

//? El evento "change" es para cuando cambie de valor del input tipo file con la clase nuevaImagen
$(".nuevaImagen").change(function(){
    
    //? "this.files[0]" son los datos de la imagen que hemos seleccionado en el formulario
    var imagen = this.files[0];

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaImagen").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen debe de estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    //? El tamaño no debe de superar los 2Mb
    }else if(imagen["size"] > 2000000){

        $(".nuevaImagen").val("");

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
            $(".previsualizar_imagen_al_editar").attr("src", rutaImagen);
        })
    }

})

//?=============================
//*=     EDITAR PRODUCTOS      =
//?===========================*/

$(document).on("click", ".btnEditarProducto", function(){

//? JUANJO PUSO ESTE EVENTO (si se pone el de juanjo hay que poner una ")" al final del cierre)
//? $(".tablaProductos tbody".on("click", "button.btnEditarProducto", function(){
    var idProducto = $(this).attr("idProducto");
    // console.log("idProducto", idProducto);
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            var datosCategoria = new FormData();
            datosCategoria.append("idCategoria", respuesta["id_categoria"]);
            //? AHORA BUSCAMOS EL NOMBRE DE LA CATEGORIA(YA QUE DE MOMENTOS TENEMOS EL id_categoria de la tabla productos)
            $.ajax({
                url: "ajax/categorias.ajax.php",
                method: "POST",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    console.log("respuesta", respuesta);
                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);
                }
            })

            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarStock").val(respuesta["stock"]);
            $("#editarPrecioCompra").val(respuesta["precio_compra"]);
            $("#editarPrecioVenta").val(respuesta["precio_venta"]);
            if(respuesta["imagen"] != ""){
                $("#imagenActual").val(respuesta["imagen"]);
                $(".previsualizar_imagen_al_editar").attr("src", respuesta["imagen"]); 
            }
        }

    })
});

//?===============================
//*=      ELIMINAR PRODUCTO      =
//?=============================*/

$(document).on("click", ".btnEliminarProducto", function(){

    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    console.log("idProducto", idProducto);
    console.log("codigo", codigo);
    console.log("imagen", imagen);

    swal({
        type: "warning",
        title: "¿Está seguro de borrar el producto?",
        text: "¡Si no lo está puede cancelar la acción!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Borrar el producto",
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=productos&idProducto="+idProducto+"&codigo="+codigo+"&imagen="+imagen;
        }  
    });

});