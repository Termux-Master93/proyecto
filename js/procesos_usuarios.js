$(document).ready(function () {
    listar_usuarios(); //listar usuarios
    function listar_usuarios(dni){
        $.ajax({
            type: "POST",
            url: "acciones/acciones_usuarios.php",
            data:{accion:'listar_usuarios',dni_bus:dni},
            success: function (response) {
                if(response=='no_existe'){
                    $('#datos').html('DNI de cliente no encontrado');
                }else{
              var datos=JSON.parse(response);
              var tabla='';
              for(z in datos){
                  if(datos[z].nivel==1){var niv='Ayudante'}
                  if(datos[z].nivel==2){var niv='Administrador'}
                  tabla+='<tr>'+
                    '<td>'+datos[z].dni+'</td>'+
                    '<td>'+datos[z].nombre+'</td>'+
                    '<td>'+datos[z].apellidos+'</td>'+
                    '<td>'+datos[z].telefono+'</td>'+
                    '<td>'+datos[z].direccion+'</td>'+
                    '<td>'+datos[z].foto+'</td>'+
                    '<td>'+'S/.'+datos[z].sueldo+'</td>'+
                    '<td>'+niv+'</td>'+
                    '<td>'+datos[z].fecha+'</td>'+
                    '<td>'+
                    '<td>'+
                    '<img id='+datos[z].dni+' src=img/pencil-fill.svg class=modificar width=25>'+
                    '</td>'+
                    '<td>'+
                    '<img id='+datos[z].dni+' src=img/trash.svg class=eliminar width=25>'+
                    '</td>'

                  '</tr>'
              }
              $('#datos').html(tabla);
            }
        }
        });
    }

    $('#tbus_usu').keyup(function (e) { 
        var dni_bus=$(this).val();
        listar_usuarios(dni_bus);
    });

 $('#agregar').click(function (e) { 
     var dni=$('#tdni').val();
     var nom=$('#tnom').val();
     var ape=$('#tape').val();
     var tel=$('#ttel').val();
     var dir=$('#tdir').val();
     var con=$('#tcon').val();
     var sue=$('#tsue').val();
     var img=$('#timg').val();
     var niv=$('#tniv').val();
     var fec=$('#tfec').val();
    //var est=$('').val();

        $.ajax({
            type: "POST",
            url: "acciones/acciones_usuarios.php",
            data: {
                accion:'agregar',
                dni:dni,
                nom:nom,
                ape:ape,
                dir:dir,
                tel:tel,
                sue:sue,
                img:img,
                niv:niv,
                fec:fec,
                con:con,
                
            },
            success: function (response) {
                alert(response);
                listar_usuarios();
                $('input[type="text"]').val('');//limpiamos los input
                $('input[type="password"]').val('');
                $('#exampleModal').modal('show');
            }
        });
 });

$(document).on('click','.eliminar',function(){
 var dni_eli=$(this).attr('id');
 $.ajax({
     type: "POST",
     url: "acciones/acciones_usuarios.php",
     data:{accion:'eliminar',dni:dni_eli},
     success: function (response) {
        listar_usuarios();
         alert(response);
         listar_usuarios();
     }
 });
});

$(document).on('click','.modificar',function(){
var dni_mod=$(this).attr('id');
$('#mod_act').modal('show');
    $.ajax({
        type: "POST",
        url: "acciones/acciones_usuarios.php",
        data:{accion:'buscar_datos',dni_mod:dni_mod},
        success: function (response) {
            var datos=JSON.parse(response);
            $('#tdni_ac').val(datos[0].dni);
            $('#tnom_ac').val(datos[0].nombre);
            $('#tape_ac').val(datos[0].apellidos);
            $('#tdir_ac').val(datos[0].direccion);
            $('#ttel_ac').val(datos[0].telefono);
            $('#tsue_ac').val(datos[0].sueldo);
            $('#timg_ac').val(datos[0].foto);
            $('#tniv_ac').val(datos[0].nivel);
            $('#tfec_ac').val(datos[0].fecha);
            $('#tcon_ac').val(datos[0].password);
        }
    });


});

$('#actualizar').click(function (e) { 
    var dni=$('#tdni_ac').val();
    var nom=$('#tnom_ac').val();
    var ape=$('#tape_ac').val();
    var tel=$('#ttel_ac').val();
    var dir=$('#tdir_ac').val();
    var con=$('#tcon_ac').val();
    var sue=$('#tsue_ac').val();
    var img=$('#timg_ac').val();
    var niv=$('#tniv_ac').val();
    var fec=$('#tfec_ac').val();
    
    $.ajax({
        type: "POST",
        url: "acciones/acciones_usuarios.php",
        data:{accion:'actulizar',
        dni:dni,
        nom:nom,
        ape:ape,
        dir:dir,
        tel:tel,
        sue:sue,
        img:img,
        niv:niv,
        fec:fec,
        con:con,          
    },
        success: function (response) {
            alert(response);
            listar_usuarios();
        }
    });
});




});//cierre general