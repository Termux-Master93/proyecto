<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel=StyleSheet href="css/productos.css" TYPE="text/css" MEDIA=screen>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <LINK rel=StyleSheet href="css/usuarios.css" TYPE="text/css" MEDIA=screen>
    <script src="js/procesos_productos.js"></script>
   <!--<script src="js/sweetalert2.all.min.js"></script>-->
    <title>Productos</title>
</head>
<body>

<!-- Modal para agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregando Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  style = "height: 450px">
     <form>
        <div class="izquierda">
            Codigo: <input type="text" class="form-control" aria-label="First name" id="tcod" autofocus><br>
            Marca: <input type="text" class="form-control" aria-label="First name" id="tmar"><br>
            Descripcion: <textarea id="tdes" cols="44" rows="3" class="form-control"></textarea><br>
            
            Categoria: <select id="tcat">
             <!-- aki va peticion ajax para llenar categoria -->
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" id="icono_cat" width="25" height="25" fill="#259f48" class="bi bi-plus-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg><br>
        </div>
         <div class="derecha">
            Producto: <input type="text" class="form-control" aria-label="First name" id="tpro"><br>
            Precio: <input type="text" class="form-control" aria-label="First name" id="tpre"><br>
            Stokc: <input type="text" class="form-control" aria-label="First name" id="tsto"><br>
            Ubicacion: <select id="tubi">
            <option value="1">Estantate 1</option>
            <option value="2">Estantate 2</option>
            <option value="3">Estantate 3</option>
          </select>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="agregar">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
        
        <div class="filtro">
        <h4 class="titulo" id="t1"><i class="fas fa-bars mx-1 text-success"></i>Listado de Productos</h4>  
        <label class="bus">Buscar : <input type="text" placeholder="Buscar..." id="tbus_pro"><button type="button" class="btn btn-primary tit_agr" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Agregar Nuevo Producto 
</button></div>
    </div><br>

    <div id="listado">
    <table id="datos_tabla">
      <thead>
          <tr>
              <th>Codigo</th>
              <th>Producto</th>
              <th>Categoria</th>
              <th>Marca</th>
              <th>Ubicacion</th>
              <th>Descripcion</th>
              <th>Precio</th>
              <th>Stock</th>
          </tr>
      </thead>
        <tbody id="datos">

        </tbody>
    </table>
</div>


<!-- Button trigger modal -->

<button type="button" class="btn btn-primary actualizar" data-bs-toggle="modal" data-bs-target="#x">
  ACTUALIZAR
</button>

<!-- Modal para actualizar -->
<div class="modal fade" id="mod_act" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style = "height: 350px">
      <form>
        <div class="izquierda_actualizar">
            Codigo: <input type="text" class="form-control" aria-label="First name" id="tcod_ac">
            Marca: <input type="text" class="form-control" aria-label="First name"  id="tmar_ac">
            Descripcion:<textarea id="tdes_ac" cols="44" rows="3" class="form-control">Ingrese descripcion</textarea><br>
            Categoria: <select id="tcat_actualizar">
             <!-- aki va peticion ajax para llenar categoria -->
            </select>
            <br>
        </div>
         <div class="derecha_actualizar">
            Producto: <input type="text" class="form-control" aria-label="First name" id="tpro_ac" value="" autofocus>
            Precio: <input type="text" class="form-control" aria-label="First name"  id="tpre_ac">
            Stokc: <input type="text" class="form-control" aria-label="First name" id="tsto_ac">
            Ubicacion: <select id="tubi_ac">
            <option value="1">Estantate 1</option>
            <option value="2">Estantate 2</option>
            <option value="3">Estantate 3</option>
          </select>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="actualizar">Actualizar</button>
      </div>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal para categoria-->
<div class="modal fade" id="categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style = "height: 220px">
          <div class="contenido_categoria">
            Codigo: <input type="text" id="tcod_cat"> <br> <br>
            Nombre: <input type="text" id="tnom_cat">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="agregar_categoria">Agregar</button>
      </div>
    </div>
  </div>
</div>







</body>
</html>