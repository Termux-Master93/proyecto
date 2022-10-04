<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Animated Sidebar CSS</title>
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/css/all.min.css">
   
    </head>                                                 

    <?php
session_start();
 $user=$_SESSION['usuarios']['dni_usu'];
if(!isset($_SESSION['usuarios']['dni_usu'])){
 
    echo"No ha iniciado sesion";
    header("location:./sesion/acceso.php");
    }
    ?>
    
  <body>
  

  <header>
    
        <div class="row">
          <div class="col">
          
              <span class="mostrar"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg></span>
            
            <h4 id="user" style="display: none;"><?php echo $user; ?></h4><!--aqui id usuario general-->
         
          <div class="container">
              <div class="col-4 position-absolute top-0 end-0 pe-5 pt-0">
                <div class="row">
                  <div class="col-3 mt-0 pt-0">
                    <img class="pb-3 mb-2 pt-0" src="img/logo.png" style="width: 4rem; height: 5rem;margin-left:-330px;">
                    
                  </div>
                  <div class="col-9 pt-3">
                    <h5 id="nom_user" class="text-white"></h5>
                    
                    <h5 id="cerrar_sesion">Cerrar sesion</h5>
                  </div>
                    
                </div>

              </div>
          </div>
        </div>
      </div>
    
</header> 

    <!-- AKI VA EL APARTADO PARA QUE CARGUE LAS HOJAS -->
    <div class="container">
          <div id="contenido" class="crud">
            
         </div> 
    </div>
    <div class="contenedor">
        <div class="menu">
              <li id="inicio"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" color="magenta" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
               <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
              </svg>
               <h6 class="texto" id="hoja-1">INICIO</h6></li>
        </div>
            
        <div class="menu">
               <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" color="orange" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" >
               <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path  fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg></span>
              <h6 class="texto1" id="hoja_personal">PERSONAL</h6></li>
         </div>

             
          <div class="menu">
             <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="yellow" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg></span>
              <h6 class="texto1" id="clientes">CLIENTES</h6></li>
          </div> 
          <div class="menu">
                 <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="aqua" height="30" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                    <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                    </svg></span>
                  <h6 class="texto1" id="proveedores">PROVEEDORES</h6>
                 </li>
             </div>
            
             <div class="menu">
                  <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="aqua" height="30" fill="currentColor" class="bi bi-hammer" viewBox="0 0 16 16">
                  <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
                  </svg></span>
                  <h6 class="texto1" id="hoja_productos">PRODUCTOS</h6></li>
             </div>

             <div class="menu">
                  <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="coral" height="30" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                  <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                  <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"/>
                  </svg></span>
                  <h6 class="texto1" id="hoja_categorias">CATEGORIAS</h6></li>
             </div> 

             <div class="menu">
                  <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="coral" height="30" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
                </svg></span>
                  <h6 class="texto1" id="reporte_ventas">REPORTE VENTAS</h6></li>
             </div> 
                 
             <div class="menu">
                  <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="coral" height="30" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
                </svg></span>
                  <h6 class="texto1" id="reporte_compras">REPORTE COMPRAS</h6></li>
             </div> 

           <div class="dropdown">
               <a href="#" class="dropdown-toggle x2"  id="dropdownMenuButton4" style="text-decoration: none;" color="coral" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="30" color="coral" height="30" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
               <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
               </svg><br> <h6 id="x2" style="color: white;">COMPRAS</h6></a>

           </div>
           
          <div class="menu">
               <li id="inicio"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" center; color="hotpink" height="30"  fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
               <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg></span>
              <h6 class="texto1" id="ventas">VENTAS</h6></li>
          </div>
   
</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script> 
<script src="js/popper.min.js"></script>    
<script  src="js/js/all.min.js"></script>
<script  src="js/jquery-3.6.0.min.js"></script>
<script src="printThis-master/printThis.js"></script>
<script  src="Print-Specified-Area-Of-A-Page-PrintArea/demo/jquery-1.10.2.js"></script>
<script src="Print-Specified-Area-Of-A-Page-PrintArea/demo/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
<script src="js/main.js"></script>
<script src="js/procesos_index.js"></script>
  </body>
</html>