<?php 
    include "./conexion.php";

    if(isset($_POST['codigo-reg']) && isset($_POST['valor-reg']) && isset($_POST['fecha-reg'])){


        $consulta=$conexion->query("SELECT id FROM cupones");

        $numero = mysqli_num_rows($consulta)+1;

        $codigo_cupon = $_POST['codigo-reg'].$numero;

        $conexion->query("INSERT INTO cupones(codigo, tipo, valor, 	status, fechaVencimiento) VALUES('$codigo_cupon','".$_POST['opcion-reg']."',".$_POST['valor-reg'].",'Activo','".$_POST['fecha-reg']."')")or die($conexion->error);

        header("Location: ../admin/cupons.php?success=Cupón Registrado");
    

    }else{
        header("Location: ../admin/cupons.php?error=Complete todos los campos");
    }
?>