<?php
	include_once '../conexion/conexion.php';
	
	if ($_POST['accion']) {
		$accion=$_POST['accion'];
		if ($accion=='mostrar_ventas') {
			if (isset($_POST['fecha'])) {
				$hoydia=$_POST['fecha'];
				$list_ventas="SELECT ventas.*,usuarios.dni_usu,concat(usuarios.nom_usu,' ',usuarios.ape_usu)as datos_usuario FROM ventas,usuarios WHERE ventas.fec_ven='$hoydia' and ventas.dni_usu=usuarios.dni_usu ORDER BY ventas.cod_ven DESC";
			}else if (isset($_POST['f_f']) && isset($_POST['f_i'])) {
				$fec_fin=$_POST['f_f'];
				$f_i=$_POST['f_i'];
				$f_f=$_POST['f_f'];
				$list_ventas="SELECT ventas.*,usuarios.dni_usu,concat(usuarios.nom_usu,' ',usuarios.ape_usu)as datos_usuario FROM ventas,usuarios WHERE ventas.fec_ven BETWEEN '$f_i' AND '$f_f' and ventas.dni_usu=usuarios.dni_usu ORDER BY ventas.cod_ven DESC";					
			}

			if (isset($_POST['bus'])) {
				$valor_bus=$_POST['bus'];
				$list_ventas="SELECT ventas.*,usuarios.dni_usu,concat(usuarios.nom_usu,' ',usuarios.ape_usu)as datos_usuario FROM ventas,usuarios WHERE  ventas.dni_usu=usuarios.dni_usu and ventas.cod_ven LIKE '%$valor_bus%' ";	
			}	
	
			$rpta=$cnn->query($list_ventas);
			$num_ventas=mysqli_num_rows($rpta);
			if($num_ventas>0){
				while ($filas=mysqli_fetch_assoc($rpta)) {
					$array_venta[]=$filas;
						
				}
				echo json_encode($array_venta);
			}

		}//cierre de accion listados

		if ($accion=='calcular_importe') {
			$ini_mes=$_POST['i_mes'];
			$fin_mes=$_POST['f_mes'];
			$ventas="SELECT ventas.cod_ven,ventas.net_ven,ventas.fec_ven,ventas.tip_con,ventas.est_ven FROM ventas WHERE ventas.fec_ven BETWEEN '$ini_mes' AND '$fin_mes' AND ventas.est_ven=1";
			$rptimp=$cnn->query($ventas);
			$rows_ventas=mysqli_num_rows($rptimp);
			if ($rows_ventas>0) {
				while ($fil_ven=mysqli_fetch_assoc($rptimp)) {
					$array_ventas[]=$fil_ven;

				}
			}	
			$compras="SELECT compras.cod_com,compras.net_com,compras.fec_com,compras.tip_com FROM compras WHERE compras.fec_com BETWEEN '$ini_mes' AND '$fin_mes'";			
		
			$rptscom=$cnn->query($compras);
			$rows_compras=mysqli_num_rows($rptscom);
			if ($rows_ventas>0 & $rows_compras>0) {
				while ($fil_com=mysqli_fetch_assoc($rptscom)) {
					$array_compras[]=$fil_com;

				}
				$importes=array_merge($array_ventas,$array_compras);
				echo json_encode($importes);
			}
		}//cierre de accion calcular importe

		if ($accion=='anular_venta') {
			$cod_ven_anu=$_POST['cod_v'];
			$campos_actaulizar="SELECT ventas.*,detalle_venta.can_pro AS can_save,detalle_venta.cod_ven,productos.cod_pro,productos.sto_pro AS stock_actual FROM ventas,productos,detalle_venta WHERE ventas.cod_ven='$cod_ven_anu' AND ventas.cod_ven=detalle_venta.cod_ven AND detalle_venta.cod_pro=productos.cod_pro";
			$rpta_anv=$cnn->query($campos_actaulizar);
			$num_sales_anular=mysqli_num_rows($rpta_anv);
			if ($num_sales_anular>0) {
				while ($fil_anv=mysqli_fetch_array($rpta_anv)) {
					$cod_pro=$fil_anv['cod_pro'];
					$stock_act=$fil_anv['stock_actual'];//actual
					$cant_plus=$fil_anv['can_save'];//cantidad vendida
					$nuw_stock=($stock_act+$cant_plus);//sumas

					$actualizar_productos="UPDATE productos,detalle_venta,ventas SET productos.sto_pro=$nuw_stock,ventas.est_ven=2 WHERE detalle_venta.cod_ven='$cod_ven_anu' AND productos.cod_pro='$cod_pro' AND ventas.cod_ven='$cod_ven_anu'";
					$cnn->query($actualizar_productos) or die("error al actualizar producto");
					echo "productos actualizados";
				}
			}
			
		}

		if ($accion=='mostar_detalle') {
			$cod_det=$_POST['cod_deta'];
			$mostrar_detalles="SELECT detalle_venta.*,productos.cod_pro,productos.nom_pro,productos.des_pro FROM detalle_venta,productos WHERE cod_ven='$cod_det' AND detalle_venta.cod_pro=productos.cod_pro";
			$rpta_det=$cnn->query($mostrar_detalles);
			$num_deta=mysqli_num_rows($rpta_det);
			if ($num_deta>0) {
				while ($fil_det=mysqli_fetch_assoc($rpta_det)) {
					$list_detarray[]=$fil_det;
				}
				echo json_encode($list_detarray);
			}
		}	

	}//aqui cierre de acciones
?>