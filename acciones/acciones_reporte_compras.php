<?php 

include('../conexion/conexion.php');
$accion=$_POST['accion'];



if($accion=='ver_compras'){
    //$listar_compras="select * from compras order by cod_com";
    $listar_compras="SELECT compras.*,proveedor.dni_prove FROM compras,proveedor WHERE  compras.dni_prove=proveedor.dni_prove and compras.cod_com";	
       
        if (isset($_POST['bus'])) {
            $valor_bus=$_POST['bus'];
            $listar_compras="SELECT compras.*,proveedor.dni_prove,proveedor.nom_prove,proveedor.ape_prove, usuarios.dni_usu,usuarios.nom_usu,usuarios.ape_usu FROM compras,proveedor,usuarios WHERE  compras.dni_prove=proveedor.dni_prove and compras.dni_usu=usuarios.dni_usu and compras.cod_com LIKE '%$valor_bus%' ";	
            $res=mysqli_query($cnn,$listar_compras)or die("ERROR222");
        }	
    
    $res=mysqli_query($cnn,$listar_compras)or die("ERROR");
   $enc_pro=mysqli_num_rows($res);
   if($enc_pro>0){
        while($f=mysqli_fetch_array($res)){
        $compras[]=array(
            "codigo"=>$f['cod_com'],
            "proveedor"=>$f['dni_prove'],
            "datos2"=>$f['nom_prove'],
            "datos3"=>$f['ape_prove'],
            "usuario"=>$f['dni_usu'],
            "nombre_usu"=>$f['nom_usu'],
            "apellido_usu"=>$f['ape_usu'],
            "fe_compra"=>$f['fec_com'],
            "descuento"=>$f['des_com'],
            "total"=>$f['tot_com'],
            "igv"=>$f['igv_com'],
            "neto"=>$f['net_com'],
            "tipo"=>$f['tip_com']
        );
    }  
    echo json_encode($compras);
}else{
    echo "no_hay_compras";
}
}

if($accion=='fechas'){
    $fi=$_POST['fi'];
    $ff=$_POST['ff'];
    
    $listar="SELECT compras.*,proveedor.dni_prove,proveedor.nom_prove,proveedor.ape_prove, usuarios.dni_usu,usuarios.nom_usu,usuarios.ape_usu FROM compras,proveedor,usuarios WHERE  fec_com BETWEEN '$fi' AND '$ff' and compras.dni_prove=proveedor.dni_prove and compras.dni_usu=usuarios.dni_usu order by cod_com desc ";	
  //  $listar="select * from compras where fec_com BETWEEN '$fi' AND '$ff' order by cod_com desc";
    $res=mysqli_query($cnn,$listar) or die ("error en listar");
    $enc_com=mysqli_num_rows($res);
    if($enc_com>0){ 

   
    while($f=mysqli_fetch_array($res)){
        $compras2[]=array(
            "codigo"=>$f['cod_com'],
            "proveedor"=>$f['dni_prove'],
            "datos2"=>$f['nom_prove'],
            "datos3"=>$f['ape_prove'],
            "usuario"=>$f['dni_usu'],
            "nombre_usu"=>$f['nom_usu'],
            "apellido_usu"=>$f['ape_usu'],
            "fe_compra"=>$f['fec_com'],
            "descuento"=>$f['des_com'],
            "total"=>$f['tot_com'],
            "igv"=>$f['igv_com'],
            "neto"=>$f['net_com'],
            "tipo"=>$f['tip_com']
        );
        
    }
     echo json_encode($compras2);
}else{
    echo "no_hay";
}

}//cierre de if inicial

if($accion=='mostrar_datos'){

    $cod=$_POST['codigo'];
   $mostrar="SELECT detalle_compra.*,compras.cod_com,productos.cod_pro,productos.nom_pro FROM productos,compras,detalle_compra WHERE detalle_compra.cod_com='$cod' and compras.cod_com=detalle_compra.cod_com and detalle_compra.cod_pro=productos.cod_pro ";
  // $mostrar_detalles="SELECT detalle_venta.*,productos.cod_pro,productos.nom_pro,productos.des_pro FROM detalle_venta,productos WHERE cod_ven='$cod_det' AND detalle_venta.cod_pro=productos.cod_pro";
   $res=mysqli_query($cnn,$mostrar) or die("ERROR EN MOSTAR");
   $enc=mysqli_num_rows($res);
   if($enc>0){
        while($f=mysqli_fetch_array($res)){
            $detalle[]=array(
                "codidgo"=>$f['cod_com'],
                "codigo_producto"=>$f['cod_pro'],
                "nombre_pro"=>$f['nom_pro'],
                "cantidad"=>$f['can_pro'],
                "precio"=>$f['pre_pro']
            );
       echo json_encode($detalle);
    }
    
   }else{
       echo "no_existe";
   }
}

?>