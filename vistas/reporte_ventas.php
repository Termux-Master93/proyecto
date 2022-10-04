<?php  
	date_default_timezone_set("America/Lima");
	$fecha_venta=date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel=StyleSheet href="css/productos.css" TYPE="text/css" MEDIA=screen>
    <LINK rel=StyleSheet href="css/usuarios.css" TYPE="text/css" MEDIA=screen>
    <title>Reportes ventas</title>
</head>
<body>
   <div class="container bg-light p-2">
   	  		<div class="row mt-4">
	  			<div class="col-4">
	  				<h3><i class="fas fa-bars mx-1 text-success"></i>Reporte Ventas</h3>	
	  			</div>
	    		
	    		<div class="col-4">
					<div class="input-group mb-3">
					  <input type="text"  id="txt_bve" class="form-control border border-success" placeholder="Ingrese..." aria-label="Recipient's username" aria-describedby="button-addon2">
					  <button class="btn btn-outline-secondary " type="button" id="button-addon2"><i class="fas fa-search"></i></button>
					</div>
	  			</div>
	  			<div class="col-4">
	  				<div class="position-relative">
	  					<h1 id="ir_ven"  class="position-absolute start-50 mt-3 translate-middle text-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i><span class="fs-5  mb-5"></span></h1>
	  				</div>
	  			</div>
	  			
	  			<h6 >Buscar Por fecha</h6>
	  				<div class="row bg-white p-2"><!-- btones de filtros-->
			    		<div class="col-3 ">
							<div class="input-group">
							  <span class="mt-2 me-1 fs-5">De:</span> <input type="date"  id="txt_fin" class="form-control  border-radius border border-success" placeholder="Ingrese..." >
							
							</div>
			  			</div>
			  			
			  			<div class="col-4 ">
							<div class="input-group">
							  <span class="mt-2 me-2  fs-5">Hasta:</span> <input type="date"  id="txt_ffi" value="<?php echo $fecha_venta; ?>" class="form-control  border-radius border border-success" placeholder="Ingrese..." aria-label="Recipient's username" aria-describedby="button-addon2">
							  <button class="btn btn-outline-secondary " type="button" id="bus_rangos"><i class="fas fa-search"></i></button>
							</div>
			  			</div>
			  			<div class="col-2"><!--boton para imprimir reporte-->
			  				<button type="button" id="print_rep" class="btn btn-success"><i class="far fa-file-pdf"></i></button>
			  			</div>
			  			<div class="col">
							<div class="input-group">
								<button class="btn btn-outline-secondary " type="button" id="imp_sun"><small class="fw-bold">Monto Sunat</small></button>
								 <input type="text"  id="importe_sun" class="form-control  border-radius border border-success" placeholder="Importe" aria-label="Recipient's username" aria-describedby="button-addon2">
							  
							</div>
						</div>				  				
			  			</div>
		  			</div>
		  		<div class="row mt-2" id="tbl_reporte">
		  			<table class="table table-striped table-hover" border="1">
				        <thead class="border border-success">
				          <th class="table-primary" >FECHA Y HORA</th>
				          <th class="table-primary" >ClIENTE</th>
				          <th class="table-primary" >VENDEDOR</th> 
				          <th class="table-primary" >TOTAL COMPROVANTE</th>
				          <th class="table-primary" >TIPO COMPROVANTE</th>
				          <th class="table-primary" >ESTADO</th>
				    	  <th class="table-primary" >ACCIONES</th>
				          <th class="table-primary" ></th>
				        </thead>
				        <tbody id="datos_ventas">
				 	
				        </tbody>
			      </table>
			      <div class="col-3"></div>
			      <div class="col-4">
			      	<div class="input-group mb-3 float-end">
					  <span class="input-group-text">S/.</span>
					  <span class="input-group-text">Soles</span>
					  <input type="text" id="tot_rep" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
					</div>
			      </div>
			      <div class="col-4">
		      	
			      </div>
		  		</div>	
		  		

    		</div>
   </div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">DETALLE DE VENTA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">

		  	<div class="row mt-2">
		  		<table class="table table-striped table-hover" border="1">
				    <thead class="border border-success">
				         <th class="table-primary" >PRODUCTO</th>
				         <th class="table-primary" >DESCRIPCION</th>
				         <th class="table-primary" >CANTIDAD</th> 
				         <th class="table-primary" >DESCUENTO</th>
				         <th class="table-primary" >PRECIO</th>
				      
				    </thead>
				    <tbody id="datos_detalle">
				 	
				    </tbody>
			     </table>
		  	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
   <script src="js/proceso_reporte_ventas.js"></script>
</body>
</html>

