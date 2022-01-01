<?php 
    include "./conexion.php";

    if(isset($_POST['nombre-up']) && isset($_POST['precio-up']) && isset($_POST['cantidad-up']) && $_POST['categoria-up']!=0 && isset($_POST['norma-up'])  && isset($_POST['material-up']) && isset($_POST['id-up'])){

        $id = $_POST['id-up'];
        $nombre = $_POST['nombre-up'];

        $consulta_producto= $conexion->query("SELECT * FROM productos WHERE id=$id AND nombre='$nombre'");
        $datos = mysqli_fetch_row($consulta_producto);

        if($_POST['nombre-up']!= $datos[1]){

            $consulta_nombre= $conexion->query("SELECT id FROM productos WHERE nombre=".$_POST['nombre-up']);

            if(mysqli_num_rows($consulta_nombre)>0){
                header("Location: ../admin/products.php?error=Ya existe un producto con este nombre");
            }     
        }
               
        $conexion->query("UPDATE productos SET nombre='".$_POST['nombre-up']."', descripcion='".$_POST['descripcion-up']."', precio=".$_POST['precio-up'].", inventario=".$_POST['cantidad-up'].",id_categoria=".$_POST['categoria-up'].", norma='".$_POST['norma-up']."', material='".$_POST['material-up']."' WHERE id=".$_POST['id-up'])or die($conexion->error);

        header("Location: ../admin/products.php?success=Producto Actualizado");

    }else{
        header("Location: ../admin/products.php?error=Complete todos los campos");
    }
?>