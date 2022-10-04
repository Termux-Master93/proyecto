$(document).ready(function () {
    var user=$('#user').html();
    $.ajax({
        url: 'acciones/proceso_index.php',
        type: "POST",
        data: {
            accion: 'lista_usuario',
            val_user: user,
        },
        success: function(respuesta){   
            var datos=JSON.parse(respuesta);
            var usuario=datos[0].datos;
            $('#nom_user').html(usuario);
        }
    });
    
   
    $('#contenido').load("vistas/compras.php");
    $('#hoja-1').click(function (e) { 
        $('#contenido').load("vistas/compras.php");
        
    });

    $('#hoja_productos').click(function (e) { 
        $('#contenido').load("vistas/productos.php");
    });

    $('#hoja_categorias').click(function (e) { 
        $('#contenido').load("vistas/categorias.php")
        
    });

    $('#hoja_personal').click(function (e) { 
        $('#contenido').load("vistas/usuarios.php")       
    });

    $('#x2').click(function(e){
        $('#contenido').load("vistas/compras.php");
    });
    $('#clientes').click(function(e) { 
        $('#contenido').load("vistas/clientes.php");
        
    });
    $('#proveedores').click(function(e) { 
        $('#contenido').load("vistas/proeevedores.php");
        
    });
    $('#ventas').click(function(e) { 
        $('#contenido').load("vistas/ventas.php");
        
    });
    $('#reporte_ventas').click(function(e) { 
        $('#contenido').load("vistas/reporte_ventas.php");
        
    });
    
    $('#reporte_compras').click(function(e) { 
        $('#contenido').load("vistas/reporte_compras.php");
        
    });

    $('#cerrar_sesion').click(function (e) { 
        $.ajax({
            type: "POST",
            url: "sesion/cerrar-secion.php",
            data:{accion:'cerrar'},
            success: function (response) {
                $(window).attr('location','sesion/acceso.php')
              //  window.location.href="location:sesion/acceso.php";
            }
        });
    });
});
