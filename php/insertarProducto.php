<?php 
    include "./conexion.php";

    if(isset($_POST['nombre-reg']) && isset($_POST['precio-reg']) && isset($_POST['cantidad-reg']) && $_POST['categoria-reg']!=0 && isset($_POST['norma-reg'])  && isset($_POST['material-reg'])){

        $carpeta = "../images/productos/";

        $nombre_imagen =  $_FILES['imagen-reg']['name'];
        
        $temp_imagen = explode('.',$nombre_imagen);
        $extension_imagen = end($temp_imagen);

        $consulta=$conexion->query("SELECT id FROM productos");

        $numero = mysqli_num_rows($consulta)+1;

        $aleatorio = rand(1,100000);

        $nombre_final_imagen = $nombre_imagen.$aleatorio.$numero.".".$extension_imagen;

        if($extension_imagen=='jpg' || $extension_imagen=='png' || $extension_imagen=='jpeg' || $extension_imagen=='JPG' || $extension_imagen=='PNG' || $extension_imagen=='JPEG'){

            if(move_uploaded_file($_FILES['imagen-reg']['tmp_name'],$carpeta.$nombre_final_imagen)){

                $consulta_producto= $conexion->query("SELECT id FROM productos WHERE nombre=".$_POST['nombre-up']);

                if(mysqli_num_rows($consulta_producto)==0){

                    $conexion->query("INSERT INTO productos(nombre, descripcion, precio, imagen, inventario, id_categoria , norma, material) VALUES('".$_POST['nombre-reg']."','".$_POST['descripcion-reg']."',".$_POST['precio-reg'].",'$nombre_final_imagen',".$_POST['cantidad-reg'].",".$_POST['categoria-reg'].",'".$_POST['norma-reg']."','".$_POST['material-reg']."')")or die($conexion->error);

                    header("Location: ../admin/products.php?success=Producto Registrado");
                }else{
                    header("Location: ../admin/products.php?error=Ya existe un producto con este nombre");
                }
            }else{
                header("Location: ../admin/products.php?error=No se pudo subir la Imagen");
            }
        }else{  
            header("Location: ../admin/products.php?error=Cargué una imagen válida");
        }
    }else{
        header("Location: ../admin/products.php?error=Complete todos los campos");
    }
?>