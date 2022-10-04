$(document).ready(function () {

	//el cuadro de informacion del producto oculto
	$('#con_oculto').hide();
	$('#cod_ven').prop('disabled',true);
	$('#fet_ven').prop('disabled',true);
	var d = new Date();
	var month = d.getMonth()+1;
	var day = d.getDate();
	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes() + ":" + (dt.getSeconds()+4);
	var codigo_dventa = d.getFullYear() + '/' +
		   (month<10 ? '0' : '') + month + '/' +
	    (day<10 ? '0' : '') + day+' | '+time;
		   console.log(codigo_dventa);
		   $('#cod_ven').val(codigo_dventa);
		
	//usamos el evento change para 
	//enviar el valor de la caja del datalst para poder consultar y mostrar
	$(document).on('keyup','#dni_cli',function(){
		var valor_cli=$(this).val();//cacturamos el valor de la caja
		//$('#cli_bus').val(valor_cli);
		$.ajax({
			url: 'acciones/procesos_ventas.php',
			type: "POST",
			data: {
				accion: 'buscar_cliente',
				dni_clie: valor_cli,
			},
			success: function(respuesta){
				console.log(respuesta);
				$('#buscar_cliente').html(respuesta);
				//$('#cli_bus').text(valor_cli);	 
			}

		})

	})
	//---------------------VER BIEN ESTE CODIGO-----------------------------
	//obtenemos el texto de lo que sellecione en el datalist por data_id y mostramos valor en otra caja
	$(document).on('change','#dni_cli',function(){
		var nom_cli=($("#buscar_cliente option[value='" + $('#dni_cli').val() + "']").attr('data_id'));
		$('#cli_bus').val(nom_cli);
	});

	//para poder agrregar un nuevo cliente
	$(document).on('click','#btn_gcv',function(){
		//recogo los valores de las cajas
		let dni_cli=$('#txt_dni_v').val();
		let nom_cli=$('#txt_nom_v').val();
		let ape_cli=$('#txt_ape_v').val();
		let tel_cli=$('#txt_tel_v').val();
		let dir_cli=$('#txt_dir_v').val();
		let ruc_cli=$('#txt_ruc_v').val();
		//abro ajax
		if (dni_cli=='') {
			$('#error1').fadeIn();//aparese mnsaje
			$('#txt_dni_v').focus();//enfocamos
			return false;
		}
		if (nom_cli=='') {
			$('#error1').fadeOut();//desvanece
			$('#error3').fadeOut();
			$('#error2').fadeIn();
			$('#txt_nom_v').focus();
			return false;
		}
		if (ape_cli=='') {
			$('#error1').fadeOut();//desvanece
			$('#error2').fadeOut();//desvanece
			$('#error3').fadeIn();
			$('#txt_ape_v').focus();
			return false;
		}else{
			$('#error1').fadeOut();
			$('#error2').fadeOut();
			$('#error3').fadeOut();
			$.ajax({
				url: 'acciones/procesos_ventas.php',
				type: "POST",
				data: {
					accion: 'nuevo_cliente',
					dni_c: dni_cli,
					nom_c: nom_cli,
					ape_c: ape_cli,
					tel_c: tel_cli,
					dir_c: dir_cli,
					ruc_c: ruc_cli,
				},
				success: function(respuesta){
					if(respuesta==1){//si la respuesta es 1 significa que ya hay un dni igual
						$('#error1').fadeIn();
						Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Cliente Agregado a Venta',
						  showConfirmButton: false,
						  timer: 1500
						})

					}else{
							$('#error1').text(' Este clienteYa Existe');
							$('#error1').fadeIn();
							$('#txt_dni_v').val('');
							$('#txt_dni_v').focus();	
					}
					$('#error1').fadeOut();
					$('#txt_dni_v').focus();
					$('#dni_cli').val(dni_cli);
					$('#cli_bus').val(nom_cli+' '+ape_cli)

				}

			})		
		}//fin de caso contrario
	})

//vamos abuscar los productos
$(document).on('keyup','#cod_pro',function(){
	var nom_pro=$(this).val();
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'buscar_producto',
			nom_p: nom_pro,
		},
		success: function(respuesta){
			$('#buscar_producto').html(respuesta);
		}
	})
})
//mostramos los datos por seleccion de prordcucto buscado 
$(document).on('change','#cod_pro',function(){
	var cod_p=$(this).val();
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'mostrar_datos_producto',
			cod_pr: cod_p,
		},
		success: function(respuesta){
			var datos_pro=JSON.parse(respuesta);
			var des_pro=datos_pro[0].des_pro;
			var nom_pro=datos_pro[0].nom_pro;
			var pre_pro=datos_pro[0].prere_pro;
			var sto_pro=datos_pro[0].sto_pro;
			$('#ocultar_des').show();
			$('.nom_produc').html(nom_pro);
			$('#des').html(des_pro);//mostramos descricion
			$('#stock').html(sto_pro).css("color","red");//mostramos stock
			$('#pre_pro').val(pre_pro);
			$('#des_pro').val(0);
			//validamos stock minimo
			var stock_min=$('#stock').html();//almacenamos el stock
			if (stock_min < 5) {//validamos stock menos de 5
				$('#error_stc').fadeIn();
			}else{
				$('#error_stc').fadeOut();//error de stock bajo
			}

		}
	})
})	 	

//agregar productos a la tabla desde el click al carrito
$('#btn_com').click(function(){
	var cod_ven=$('#cod_ven').val();
	var cod_pro=$('#cod_pro').val();
	var can_pro=$('#can_pro').val();
	var des_pr=$('#des_pro').val();
	var pre_pro=$('#pre_pro').val();
	var stock_min=$('#stock').html();//almacenamos el stock

	if (cod_pro=='') {
		$('#error_pro').fadeIn();
		$('#cod_pro').focus();
		return false;
	}
	if (can_pro=='') {
		$('#error_cant').fadeIn();
		$('#error_pro').fadeOut();
		$('#can_pro').focus();

		return false;
	}
	if (stock_min==0) {//validamos stock cuando no hay nada
		 
		Swal.fire({
		  title: 'No Hay Stock De Este Producto',
		  showClass: {
		    popup: 'animate__animated animate__fadeInDown'
		  },
		  hideClass: {
		    popup: 'animate__animated animate__fadeOutUp'
		  }
		})
		limpiar_datos_productos();
		return false;
		
	}else{
		$.ajax({
			url: 'acciones/procesos_ventas.php',
			type: "POST",
			data: {
				accion: 'carrito_compras',
				cod_v: cod_ven,
				cod_p: cod_pro,
				can_p: can_pro,
				des_p: des_pr,
				pre_p: pre_pro,
			},
			success: function(respuesta){
				listar_tabletmp();//llamamos a la funcion listar producos
				//vamos hacer los totales
				$('#error_cant').fadeOut();
				$('#error_pro').fadeOut();
				$('#error_stc').fadeOut();//error de stock bajo
				$('#error_nom').fadeOut();
				limpiar_datos_productos();//limpiamos el producto de los imputs
			}
		});
	}//fin de else
})

//funcion para controlar el listado de productos en la tabla temporal y hai mismo caculamos el total por producto
function listar_tabletmp(){
	var cod_ven=$('#cod_ven').val();
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'listando_productos',
			cod_ve: cod_ven,
		},
		success: function(respuesta){
			var datos_producto=JSON.parse(respuesta);
			//console.log(datos_producto);
			var lista_productos;
			var lista_comprovante;
			var lista_factura;
			var lista_boleta;
			var tot_pro=0;
			var sumador_tot=0;
			var t_base=0;
			var t_igv=0;
			var total_pro=0;
			for(i in datos_producto){
				var conta=datos_producto[i].contador;
				var cod_venta=datos_producto[i].cod_ven;
				var cant=datos_producto[i].can_pro;
				var prec=datos_producto[i].pre_pro;
				var desct=parseFloat(datos_producto[i].desct_pro);
					 tot_pro=parseFloat((cant*prec)).toFixed(2);
					 total_pro=parseFloat((tot_pro-desct).toFixed(2));
				
				lista_productos+=`<tr>
									<td>${datos_producto[i].nom_pro}</td>
									<td>${datos_producto[i].can_pro}</td>
									<td>${datos_producto[i].des_pro}</td>
									<td>${datos_producto[i].desct_pro}</td>
									<td>${datos_producto[i].pre_pro}</td>
									<td id="total_pro">S/.${total_pro}</td>
									<td><img class="modifica_vtmp" id="${conta}" src="img/pencil-fill.svg" alt=""></td>
									<td><img class="elimina_vtmp" id="${conta}" src="img/trash.svg" alt=""></td>
								</tr>`;
								sumador_tot=(sumador_tot+total_pro);//sumamos el total
								t_base=parseFloat((sumador_tot/1.18).toFixed(2));
								t_igv=parseFloat((sumador_tot-t_base).toFixed(2));
							
								$('#total').val(t_base);
								$('#igv').val(t_igv);
								$('#neto').val(parseFloat(sumador_tot).toFixed(2));

								//llenamos los datos del comprovante
				lista_comprovante+=`<tr>
									<td><h6>${datos_producto[i].nom_pro}, ${datos_producto[i].des_pro}</h6></td>
									<td>${datos_producto[i].can_pro}</td>
									<td>${datos_producto[i].pre_pro}</td>
									<td id="total_pro">S/.${total_pro}</td>
								</tr>`;	
				lista_factura=lista_comprovante;//le ifualamos los valores a una nueva lista
				lista_boleta=list_comprovante;
				$('#list_productos').html(lista_productos);
				$('#list_comprovante').html(lista_comprovante);
				$('#list_factura').html(lista_factura);//carrito factura
				$('#list_boleta').html(lista_factura);//carrito boleta
				$('#net_con').html(parseFloat(sumador_tot).toFixed(2));//total del conprovante
				//datos factura
				$('#gra_fac').html(t_base);
				$('#exo_fac').html('0.0');
				$('#igv_fac').html(t_igv);
				$('#net_fac').html(sumador_tot);
				//datos boleta
				$('#gra_bol').html(t_base);
				$('#exo_bol').html('0.0');
				$('#igv_bol').html(t_igv);
				$('#net_bol').html(sumador_tot);

			}
		}
	})
}
//calculamos el neto segun descuento
$(document).on('keyup','#nue_des',function(){
	var desc=$(this).val();
	var total=$('#total').val();
	var neto=(total-desc);
	$('#neto').val(neto);

})

//acion para eliminar cuando yo de clik en la imagen eliminar
$(document).on('click','.elimina_vtmp',function(e){
	var cont=$(e.target).attr('id');//cojemos el id como atributo
   var row = $(this).parents('tr')//cojemos el tr que seleccionamos en la imagen de eliminar
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'eliminar_pro_car',
			cod_v: cont,
		},
		success: function(respuesta){
			console.log(respuesta);
			$(row).remove();//elimina hasta el primero
			listar_tabletmp();
	 		
		}

	})

});
//Listamos producto a modificar
$(document).on('click','.modifica_vtmp',function(e){
	var cont=$(e.target).attr('id');
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'listando_productos',
			contad: cont,
		},
		success: function(respuesta){
			var datos_producto=JSON.parse(respuesta);//parsemaos los datos del produco a modificar
			console.log(datos_producto);
			$('#cod_pro').val(datos_producto[0].cod_pro);
			$('#can_pro').val(datos_producto[0].can_pro);
			$('#pre_pro').val(datos_producto[0].pre_pro);
			$('#des_pro').val(datos_producto[0].des_pro);
			$('#con_oculto').val(datos_producto[0].contador);
			//activamos el boton actualizar y bloqueamos el boton agregar compras
			$('#btn_acp').show();
			$('#btn_com').hide();
			$('#cod_pro').attr('disabled','disabled');//codigo
			$('#pre_pro').attr('disabled','disabled');//precio
		}
	})
});
//UPDATE PRODUCT OF CARD FOR SALE
$(document).on('click','#btn_acp',function(){
	var cod_v=$('#cod_ven').val();
	var pro_act=$('#cod_pro').val();
	var can_act=$('#can_pro').val();
	var pre_act=$('#pre_pro').val();
	var des_act=$('#des_pro').val();
	var con_act=$('#con_oculto').val();
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'modificar_producto',
			co_act: con_act,
			cod_vent: cod_v,
			id_act: pro_act,
			c_act: can_act,
			p_act: pre_act,
			d_act: des_act,
		},
		success: function(respuesta){
			
			listar_tabletmp();
			$('#btn_com').show();
			$('#cod_pro').removeAttr('disabled');
			$('#pre_pro').removeAttr('disabled');
			limpiar_datos_productos();
			$('#btn_acp').hide();


		}
	})
})
//validamos tipos de comprovante
$('#tip_con').click(function(){
	var tipo_con=$("#tip_con option:selected").val();
	if (tipo_con==1) {
		$('#dni_cli').attr("disabled","disabled");
		$('#cli_bus').attr("disabled","disabled");

	}
	if (tipo_con==2) {
		$('#dni_cli').removeAttr('disabled');
		$('#cli_bus').removeAttr('disabled');
	}
	if (tipo_con==3) {
		$('#dni_cli').removeAttr('disabled');
		$('#cli_bus').removeAttr('disabled');
	}
})
//vamos agregar la venta
$(document).on('click','#btn_nuev',function(){
	var tip_con=$("#tip_con option:selected").val();
	var dni_cliente=$("#dni_cli").val();
	var cli_buscado=$('#cli_bus').val();
	if (tip_con==0) {
		$('#error_tic').fadeIn();
		$('#tip_con').focus();
		return false;
	}
	//if this selected factura and input is null
	if (tip_con==2 &  dni_cliente=='') {
			$('#error_bdni').fadeIn();
			$('#dni_cli').focus();
			$('#error_tic').fadeOut();
			return false;		
	}if (tip_con==3 &  cli_buscado=='') {
			$('#error_nom').fadeIn();
			$('#dni_nom').focus();
			$('#error_tic').fadeOut();
			return false;		
	}else{
			//recogemos los datos ainsertar	
			var cod_ven=$('#cod_ven').val();
			var dni_usu=$('#user').html();
		    var dni_cli=$('#dni_cli').val().trim();
			var fec_ven=$('#fet_ven').val();
			var tot_ven=$('#total').val();
			var des_ven=$('#igv').val();
			var net_ven=$('#neto').val();
			var tipo_p=1;
			var rup_cli_ven=$('#rup_cli').val();
			var nom_cl=$('#cli_bus').val();

			$.ajax({
				url: 'acciones/procesos_ventas.php',
				type: "POST",
				data: {
					accion: 'nueva_venta',
					cod_v: cod_ven,
					dni_u: dni_usu,
					dni_c: dni_cli,
					fec_v: fec_ven,
					tot_v: tot_ven,
					des_v: des_ven,
					net_v: net_ven,
					tp: tipo_p,
					tc: tip_con,
					rup_c: rup_cli_ven,
					nom_c:nom_cl,


				},

				success: function(respuesta){
					console.log(respuesta);
					$('#error_tic').fadeOut();
					$('#error_bdni').fadeOut();
					$('#nom_con').html($('#cli_bus').val());//nombre opcional del ticked y boleta
					$('#dni_con').html($('#dni_cli').val());
					var mode='iframe';
					var close=mode=="popup";
					var codigo_v=$('#cod_ven').val();//alamacenamos el codigo establecido
					$('#cod_compro').html(codigo_v);//asignamos el codigo almacenado a codigo comprovante
					var options={
						mode: mode,
						popClose:close,
					
					};
					if (tip_con==1) {
						$('div#ticked').show().printArea(options);//imprimimos	

					}else if (tip_con==2) {
						$('#nom_fac').html($('#cli_bus').val());//nombre opcional del ticked y boleta
						$('#dni_fac').html($('#dni_cli').val());
						var mode='iframe';
						var close=mode=="popup";
						var codigo_v=$('#cod_ven').val();//alamacenamos el codigo establecido
						$('#cod_fac').html(codigo_v);//asignamos el codigo almacenado a codigo comprovante
						var options={
							mode: mode,
							popClose:close,
					
						};
						$('div#factura').show().printArea(options);//imprimimos

					}else if (tip_con==3) {
						$('#nom_bol').html($('#cli_bus').val());//nombre opcional del ticked y boleta
						$('#dni_bol').html($('#dni_cli').val());
						var mode='iframe';
						var close=mode=="popup";
						var codigo_v=$('#cod_ven').val();//alamacenamos el codigo establecido
						$('#cod_bol').html(codigo_v);//asignamos el codigo almacenado a codigo comprovante
						var options={
							mode: mode,
							popClose:close,
					
						};
						$('div#boleta').show().printArea(options);//imprimimos
					}
					
					//formatos para fecha y horas + segundos 
					var d = new Date();
					var month = d.getMonth()+1;
					var day = d.getDate();
					var dt = new Date();
					var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
					var codigo_dventa = d.getFullYear() + '/' +
					    (month<10 ? '0' : '') + month + '/' +
					    (day<10 ? '0' : '') + day+' | '+time;
					$('#cod_ven').val(codigo_dventa);//volvemos a signar el codigo
					$('#list_productos').html('');//limpiamos la pabla
					limpiar_cliente();
					$('div#ticked').hide();
					$('div#factura').hide();
					$('div#boleta').hide();
					$('#error_nom').fadeOut();//desaparese mensaje de error de nombre de boleta
				}
			})

	}//fin de caso contrario 1
})
$('#can_ven').click(function(){
	//debemos limpiar el carrito de productos
	var cod_v=$('#cod_ven').val();
	$.ajax({
		url: 'acciones/procesos_ventas.php',
		type: "POST",
		data: {
			accion: 'limpiar_carro',
			cod_cav: cod_v,
		},
		success: function(respuesta){
			$('#contenido').load("vistas/ventas.php");
		}
	})
});

//FUNCIONES DE APOLLO

function limpiar_datos_productos(){
	$('#cod_pro').val('');
	$('#can_pro').val('');
	$('#pre_pro').val('');
	$('#ocultar_des').hide();
	$('#cod_pro').focus();
}

$('#btn_cal').click(function(){
	var monto_restar=$('#txt_mvu').val();
	var mineto=$('#neto').val();
	var vuelto=(monto_restar-mineto).toFixed(2);
	$('#txt_vue').val(vuelto);	
});
$('#btn_lim').click(function(){
	$('#txt_mvu').val('');
	$('#txt_vue').val('');
	$('#txt_mvu').focus();
});
function limpiar_cliente(){
	$('#dni_cli').val('');
	$('#cli_bus').val('');
}


})//cierre de dom