<?php 
    include "./php/conexion.php";

    session_start();
    
    /*Capturamos la venta*/
    if(!isset($_GET['id_venta'])){
        header("Location: index.php");
    }

    
    /*Datos de la venta y el usuario*/
    $datos = $conexion->query("SELECT ventas.*, usuario.nombre, usuario.telefono, usuario.email FROM ventas INNER JOIN usuario ON ventas.id_usuario = usuario.id WHERE ventas.id=".$_GET['id_venta'])or die($conexion->error);

    $datosUsuario = mysqli_fetch_row($datos);


    
    /*Datos del envio*/
    $datos2 = $conexion->query("SELECT envios.*,distrito.DisDescripcion,provincia.ProvDescripcion,departamento.DepDescripcion FROM envios INNER JOIN distrito ON envios.id_distrito = distrito.idDistrito INNER JOIN provincia ON distrito.idProvincia= provincia.idProvincia INNER JOIN departamento ON provincia.idDepartamento = departamento.idDepartamento WHERE envios.id_venta=".$_GET['id_venta'])or die($conexion->error);

    $datosEnvio = mysqli_fetch_row($datos2);



    /*Datos del detalle*/
    $datos3 = $conexion->query("SELECT productos_venta.*,productos.nombre AS nombre_producto, productos.imagen FROM productos_venta INNER JOIN productos ON productos_venta.id_producto = productos.id  WHERE productos_venta.id_venta=".$_GET['id_venta'])or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Revisar Pedido</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="./images/img/icono.png"/>

    <?php include("./layouts/estilos.php"); ?> 
    
  </head>
  <body>
  
  <div class="site-wrap">

    <?php include("./layouts/header.php"); ?>
    
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="./">Inicio</a> <span class="mx-2 mb-0">/</span>
           <strong class="text-black">Revisar Pedido</strong></div>
        </div>
      </div>
    </div>

    <div class="container">

        <div class="row mt-5 mb-3">
            <div class="col-12">
            <h1 class="page-header">Revisar Pedido</h1>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-8 mb-4">

                <div class="table-responsive mb-4">
                    <table class="table table-hover"">
                        <thead style="background:#7971ea;color:#fff;text-align:center;">
                            <tr>
                                <th scope="col">Producto</th>
                                <th ></th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                            <?php
                                while($f = mysqli_fetch_array($datos3)){
                            ?>
                            <tr>
                                <td><?php echo $f['nombre_producto']?></td>
                                <td class="text-center mob-hide">
                                    <img src="images/productos/<?php echo $f['imagen']?>" alt="<?php echo $f['nombre_producto']?>" title="<?php echo $f['nombre_producto']?>" style="width:60px;">
                                
                                </td>
                                <td>S/ <?php echo number_format($f['precio'],2,'.','');?></td>
                                <td><?php echo $f['cantidad']?></td>
                                <td>S/ <?php echo number_format($f['subtotal'],2,'.','');?></td>
                            </tr>
                            <?php 
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
            
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="legend m-0"><i class="far fa-user-circle"></i> Datos del Usuario</h6>
                            </div>
                            <div class="card-body">
                                <div id="review_shipping_address">
                                    <label><strong>Nombre : </strong><br><?php echo $datosUsuario[7];?></label><br>
                                    <label><strong>Correo : </strong><br><?php echo $datosUsuario[9];?></label><br>
                                    <label><strong>Teléfono : </strong><br><?php echo $datosUsuario[8];?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="legend m-0"><i class="far fa-paper-plane"></i> Datos del Envío</h6>
                            </div>
                            <div class="card-body">
                                <div id="review_shipping_address">
                                    <label><strong>Dirección : </strong><br><?php echo $datosEnvio[2];?></label><br>
                                    <label><strong>Referencia : </strong><br><?php echo $datosEnvio[3];?></label><br>
                                    <label><strong>Ubicación : </strong><br><?php echo $datosEnvio[7];?>, <?php echo $datosEnvio[8];?>, <?php echo $datosEnvio[9];?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="legend m-0"><i class="fas fa-balance-scale-left"></i> Compra # <?php echo $_GET['id_venta'];?></h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>

                                <tr>
                                    <td colspan="1" class="text-left">Sub-Total</td>
                                    <td colspan="1" class="text-right">S/ <?php echo number_format($datosUsuario[4],2,'.','');?></td>
                                </tr>

                                <tr>
                                    <td colspan="1" class="text-left">IGV(16%)</td>
                                    <td colspan="1" class="text-right">S/ <?php echo number_format($datosUsuario[4]*0.16,2,'.','');?></td>
                                </tr>

                                <tr class="totals key">
                                    <td colspan="1" class="text-left">
                                        <strong>Total</strong>
                                    </td>
                                    <td colspan="1" class="text-right">
                                        <strong>S/ <?php echo number_format($datosUsuario[2],2,'.','');?></strong>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <p class="text-center">
                            <span class="badge badge-primary p-3"><?php echo $datosUsuario[5];?></span>
                        </p>
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