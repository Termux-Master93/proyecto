
<?php

$accion=$_POST['accion'];
if($accion=='cerrar'){

    session_start();
    session_destroy();
    }
 ?>