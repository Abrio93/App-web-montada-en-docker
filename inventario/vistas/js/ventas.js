// //? PARA VER EL ARRAY EN JSON(EN CONSOLA) QUE TRAE LA CONSULTA PARA MOSTRAR LA TABLA
// $.ajax({
//     url: "ajax/datatable-ventas.ajax.php",
//     success:function(respuesta){
//         console.log("respuesta", respuesta);
//     }
// })

//? APLICAR ORIGEN DATOS JSON A LA TABLA DINÁMICA DE VENTAS
$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
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

//? AÑADIENDO PRODUCTOS A LA VENTA DESDE LA TABLA
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){
    var idProducto = $(this).attr("idProducto");
    
    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn btn-default");
    
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            // console.log("respuesta", respuesta);
            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            console.log("respuesta", respuesta);

            $(".nuevoProducto").append(
                '<!-- DESCRIPCION DEL PRODUCTO -->'+
                '<div class="row" style="padding: 5px 15px;">'+
                '<div class="col-xs-7" style="padding-right: 0px;">'+
                    '<div class="input-group">'+
                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
                    '<input type="text" class="form-control" name="agregarProducto" value="'+descripcion+'" readonly required>'+
                    '</div>'+
                '</div>'+
                '<!-- CANTIDAD DEL PRODUCTO -->'+
                '<div class="col-xs-2" style="padding: 0px 2px 0px;">'+
                    '<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" required>'+
                '</div>'+
                '<!-- PRECIO DEL PRODUCTO -->'+
                '<div class="col-xs-3" style="padding-left: 0px;">'+
                    '<div class="input-group">'+
                    '<input type="number" min="1" class="form-control" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
                    '<span class="input-group-addon"><i class="ion ion-social-euro"></i></span>'+
                    '</div>'+
                '</div>'+
                '</div>'
            );
        }
    })
});

//? QUITAR PRODUCTOS DE LA VENTA Y HABILITAR BOTON
var idProductosQuitadosVenta = [];

sessionStorage.removeItem("cancelarVentaProductos");

$(".formularioVenta").on("click", "button.quitarProducto", function(){
    
    //* Va subiendo etiquetas y elimina el bloque entero
    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

    //? ALMACENAR EN EL sessionStorage EL ID DEL PRODUCTO A QUITAR DE LA VENTA
    if(sessionStorage.getItem("cancelarVentaProductos") != null){
        idProductosQuitadosVenta.concat(sessionStorage.getItem("cancelarVentaProductos"))
    }

    idProductosQuitadosVenta.push({"idProducto":idProducto});
    //? JSON.stringify -> PARA PASAR LOS DATOS A FORMATO JSON
    sessionStorage.setItem("cancelarVentaProductos", JSON.stringify(idProductosQuitadosVenta));

    $("button.habilitarBoton[idProducto='"+idProducto+"']").removeClass("btn-default");
    $("button.habilitarBoton[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

});

//? CADA VEZ QUE SE NAVEGUE EN LA TABLA (CAMBIO PAGINAS, BUSCADIR I FILTRO REGISTROS)
$("tableVentas").on("draw.dt", function(){
    if(sessionStorage.getItem("cancelarVentaProductos") != null){
        var listaIdProductos = JSON.parse(sessionStorage.getItem("cancelarVentaProductos"));

        for(var i = 0; i < listaIdProductos.length; i++){
            $("button.habilitarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass("btn-default");
            $("button.habilitarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass("btn-primary agregarProducto");
        }
    }
});