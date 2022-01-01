<?php 
    include "./conexion.php";

    if(isset($_POST['nombre-up']) && isset($_POST['telefono-up']) && isset($_POST['correo-up']) && isset($_POST['id'])){

        $correo = $_POST['correo-up'];
        $id = $_POST['id'];
        $telefono = $_POST['telefono-up'];
        $nombre = $_POST['nombre-up'];

        $consulta_correo= $conexion->query("SELECT email FROM usuario WHERE email='".$_POST['correo_up']."' AND id=$id")or die($conexion->error);
        $datos = mysqli_fetch_row($consulta_correo);

        if($_POST['correo-up']!= $datos[0]){
            $consulta_correo2= $conexion->query("SELECT * FROM usuario WHERE email= '".$_POST['correo_up']."'")or die($conexion->error);

            if(mysqli_num_rows($consulta_correo2)>0){
                header("Location: ../myData.php?id=".$_POST['id']."&error=Este correo ya ha sido registrado");
            }     
        }
               
        $conexion->query("UPDATE usuario SET nombre='$nombre', telefono='$telefono', email='$correo' WHERE id=$id")or die($conexion->error);

        header("Location: ../myData.php?id=".$_POST['id']."&success=Se actualizaron los datos");

    }else{
        header("Location: ../myData.php?id=".$_POST['id']."&error=Complete todos los campos");
    }
?>