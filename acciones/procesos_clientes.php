<?php include_once '../conexion/conexion.php';
if($_POST['proceso']='listado_cli'){
	$listado="SELECT * FROM cliente ORDER BY ape_cli";
	if(isset($_POST['buscar'])){
		$buscar=$_POST['buscar'];//aqui es cualquier considencia
		$listado="SELECT * FROM cliente WHERE dni_cli LIKE '%$buscar%' OR nom_cli LIKE '%$buscar%' OR ape_cli LIKE '%$buscar%' or ruc_cli LIKE '%$buscar%'";
	}
	if(isset($_POST['bus_dni_c'])){
		$dni_cl=$_POST['bus_dni_c'];
		$listado="SELECT * FROM cliente WHERE dni_cli='$dni_cl'";
	}
	$resp=$cnn->query($listado);
	$num_rows=mysqli_num_rows($resp);
	if($num_rows > 0){
		while ($filas=mysqli_fetch_assoc($resp)) {
			$array_list[]=$filas;
		}
		echo json_encode($array_list,JSON_UNESCAPED_UNICODE);
	}else{
		echo "nodata";
	}
}
if($_POST['proceso']='agregar'){
	if (isset($_POST['dni_c'])) {
		$dni=$_POST['dni_c'];
		$nom=$_POST['nom_c'];
		$ape=$_POST['ape_c'];
		$tel=$_POST['tel_c'];
		$dir=$_POST['dir_c'];
		$ruc=$_POST['ruc_c'];

		$consultar_dni="SELECT * FROM cliente WHERE dni_cli='$dni'";
		$rptas=$cnn->query($consultar_dni);
		$fila=mysqli_num_rows($rptas);
		if($fila==0){
			$insertar="INSERT INTO cliente VALUES('$dni','$nom','$ape','$tel','$dir','$ruc')";
			$cnn->query($insertar);
			echo 1;
		}else{
			echo 0;
		}
	}

}

if($_POST['proceso']='actualizar_cli'){
	if(isset($_POST['dni'])){
		$dni=$_POST['dni'];
		$nom=$_POST['nom'];
		$ape=$_POST['ape'];
		$tel=$_POST['tel'];
		$dir=$_POST['dir'];
		$ruc=$_POST['ruc'];
		$update="UPDATE cliente SET dni_cli='$dni',nom_cli='$nom',ape_cli='$ape',tel_cli='$tel',dir_cli='$dir',ruc_cli='$ruc' WHERE dni_cli='$dni'";
		$cnn->query($update);

	}
}

if($_POST['proceso']='eliminar'){
	if(isset($_POST['dni_eli'])){
		$dni_eli=$_POST['dni_eli'];
		$elimina="DELETE FROM cliente WHERE dni_cli='$dni_eli'";
		$cnn->query($elimina);
		echo "eliminado con exito";
	}
}


 ?>