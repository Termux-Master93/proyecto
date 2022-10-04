$(document).ready(function(){
		
		$(listar_clientes());//llamamos el listar todos
	
	$(document).on('keyup',function(e){
  		var buscador=$('#txt_bus').val();
  		$(listar_clientes(buscador));//listamos por parametro
	})
	function listar_clientes(buscador){
		var list;
		$.ajax({
			async: true,
			url: 'acciones/procesos_clientes.php',
			type: "POST",
			data: {
				proceso: 'listado_cli',
				buscar: buscador,
			},
			success: function(respuesta){		
				if (respuesta=='nodata') {
					list="no hay datos";
					$('#datos').html(list);
				}else{
					var datos=JSON.parse(respuesta);
					for(i in datos){
					var dni_cli=datos[i].dni_cli;
					
					list+=`<tr>
								<td>${dni_cli}</td>
								<td>${datos[i].nom_cli}</td>
								<td>${datos[i].ape_cli}</td>
								<td>${datos[i].tel_cli}</td>
								<td>${datos[i].dir_cli}</td>
								<td>${datos[i].ruc_cli}</td>
								<td><img class="modificar" id="${dni_cli}" data-bs-toggle="modal" data-bs-target="#exampleModal" src="img/pencil-fill.svg" alt=""></td>
								<td><img class="elimina" id="${dni_cli}" src="img/trash.svg"></td>
							</tr>`;

					$('#datos').html(list);
					}
				}
			}
			
		});

	};//fin de funcion listar

	$(document).on('click','.elimina', function(e){
		var dni_client=$(e.target).attr('id');

	
		$.ajax({
			async: true,
			url: 'acciones/procesos_clientes.php',
			type: "POST",
			data:{
				dni_eli: dni_client,
				proceso: 'eliminar',
			}, 
			success: function(respuesta){
				$(listar_clientes());

				$('.elimina').off('click');
				$(listar_clientes());
			}

		})

	})//fin de funcion eliminar

$(document).on('click','#btn_gua',function(e){
	var dni_c=$('#txt_dni').val();
	var nom_c=$('#txt_nom').val();
	var ape_c=$('#txt_ape').val();
	var tel_c=$('#txt_tel').val();
	var dir_c=$('#txt_dir').val();
	var ruc_c=$('#txt_ruc').val();
	if(dni_c==''){
		$('#error1').fadeIn();
		$('#txt_dni').focus();
		return false;
	}else if(nom_c==''){
		$('#error1').fadeOut();
		$('#error2').fadeIn();
		$('#txt_nom').focus();
		return false;
	}else if(ape_c==''){
		$('#error2').fadeOut();//lo desvanece
		$('#error3').fadeIn();
		$('#txt_ape').focus();
		return false;
	}else{
		$('#error3').fadeOut();
		$.ajax({
			async: true,
			url: 'acciones/procesos_clientes.php',
			type: "POST",
			data: {
				proceso: 'agregar',
				dni_c: dni_c,
				nom_c: nom_c,
				ape_c: ape_c,
				tel_c: tel_c,
				dir_c: dir_c,
				ruc_c: ruc_c,
			},
			success: function(respuesta){
			if(respuesta==1){
				$('#error1').fadeIn();
				Swal.fire({
				  position: 'center',
				  icon: 'success',
				  title: 'Cliente Guardao Con Exito',
				  showConfirmButton: false,
				  timer: 1500
				})

			}else{
					$('#error1').text(' Este Cliente Ya Existe');
					$('#error1').fadeIn();
					$('#txt_dni').val('');
					$('#txt_dni').focus();	
			}
			$('#error1').fadeOut();
			$(listar_clientes());	
			$('#txt_dni').focus();

			}	
			
		})

	}

})//cierre de la funcion Modificar

$(document).on('click','.modificar',function(e){
	$('#error1').fadeOut();
	$('#error2').fadeOut();
	$('#error3').fadeOut();
	var dni_cl=$(e.target).attr('id');
	$.ajax({
		async: true,
		url: 'acciones/procesos_clientes.php',
		type: "POST",
		data: {
			bus_dni_c: dni_cl,
		},
		success: function(respuesta){
			var list=JSON.parse(respuesta);
				//asignamos valores buscados con el codigo enviado cuando hacemos click en el lapiz)
			$('#txt_dni').val(list[0].dni_cli);
			$('#txt_nom').val(list[0].nom_cli);
			$('#txt_ape').val(list[0].ape_cli);
			$('#txt_tel').val(list[0].tel_cli);
			$('#txt_dir').val(list[0].dir_cli);
			$('#txt_ruc').val(list[0].ruc_cli);
			$('#txt_dni').attr('disabled','disabled');
			}
			
		});
		$('#btn_gua').hide();//ocultamos el boton guardar
		$('#btn_act').show();//mostramos
})//fin de lafuncion modificar

$(document).on('click','#btn_act',function(){
	var dni=$('#txt_dni').val();
	var nom=$('#txt_nom').val();
	var ape=$('#txt_ape').val();
	var tel=$('#txt_tel').val();
	var dir=$('#txt_dir').val();
	var ruc=$('#txt_ruc').val();
	$.ajax({
		async: true,
		url: 'acciones/procesos_clientes.php',
		type: "POST",
		data:{
			proceso: 'actualizar_cli',
			dni: dni,
			nom: nom,
			ape: ape,
			tel: tel,
			dir: dir,
			ruc: ruc,
		},
		success:function(respuesta){
			$(listar_clientes());
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Cliente Actualizado Con Exito',
				showConfirmButton: false,
				timer: 1500
			})
		}
	})
})	

//procesos secundarios
function limpiar(){ //funcion limpiar
	$('#txt_dni').val('');	
	$('#txt_nom').val('');
	$('#txt_ape').val('');
	$('#txt_tel').val('');
	$('#txt_dir').val('');
	$('#txt_ruc').val('');
}
$(document).on('click','#boton',function(){
	$('#btn_act').hide();
	$('#btn_gua').show();
	$('#txt_dni').removeAttr('disabled');
	limpiar();
})




})