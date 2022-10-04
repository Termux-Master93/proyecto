<?php
include("../conexion/conexion.php");

$accion=$_POST['accion'];

if($accion=='listar_categorias'){
    $listar="select * from categoria order by cod_cat";
    if(isset($_POST['cat'])){
        $cat=$_POST['cat'];
        $listar="select * from categoria where nom_cat like '%$cat%'";
    }


    $res=mysqli_query($cnn,$listar) or die("Error en listar");
    $res_c=mysqli_num_rows($res);

    if($res_c>0){
        while($f=mysqli_fetch_array($res)){
     $categoria[]=array(
        "codigo"=>$f["cod_cat"],
        "nombre"=>$f["nom_cat"],
     );
    }
   echo json_encode($categoria,JSON_UNESCAPED_UNICODE);
}else{
    echo "no_existe";
}
 }//llave del if general
  
 //numero mayor
 if($accion=='numero_mayor'){
     $maximo="select max(cod_cat+1) from categoria";
     $res=mysqli_query($cnn,$maximo) or die("error");
       
     $rs=mysqli_fetch_row($res); //fetch rows devuelve las filas obtenidas, devuelve un array de cadenas que se corresponde con la fila obtenida
     $nmax = trim($rs[0]); //trim elimina los espacios en blanco luego de ello ponemos 0 para que comienze el conteo desde ai despues enviamos el valor a js para mostrarlo a la cajaa, el 0 es el parametro del trim 
     echo ($nmax); 

 }//fin de proceso numero mayor

 //inicio de proceso agregar
 if($accion=='agregar'){
     $cod=$_POST['cod'];
     $nom=$_POST['nom'];

     $agregar="insert into categoria values($cod,'$nom')";
     mysqli_query($cnn,$agregar) or die("Error en Agregar Categoria");
     echo "Categoria agregada correctamente";
}

//eliminar
if($accion=='eliminar'){
    $cod=$_POST['cod_e'];
    
    $eliminar="delete from categoria where cod_cat=$cod";
    mysqli_query($cnn,$eliminar) or die("error en eliminar");
    echo "eliminado correctamente";
}

//buscar valor modificar, esta accion tambiem puede acomadarse en la funcion listar para ahorrar lineas de codigo
if($accion=='buscar_valor_modificar'){
    $cod_m=$_POST['cod_m'];
    $buscar="select * from categoria where cod_cat=$cod_m";
    $res=mysqli_query($cnn,$buscar) or die("errror en buscar valor");
    while($f=mysqli_fetch_array($res)){
        $cat_bus[]=array(
            'cod'=>$f['cod_cat'],
            'nom'=>$f['nom_cat'],
        );
    }
    echo json_encode($cat_bus);
}

//actualizar datos
if($accion=='actualizar'){
    $cod_ac=$_POST['cod_ac'];
    $nom_ac=$_POST['nom_ac'];
    $actualizar="update categoria set nom_cat='$nom_ac' where cod_cat=$cod_ac";
    mysqli_query($cnn,$actualizar) or die("Error en actualizar");
    echo "Actualizar correctamente";
}
?>