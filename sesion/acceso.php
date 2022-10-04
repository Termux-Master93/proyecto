<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/estilos_validaciones.css">

    <title>Document</title>
</head>

<body class="bg-gradient-primary">

<div class="container"  class="thumbnail" >
  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-12 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image">
              <img src="../img/logo_social.png" class="img-thumbnail">
            </div>
            <div class="col-lg-6">
                 <div class="p-5">
                <div class="text-center">
                  <h1 class="h3 text-gray-900 mb-3">Iniciar Sesión</h1>
                  </div>
                <form class="formulario" method="POST" id="formulario"> 
                  <?php echo isset($alert) ? $alert : ""; ?>
    <div class="form-group">
                    
 <!-- Grupo: Usuario -->
 <div class="formulario__grupo" id="grupo__usuario">
				<label for="usuario" class="formulario__label">Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="dni_usu" id="usuario" placeholder="10203040">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 1 a 8 dígitos y solo numeros.</p>
			</div>
       
                  
                  	<!-- Grupo: Contraseña -->
             <div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="con_usu" id="password">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
			</div>
 
      <div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class=" formulario__btn" name="btn" >Enviar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			</div>
                       
                 
       </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
  


<?php 
$alert = '';
session_start();
include("../conexion/conexion.php");    
if(isset($_POST['btn'])){
    $dni_usu=$_POST['dni_usu'];
    $con=$_POST['con_usu'];
   $buscar="select *  from usuarios where dni_usu='$dni_usu' and con_usu='$con' ";
    $res=mysqli_query($cnn,$buscar)or die("error  en  buscar usuario");
     $num_res=mysqli_num_rows($res);
     if($num_res==1){
       $res_a=mysqli_fetch_array($res);
        $_SESSION['usuarios']['dni_usu']=$res_a['dni_usu'];
        $_SESSION['usuarios']['con_usu']=$res_a['con_usu'].' '.$res_a['nom_u'];
            header("location:../index.php");
            }else {
              $alert = '<div class="alert alert-danger" role="alert">
                    Usuario o Contraseña Incorrecta
                  </div>';
              session_destroy();
            }
                
            }
?>


            <script src="../js/validaciones.js"></script>
    </body>


</html>