<?php 
  session_start();
  include './php/conexion.php';

  /*Si no hay datos en el carrito de compras*/
  if(!isset($_SESSION['carrito'])){
      header('Location: ./products.php');
  }



  /*Si hay datos en el carrito de compras*/
  $arreglo = $_SESSION['carrito'];
  $subtotal_venta = 0;
  $idCupon=1;



  /*Calculamos los datos de la venta en general*/
  for($i=0;$i<count($arreglo);$i++){
      $subtotal_venta = $subtotal_venta + $arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']; 
  }
  $igv = $subtotal_venta * 0.16;
  $total_venta = $subtotal_venta + $igv;
  $fecha = date('Y-m-d h:m:s');
  $estado = 'Registrado';



  /*Hacemos efectivo el cupon*/
  if(isset($_POST['id_cupon'])){
    if($_POST['id_cupon']!=""){
      $conexion->query("UPDATE cupones SET status = 'Inactivo' WHERE idCupon=".$_POST['id_cupon'])or die($conexion->error);
      $idCupon= $_POST['id_cupon'];

      $consultaCupon = $conexion->query("SELECT * FROM cupones WHERE idCupon=".$_POST['id_cupon'])or die($conexion->error);

      $dataCupon = mysqli_fetch_row($consultaCupon);

      if($dataCupon[2]=="Dinero"){
        $total_venta = $total_venta-$dataCupon[3];
      }else{
        $total_venta = $total_venta-(($dataCupon[3]/100)*$total_venta);
      }

    }
  }




  /*Validamos si ha iniciado sesion o no*/
  if(!isset($_POST['idUsuario'])){

    $clave = $_POST['clave_reg'];
    $imagen = "usuario.png";
    $nivel = "Cliente";

    $re  = $conexion->query("SELECT * FROM usuario WHERE email= '".$_POST['correo_reg']."'")or die($conexion->error);

    /*Validamos que si su cuenta ya existe*/
    if(mysqli_num_rows($re)>0){

      header("Location: ./checkout.php?error=Usted ya tiene una cuenta asociada a este correo, por favor inicie sesión");
    
    /*Creamos cuenta*/
    }else{
      $conexion -> query("INSERT INTO usuario(nombre,telefono,email,password,img_perfil,nivel) 
      VALUES('".$_POST['nombres_reg']." ".$_POST['apellidos_reg']."', '".$_POST['telefono_reg']."', '".$_POST['correo_reg']."', '".sha1($clave)."','$imagen', '$nivel')")or die($conexion->error);
  
      $id_usuario = $conexion->insert_id;
  
      $nombres = $_POST['nombres_reg'].' '.$_POST['apellidos_reg'];
      $correo = $_POST['correo_reg'];

      $idLogin = $id_usuario;
      $nombreLogin = $nombres;
      $correoLogin = $correo;
      $imagenLogin = $imagen;
      $nivelLogin = $nivel;

      /*Iniciamos sesion*/
      $_SESSION['datos_login']= array(
                'nombre'=>$nombreLogin,
                'id_usuario'=>$idLogin,
                'correo'=>$correoLogin,
                'imagen'=>$imagenLogin,
                'nivel'=>$nivelLogin
      );
    }

  }else{

    $id_usuario = $_POST['idUsuario'];

    $consultaData = $conexion -> query("SELECT * FROM usuario WHERE id =".$id_usuario);

    $data = mysqli_fetch_row($consultaData);

    $nombres = $data[1];
    $correo = $data[3];

  }
  


  /*Registramos la venta*/
  $conexion -> query("INSERT INTO ventas(id_usuario,total,fecha,subtotal,status,id_cupon) VALUES($id_usuario,$total_venta,'$fecha',$subtotal_venta,'$estado',$idCupon)")or die($conexion->error);

  $id_venta = $conexion->insert_id;



  /*REGISTRAMOS LOS DETALLES*/
  for($i=0;$i<count($arreglo);$i++){

    $conexion -> query("INSERT INTO productos_venta(id_venta,id_producto,cantidad,precio,subtotal) VALUES($id_venta,".$arreglo[$i]['Id'].",".$arreglo[$i]['Cantidad'].",".$arreglo[$i]['Precio'].",".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio'].")")or die($conexion->error); 

    $conexion -> query("UPDATE productos SET inventario = inventario - ".$arreglo[$i]['Cantidad']." WHERE id = ".$arreglo[$i]['Id']."")or die($conexion->error);

  }



  /*Registramos el envio*/
  $conexion -> query("INSERT INTO envios(id_distrito,direccion,ciudad,cp,id_venta,notas) VALUES('".$_POST['distrito_reg']."','".$_POST['direccion_reg']."','".$_POST['ciudad_reg']."','".$_POST['cp_reg']."',$id_venta,'".$_POST['notas_reg']."')")or die($conexion->error);


  /*Enviamos correo de verificacipón*/
  include "./php/mail.php";



  /*Vaciamos el carrito*/
  unset($_SESSION['carrito']);

?>
<!DOCTYPE html>
<html lang="es">
  <head>
   <title>Pernos & Pernos | Gracias</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <link rel="icon" type="image/png" href="./images/img/icono.png"/>

    <?php include("./layouts/estilos.php"); ?>
    
  </head>
  <body>
  
  <div class="site-wrap">

   <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Gracias!</h2>
            <p class="lead mb-5">Tu pedido se completó con éxito.</p>
            <p><a href="view-order.php?id_venta=<?php echo $id_venta;?>" class="btn btn-sm btn-primary">Ver Pedido</a></p>
          </div>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <?php include("./layouts/scripts.php"); ?> 
    
  </body>
</html>