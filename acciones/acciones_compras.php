<?php
include('../conexion/conexion.php');
$accion=$_POST['accion'];

if($accion=='lis_pro'){
        $listar="select * from proveedor order by nom_prove";
        $res=mysqli_query($cnn,$listar) or die("Error en listar");
        while($f=mysqli_fetch_array($res)){
        $dni=$f['dni_prove'];
        $nom=$f['nom_prove'];
        $ape=$f['ape_prove'];
        echo "<option value=$dni>$nom $ape</option>";
}
}

if($accion=='listar_temporal'){
    $cod_tmp=$_POST['cod_tmp'];
    $listar_temporal="select * from temporal_compras,productos where productos.cod_pro=temporal_compras.cod_pro and temporal_compras.cod_com='$cod_tmp'";
    $res=mysqli_query($cnn,$listar_temporal) or die ("Error en listar datos de la tabla temporal");
    $encontrado=mysqli_num_rows($res);
    if($encontrado>0){

  
    while($f=mysqli_fetch_array($res)){
        $temporal[]=array(
            "codigo_compra"=>$f['cod_com'],
            "codigo_pro"=>$f['cod_pro'],
            "nombre_pro"=>$f['nom_pro'],
            "cantidad_pro"=>$f['can_pro'],
            "precio_pro"=>$f['pre_pro'],
            "ce"=>$f['cod_eli'],
            
        );
    }
    echo json_encode($temporal);
}else{
    echo "vacio";
}
}

if($accion=='lis_productos'){
    $pro=$_POST['ppro'];
    $listar="select * from productos where nom_pro like '%$pro%'";
    $res=mysqli_query($cnn,$listar) or die("Error en listar productos");
    $res_enc=mysqli_num_rows($res);
    if($res_enc>0){
        while($f=mysqli_fetch_array($res)){
            $productos[]=array(
                "cod"=> $f["cod_pro"], 
                "nom"=> $f["nom_pro"],
                "cat"=>$f['cod_cat'],         
                "mar"=>$f["mar_pro"],
                "ubi"=>$f["ubi_pro"],
                "des"=>$f["des_pro"],
                "sto"=>$f["sto_pro"],
                "prere"=>$f["prere_pro"],
            );
        }
        echo json_encode($productos);
    }else{
        echo "no_existe";
    }
    
}

if($accion=='buscar_valor_productos'){
    $cod_pro=$_POST['cod'];
    $consulta="select * from productos  where productos.cod_pro='$cod_pro'";
    $res=mysqli_query($cnn,$consulta) or die("Error en listar Productos");
    $res_pro=mysqli_num_rows($res);
    if($res_pro>0){

    
    while($f=mysqli_fetch_array($res)){
        $productos[]=array(
            "cod"=> $f["cod_pro"], 
            "nom"=> $f["nom_pro"],
            "cat"=>$f['cod_cat'],    
            "mar"=>$f["mar_pro"],
            "ubi"=>$f["ubi_pro"],
            "des"=>$f["des_pro"],
            "sto"=>$f["sto_pro"],
            "prere"=>$f["prere_pro"],
            
        );
    }
    echo json_encode($productos);
}else{
    echo "no_existe";
}
}

if($accion=='agregar_temporal'){
    $cod_compra=$_POST['cod_com'];
    $cod=$_POST['cod'];
    $nom=$_POST['nom'];
    $can=$_POST['can'];
    $pre=$_POST['pre'];
    echo $cod_compra." ".$cod." ",$nom." ".$can." ".$pre;
    $agregar_temporal="insert into temporal_compras(cod_com,cod_pro,can_pro,pre_pro)
    values('$cod_compra','$cod',$can,$pre)";
    mysqli_query($cnn,$agregar_temporal) or die("Error en agregar a temporal");
    echo "agregado correctamente";
  
}

if($accion=='eliminar_temporal'){
    $cod_eli=$_POST['cod_eli'];
    $eliminar="delete from temporal_compras where cod_eli='$cod_eli'";
    mysqli_query($cnn,$eliminar) or die("Error en Eliminar Producto de la Tabla Temporal");
    echo "Eliminado Correctamente";
}

if($accion=='agregar_compra'){
    $cod_com=$_POST['cod_com'];
    $dni_pro=$_POST['dni_pro'];
    $dni_usu=$_POST['dni_usu'];
    $fecco=$_POST['fecco'];
    $tip_com=$_POST['tip_com'];
    $des=$_POST['des_com'];
    $total=$_POST['total'];
    $igv=$_POST['igv'];
    $neto=$_POST['neto'];
    //proceso para actualizar los productos que llegaron 
    $actualizar="select productos.cod_pro,productos.sto_pro,sum(temporal_compras.can_pro) as suma_productos,temporal_compras.cod_eli from productos,temporal_compras where productos.cod_pro=temporal_compras.cod_pro and temporal_compras.cod_com='$cod_com' group by temporal_compras.cod_pro";
    $res_actu=mysqli_query($cnn,$actualizar) or die("ERROR EN CONSULTA GAAA");
    while($f=mysqli_fetch_array($res_actu)){
        $sto_pro=$f['sto_pro'];//stock actual que tenemos en la tabla productos
        $cant_exis=$f['suma_productos'];//cantidad que traen los pajines
        $cod_tem=$f['cod_eli'];
        $cod_pro=$f['cod_pro'];
        $ingreso=($sto_pro+$cant_exis);
        $actualizar_stock="update productos,temporal_compras set productos.sto_pro=$ingreso where temporal_compras.cod_eli=$cod_tem and productos.cod_pro='$cod_pro' and temporal_compras.cod_com='$cod_com'";
		mysqli_query($cnn,$actualizar_stock) or die("ERROR EN TRATA DE ACTUALIZAR RAAA");
    }
   
   
    //paso los datos que tiene la temporal a la tabla detalle
    $sacar_datos_temporal="INSERT INTO detalle_compra ( 
       cod_com,cod_pro,can_pro,pre_pro  ) 
  SELECT  cod_com,cod_pro,can_pro,pre_pro
  FROM temporal_compras 
  WHERE temporal_compras.cod_com='$cod_com' 
  ORDER BY cod_com ";




  //aki eliminar los datos que tenia la tabla temporal
   $eliminar_datos_temporal="DELETE FROM temporal_compras where cod_com='$cod_com'";
   $cnn->query($eliminar_datos_temporal) or die("ERROR EN ELIMINAR DATOS TEMPORAL");
   //reestablecer el autoincremento
   $reestable="alter table temporal_compras AUTO_INCREMENT=1;";
    mysqli_query($cnn,$sacar_datos_temporal) or die("Error al tratar de agregar a detalle_compras");
    mysqli_query($cnn,$reestable) or die("error al tratar de reestablecer desde 1");

    //agrego los datos a la tabla compras
    $agregar_compra="INSERT INTO compras values('$cod_com','$dni_pro','$dni_usu','$fecco',$total,$des,$igv,$neto,'$tip_com')";
    mysqli_query($cnn,$agregar_compra) or die("Error");


     echo "agregado Correctamente";     
}

if($accion=='nuevo_codigo' || $accion=='cancelar'){
    date_default_timezone_set('America/Lima');
     $cod=date("Y-m-d | h:i:s ",time());
     $x=$cod;
  echo $cod;
  
}
//prueba
if($accion=='c'){
    
        //actualizar la cantidad que ingrega
        $actualizar_stock="select * from temporal_compras group by cod_pro  ";
        $res_stokc=mysqli_query($cnn,$actualizar_stock) or die ("ERROR EN CONSULTA ACTUALIZAR");
        while($f=mysqli_fetch_array($res_stokc)){
            $cod_pro=$f['cod_pro'];
            $can_pro=$f['can_pro'];
             echo $cod_pro.':'.$can_pro.", ";
        }
       
}

if($accion=='buscar_datos'){
    $cod=$_POST['cod'];
    $buscar="select * from temporal_compras,productos where cod_eli=$cod and temporal_compras.cod_pro=productos.cod_pro";
    $res=mysqli_query($cnn,$buscar) or die("ERROR EN BUSCAR DATOS");
    while($f=mysqli_fetch_array($res)){
        $pro_tem[]=array(
        "x1"=>$f['cod_com'],
        "x2"=>$f['cod_pro'],
        "x3"=>$f['nom_pro'],
        "x4"=>$f['can_pro'],
        "x5"=>$f['pre_pro'],
        "x6"=>$f['cod_eli'],
        );

    }
    echo json_encode($pro_tem);
}

if($accion=='actulizar_temporal'){
    $cod_compra=$_POST['cod_com'];
    $cod=$_POST['cod'];
    $nom=$_POST['nom'];
    $can=$_POST['can'];
    $pre=$_POST['pre'];
   
   $actualizar_temporal="update temporal_compras set cod_com='$cod_compra',can_pro=$can,pre_pro=$pre where cod_com='$cod_compra'";
    mysqli_query($cnn,$actualizar_temporal) or die("Error en agregar a temporal");
    echo "aactualizado correctamente";
  
}

if($accion=='cancelar'){
    $cod_el=$_POST['cod_el'];
    $eli="delete from temporal_compras where cod_com='$cod_el'";
    mysqli_query($cnn,$eli) or die("errore");
    echo "";
}

?>