$(document).ready(function () {
	//vamos a listar las ventas por dia
	listar_ventas();
	$('#txt_bve').keyup(function(e){
		var buscardor=$('#txt_bve').val();
		$(listar_ventas(buscardor));
	})
	function listar_ventas(buscardor){
		var fec_dia=$('#txt_ffi').val();
		var listado_v;
		$.ajax({
			url: 'acciones/proceso_reporte_ventas.php',
			type: "POST",
			data: {
				accion: 'mostrar_ventas',
				fecha: fec_dia,
				bus: buscardor,
			},
			success: function(respuesta){
				var list_ventas=JSON.parse(respuesta);
				var cod_tmp;
				var comprovante;
				var estado;
				var neto;
				var codigo_ven;
				var total_rep=0;
				var anular;
				for(i in list_ventas){
					if (list_ventas[i].dni_cli==null) {
						cod_tmp="00000000";
					}else{
					    cod_tmp=list_ventas[i].dni_cli;
					}
					if (list_ventas[i].tip_con==1) {
						comprovante="Ticked";
					}else if (list_ventas[i].tip_con==2) {
						comprovante="Factura";
					}else{
						comprovante="Boleta";
					}
					neto=list_ventas[i].net_ven;
					codigo_ven=list_ventas[i].cod_ven;
					if (list_ventas[i].est_ven==1) {
						estado='<span style="color: #4BC304;"><i class="fas fa-check"></i></span>';			
						total_rep+=parseFloat(neto);
					}else{
						estado='<span style="color: red;"><i class="fas fa-times"></i></span>';
					}

					listado_v+=`<tr>
									<td>${codigo_ven}</td>
									<td>${cod_tmp}</td>
									<td>${list_ventas[i].datos_usuario}</td>
									<td>${neto}</td>
									<td>${comprovante}</td>
									<td>${estado}</td>
									<td ><img style="width: 30px;" class="detalle" id="${codigo_ven}"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" src="img/optometry.png" alt=""></td>
									<td id="pruev"><img style="width: 30px;" class="anular" id="${codigo_ven}" src="img/eliminar1.png"></td>									

								</tr>`;	
							
					$('#datos_ventas').html(listado_v);	
					$('#tot_rep').val(parseFloat(total_rep).toFixed(2));// imprimimos total
				}
			}
		});
	}
	//Procedimiento para calcular importe a pagar a la sunat
	$('#imp_sun').click(function(){
		var ini_mes=$('#txt_fin').val();
		var fin_mes=$('#txt_ffi').val();
		if (ini_mes==0) {
			alert("ingrese fecha de Inicio de Mes");
			$('#txt_fin').focus();
			return;
		}else{
			var tip_doc;
			var tot_doc2=0;
			var tot_doc3=0;
			var net_importe;
			var sum_com_bol=0;
			var sum_com_fac=0;
			var tip_doc_ven;
			var tot_comp=0;
			
			$.ajax({
				url: 'acciones/proceso_reporte_ventas.php',
				type: "POST",
				data: {
					accion: 'calcular_importe',
					i_mes: ini_mes,
					f_mes: fin_mes,
				},
				success: function(respuesta){			
					var lista_ven_com=JSON.parse(respuesta);
					console.log(lista_ven_com);
					for(i in lista_ven_com){
						tip_doc=lista_ven_com[i].tip_con;
						if (tip_doc==2) {
							 tot_doc2+=parseFloat(lista_ven_com[i].net_ven);	
						}
						if (tip_doc==3) {
							tot_doc3+=parseFloat(lista_ven_com[i].net_ven);
						}
						tip_doc_ven=lista_ven_com[i].tip_com;
						if (tip_doc_ven=='boleta') {
							sum_com_bol+=parseFloat(lista_ven_com[i].net_com);
						}
						if (tip_doc_ven=='factura') {
							sum_com_fac+=parseFloat(lista_ven_com[i].net_com);	
						}
						tot_comp=(sum_com_bol+sum_com_fac).toFixed(2);
						net_importe=((tot_doc2+tot_doc3)-tot_comp).toFixed(2);
						$('#importe_sun').val(net_importe);
						
					}

				}
			});
		}
	});
	$('#bus_rangos').click(function(){
		if ($('#txt_fin').val().length < 1 && $('#txt_ffi').val().length > 1) {
			listar_ventas();
			
		}else if ($('#txt_fin').val().length > 1 && $('#txt_ffi').val().length > 1) {
			listar_rangos();	
		}
	});

	function listar_rangos(){
		var fecha_ini=$('#txt_fin').val();
		var fecha_fin=$('#txt_ffi').val();
		var listado_ve;
		var listado_rangos;
		$.ajax({
			url: 'acciones/proceso_reporte_ventas.php',
			type: "POST",
			data: {
				accion: 'mostrar_ventas',
				f_i: fecha_ini,
				f_f: fecha_fin,
			},
			success: function(respuesta){
				var list_venta=JSON.parse(respuesta);
				console.log(list_venta);
				var cod_tmp;
				var comprovante;
				var estado;
				var neto2;
				var total_repo=0;
				var codigo_ven;
				for(i in list_venta){
					if (list_venta[i].dni_cli==null) {
						cod_tmp="00000000";
					}else{
					    cod_tmp=list_venta[i].dni_cli;
					}
					if (list_venta[i].tip_con==1) {
						comprovante="Ticked";
					}else if (list_venta[i].tip_con==2) {
						comprovante="Factura";
					}else{
						comprovante="Boleta";
					}
					neto2=list_venta[i].net_ven;
					if (list_venta[i].est_ven==1) {
						estado='<span style="color: #4BC304;"><i class="fas fa-check"></i></span>';
						total_repo+=parseFloat(neto2);//sumanos las ventas que estn exitosas
					}else{
						estado='<span style="color: red;"><i class="fas fa-times"></i></span>';
					}					
						
						codigo_ven=list_venta[i].cod_ven;
						
						if ($('#txt_fin').val().length > 0 & $('#txt_ffi').val().length >0) {
						
							listado_rangos+=`<tr>
							
										<td>${codigo_ven}</td>
										<td>${cod_tmp}</td>
										<td>${list_venta[i].datos_usuario}</td>
										<td>${neto2}</td>
										<td>${comprovante}</td>
										<td>${estado}</td>
										<td ><img  style="width: 30px;" class="detalle" id="${codigo_ven}"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" src="img/optometry.png" alt=""></td>
										<td id="prue"><img style="width: 30px;" class="anular" id="${codigo_ven}" src="img/eliminar1.png"></td>
									</tr>`;

							$('#datos_ventas').html(listado_rangos);
							$('#tot_rep').val(parseFloat(total_repo).toFixed(2));// imprimimos total	
						}											
				}

			}
			
		});	
	}

	$(document).on('click','.anular',function(e){
		 var anula=$(this).attr('id');
		 console.log(anula);

					Swal.fire({
				  title: 'Esta seguro de Anular esta Venta?',
				  showDenyButton: true,
				  
				  confirmButtonText: 'Anular',
				  denyButtonText: `Cancelar`,
				}).then((result) => {
					  /* Read more about isConfirmed, isDenied below */
					  if (result.isConfirmed) {

					    Swal.fire('Venta Anulada Con Exito!', '', 'success')
					  		$.ajax({
								url: 'acciones/proceso_reporte_ventas.php',
								type: "POST",
								data: {
									accion: 'anular_venta',
									cod_v: anula,
								},
								success: function(respuesta){
									//validar listados
									if ($('#txt_fin').val().length < 1 && $('#txt_ffi').val().length > 1) {
										listar_ventas();
										
									}else if ($('#txt_fin').val().length > 1 && $('#txt_ffi').val().length > 1) {
										listar_rangos();	
									}
																/*var bloquear=$('.anular')[0];
									$('#pruev').find(bloquear).prop( 'disabled',true );*/

																		
								}
							});
					  	
					  } else if (result.isDenied) {
					    Swal.fire('Gracias Por Cancelar Anulacion', '', 'info')
					     anular=null;
					  }
					  
				})
		
	});	//fin de anular

	$(document).on('click','.detalle',function(e){
		var cod_det=$(this).attr('id');
		var list_deta;
		$.ajax({
			url:'acciones/proceso_reporte_ventas.php',
			type: "POST",
			data: {
				accion: 'mostar_detalle',
				cod_deta: cod_det,
			},
			success: function(respuesta){
				var lista_detalle=JSON.parse(respuesta);
				console.log(lista_detalle);
				
				for(i in lista_detalle){
					list_deta+=`<tr>
							<td>${lista_detalle[i].nom_pro}</td>
							<td>${lista_detalle[i].des_pro}</td>
							<td>${lista_detalle[i].can_pro}</td>
							<td>${lista_detalle[i].des_ven}</td>
							<td>${lista_detalle[i].pre_pro}</td>

					</tr>`;
					$('#datos_detalle').html(list_deta);
				}
			}
		});
	})
	//codigo de ayuda
	$('#ir_ven').click(function(){
		$('#contenido').load("vistas/ventas.php");
	})
	$('#print_rep').click(function(){
		var mode='iframe';
		var close=mode=="popup";
		var options={
			mode: mode,
			popClose:close,
					
		};
		$('#tbl_reporte').show().printArea(options);//imprimimos
	})


});//cierre  de dom