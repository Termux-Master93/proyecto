<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel=StyleSheet href="css/estilos_compras.css" TYPE="text/css" MEDIA=screen>
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    if(!isset($_SESSION['usuarios']['dni_usu'])){
    echo"No ha iniciado sesion";
    header("location:../sesion/acceso.php");
    }
     ?>



    <?php 
    date_default_timezone_set('America/Lima');
    $cod=date("Y-m-d | h:i:s ",time());
    $fecha_compra=date("Y-m-d");
    ?>

     
<div class="contenedor_compras">
<!--<input id="usu" value="<?php echo $_SESSION['usuarios']['dni_usu']. ' - '.$_SESSION['usuarios']['con_usu'];?>">-->
    <input id="usu" value="<?php echo $_SESSION['usuarios']['dni_usu'];?>">
    <div class="primer-fila">
        <label  class="col-form-label">Codigo de compra:</label>
        <input type="text" value="<?php echo $cod;?>" id="tcod_com">

        <label for="col-form-label" class="fein">Fecha de Ingreso: </label>
        <input type="date" id="tfecom" value="<?php echo $fecha_compra?>">
    </div>
    <div class="segunda-fila">
    <label for="col-form-label" class="p">  Comprobante </label>
        <select name="" id="ttipcom">
            <option value="boleta">Boleta</option>
            <option value="factura">Factura</option>
        </select>

        <label for="col-form-label" class="p"> Proveedor</label>
        <select id="prove">
            <!-- Peticion ajax -->
        </select>

        <label for="">Descuento General:</label> <input type="text" id="tdes_com"><br>
        <input type="text" id="cod_pro"> <br><br>
    </div>

    <div class="tercera-fila">
        <label for="" class="p">Producto:</label><input type="text" id="tpro" placeholder="Buscar producto">
        <label for="" class="p"> Cantidad:</label><input type="text" id="tcan" >
        <label for="" class="p">Precio de Compra:</label><input type="text" id="tpre_ing">
        <button type="button" id="agregar_temporal" class="btn btn-primary btn-lg mt-0"><i class="fas fa-cart-plus"></i></button>
        <button type="button" id="actualizar" class="btn btn-primary btn-lg mt-0"><i class="fas fa-edit"></i></button>
    </div>

    <table border="1" id="tabla_mostrar">
        <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Precio Refe.</th>
            <th>Stock</th>
            <th>Agregar</th>
        </tr>
        <tbody id="datos">

        </tbody>
    </table><br><br>

    <!--Creacion de la tabla temporal -->
    <div id="tabla_temporal">
    <table>
        <thead>        
        <tr>
            <th id="cod_eli">Cod_eli</th>
            <th scope="col">Codigo</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Total</th>          
        </tr>
        </thead>
    <tbody id="datos_tabla">

    </tbody>
    </table>
    </div><br><br><br>
 <!--<h4>falta arreglar estos campos ya que no sale los datos correctos</h4>-->
    <div style="width: 200px;" id="x">
  
    
    <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Total Base: </span>
            <input type="text" id="ttotal" class="form-control" placeholder="total Base" aria-label="Username" aria-describedby="basic-addon1">
    </div><br>


    <div class="input-group mb-3">
         <span class="input-group-text" id="basic-addon1">IGV: </span>
        <input type="text" id="tigv" class="form-control" placeholder="IGV" aria-label="Username" aria-describedby="basic-addon1">
    </div><br>

    <div class="input-group mb-3">
         <span class="input-group-text" id="basic-addon1">Neto: </span>
        <input type="text" id="tneto" class="form-control" placeholder="Neto" aria-label="Username" aria-describedby="basic-addon1">
    </div><br><br>
 
 </div>
   

     <div class="container">
         <div class="row">
             <div class="col order-last">
        </div>

        <div class="col">
            <input type="submit" class="btn btn-danger" value="Cancelar" id="cancelar">
            <input type="submit" class="btn btn-primary"  value="Agregar Compra" id="agregar_compra">
         </div>

        <div class="col order-first">
    
        </div>
  </div>
  
    <script src="js/procesos_compras.js"></script>
</body>
</html>