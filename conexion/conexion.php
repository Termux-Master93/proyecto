<?php
$servidor="localhost";
$usuario="root";
$clave="";
$base="bd_motorepuestos";
$cnn=mysqli_connect($servidor,$usuario,$clave)or die("Error conectar con servidor");
mysqli_select_db($cnn,$base)or die("Error en base datos");

?>