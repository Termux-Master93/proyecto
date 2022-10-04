<?php
include("../conexion/conexion.php");
$accion=$_POST['accion'];

if($accion=='listar_usuarios'){
    $listar="select * from usuarios order by nom_usu";
    if(isset($_POST['dni_bus'])){
        $dni=$_POST['dni_bus'];
        $listar="select * from usuarios where dni_usu like '%$dni%' order by nom_usu";
    }
    $res=mysqli_query($cnn,$listar) or die("Error en listar");
    $res_usu=mysqli_num_rows($res);
    if($res_usu>0){
        while($f=mysqli_fetch_array($res)){
            $usuarios[]=array(
                'dni'=>$f['dni_usu'],
                'nombre'=>$f['nom_usu'],
                'apellidos'=>$f['ape_usu'],
                'direccion'=>$f['dir_usu'],
                'telefono'=>$f['tel_usu'],
                'sueldo'=>$f['sue_usu'],
                'foto'=>$f['fot_usu'],
                'nivel'=>$f['niv_usu'],
                'fecha'=>$f['fecing_usu'],
                'estado'=>$f['est_usu'],
            );
        }
        echo json_encode($usuarios);
    }else{
        echo "no_existe";
    }
    
}

if($accion=='agregar'){
    $dni=$_POST['dni'];
    $nom=$_POST['nom'];
    $ape=$_POST['ape'];
    $dir=$_POST['dir'];
    $tel=$_POST['tel'];
    $sue=$_POST['sue'];
    $img=$_POST['img'];
    $niv=$_POST['niv'];
    $fec=$_POST['fec'];
    $con=$_POST['con'];
   // $est=$_POST['est'];
   //echo $tel;
  $agregar="insert into usuarios (dni_usu,nom_usu,ape_usu,dir_usu,tel_usu,sue_usu,fot_usu,niv_usu,fecing_usu,con_usu)
   values('$dni','$nom','$ape','$dir','$tel',$sue,'$img',$niv,'$fec','$con')";
    mysqli_query($cnn,$agregar) or die("Error en agregar Usuario");
    echo "Agregado Correctamente";

   

}

if($accion=='eliminar'){
    $dni_eli=$_POST['dni'];
    $eliminar="delete from usuarios where dni_usu='$dni_eli'";
    mysqli_query($cnn,$eliminar) or die("Error en eliminar");
    echo "Eliminado Correctamente";
}

if($accion=='buscar_datos'){
    $dni_mod=$_POST['dni_mod'];
    $consulta="select * from usuarios where dni_usu='$dni_mod'";
    $res=mysqli_query($cnn,$consulta) or die("Error en buscar");
    while($f=mysqli_fetch_array($res)){
        $usuarios[]=array(
            'dni'=>$f['dni_usu'],
            'nombre'=>$f['nom_usu'],
            'apellidos'=>$f['ape_usu'],
            'direccion'=>$f['dir_usu'],
            'telefono'=>$f['tel_usu'],
            'sueldo'=>$f['sue_usu'],
            'foto'=>$f['fot_usu'],
            'nivel'=>$f['niv_usu'],
            'fecha'=>$f['fecing_usu'],
            'password'=>$f['con_usu'],
            'estado'=>$f['est_usu'],
        );
        echo json_encode($usuarios);
    }
}

if($accion=='actulizar'){
    $dni=$_POST['dni'];
    $nom=$_POST['nom'];
    $ape=$_POST['ape'];
    $dir=$_POST['dir'];
    $tel=$_POST['tel'];
    $sue=$_POST['sue'];
    $img=$_POST['img'];
    $niv=$_POST['niv'];
    $fec=$_POST['fec'];
    $con=$_POST['con'];
    
    $actualizar="update usuarios set nom_usu='$nom',ape_usu='$ape',dir_usu='$dir',tel_usu='$tel',sue_usu=$sue,fot_usu='$img',niv_usu=$niv,fecing_usu='$fec',con_usu='$con' where dni_usu='$dni'";
    mysqli_query($cnn,$actualizar) or die("ERROR EN ACTUALIZAR");
    echo "Actualizado Correctamente";
}

?>