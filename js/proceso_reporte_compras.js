$(document).ready(function () {

	listar_compras();

	function listar_compras(bus_pro){
        if(bus_pro==''){
            $('#datos').html('');
            $('#ttotal').val('');
        }else{
        $.ajax({
            type: "POST",
            url: "acciones/acciones_reporte_compras.php",
            data: {accion:'ver_compras',
            bus:bus_pro,},
            success: function (response) {
                if(response=='no_hay_compras'){
                    $('#datos').html('Compra no existe');
                    $('#ttotal').val('');
                }else{              
                var datos=JSON.parse(response);
                var tabla;
                var total=0;

                for (z in datos){
                    var codigo=datos[z].codigo
                    tabla+=`<tr>
									<td>${datos[z].codigo}</td>
									<td>${datos[z].datos2+' '+datos[z].datos3}</td>
									<td>${datos[z].nombre_usu+' '+datos[z].apellido_usu}</td>
									<td>S/.${datos[z].neto}</td>
									<td>${datos[z].tipo}</td>
									<td>S/.${datos[z].descuento}</td>
									<td ><img style="width: 30px;" class="detalle" id="${datos[z].codigo}"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" src="img/optometry.png" alt=""></td>
	

								</tr>`;	


                   
                    total+=parseFloat(datos[z].neto-datos[z].descuento);
                }
                $('#datos').html(tabla);
                //console.log(response);
                $('#ttotal').val(parseFloat(total).toFixed(2));
            }
            }
        });
    }
	}
$('#tpro').keyup(function (e) { 
    this.value = this.value.replace(/[^-0-9]/g, '');
    var pro=$(this).val();
    listar_compras(pro);
});


function fechas(){
    var fi=$('#tfi').val()
    var ff=$('#tff').val();
    $.ajax({
        type: "POST",
        url: "acciones/acciones_reporte_compras.php",
        data:{accion:'fechas',
        fi:fi,
        ff:ff},
        success: function (response) {
            var datos=JSON.parse(response);
            var tabla;
            var total=0;
            for (z in datos){
                tabla+=`<tr>
                <td>${datos[z].codigo}</td>
                <td>${datos[z].datos2+' '+datos[z].datos3}</td>
                <td>${datos[z].nombre_usu+' '+datos[z].apellido_usu}</td>
                <td>S/. ${datos[z].neto}</td>
                <td>${datos[z].tipo}</td>
                <td>S/.${datos[z].descuento}</td>
                <td ><img style="width: 30px;" class="detalle" id="${datos[z].codigo}"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" src="img/optometry.png" alt=""></td>
        
            </tr>`;	
                total+=parseFloat(datos[z].neto)-datos[z].descuento;
            }
            $('#datos').html(tabla);
        //    console.log(response);
            $('#ttotal').val(parseFloat(total).toFixed(2));
        }
    });
}

$('#tbus').click(function (e) { 
    fechas();
});


$(document).on('click','.detalle',function(){
var cod=$(this).attr('id');
var tabla;
        $.ajax({
            type: "POST",
            url: "acciones/acciones_reporte_compras.php",
            data:{accion:'mostrar_datos',codigo:cod},
            success: function (response) {
               // alert(response)
                console.log(response)
                var datos=JSON.parse(response);
               
                for (z in datos){
                     tabla+='<tr>'+
                    '<td>'+datos[z].nombre_pro+'</td>'+
                    '<td>'+datos[z].cantidad+'</td>'+
                    '<td>'+datos[z].precio+'</td>'+
                    '</tr>' 
                }
                   
                
                $('#datos_detalle').html(tabla);
            }
        });
});


$('#print_rep').click(function(){
    var mode='iframe';
    var close=mode=="popup";
    var options={
        mode: mode,
        popClose:close,
                
    };
    $('#tabla_reporte').show().printArea(options);//imprimimos
})
});