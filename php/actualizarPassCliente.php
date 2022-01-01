<?php 
    include "./conexion.php";
    /*
    if(isset($_POST['pass1-up']) && isset($_POST['pass2-up']) && isset($_POST['passActual-up']) && isset($_POST['id-pass'])){
        
        if($_POST['pass1-up'] != $_POST['pass2-up']){
            header("Location: ../myData.php?id=".$_POST['id-pass']."&error2=Las contraseñas no coinciden");
        }

        $clave = sha1($_POST['passActual-up']);
        $id = $_POST['id-pass'];
        $newClave = sha1($_POST['pass1-up']);

        $consulta_identidad = $conexion->query("SELECT * FROM usuario WHERE password='$clave' AND id=$id")or die($conexion->error);

        if(mysqli_num_rows($consulta_identidad)>0){
            header("Location: ../myData.php?id=".$_POST['id-pass']."&error2=Las credenciales no son validas");
        } 
               
        $conexion->query("UPDATE usuario SET password='$newClave' WHERE id=$id")or die($conexion->error);

        header("Location: ../myData.php?id=".$_POST['id-pass']."&success2=Se actualizo la contraseña");
        
    }else{
        header("Location: ../myData.php?id=".$_POST['id-pass']."&error2=Complete todos los campos");
    }
    */
    header("Location: ../myData.php?id=".$_POST['id-pass']."&error3=Estamos trabajando en esto");
?>