<?php 
    include "./conexion.php";

    if(isset($_POST['email_login']) && isset($_POST['pass_login'])){

        $resultado = $conexion->query("SELECT * FROM usuario WHERE email='".$_POST['email_login']."' AND password='".sha1($_POST['pass_login'])."' LIMIT 1")or die($conexion->error);

        if(mysqli_num_rows($resultado)>0){

            $datosUsuario = mysqli_fetch_row($resultado);

            $id = $datosUsuario[0];
            $nombre = $datosUsuario[1];
            $correo = $datosUsuario[3];
            $imagen = $datosUsuario[5];
            $nivel = $datosUsuario[6];

            session_start();
            $_SESSION['datos_login']= array(
                'nombre'=>$nombre,
                'id_usuario'=>$id,
                'correo'=>$correo,
                'imagen'=>$imagen,
                'nivel'=>$nivel
            );

            if($nivel=="Administrador"){
                header("Location: ../admin/products.php");
            }elseif($nivel=="Cliente"){
                header("Location: ../my-orders.php");
            }
            
        }else{
            header("Location: ../login.php?error=Datos Incorrectos");
        }
    }else{
        header("Location: ../login.php?error=Complete los campos");
    }
?>