<?php 
    session_start();
    include "./php/conexion.php";
    
    if(!isset($_SESSION['datos_login'])){
      header("Location: ../login.php");
    }
    $arregloUsuario =  $_SESSION['datos_login'];
    $id = $arregloUsuario['id_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Mis Pedidos </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <link rel="icon" type="image/png" href="./images/img/icono.png"/>

    <?php include("./layouts/estilos.php"); ?> 
    
  </head>
  <body>
  
  <div class="site-wrap">

    <?php include("./layouts/header.php"); ?>

    <div class="container">
      <div class="row">

        <div class="col-lg-8 pt-5 mb-5">
            <h2><i class="fas fa-list"></i> Mis Pedidos</h2>
            <div class="table-responsive mt-4 mb-2">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $resultado = $conexion->query("SELECT * FROM ventas WHERE id_usuario = $id")or die($conexion->error);
									  $contador =1;
									  while($f = mysqli_fetch_array($resultado)){
                  ?>
                  <tr>
                    <th scope="row"><?php echo $contador;?></th>
                    <td><?php echo $f['fecha'];?></td>
                    <td>S/ <?php echo number_format($f['total'],2,'.','');?></td>
                    <td><?php echo $f['status'];?></td>
                    <td><a href="view-order.php?id_venta=<?php echo $f['id'];?>" class="btn btn-primary btn-sm"><i class="far fa-eye"></i></a></td>
                  </tr>
                  <?php 
                    }
                  ?>
                </tbody>
              </table>
            </div>
        </div>

        <div class="col-lg-4 pt-5 mb-5">
          <div class="card">
            <div class="card-header">
              <i class="fas fa-user"></i> Datos del Usuario
            </div>
            <div class="card-body">
              <?php 
                $resultado2= $conexion->query("SELECT * FROM usuario WHERE id = $id")or die($conexion->error);

                $data = mysqli_fetch_row($resultado2);
              ?>
              <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="images/users/<?php echo $data[5];?>" alt="" style="width:80px">
                <h5 class="card-title mt-2"><?php echo $data[1];?></h5>
              </div>
              <p class="card-text"><i class="fas fa-phone-square"></i> Teléfono : <?php echo $data[3];?> <br><i class="fas fa-envelope"></i> Correo : <?php echo $data[2];?></p>
            </div>
            <div class="card-footer text-center">
                <a href="myData.php?id=<?php echo $id;?>" class="btn btn-success">Actualizar Datos</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <?php include("./layouts/scripts.php"); ?> 
    
  </body>
</html>