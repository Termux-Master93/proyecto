$(document).ready(function () {
    $('#usu').hide();
    $('#actualizar').hide();
    $('#tcod_com').prop('disabled',true);
    $('#cod_eli').hide();
    $('#cod_pro').hide();
    listar_productos_temporal();
    listar_proveedores();
    $('#tabla_mostrar').hide();
    $('#tdes_com').val('0');
    
       function listar_proveedores(){
    $.ajax({
        type: "POST",
        url: "acciones/acciones_compras.php",
        data:{accion:'lis_pro'},
        success: function (response) {
            $('#prove').html(response);
            console.log(response);
        }
    });
    }

    function productos(pro){
        if(pro==''){
            $('#tabla_mostrar').hide();
            return;
        }else{

        
        $.ajax({
            type: "POST",
            url: "acciones/acciones_compras.php",
            data: {accion:'lis_productos',ppro:pro},

            success: function (response) {     
                $('#tabla_mostrar').show();
                if(response=='no_existe'){
                    $('#datos').html('producto no encontrado');
                }else{
            var datos=JSON.parse(response);
            var tabla='';
            for(z in datos){
                var codigo =datos[z].cod
                tabla+='<tr>'+
                    '<td>'+datos[z].cod+'</td>'+
                    '<td>'+datos[z].nom+'</td>'+
                    '<td>'+datos[z].prere+'</td>'+
                    '<td>'+datos[z].sto+'</td>'+
                    '<td>'+
                    '<svg id='+codigo+'  xmlns="http://www.w3.org/2000/svg" width="16"  height="16" fill="currentColor" class="bi bi-check2 cod_pro" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>'
                    
                    +'</td>'+
                +'</tr>'
            }
            $('#datos').html(tabla);
            }
        }
        });
        }
    }

    //listar productos agregados a la tabla temporall

    function listar_productos_temporal(){
        var cod_tmp=$('#tcod_com').val();
        $.ajax({
            type: "POST",
            url: "acciones/acciones_compras.php",
            data:{accion:'listar_temporal',cod_tmp: cod_tmp},
            success: function (response) {
                if(response=='vacio'){
                    $('#datos_tabla').html('');  
                    $('#ttotal').val('');
                    $('#tigv').val('');
                    $('#tneto').val('');                 
                }else{

              
                var datos=JSON.parse(response);
                var temporal='';
               var neto=0;
               var total=0;
               var tot_base=0;
               var igv=0;
                for(z in datos){
                   
                    var codigo=datos[z].codigo_pro;
                   var cantidad=datos[z].cantidad_pro;
                   var precio=datos[z].precio_pro;
                 
                   total=parseFloat((cantidad*precio)).toFixed(2);
                    temporal+='<tr>'+
                   // '<td id="x">'+datos[z].ce+'</td>'+
                    '<td>'+codigo+'</td>'+
                    '<td>'+datos[z].nombre_pro+'</td>'+
                    '<td >'+cantidad+'</td>'+
                    '<td>'+precio+'</td>'+
                    '<td class="total">S/.'+total+'</td>'+
                    '<td>'+
                    '<img id='+datos[z].ce+' class="modificar" src="img/pencil-fill.svg" width="25" >'+
                    '</td>'+
                     '<td>'+
                    '<img id='+datos[z].ce+' alt='+cantidad+' style='+precio+' class="elimina"  src="img/eliminar.png" width="25" >'+
                    '</td>'+
                    '</tr>' 

                     neto+=Number(total);
                    tot_base=Number(neto/1.18).toFixed(2);              
                    igv=Number(neto-tot_base).toFixed(2);
                    $('#ttotal').val(parseFloat(tot_base).toFixed(2));  
                    
                  
                    $('#tigv').val(parseFloat(igv).toFixed(2));
                                     
                }
                   
                    $('#datos_tabla').html(temporal);  
                    $('#tneto').val(parseFloat(neto).toFixed(2)); 
                    
            }         
        }
        });
        
    }

   
$('#tpro').keyup(function (e) { 
    var pro=$(this).val()
    productos(pro);
    
});

$(document).on('click','.cod_pro',function(){
  var cod=$(this).attr('id');
 // alert(cod);
 $('#tabla_mostrar').hide();
  $.ajax({
      type: "POST",
      url: "acciones/acciones_compras.php",
      data:{accion:'buscar_valor_productos',cod:cod},
      success: function (response) {
      
          if(response=='no_existe'){
            alert("Producto no tiene precio de compra anterior");
          }else{
        var datos=JSON.parse(response);
        $('#cod_pro').val(datos[0].cod);
         $('#tpro').val(datos[0].nom);
         console.log(datos);         
      }
    }
  });
});





$('#agregar_temporal').click(function (e) {  
    var cod_compra=$('#tcod_com').val();
    var cod_pro=$('#cod_pro').val();
    var nom_pro=$('#tpro').val();
    var can=$('#tcan').val();
    var pre=$('#tpre_ing').val();
   // var tot=$('#ttotal').val();
    
     if(nom_pro==''){
         alert("Ingresar Producto Por favor");
         $('#tpro').focus();
         return;
     }else{
        $('#tcan').focus();
        if(can==''){
            alert("Ingresar Cantidad Por favor");
            $('#tcan').focus();
            return;
        }else{
            $('#tpre_ing').focus();
            if(pre==''){
                alert("Ingresar Precio Por favor");
                $('#tpre_ing').focus();
                return;
            }else{
    
   $.ajax({
       type: "POST",
       url: "acciones/acciones_compras.php",
       data:{accion:'agregar_temporal',
       cod_com:cod_compra,
       cod:cod_pro,
       nom:nom_pro,
       can:can,
       pre:pre
     },
       success: function (response) {
       // total5();  
        listar_productos_temporal();
        $('#tpro').val('');
        $('#tcan').val('');
        $('#tpre_ing').val('');
        $('#tabla_mostrar').hide();
        
        $('#tpro').focus();
        alert(response);

      
       }
   
   }); 
}
}//cierre de validacion de
}//cierre de validacion inicial
});



//Si hago click en el icono de eliminar de la tabla temporal


$(document).on('click','.elimina',function(){
    var total=0;
    var total_base=0;
    var toba=0;
    var igv=0;
    var t=0;
    var can=0;
    var pre=0;
    var cod_eli=$(this).attr('id');
    var can=$(this).attr('alt');
    var pre=$(this).attr('style');

    $.ajax({
        type: "POST",
        url: "acciones/acciones_compras.php",
        data: {accion:'eliminar_temporal',cod_eli:cod_eli},
        success: function (response) {
            //alert(response);
            listar_productos_temporal();
            
            //total base
            total_base=parseFloat((can*pre)/1.18);
            toba= Number($('#ttotal').val()-total_base);
            $('#ttotal').val(parseFloat(toba).toFixed(2)); 

            //NETO
            total=parseFloat(can*pre);           
            t=Number($('#tneto').val()-total);
            $('#tneto').val(parseFloat(t).toFixed(2));
           // IGV
           igv=(parseFloat($('#tneto').val()) - parseFloat($('#ttotal').val()));
           $('#tigv').val(parseFloat(igv).toFixed(2)); 
        
        }
    });
});

function nueva_compra(){
  //  $('#tcod_com').val('');
    $('#tpro').val('');
    $('#tpre_ing').val('');
    $('#tdes_com').val('0');
    $('#datos_tabla').empty();
    $('#ttotal').val('');     
    $('#tigv').val('');     
    $('#tneto').val('');
    $("#prove option:selected").val('');
    $("#ttipcom option:selected").val('');
}


$('#agregar_compra').click(function (e) { 
 var cod_com=$('#tcod_com').val();
  var dni_pro=$("#prove option:selected").val();
  //usuario falta sacarlo
  var dni_usu=$('#usu').val();;
  var fecco=$('#tfecom').val();
  var tip_com=$("#ttipcom option:selected").val();
  var des=$('#tdes_com').val();
  var total=$('#ttotal').val();
  var igv=$('#tigv').val();
  var neto=$('#tneto').val();
console.log(cod_com," ",dni_pro," ",dni_usu," ",fecco," ",tip_com," ",des," ",total," ",igv," ",neto);

  var mode='iframe';
  var close=mode=="popup";
  var options={
      mode: mode,
      popClose:close,
              
  };
  $('#tabla_temporal').show().printArea(options);
  $.ajax({
    type: "POST",
    url: "acciones/acciones_compras.php",
    data: {accion:'nuevo_codigo'},
    success: function (response) {
        $('#tcod_com').val(response);
        console.log(response);
    //  alert(response);
    }
});

     $.ajax({
         type: "POST",
         url: "acciones/acciones_compras.php",
         data: {accion:'agregar_compra',
               cod_com:cod_com,
               dni_pro:dni_pro,
               dni_usu:dni_usu,
               fecco:fecco,
               tip_com:tip_com,
               des_com:des,
               total:total,
               igv:igv,
               neto:neto      
                },
         success: function (response) {
          alert(response);  
          $('#tpro').focus();
          console.log(response);
          $('#tdes_com').val('0');
          nueva_compra();
         
       //   alert("Compa Agregada Correctamente");
         }

     });


   
});

//BUSCAR DATOS DEL PRODUCTOS Y MOSTRARLOS
$(document).on('click','.modificar',function(){
   // $('#tpre_ing').prop('disabled',true);
    $('#tcan').focus();
var cod=$(this).attr('id');
$('#agregar_temporal').hide();
$('#actualizar').show();

$.ajax({
    type: "POST",
    url: "acciones/acciones_compras.php",
    data: {accion:'buscar_datos',cod:cod},
    success: function (response) {
       var datos=JSON.parse(response);
       console.log("valores",datos);
       $('#cod_pro').val(datos[0].x2);
       $('#tpro').val(datos[0].x3);
       $('#tcan').val(datos[0].x4);
       $('#tpre_ing').val(datos[0].x5);
       
    }
});
});



$('#actualizar').click(function (e) { 
    $('#tpre_ing').prop('disabled',false);
    var can=0;
    var pre=0;
    var neto=0;
    var neto_fijo=0;
    var tt=0;
    var des=$('#tdes_com').val();
    var can=$('#tcan').val();
    var pre=$('#tpre_ing').val();
    var ne=$('#tneto').val();

    var cod_compra=$('#tcod_com').val();
    var cod_pro=$('#cod_pro').val();
    var nom_pro=$('#tpro').val();
    var can=$('#tcan').val();
    var pre=$('#tpre_ing').val();
 // tt es todo el neto que hay en la caja
 
    neto=can*pre;



    tt+=Number($('#tneto').val());
    neto_fijo=parseFloat(neto-tt);
    
    neto_fijo+=Number($('#tneto').val());

  
    $.ajax({
        type: "POST",
        url: "acciones/acciones_compras.php",
        data:{accion:'actulizar_temporal',
        cod_com:cod_compra,
        cod:cod_pro,
        nom:nom_pro,
        can:can,
        pre:pre
      },
        success: function (response) {
           
    $('#tneto').val(parseFloat(neto_fijo).toFixed(2));
    
           
          $('#agregar_temporal').show(); 
          $('#actualizar').hide();
         listar_productos_temporal();
        $('#tpro').val('');
        $('#tcan').val('');
        $('#tpre_ing').val('');
        $('#tpro').focus();
         alert(response);
         
        }
    });

});


$('#tcan').keyup(function (e) {     
  
  this.value = this.value.replace(/[^0-9]/g, '');

});

$('#tpre_ing').keyup(function (e) {     
  
    this.value = this.value.replace(/[^0-9.]/g, '');
  
  });

  $('#tdes_com').keyup(function (e) { 
    this.value = this.value.replace(/[^0-9.]/g, '');
  });

  $('#cancelar').click(function (e) { 
    nueva_compra();
    var cod_el=$('#tcod_com').val();
    $.ajax({
        type: "POST",
        url: "acciones/acciones_compras.php",
        data: {
        accion:'cancelar'},
        success: function (response) {
            $('#tcod_com').val(response);
        }
    });

    $.ajax({
        type: "POST",
        url: "acciones/acciones_compras.php",
        data: {accion:'cancelar',cod_el: cod_el},
        success: function (response) {
            
        }
    });
  });



});