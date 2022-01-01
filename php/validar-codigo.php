<?php 
    include "conexion.php";

    if(isset($_POST['codigo'])){
        $respuesta = $conexion->query("SELECT * FROM cupones WHERE codigo='".$_POST['codigo']."' AND status='Activo'");

        if(mysqli_num_rows($respuesta)==0){
           echo  "error";
        }else{

            $datos = mysqli_fetch_row($respuesta);
            $arreglo = array(
                        "id"=>$datos[0],
                        "codigo"=>$datos[1],
                        "tipo"=>$datos[2],
                        "valor"=>$datos[3],
                        "status"=>$datos[4],
                        "fechaVencimiento"=>$datos[5]
            );
        
            echo json_encode($arreglo);
            
        }
    }else{
       echo "error";
    }
?>