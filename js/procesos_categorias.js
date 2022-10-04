$(document).ready(function () {
    lis_cat();
    numero();
    function lis_cat(cat){
        $.ajax({
            type: "POST",
            url: "acciones/acciones_categorias.php",
            data:{accion:'listar_categorias',cat:cat},
            success: function (response) {
                if(response=='no_existe'){
                    $('#datos').html('Categoria no existe');
                }else{                
                var tabla="";
                var datos=JSON.parse(response);
                               
                for (z in datos){
                    var codigo=datos[z].codigo
                    tabla+='<tr>'+
                    '<td>'+codigo+'</td>'+
                    '<td>'+datos[z].nombre+'</td>'+
                    '<td>'+
                    '<img id='+codigo+' class="elimina" src="img/eliminar.png" width="25">'+
                    '</td>'+
                    '<td>'+
                    '<svg id='+codigo+' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil modificar" viewBox="0 0 16 16" src="../img/modificar.jfif" width="25"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>'+
                    '</td>'+
                    '</tr>' 
                }
                
               // console.log(response);
                $('#datos').html(tabla);
            }}
        });
    }

$('#tbus_cat').keyup(function (e) { 
    var bus_cat=$(this).val();
    lis_cat(bus_cat);
     
});

function numero(){
    $.ajax({
        type: "POST",
        url: "acciones/acciones_categorias.php",
        data:{accion:'numero_mayor'},
        success: function (response) {
            $('#tcod_cat').val(response);
            $('#tcod_cat').prop('disabled',true);
            $('#tnom_cat').focus();
        }
    });
}//fin llave de funcion numero

$(document).on('click','.elimina',function(){
    var cod_e=$(this).attr('id');
  
    $.ajax({
        type: "POST",
        url: "acciones/acciones_categorias.php",
        data: {accion:'eliminar',cod_e:cod_e},
        success: function (response) {
            alert(response);
            numero();
           lis_cat();
           
           //numero();
           //lis_cat();
        }
    });



    });//fin de llave elimina


$('#agregar').click(function (e) { 
    e.preventDefault();
   var cod=$('#tcod_cat').val();
   var nom=$('#tnom_cat').val();

   if(nom==''){
       alert("Ingrese Nombre de categoria");
       $('#tcod_cat').focus();
       return;
   }else{


   $.ajax({
       type: "POST",
       url: "acciones/acciones_categorias.php",
       data:{accion:'agregar',cod:cod,nom:nom},
       success: function (response) {
           alert(response);
           numero();
           lis_cat();
           $('input[type="text"]').val('');//limpiamos los input
           $('#categoria').modal("hide");
           $()
       }
   
   });

 }//llave de condicion
});//fin llave de agregar

//aki hacemos peticion para buscar los datos y de tal forma podamos actualizarlos
$(document).on('click','.modificar',function(){
    $('#mod_act').modal('show');
    $('#tcod_act').prop('disabled',true);
    $('#tnom_act').focus();
    var cod_m=$(this).attr('id');
    $.ajax({
        type: "POST",
        url: "acciones/acciones_categorias.php",
        data: {accion:'buscar_valor_modificar',cod_m:cod_m},
        success: function (response) {
            var datos=JSON.parse(response);
            for (z in datos){
                $('#tcod_act').val(datos[z].cod);
                $('#tnom_act').val(datos[z].nom);
            }
            console.log(response);
            
        }
    });
})

//peticion para actualizar

$('#actualizar').click(function (e) { 
    e.preventDefault();
    var cod_act=$('#tcod_act').val();
    var nom_act=$('#tnom_act').val();

    $.ajax({
        type: "POST",
        url: "acciones/acciones_categorias.php",
        data:{accion:'actualizar',cod_ac:cod_act,nom_ac:nom_act},
        success: function (response) {
            alert(response);
            lis_cat();
            $('#mod_act').modal('hide');
        }
    });
});

});