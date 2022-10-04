<?php 
include_once '../conexion/conexion.php';

if (isset($_POST['accion'])) {
	$accion=$_POST['accion'];
	if($accion=="listar_prove"){
		$listar_pro="SELECT * FROM proveedor  ORDER BY ape_prove";
		
		if(isset($_POST['buscar'])) {
			$valor_bus=$_POST['buscar'];
			$listar_pro="SELECT * FROM proveedor WHERE dni_prove LIKE '%$valor_bus%' OR ape_prove LIKE '%$valor_bus%'";
		}
		if (isset($_POST['dni_a_mod'])) {
			$dni_modi=$_POST['dni_a_mod'];
			$listar_pro="SELECT * FROM proveedor WHERE dni_prove='$dni_modi'";
		}	
		$respt=$cnn->query($listar_pro);
		$num_rows=mysqli_num_rows($respt);
		if($num_rows > 0){
			while ($filas=mysqli_fetch_assoc($respt)) {
				$arraylist[]=$filas;
			}
			echo json_encode($arraylist,JSON_UNESCAPED_UNICODE);
		}else{
			echo 'nodata';
		}
		exit;
	}//fin accion listar y buscar

	if($accion=='insertar_prove') {
		if (isset($_POST['dni_p'])) {	
			$dni_pr=$_POST['dni_p'];
			$nom_pr=$_POST['nom_p'];
			$ape_pr=$_POST['ape_p'];
			$tel_pr=$_POST['tel_p'];
			$raz_pr=$_POST['raz_p'];
			$ruc_pr=$_POST['ruc_p'];
			$dir_pr=$_POST['dir_p'];
			$consulta_existente="SELECT * FROM proveedor WHERE dni_prove='$dni_pr'";
			$rpta_e=$cnn->query($consulta_existente);
			$num_filas=mysqli_num_rows($rpta_e);
			if ($num_filas==0) {
				$insertar_prove="INSERT INTO proveedor VALUES('$dni_pr','$nom_pr','$ape_pr','$tel_pr','$raz_pr','$ruc_pr','$dir_pr')";
				$cnn->query($insertar_prove) or die("error en insertar");
				echo 1;
			}else{
				echo 0;
			}
			
		}
	}//fin accion agregar proevedor

	if ($accion=='eliminar_pro') {
		$dni_e=$_POST['dni_a_eli'];
		$delete="DELETE FROM proveedor WHERE dni_prove='$dni_e'";
		$cnn->query($delete) or die("error al eliminar");
		echo "peoveedor eliminado";
	}// fin accion eliminar

	if($accion=='modificar_pro'){
		$dni_prm=$_POST['dni_pmo'];
		$nom_prm=$_POST['nom_pmo'];
		$ape_prm=$_POST['ape_pmo'];
		$tel_prm=$_POST['tel_pmo'];
		$raz_prm=$_POST['raz_pmo'];
		$ruc_prm=$_POST['ruc_pmo'];
		$dir_prm=$_POST['dir_pmo'];
		$update="UPDATE proveedor  SET dni_prove='$dni_prm',nom_prove='$nom_prm',ape_prove='$ape_prm',tel_prove='$tel_prm',raso_prove='$raz_prm',ruc_prove='$ruc_prm',dir_prove='$dir_prm' WHERE dni_prove='$dni_prm'";
		$cnn->query($update);
		echo "actualizado";
	}//fin de la accion modificar


}

 ?>