<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Proevedores</title>
  </head>
  <body>
   	<div class="container">
  		<div class="row mt-4">
  			<div class="col-4">
  				<h3><i class="fas fa-bars mx-1 text-success"></i>Lista de Proevedores</h3>	
  			</div>
    		
    		<div class="col-4">
				<div class="input-group mb-3">
				  <input type="text"  id="txt_bpro" class="form-control border border-success" placeholder="Ingrese..." aria-label="Recipient's username" aria-describedby="button-addon2">
				  <button class="btn btn-outline-secondary text-success" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
				</div>
  			</div>
  			<div class="col-4">
  				<div class="position-relative">
  					<h1 id="ing_agre" class="position-absolute start-50 mt-3 translate-middle text-success" data-bs-toggle="modal" data-bs-target="#modelproevedor"><i  class="fas fa-user-plus"></i></h1>	
  				</div>
  			</div>
    	</div>
    </div><!--cierre de parte del buscador-->
    <div class="container">
      <table class="table table-striped table-hover" border="1">
        <thead class="border border-success">
          <th class="table-primary" >DNI</th>
          <th class="table-primary" >NOMBRES</th>
          <th class="table-primary" >APELLDOS</th>
          <th class="table-primary" >TELEFONO</th>
          <th class="table-primary" >RAZON SOCIAL</th>
          <th class="table-primary" >RUC</th>
          <th class="table-primary" >DIRECCIÓN</th>
          <th class="table-primary" >ACCIONES</th>
          <th class="table-primary" ></th>
        </thead>
        <tbody id="datos_pro">
 	
        </tbody>
      </table>
    </div>

<div class="modal fade" id="modelproevedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="text_agre">AGREGAMOS PROEVEDOR</h5>
        <h5 class="modal-title" id="text_act">ACTUALIZAR PROEVEDOR</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="txt_dni" class="col-form-label">DNI:</label>
            <input required type="text" class="form-control" id="txt_dnip" >
            <span class="badge bg-danger" id="error1" style="display: none;"> Su Dni Porfavor...</span>
          </div>
          <div class="mb-3">
            <label for="txt_nom" class="col-form-label">NOMBRES:</label>
            <input type="text" class="form-control" id="txt_nomp">
            <span class="badge bg-danger" id="error2" style="display: none;">Su Nombre Porfavor...</span>
          </div>
          <div class="mb-3">
            <label for="txt_ape" class="col-form-label">APELLIDOS:</label>
             <input type="text" class="form-control" id="txt_apep">
            <span class="badge bg-danger" id="error3" style="display: none;">Sus apellidos Porfavor...</span>
          </div>
          <div class="mb-3">
            <label for="txt_tel" class="col-form-label">TELEFONO:</label>
             <input type="text" class="form-control" id="txt_telp">
          </div>
          <div class="mb-3">
            <label for="txt_dir" class="col-form-label">RAZON SOCIAL:</label>
             <input type="text" class="form-control" id="txt_razp">
          </div>
          <div class="mb-3">
            <label for="txt_dir" class="col-form-label">DIRECCION:</label>
             <input type="text" class="form-control" id="txt_dirp">
          </div>
          <div class="mb-3">
            <label for="txt_ruc" class="col-form-label">RUC:</label>
             <input type="text" class="form-control" id="txt_rucp">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btn_can" data-bs-dismiss="modal">CANCELAR</button>
        <button type="button" id="btn_guap" class="btn btn-primary">GUARDAR</button>
        <button type="button" id="btn_actp" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>
 <script src="js/procesos_proevedor.js"></script>
  </body>
</html>