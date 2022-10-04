$(document).ready(function () {

     $(lis_pro());
    llenar_categorias();
    $('.actualizar').hide();
    
     //FUNCION PARA LLENAR CATEGORIAS
    function llenar_categorias(){
            $.ajax({
                type: "POST",
                url: "acciones/acciones_productos.php",
                data: {accion:"llen_cat"},
                success: function (response) {
                    $('#tcat').html(response);
                    $('#tcat_actualizar').html(response);
                   console.log(response);
                }
            });
     }
     //fin de peticion de llenar categorias
    
    //funcion cuando escriba en la caja y se filtre
    $('#tbus_pro').keyup(function () { 
        var bus_pro=$(this).val();
        $(lis_pro(bus_pro));
    });


    //funcion para listar y tambien aprovechamos para hacer un filtro
    function lis_pro(par_bus){
    $.ajax({
        url: 'acciones/acciones_productos.php',
        method: 'POST',
        data: {accion:"listar_productos",buscar:par_bus},
        success: function (response) {
            if(response=='no_existe'){
                $('#datos').html('Producto no Existe');
            }else{
        var tabla="";
            var datos=JSON.parse(response);//PARCEAMOS LA RESPUESTA, PARA QUE DE ESE MODO PODAMOS TOMAR SUS VALORES
        
            for(z in datos){
                var codigo =datos[z].cod
                //comparamos el codigo y luego procedemos a PONER EL NOMBRE categoria
              
                
                // //comparamos el codigo y luego procedemos a PONER EL NOMBRE para ubicacion
                if(datos[z].ubi==1){ubicacion="Estante 1"}
                if(datos[z].ubi==2){ubicacion="Estante 2"}
                if(datos[z].ubi==3){ubicacion="Estante 3"}

                tabla+='<tr>'+
                    '<td>'+codigo+'</td>'+
                    '<td>'+datos[z].nom+'</td>'+
                    '<td>'+datos[z].nombre_categoria+'</td>'+
                    '<td>'+datos[z].mar+'</td>'+
                    '<td>'+ubicacion+'</td>'+
                    '<td>'+datos[z].des+'</td>'+
                    '<td>'+datos[z].prere+'</td>'+
                    '<td>'+datos[z].sto+'</td>'+


                    '<td>'+
                    '<img id='+codigo+' class="elimina" src="img/trash.svg" width="25">'+
                    '</td>'+

                    '<td>'+
                    '<img id='+codigo+' class="modificar" src="img/pencil-fill.svg" width="25">'+
                    '</td>'


                    '</tr>'                                    
            }
            console.log(response);
            $('#datos').html(tabla);
        }}
    });
    }//Fin de Funcion


    //capturar el valor de categoria
     $('#tcat').change(function (e) { 
         e.preventDefault();
         var x=$(this).val();
            
         $.ajax({
             type: "POST",
             url: 'acciones/acciones_productos.php',
             data: {},                
             success: function (response) {
                    
            }
            });
     });
    //fin del proceso



    //Inicio para la peticion de Eliminar
    $(document).on('click','.elimina',function(){
    //alert("Estamos en Eliminar");
    var cod_pro=$(this).attr('id');
    //alert(cod_pro);

    $.ajax({
        type: "Post",
        url: "acciones/acciones_productos.php",
        data: {codigo:cod_pro,accion:"eliminar_producto"},
        success: function (response) {
        $(lis_pro());
        alert(response);
        $(lis_pro());
        }
    });

    });
    //fin de la peticion de eliminar

     //Agregar
     $('#agregar').click(function () { 
        $('#tcod').focus();//enfocamos a la caja de codigo
        var cod=$('#tcod').val();
        var mar=$('#tmar').val();
        var des=$('#tdes').val();
        var cat=$('#tcat').val();
        var pro=$('#tpro').val();
        var pre=$('#tpre').val();
        var stoc=$('#tsto').val();
        var ubi=$('#tubi').val();  
        
        //validacion si el campo de agregar codigo esta vacio
        if(cod=="" ){
            Swal.fire('Ingrese Codigo')
            return;
        }else{
            if(pro==''){
                Swal.fire('Ingrese Producto')
                pro.focus();
                return;
            }else{
                if(pre==''){   //falta validar para que solo acepte numeros                
                    Swal.fire('Ingrese Precio')
                    pre.focus();
                    return;
                }else{
                    if(stoc==''){
                        Swal.fire('Ingrese Stock')
                        stoc.focus();
                        return;
                    }else{

       // alert(cat);
       // console.log(cat);
        $.ajax({
         type: "POST",
          url: "acciones/acciones_productos.php",
            data: {
                accion:"agregar_producto",
                codigo:cod,
                marca:mar,
                descripcion:des,
                categoria:cat,
                producto:pro,
                precio:pre,
                stock:stoc,
                ubicacion:ubi,
            },
            success: function (response) {
              if(response=="existe"){ //este texto existe lo recojo desde donde se hizo la peticion
               //alert("producto ya existe")
               Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El Producto con el codigo ingresado ya existe',
              })
              }else{
               //alert("Agregado Correctamente");
               Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Producto Guardado con exito',
                showConfirmButton: false,
                timer: 1500
              })
              }
              //$('#exampleModal').modal('hide');//cerramos la ventana modal de agregar
                  $('input[type="text"]').val('');//limpiamos los input
                  $('#tdes').val('');
                $(lis_pro());
               // alert(response);
            } 
        });
    }
}


}


}
    });
     //fin agregar

    ////para buscar el valor a modificar y hacer la peticion 
    $(document).on('click','.modificar',function(){
        var cod_mod=$(this).attr('id');
        //alert(cod_mod);
        $("#mod_act").modal("show"); 
        $("#tcod_ac").prop("disabled", true);
        //$('#tpro_ac').focus();
            $.ajax({
                url: 'acciones/acciones_productos.php',
                method: 'POST',
                data: {cod_act:cod_mod,accion:'buscar_valor'},   

                success: function (response) {
                $('#tpro_ac').focus();
                    var datos=JSON.parse(response);
                
                    for(z in datos){
                    
                        $('#tcod_ac').val(datos[z].cod);
                        $('#tpro_ac').val(datos[z].nom);
                        $('#tcat_actualizar').val(datos[z].cat);
                        $('#tmar_ac').val(datos[z].mar);
                        $('#tubi_ac').val(datos[z].ubi); 
                        $('#tdes_ac').val(datos[z].des);
                        $('#tsto_ac').val(datos[z].sto);
                        $('#tpre_ac').val(datos[z].prere);
                    }
                
                }
            });
            
     });

    //PETICION PARA ACTUALIZAR
    $('#actualizar').click(function () { 
        // alert("vamos a actualizar");
        var cod=$('#tcod_ac').val();
        var pro=$('#tpro_ac').val();
        var cat=$('#tcat_actualizar').val();
        var mar=$('#tmar_ac').val();
        var ubi=$('#tubi_ac').val();
        var des=$('#tdes_ac').val();
        var stoc=$('#tsto_ac').val();
        var pre=$('#tpre_ac').val();   

    //alert (cat);

        $.ajax({
            type: "POST",
            url: "acciones/acciones_productos.php",
            data: {
                accion:"actualizar",
                codigo:cod,
                producto:pro,
                categoria:cat,
                marca:mar,                
                ubicacion:ubi, 
                descripcion:des, 
                stock:stoc,
                precio:pre,
            },
            success: function (response) {
                $('#tpro_ac').focus();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Producto Actualizado Correctamente',
                    showConfirmButton: false,
                    timer: 1500
                  })  
                  $('#mod_act').modal('hide');//cerramos la ventana modal de actualizar
                $(lis_pro());                                         
            }
        }); 
    });
    //FIN DE PETICION

    //ABRIR MODAL CATEGORIA
    $('#icono_cat').click(function (e) { 
        $('#categoria').modal('show');//abrimos la modal 
        $.ajax({
            type: "POST",
            url: "acciones/acciones_productos.php",
            data:{accion:'maximo'},
            success: function (response) {
                $('#tcod_cat').val(response); //mostramos el resultado en la caja del codigo
                $('#tcod_cat').prop("disabled",true); //lo bloqueamos
                $('#tnom_cat').focus();// aki enfocamos
            }
        });
    });
    //FIN

    $('#agregar_categoria').click(function (e) { 
        e.preventDefault();
       var cod_cat=$('#tcod_cat').val();  
       var nom_cat=$('#tnom_cat').val();
        if(nom_cat==''){
            alert("Ingrese Nombre de Categoria por favor");
            $('#tnom_cat').focus();
            return;
        }else{

       
       $.ajax({
           type: "POST",
           url: "acciones/acciones_productos.php",
           data: {accion:'agregar_categoria',cod:cod_cat,nom:nom_cat},
           success: function (response) {
               alert(response);
              $('input[type="text"]').val('');//limpiamos los input
               $('#categoria').modal('hide');
               llenar_categorias(); 
               //recordatoria, falta que despues de agregar la nueva categoria, esta salga ya seleccionada en el combobox de categoria
           }
       });
    } 
    });
});

//falta hacer que la categoria se agregue automaticamente el la lista 