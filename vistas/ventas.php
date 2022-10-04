<?php 
	date_default_timezone_set("America/Lima");
	$fecha_venta=date("Y-m-d");
	$codigo_ven=date("j-n-y | h:i:s");
	//$mes=date("m");

 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet"  href="../css/main_clientes.css">
    <title>Clientes</title>
  </head>
  <body>
  <div class="ocultar">
  	<div class="container">
  		<div class="row">

  		<div class="col">
	  		 <div class="mb-3">
		      <label for="cod_ven" class="col-form-label">CODIGO:</label>
            <div class="refres_cod">
					   <input  id="cod_ven" class="form-control form-control-lg" type="text" aria-label=".form-control-lg example" value="">
	          </div>

      		</div>  
      </div>
  			<div class="col">
  				
  			</div>
	        <div class="col">
	          	<div class="mb-3">
		            <label for="fet_ven" class="col-form-label">FECHA:</label>
		            <input required type="date" class="form-control form-control-lg" id="fet_ven" value="<?php echo $fecha_venta; ?>" >
		           
	          </div>	
	        </div>
        </div>
        <div class="bg-light"><!--contendor datos cliente-->
          <div class="row px-3 py-3"> 
            <div class="col-3"> 
              <label for="form-select" class="col-form-label fw-lighter fs-5">Seleccione Comprovante:</label>
                <div class="me-5">

                 <select class="form-select" id="tip_con" multiple aria-label="multiple select example">
                   <option selected value="0">--TIPO DE COMPROVANTE--</option>
                    <option  value="1">TICKET</option>
                    <option value="2">FACTURA</option>
                    <option value="3">BOLETA</option>
                  </select>
                  <span class="badge bg-danger" id="error_tic" style="display: none;">Seleccione Comprovante...</span>
                </div>
              </div>
            	<div class="col-3">
               <label for="valores" class="col-form-label fw-lighter fs-5">Cliente Eventual:</label>
              	<div class="input-group mt-0">	  
        					<input name="valores" class="form-control form-control-lg" list="buscar_cliente" id="dni_cli" placeholder="Ingrese...! cliente"> 
        					<datalist id="buscar_cliente">
        					  
        					</datalist>

        				  <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button> 
                  <span class="badge bg-danger" id="error_bdni" style="display: none;">Busque RUP o agrege Cliente...</span>
        				</div>
    			   </div>
            	<div class="col-3">
              	<div class="position-relative">
        				<h1 id="btn_agc" class="position-absolute start-50 mt-5 translate-middle text-success" data-bs-toggle="modal" data-bs-target="#cliente_venta"><i  class="fas fa-user-plus"></i></h1>	
        				 </div>
            	</div>
            	<div class="col-3">
    	  		    <div class="mt-0">
    		          <label for="cli_bus" class="col-form-label fw-lighter fs-5">Cliente:</label>
    					     <input class="form-control form-control-lg" id="cli_bus" type="text" placeholder="Cliente buscado" aria-label=".form-control-lg example">
    	           </div>
                <span class="badge bg-danger" id="error_nom" style="display: none;" >Ingrese Minimo un Nombre...</span>
            	</div>
              <div class="col-3" style="display: none;">
                <div class="mt-0">
                  <label for="rup_cli" class="col-form-label fw-lighter fs-5">rup:</label>
                   <input class="form-control form-control-lg" id="rup_cli" type="text" placeholder="Cliente buscado" aria-label=".form-control-lg example">
                 </div>
              </div>
          </div>
        </div>
        
        <div class="bg-light my-3 px-3 py-3">
          <div class="row"><!--Datos de los productos-->
          	<div class="col-3">
              <label for="cod_pro" class="col-form-label">Buscar Producto:</label>
              <div class="input-group mt-0">	  
      					<input class="form-control form-control-lg" list="buscar_producto" id="cod_pro" placeholder="Ingrese...! Producto">
      					<datalist id="buscar_producto">
      		
      					</datalist>


      				  <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>

      				</div>

              <span class="badge bg-danger" id="error_pro" style="display: none;">Busque Producto...</span>
              <span class="badge bg-danger" id="error_stc" style="display: none;" >Stock Bajo...</span>
          	</div>
            <div class="col-2 bg-info rounded-start" id="ocultar_des" style="display: none;">
                <div class="mt-3">
                  <h5 class="nom_produc"></h5>
                  <div id="des">

                   <!--aqui descripcion-->

                  </div> 
                    <h6 id="stock" class="text-center fw-bolder"> </h6>      
                </div>
            </div>
          	<div class="col-2">
   	  		    <div class="mt-2">
  		            <label for="can_pro" class="col-form-label">CANT/UND:</label>
  					     <input id="can_pro" class="form-control form-control-lg" type="text" placeholder="Unidades" aria-label=".form-control-lg example">
                 <span class="badge bg-danger" id="error_cant" style="display: none;">Ingrese Cantidad...</span>
  	          </div>       		
          	</div>
          	<div class="col-2">
  	  		    <div class="mt-2">
  		            <label for="pre_pro class" class="col-form-label">PRECIO:</label>
  					     <input id="pre_pro" class="form-control form-control-lg" type="text" placeholder="Precio" aria-label=".form-control-lg example">
  	          </div>
          	</div>
          	<div class="col-2">
  	  		  <div class="mt-2">
  		          <label for="des_pro" class="col-form-label">DESCUENTO:</label>
  					   <input id="des_pro" class="form-control form-control-lg fs-5" type="text" placeholder="descuento" aria-label=".form-control-lg example"> 
               <input id="con_oculto" style="display: none;" class="form-control form-control-lg fs-5" type="text" placeholder="descuento" aria-label=".form-control-lg example">
  	          </div>
          	</div>

            <div class="row">
                  <div class="col-10">
                    
                  </div>
                  <div class="col-2"><!--botones -->
          	  		   <div class="mt-3">
          				      <button type="button" id="btn_com" class="btn btn-primary btn-lg mt-4"><i class="fas fa-cart-plus"></i></button>
                        <button type="button" id="btn_acp" style="display: none;"  class="btn btn-primary btn-lg mt-4"><i class="fas fa-edit"></i></button>
          	          </div>
              	 </div>
            </div>
          </div>
        </div>
        <div class="row">
           <table class="table table-striped " border="2" id="tabla_tmp">
            <thead class="border-success">
                <th class="table-primary">PRODUCTO</th>
                <th class="table-primary">CANTIDAD</th>  
                <th class="table-primary">DESCRIPCION</th>
                <th class="table-primary">DESCUENTO</th>
                <th class="table-primary">PRECIO</th> 
                <th class="table-primary">TOTAL</th>  
                <th class="table-primary">ACCIONES</th> 
                <th class="table-primary"></th>              
            </thead>
            <tbody id="list_productos">
                          
            </tbody>
            
           </table>
           <div class="row">
            <div class="col-3">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                  <div class="card-header">CALCULAR VUELTO</div>
                  <div class="card-body">
                     <div class="col">
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Monto: </span>
                          <input type="text" id="txt_mvu" class="form-control" placeholder="Efectivo" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                       <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Vuelto: </span>
                          <input type="text" id="txt_vue" class="form-control" placeholder="dar vuelto" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="row">
                          <div class="col">
                            <button class="btn btn-danger" id="btn_cal" type="button">CALCULAR</button>
                          </div>
                          <div class="col">
                            <button class="btn btn-danger"  id="btn_lim"  type="button"><i class="fas fa-broom"></i></button>
                          </div>                          
                        </div>
<div class="d-print-none">Screen Only (Hide on print only)</div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col">
           <div class="row">
              <div class="col-8">
                
              </div>
               
               <div class="col-3">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Base: </span>
                  <input type="text" id="total" class="form-control" placeholder="total Base" aria-label="Username" aria-describedby="basic-addon1">
                </div>
              </div>
           </div>
           <div class="row mt-3">
              <div class="col-8">
                
              </div>
               
               <div class="col-3">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">IGV: </span>
                  <input type="text" id="igv" class="form-control" placeholder="IGV" aria-label="Username" aria-describedby="basic-addon1">
                </div>
              </div>
           </div>
           <div class="row mt-3">
              <div class="col-8">
                
              </div>
               
               <div class="col-3">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">NETO: </span>
                  <input type="text" id="neto" class="form-control" placeholder="total Recibir" aria-label="Username" aria-describedby="basic-addon1">
                </div>
              </div>
           </div>          
           </div>  
           </div>
        </div>

       <div class="d-grid gap-2 col-6 mx-auto">
        <div class="row mt-3">
          <div class="col">
            <button id="can_ven" class="btn btn-danger" type="button">CANCELAR VENTA</button>
          </div>
          <div class="col">
            <button id="btn_nuev" class="btn btn-primary" type="submit">AGREGAR NUEVA VENTA</button>
          </div>
        </div>
      </div>
    </div><!--cierre de container-->

 
 <div class="modal fade" id="cliente_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAMOS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="txt_dni_v" class="col-form-label">DNI:</label>
            <input required type="text" class="form-control" id="txt_dni_v" >
            <span class="badge bg-danger" id="error1" style="display: none;"> Su Dni Porfavor...</span>
          </div>
          <div class="mb-3">
            <label for="txt_nom_v" class="col-form-label">NOMBRES:</label>
            <input type="text" class="form-control" id="txt_nom_v">
            <span class="badge bg-danger" id="error2" style="display: none;">Su Nombre Porfavor...</span>
          </div>
          <div class="mb-3">
            <label for="txt_ape_v" class="col-form-label">APELLIDOS:</label>
             <input type="text" class="form-control" id="txt_ape_v">
            <span class="badge bg-danger" id="error3" style="display: none;">Sus apellidos Porfavor...</span>
          </div>
          <div class="mb-3">
            <label for="txt_tel_v" class="col-form-label">TELEFONO:</label>
             <input type="text" class="form-control" id="txt_tel_v">
          </div>
          <div class="mb-3">
            <label for="txt_dir_v" class="col-form-label">DIRECCION:</label>
             <input type="text" class="form-control" id="txt_dir_v">
          </div>
          <div class="mb-3">
            <label for="txt_ruc_v" class="col-form-label">RUC:</label>
             <input type="text" class="form-control" id="txt_ruc_v">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btn_can" data-bs-dismiss="modal">CANCELAR</button>
        <button type="button" id="btn_gcv" class="btn btn-primary">GUARDAR</button>
       
      </div>
    </div>
  </div>


</div> 

  <div id="ticked" style="display: none;"><!--aqui pues haciendo mi ticked-->
    <div class="row">
        <div class="col">
         <span>TICKET N°:</span><p class="text-center" id="cod_compro"></p>
        </div>
    </div>
    <div class="col">
       <h5 class="text-center">Negocios el agarre de Pablo</h5>
    </div>
    <div class="row">   
         <h5>Cliente: <span id="nom_con">Varios</span></h5> 
    </div>
    <div class="row">   
         <h5>N°: <span id="dni_con"></span></h5> 
    </div>
    <div class="row">
      <table class="table-danger">
        <thead>
          <th>Descripcion</th>
          <th>Cantidad</th>
          <th>Precio.UNIT</th>
          <th>Total</th>
        </thead>
        <tbody id="list_comprovante">
                          
        </tbody>

      </table>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>Total a Pagar: </h6>
       </div>  
       <div class="col-2">
        <h6 id="net_con">...</h6>
      </div>
    </div>
    <div class="row">
      <h5 class="text-center">Gracias Por Visitarnos</h5>
    </div>
</div><!--cierre de ticket-->

  <div id="factura" style="display: none;"><!--aqui pues haciendo mi ticked-->
    <div class="row">
        <div class="col">
          <p class="text-center" id="cod_fac">FACTURA N°:</p>
        </div>
    </div>
    <div class="col">
       <h5 class="text-center">Negocios Rafo/h5>
    </div>
    <div class="row">   
         <h5>Cliente: <span id="nom_fac">Varios</span></h5> 
    </div>
    <div class="row">   
         <h5>N°: <span id="dni_fac"></span></h5> 
    </div>
    <div class="row">
      <table class="table-danger">
        <thead>
          <th>Descripcion</th>
          <th>Cantidad</th>
          <th>Precio.UNIT</th>
          <th>Total</th>
        </thead>
        <tbody id="list_factura">
                          
        </tbody>

      </table>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>OP Gravadas:  </h6>
       </div>  
       <div class="col-2">
        <h6 id="gra_fac">...</h6>
      </div>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>OP Exonerada: </h6>
       </div>  
       <div class="col-2">
        <h6 id="exo_fac">...</h6>
      </div>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>IGV: </h6>
       </div>  
       <div class="col-2">
        <h6 id="igv_fac">...</h6>
      </div>
    </div>
      <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>NETO: </h6>
       </div>  
       <div class="col-2">
        <h6 id="net_fac">...</h6>
      </div>
    </div>
    <div class="row">
      <h5 class="text-center">Gracias Por Visitarnos</h5>
    </div>
</div><!--cierre de factura-->

  <div id="boleta" style="display: none;"><!--aqui pues haciendo mi boleta-->
    <div class="row">
        <div class="col">
         BOLETA N°:<p class="text-center" id="cod_bol"></p>
        </div>
    </div>
    <div class="col">
       <h5 class="text-center">Negocios el agarre de Pablo</h5>
    </div>
    <div class="row">   
         <h5>Cliente: <span id="nom_bol">Varios</span></h5> 
    </div>
    <div class="row">   
         <h5>N°: <span id="dni_bol"></span></h5> 
    </div>
    <div class="row">
      <table class="table-danger">
        <thead>
          <th>Descripcion</th>
          <th>Cantidad</th>
          <th>Precio.UNIT</th>
          <th>Total</th>
        </thead>
        <tbody id="list_boleta">
                          
        </tbody>

      </table>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>OP Gravadas:  </h6>
       </div>  
       <div class="col-2">
        <h6 id="gra_bol">...</h6>
      </div>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>OP Exonerada: </h6>
       </div>  
       <div class="col-2">
        <h6 id="exo_bol">...</h6>
      </div>
    </div>
    <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>IGV: </h6>
       </div>  
       <div class="col-2">
        <h6 id="igv_bol">...</h6>
      </div>
    </div>
      <div class="row">
      <div class="col-8"></div>
      <div class="col-2">
        <h6>NETO: </h6>
       </div>  
       <div class="col-2">
        <h6 id="net_bol">...</h6>
      </div>
    </div>
    <div class="row">
      <h5 class="text-center">Gracias Por Visitarnos</h5>
    </div>
</div><!--cierre de factura-->
</div>

    <script src="js/procesos_ventas.js"></script>
  </body>

</html>