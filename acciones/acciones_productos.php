<?php
include('../conexion/conexion.php');

$accion=$_POST['accion'];

    //llenar categoria
        if($accion=="llen_cat"){
        $lis_car="select * from categoria order by nom_cat";
        $res=mysqli_query($cnn,$lis_car) or die("Error en listar Categorias");
        while($f=mysqli_fetch_array($res)){
            
        $cod_cat=$f['cod_cat'];
        $nom_cat=$f['nom_cat'];

        echo "<option value=$cod_cat>$nom_cat</option>";
            }
        }
    //Finalizamos el proceso de llenar categoria

    //Procesos para agregar producto

    if($accion=="agregar_producto"){
        $cod=$_POST['codigo'];
        $pro=$_POST['producto']; 
        $cat=$_POST['categoria'];
        $mar=$_POST['marca'];
        $ubi=$_POST['ubicacion'];
        $des=$_POST['descripcion']; 
        $stock=$_POST['stock'];
        $pre=$_POST['precio'];
    
    $listar="select * from productos where cod_pro='$cod'";  //consulta para seleccionar todos los productos y luego comparamos con el parametro codigo que viene desde js    
    $res=mysqli_query($cnn,$listar) or die("Error en Comparar");//ejecutamos
    $cod_pro_exi=mysqli_num_rows($res); //

    if($cod_pro_exi>0){ //si esque lo encontre entonces que salgo un mensaje
        //echo"El Producto con el codigo ingresado ya existe";
        echo "existe";
    }else{ //caso contrario que agregue normal 
        $agregar="insert into productos values('$cod','$pro',$cat,'$mar',$ubi,'$des','$stock','$pre')";
        mysqli_query($cnn,$agregar) or die("Error en agregar");
        echo "nuevo";
    }

    // echo $cat;
   
    }
    //Fin proceso para agregar Producto
  

    //listamos productos
    if($accion=='listar_productos'){      
    $listar="select * from productos p, categoria c where c.cod_cat=p.cod_cat";//listamos todos los productos
    if(isset($_POST['buscar'])){ //si existe la variable enviadad desde JS Entonces que ejecute todo esto
        $nom_bus=$_POST['buscar'];
        $listar="select * from productos p, categoria c where nom_pro like '%$nom_bus%' and c.cod_cat=p.cod_cat";
        //$listar="select * from productos where nom_pro like '%$nom_bus%' order by nom_pro";        
        $res=mysqli_query($cnn,$listar) or die("Error en listar");              
    }
    
    $res=mysqli_query($cnn,$listar) or die("Error en listar");
    $res_pro=mysqli_num_rows($res);
    if($res_pro>0){
     while($f=mysqli_fetch_array($res)){ 

        $productos[]=array(
        "cod"=> $f["cod_pro"], 
        "nom"=> $f["nom_pro"],
        "cat"=>$f['cod_cat'],
       "nombre_categoria"=>$f['nom_cat'],
        "mar"=>$f["mar_pro"],
        "ubi"=>$f["ubi_pro"],
        "des"=>$f["des_pro"],
        "sto"=>$f["sto_pro"],
        "prere"=>$f["prere_pro"],
        );

    }
  
    echo json_encode($productos,JSON_UNESCAPED_UNICODE);
            }else{
                echo "no_existe";
            }
   
    }//llave del if general


    //Eliminar Producto
    if($accion=="eliminar_producto"){
        //echo "ESTAMOS BIEN EN ELIMINAR";
        $cod=$_POST['codigo'];
        $consulta="delete from productos where cod_pro='$cod'";
        mysqli_query($cnn,$consulta) or die("Error en Eliminar");
        echo "Eliminado Correctamente";

    }
    //fin de proceso eliminar

    //Inicio para el proceso de modificar 
    if($accion=="actualizar"){
        $cod=$_POST['codigo'];
        $pro=$_POST['producto']; 
        $cat=$_POST['categoria'];
        $mar=$_POST['marca'];
        $ubi=$_POST['ubicacion'];
        $des=$_POST['descripcion']; 
        $stock=$_POST['stock'];
        $pre=$_POST['precio'];

        $actualizar="update productos set nom_pro='$pro',cod_cat=$cat,mar_pro='$mar',ubi_pro=$ubi,des_pro='$des',sto_pro=$stock,prere_pro=$pre where cod_pro='$cod'";
       mysqli_query($cnn,$actualizar) or die("Error en actualizar");


        echo "Actualizado correctamente";

    }
   //fin de proceso
   

    //Sacamos el maximo numero de la tabla categoria
    if($accion=='maximo'){
        $consulta="select max(cod_cat+1) from categoria";
        $res=mysqli_query($cnn,$consulta) or die("error");
       
        $rs=mysqli_fetch_row($res); //fetch rows devuelve las filas obtenidas, devuelve un array de cadenas que se corresponde con la fila obtenida
        $nmax = trim($rs[0]); //trim elimina los espacios en blanco luego de ello ponemos 0 para que comienze el conteo desde ai despues enviamos el valor a js para mostrarlo a la cajaa, el 0 es el parametro del trim 
        echo ($nmax); 
    }

       //agregar_categoria
   if($accion=='agregar_categoria'){
       $cod=$_POST['cod'];
       $nom=$_POST['nom'];
      $agre_cat= "insert into categoria values($cod,'$nom')";
       mysqli_query($cnn,$agre_cat) or die("Error en agregar Categoria");
       echo "Categoria agregada correctamente";
   }


   if($accion=='buscar_valor'){
    $pro_bus=$_POST['cod_act'];
    $listar="select * from productos where cod_pro='$pro_bus'"; 
    $res=mysqli_query($cnn,$listar) or die("Error en listar");
    $res_pro=mysqli_num_rows($res);
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
  
    echo json_encode($productos,JSON_UNESCAPED_UNICODE);
   }



?>