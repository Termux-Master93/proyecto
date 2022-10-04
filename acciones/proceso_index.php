<?php 

include("../conexion/conexion.php");
$accion=$_POST['accion'];
if ($accion=='lista_usuario') {
	$cod_usu=$_POST['val_user'];
	$mostrar_user="SELECT dni_usu,CONCAT(nom_usu,' ',ape_usu) as datos FROM usuarios WHERE dni_usu='$cod_usu' ";
	$rpta=$cnn->query($mostrar_user);
	$rows_user=mysqli_num_rows($rpta);
	if($rows_user>0){
		while ($filas=mysqli_fetch_array($rpta)) {
			$usuarios[]=$filas;
		}
		 echo json_encode($usuarios,JSON_UNESCAPED_UNICODE);
	}
	
}
 ?>