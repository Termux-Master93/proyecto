<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel=StyleSheet href="css/productos.css" TYPE="text/css" MEDIA=screen>
    <title>Categorias</title>
</head>
<body>

<div class="modal fade" id="categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregando Nueva Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  style = "height: 220px">
        
          <div class="contenido_categoria">
             Codigo: <input type="text" id="tcod_cat"> <br> <br>
             Nombre: <input type="text" id="tnom_cat">
          </div>          
                
        </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="agregar">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
    
        <div class="filtro"> 
        <h4 class="titulo" id="t1"><i class="fas fa-bars mx-1 text-success"></i>Listado de Categorias</h4> 
        <label class="bus">Buscar : <input type="text" placeholder="Buscar por Nombre" id="tbus_cat"><button type="button" class="btn btn-primary tit_agr" data-bs-toggle="modal" data-bs-target="#categoria">
        Agregar Nueva Categoria
</button></div>
    </div><br>

    <div id="listado">
    <table >
      <thead>
          <tr>
              <th>Codigo</th>
              <th>Nombre</th>
          </tr>
      </thead>
        <tbody id="datos">
              <!--aki va peticion ajax para que llene la tabla -->
        </tbody>
    </table>
</div>




<!-- Modal para actualizar -->
<div class="modal fade" id="mod_act" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style = "height: 220px">
      
          <div class="contenido_categoria">
             Codigo: <input type="text" id="tcod_act"> <br> <br>
             Nombre: <input type="text" id="tnom_act">
          </div>   

        </div>
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





    <script src="js/procesos_categorias.js"></script>

</body>
</html>