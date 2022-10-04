$(document).ready(function(){
	
		$(listado_proevedores());

	$(document).on('keyup','#txt_bpro',function(e){
		var bus_pro=$('#txt_bpro').val();
		$(listado_proevedores(bus_pro));
	})
	function listado_proevedores(bus_pro){
		var lista;
		$.ajax({
			url: 'acciones/procesos_proevedor.php',
			type: "POST",
			data: {
				accion: 'listar_prove',
				buscar: bus_pro,
			},
			success: function(respuesta){
				if (respuesta=='nodata') {
					lista='no hay datos';
				}else{
						var datos=JSON.parse(respuesta);

						//console.log(respuesta);
						for(i in datos){
							var dni_pro=datos[i].dni_prove;

							lista+=`<tr>
										<td>${datos[i].dni_prove}</td>
										<td>${datos[i].nom_prove}</td>
										<td>${datos[i].ape_prove}</td>
										<td>${datos[i].tel_prove}</td>
										<td>${datos[i].raso_prove}</td>
										<td>${datos[i].ruc_prove}</td>
										<td>${datos[i].dir_prove}</td>
										<td><img class="modificar_pro" id="${dni_pro}" data-bs-toggle="modal" data-bs-target="#modelproevedor" src="img/pencil-fill.svg" alt=""></td>
										<td><img class="elimina_pro" id="${dni_pro}" src="img/trash.svg" alt=""></td>

									</tr>`;
						}
						datos=lista;
						$('#datos_pro').html(lista);
				}
						
			}
		})//fin de ajax
	}//fin funcion listar proveevedor con buscardor

$(document).on('click','.elimina_pro',function(e){
	var dni_eli=$(e.target).attr('id');
	$.ajax({
			url: 'acciones/procesos_proevedor.php',
			type: "POST",
			data: {
				accion: 'eliminar_pro',
				dni_a_eli: dni_eli,
			},	
			success: function(respuesta){
			Swal.fire({
			  title: 'Estamos Eliminando Proevedor!',
			  html: 'I will close in <b></b> milliseconds.',
			  timer: 2000,
			  timerProgressBar: true,
			  didOpen: () => {
			    Swal.showLoading()
			    const b = Swal.getHtmlContainer().querySelector('b')
			    timerInterval = setInterval(() => {
			      b.textContent = Swal.getTimerLeft()
			    }, 100)
			  },
			  willClose: () => {
			    clearInterval(timerInterval)
			  }
			}).then((result) => {
			  /* Read more about handling dismissals below */
			  if (result.dismiss === Swal.DismissReason.timer) {
			    console.log('Estamos eliminado Registro');
			  }
			})
				$(listado_proevedores());
			}	
	})
})//fin de funcion eliminar


	$(document).on('click','#btn_guap',function(){

		var dnip=$('#txt_dnip').val();
		var nomp=$('#txt_nomp').val();
		var apep=$('#txt_apep').val();
		var telp=$('#txt_telp').val();
		var razop=$('#txt_razp').val();
		var rucp=$('#txt_rucp').val();
		var dirp=$('#txt_dirp').val(); 
		if (dnip=='') {
			$('#error1').fadeIn();
			$('#txt_dnip').focus();
			return false;
		}		
		if (nomp=='') {
			$('#error1').fadeOut();//desvanece
			$('#error3').fadeOut();
			$('#error2').fadeIn();
			$('#txt_nomp').focus();
			return false;
		}
		if (apep=='') {
			$('#error1').fadeOut();
			$('#error2').fadeOut();
			$('#error3').fadeIn();
			$('#txt_apep').focus();
			return false;
		}else{
			$('#error1').fadeOut();
			$('#error2').fadeOut();
			$('#error3').fadeOut();
			$.ajax({
				url: 'acciones/procesos_proevedor.php',
				type: "POST",
				data: {
					accion: 'insertar_prove',
					dni_p: dnip,
					nom_p: nomp,
					ape_p: apep,
					tel_p: telp,
					raz_p: razop,
					ruc_p: rucp,
					dir_p: dirp,
				},
				success: function(respuesta){
					if(respuesta==1){
						$('#error1').fadeIn();
						Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Proevedor Guardao Con Exito',
						  showConfirmButton: false,
						  timer: 1500
						})

					}else{
							$('#error1').text(' Este Proevedor Ya Existe');
							$('#error1').fadeIn();
							$('#txt_dnip').val('');
							$('#txt_dnip').focus();	
					}
					$('#error1').fadeOut();
					$(listado_proevedores());
					$('#txt_dnip').focus();

				}
				
			});
		}
	})//fin de la funcion guardar
	$(document).on('click','.modificar_pro',function(e){
		$('#text_agre').hide();
		$('#text_act').show();
		$('#btn_actp').show();
		$('#btn_guap').hide();
		var dni_mod=$(e.target).attr('id');
		$.ajax({
				url: 'acciones/procesos_proevedor.php',
				type: "POST",
				data: {
					accion: 'listar_prove',
					dni_a_mod: dni_mod,
				},
				success: function(respuesta){
					var lista=JSON.parse(respuesta);
					$('#txt_dnip').val(lista[0].dni_prove);
					$('#txt_nomp').val(lista[0].nom_prove);
					$('#txt_apep').val(lista[0].ape_prove);
					$('#txt_telp').val(lista[0].tel_prove);
					$('#txt_razp').val(lista[0].raso_prove);
					$('#txt_rucp').val(lista[0].ruc_prove);
					$('#txt_dirp').val(lista[0].dir_prove);
					$('#txt_dnip').attr('disabled','disabled');
				}
		})
	})//fin de la funcion listar por dni para modificar

	$(document).on('click','#btn_actp',function(){
		var dni_pm=$('#txt_dnip').val();
		var nom_pm=$('#txt_nomp').val();
		var ape_pm=$('#txt_apep').val();
		var tel_pm=$('#txt_telp').val();
		var raz_pm=$('#txt_razp').val();
		var ruc_pm=$('#txt_rucp').val();
		var dir_pm=$('#txt_dirp').val();
		$.ajax({
			url: 'acciones/procesos_proevedor.php',
			type: "POST",
			data: {
				accion: 'modificar_pro',
				dni_pmo: dni_pm,
				nom_pmo: nom_pm,
				ape_pmo: ape_pm,
				tel_pmo: tel_pm,
				raz_pmo: raz_pm,
				ruc_pmo: ruc_pm,
				dir_pmo: dir_pm,
			},
			success: function(respuesta){
					Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Proevedor Actualizado Con Exito',
						  showConfirmButton: false,
						  timer: 1500
					})
				$(listado_proevedores());
			}
		})

	})

	
//procesos de completo
$(document).on('click','#ing_agre',function(){
	$('#btn_actp').hide();
	$('#btn_guap').show();
	$('#text_act').hide();
	$('#text_agre').show();
	$('#txt_dnip').removeAttr('disabled');
	limpiar_cajas_pro();
	//$('#txt_dnip').focus();
})

function limpiar_cajas_pro(){
	$('#txt_dnip').val('');
	$('#txt_nomp').val('');
	$('#txt_apep').val('');
	$('#txt_telp').val('');
	$('#txt_razp').val('');
	$('#txt_rucp').val('');
	$('#txt_dirp').val('');
	
}


})//sierre de dom