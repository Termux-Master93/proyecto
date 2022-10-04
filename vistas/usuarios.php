<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK rel=StyleSheet href="css/productos.css" TYPE="text/css" MEDIA=screen>
    <LINK rel=StyleSheet href="css/usuarios.css" TYPE="text/css" MEDIA=screen>
    <title>Usuarios</title>
</head>
<body>
    <!-- Modal para agregar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregando Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  style = "height: 550px">
     <form>
        <div class="izquierda">
            DNI: <input type="text" class="form-control" aria-label="First name" id="tdni" autofocus><br>
            Nombre: <input type="text" class="form-control" aria-label="First name" id="tnom"><br>
            Apellido: <input type="text" class="form-control" aria-label="First name" id="tape"><br>
            Telefono: <input type="text" class="form-control" aria-label="First name" id="ttel"><br>
            Direccion: <input type="text" class="form-control" aria-label="First name" id="tdir"><br>
           
           
        </div>
         <div class="derecha_usuarios">
            Contraseña: <input type="password" class="form-control" aria-label="First name" id="tcon"><br>
            Sueldo: <input type="text" class="form-control" aria-label="First name" id="tsue"><br>
            Fecha de Ingreso: <input type="date" class="form-control" aria-label="First name" id="tfec"><br>
            Foto: <input type="file" class="form-control" aria-label="First name" id="timg"><br>
            Nivel: <select name="" id="tniv">
                <option value="1">Ayudante</option>
                <option value="2">Administrador</option>
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
 
    <div id="buscar"></div>
     
        <div class="filtro">
          <h4 class="titulo" id="t1"><i class="fas fa-bars mx-1 text-success"></i>Listado de Usuarios</h4>
           <label class="bus">Buscar : <input type="text" placeholder="Buscar por DNI" id="tbus_usu"><button type="button" class="btn btn-primary tit_agr" data-bs-toggle="modal" data-bs-target="#exampleModal">
           <i  class="fas fa-user-plus"></i>
</button></div>
    </div><br>

    <div id="listado">
    <table id="datos_tabla" border="2">
      <thead>
          <tr>
              <th>DNI</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Foto</th>
              <th>Sueldo</th>
              <th>Nivel</th>
              <th>Fecha de Ingreso</th>
          </tr>
      </thead>
        <tbody id="datos">

        </tbody>
    </table>
</div>


<!-- Modal para actualizar -->
<div class="modal fade" id="mod_act" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style = "height: 550px">
      <form>
        <div class="izquierda">
            DNI: <input type="text" class="form-control" aria-label="First name" id="tdni_ac" autofocus><br>
            Nombre: <input type="text" class="form-control" aria-label="First name" id="tnom_ac"><br>
            Apellido: <input type="text" class="form-control" aria-label="First name" id="tape_ac"><br>
            Telefono: <input type="text" class="form-control" aria-label="First name" id="ttel_ac"><br>
            Direccion: <input type="text" class="form-control" aria-label="First name" id="tdir_ac"><br>
           
           
        </div>
         <div class="derecha_usuarios">
            Contraseña: <input type="password" class="form-control" aria-label="First name" id="tcon_ac"><br>
            Sueldo: <input type="text" class="form-control" aria-label="First name" id="tsue_ac"><br>
            Fecha de Ingreso: <input type="date" class="form-control" aria-label="First name" id="tfec_ac"><br>
            Foto: <input type="file" class="form-control" aria-label="First name" id="timg_ac"><br>
            Nivel: <select name="" id="tniv_ac">
                <option value="1">Ayudante</option>
                <option value="2">Administrador</option>
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


    


    <script src="js/procesos_usuarios.js"></script>

</body>
</html>