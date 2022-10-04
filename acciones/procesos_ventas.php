<?php 
	include_once '../conexion/conexion.php';
	if ($_POST['accion']) {
		$accion=$_POST['accion'];
		//listado para buscar el cliente
		if ($accion=='buscar_cliente') {
			$dni_bus=$_POST['dni_clie'];
			$buscar_cliente="SELECT * FROM cliente WHERE dni_cli LIKE '%$dni_bus%' LIMIT 3";
			$rpta=$cnn->query($buscar_cliente);
			while ($fila=mysqli_fetch_array($rpta)) {
				$dni_c=$fila['dni_cli'];
				$datos_cli=$fila['nom_cli'].' '.$fila['ape_cli'];
				echo "<option  data_id='$datos_cli' value='$dni_c'>$datos_cli";
			}
			
		}
		//agregar nuevo cliente desde ventas
		if ($accion=='nuevo_cliente') {
			$dni_c=$_POST['dni_c'];
			$nom_c=$_POST['nom_c'];
			$ape_c=$_POST['ape_c'];
			$tel_c=$_POST['tel_c'];
			$dir_c=$_POST['dir_c'];
			$ruc_c=$_POST['ruc_c'];
			//consultamos si el dni ya existe
			$consultar_cliente="SELECT * FROM cliente WHERE dni_cli='$dni_c'";
			$rptac=$cnn->query($consultar_cliente);
			$val_rpta=mysqli_num_rows($rptac);
			if ($val_rpta==0) {
				$insertar="INSERT INTO cliente VALUES('$dni_c','$nom_c','$ape_c','$tel_c','$dir_c','$ruc_c')";
				$cnn->query($insertar);
				echo 1;
			}else{
				echo 0;
			}
			
			
		}
		//accion para mostrar datos del producto en el buscador y llenar el combo
		if ($accion=='buscar_producto') {
			$valor_pro=$_POST['nom_p'];
			$buscar_pro="SELECT * FROM productos WHERE cod_pro LIKE '%$valor_pro%' OR nom_pro LIKE '%$valor_pro%' LIMIT 8";
			$rptap=$cnn->query($buscar_pro);
			$rows_pro=mysqli_num_rows($rptap);
			if ($rows_pro>0) {
				while ($fila_p=mysqli_fetch_array($rptap)) {
					$cod_pro=$fila_p['cod_pro'];
					$nom_pro=$fila_p['nom_pro'];
					echo "<option data_id='$nom_pro' value='$cod_pro'>'$nom_pro'";
				}				
			}
		}
		//accion de mostrar datos del combo por id
		if ($accion=='mostrar_datos_producto') {
			$cod_pro=$_POST['cod_pr'];
			$buscar_pro="SELECT * FROM productos WHERE cod_pro='$cod_pro'";
			$rptabp=$cnn->query($buscar_pro);
			$rows_search=mysqli_num_rows($rptabp);
			if ($rows_search>0) {
				while ($fila_bp=mysqli_fetch_assoc($rptabp)) {
					$array_buspro[]=$fila_bp;
				}
				echo json_encode($array_buspro,JSON_UNESCAPED_UNICODE);
			}
		}
		//accion para insertar a la tabla temporal y mostrar valores que van a la tabla
		if ($accion=='carrito_compras') {
			$cod_ven=$_POST['cod_v'];
			$cod_pro=$_POST['cod_p'];
			$can_pro=$_POST['can_p'];
			$des_pro=$_POST['des_p'];
			$pre_pro=$_POST['pre_p'];


			$producto_acarro="INSERT INTO temporal_ventas VALUES('$cod_ven','$cod_pro',$can_pro,$des_pro,$pre_pro,contador)";
			$cnn->query($producto_acarro);

		}

		if ($accion=='listando_productos') {
			if (isset($_POST['cod_ve'])) {
				$cod_vent=$_POST['cod_ve'];
				$supervisar_carro="SELECT *,temporal_ventas.des_pro AS desct_pro FROM temporal_ventas,productos WHERE cod_ven='$cod_vent' AND productos.cod_pro=temporal_ventas.cod_pro";//consulta para lisatar las ventas
			}
			//aprovechamos para mostrar y listar mi producto a modificar
			if (isset($_POST['contad'])) {
				$conta=$_POST['contad'];
				$supervisar_carro="SELECT * FROM temporal_ventas WHERE contador=$conta";

			}

			$rpttv=$cnn->query($supervisar_carro);
			$rows_tmp=mysqli_num_rows($rpttv);
			if($rows_tmp>0){
				while ($fila_tmp=mysqli_fetch_assoc($rpttv)) {
					$array_tpm[]=$fila_tmp;
				}
				echo json_encode($array_tpm,JSON_UNESCAPED_UNICODE);
			}else{
				echo 1;
			}			
		}
		//accion para eliminar las ventas del carrito
		if ($accion=='eliminar_pro_car') {
			$cod_vtmp=$_POST['cod_v'];
			
			$eliminar_vtmp="DELETE FROM temporal_ventas WHERE contador=$cod_vtmp";
			$cnn->query($eliminar_vtmp);
			echo $cod_vtmp;
		}
		//Modificamos el producto por codigo
		if ($accion=='modificar_producto') {
			$cod_vent=$_POST['cod_vent'];
			$codi_pro=$_POST['id_act'];
			$can_pro=$_POST['c_act'];
			$pre_pro=$_POST['p_act'];
			$des_pro=$_POST['d_act'];
			$conta=$_POST['co_act'];
			$update_pro_tmp="UPDATE temporal_ventas SET cod_ven='$cod_vent',cod_pro='$codi_pro',can_pro=$can_pro,des_pro=$des_pro,pre_pro=$pre_pro,contador=$conta WHERE contador=$conta";
			$cnn->query($update_pro_tmp);
			
		}
		//agregamos la nueva venta
		if ($accion=='nueva_venta') {
			$cod_ven=$_POST['cod_v'];
			$dni_usu=$_POST['dni_u'];
			
			$fec_ven=$_POST['fec_v'];
			$tot_ven=$_POST['tot_v'];
			$igv_ven=$_POST['des_v'];
			$net_ven=$_POST['net_v'];
			$tip_pag=$_POST['tp'];
			$tip_con=$_POST['tc'];
			$rup_cli=$_POST['rup_c'];
			$nom_cli=$_POST['nom_c'];
			//proceso para actualizar el stock de los productos que salen actualizamos mientras mostramos

			$mostrar_stop="SELECT productos.cod_pro,productos.sto_pro,SUM(temporal_ventas.can_pro) AS sum_igu,temporal_ventas.contador FROM productos,temporal_ventas WHERE productos.cod_pro=temporal_ventas.cod_pro AND temporal_ventas.cod_ven='$cod_ven' GROUP BY temporal_ventas.cod_pro";
			$rptabp=$cnn->query($mostrar_stop);
			$rows_pro=mysqli_num_rows($rptabp);
			while ($filas_p=mysqli_fetch_array($rptabp)) {
				$stock=$filas_p['sto_pro'];//stock actual
				$cant_p=$filas_p['sum_igu'];//cantidad a llevar
				$cod_p=$filas_p['cod_pro'];
				$idtmp_pro=$filas_p['contador'];
				$nuevo_stock=($stock-$cant_p);
				echo $nuevo_stock;
				$update_stock="UPDATE productos,temporal_ventas SET productos.sto_pro=$nuevo_stock WHERE temporal_ventas.contador=$idtmp_pro AND productos.cod_pro='$cod_p' AND temporal_ventas.cod_ven='$cod_ven'";
				$cnn->query($update_stock) or die("error al actualizr stock");
			}
		
			//insertamos a la tabla detalle_venta de la tabla temporal
			$ventas_detalle="INSERT INTO detalle_venta(cod_ven,cod_pro,can_pro,des_ven,pre_pro)
						SELECT cod_ven,cod_pro,can_pro,des_pro,pre_pro
						FROM temporal_ventas
						WHERE temporal_ventas.cod_ven='$cod_ven'";
						$cnn->query($ventas_detalle);
						

			//eliminamos los productos de la temporal por que ya estan en detalle
			$elimina_protmp="DELETE FROM temporal_ventas";
			$cnn->query($elimina_protmp);
		
			//reinicaiamos el contador de la temporal
			$reiniciar_tabla="ALTER TABLE temporal_ventas AUTO_INCREMENT=1";
			$cnn->query($reiniciar_tabla);
			if($_POST['dni_c']!=null){
				$dni_cliente=$_POST['dni_c'];
		        $registra_ven="INSERT INTO ventas VALUES('$cod_ven','$dni_usu','$dni_cliente','$fec_ven',$tot_ven,$igv_ven,$net_ven,$tip_pag,$tip_con,'$rup_cli','$nom_cli',est_ven)";
				$cnn->query($registra_ven) or die("eroor en consulta agregar venta no nula");
		    }else{ 

		    	$registra_ven="INSERT INTO ventas VALUES('$cod_ven','$dni_usu',dni_cli,'$fec_ven',$tot_ven,$igv_ven,$net_ven,$tip_pag,$tip_con,'$rup_cli','$nom_cli',est_ven)";
				$cnn->query($registra_ven) or die("eroor en consulta agregar venta");

		       
		    }
			//insertamos la venta al fin veamos si funka
			

			//consulta para restar los stocks


		}

		if ($accion=='limpiar_carro') {
			$codi_cav=$_POST['cod_cav'];
			//eliminamos los productos de la temporal 
			$limpiar_carro="DELETE FROM temporal_ventas";
			$cnn->query($limpiar_carro);
		}

	}//cierre de existemcia de accion

 ?>