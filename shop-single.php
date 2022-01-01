<?php
  session_start();
  include "./php/conexion.php";

  if(isset($_GET['id'])){
    $resultado = $conexion->query("SELECT * FROM productos WHERE id=".$_GET['id']."")or die($conexion->error);

    if(mysqli_num_rows($resultado)>0){
      $fila = mysqli_fetch_row($resultado);
    }else{
      header("Location: ./products.php");
    }
  }else{
    header("Location: ./products.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | <?php echo $fila[1];?></title>
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
          <div class="col-md-12 mb-0"><a href="./">Inicio</a> <span class="mx-2 mb-0">/</span><a href="./products.php">Productos</a> <span class="mx-2 mb-0">/</span><strong class="text-black"><?php echo $fila[1];?></strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">

          <div class="col-md-6 d-flex justify-content-center">
            <img src="images/productos/<?php echo $fila[4];?>" alt="<?php echo $fila[1];?>" class="img-fluid">
          </div>

          <div class="col-md-6">
            <h2 class="text-black"><?php echo $fila[1];?></h2>
            <p class="mb-4">Norma: <?php echo $fila[7];?> - Material: <?php echo $fila[8];?></p>
            <p><?php echo $fila[2];?>.</p>
            <p><strong class="text-primary h4">S/ <?php echo number_format($fila['3'],2,'.','');?> soles</strong></p>

            <form action="cart.php" method="GET">
              <input type="hidden" name="id_producto" value="<?php echo $fila[0]; ?>">
              <div class="mb-5">
                <div class="input-group mb-3" style="max-width: 120px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                </div>
                <input type="text" class="form-control text-center" value="1" placeholder="" name="cantidad_producto" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                </div>
              </div>

              </div>
              <p><button type="submit" class="buy-now btn btn-sm btn-primary">Agregar al carrito</button></p>
            </form>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Últimos Productos</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              <?php 
                $resultado = $conexion->query("SELECT * FROM productos WHERE id!= ".$fila['0']." ORDER BY id DESC LIMIT 6")or die($conexion->error);

                while($fila = mysqli_fetch_array($resultado)){
              ?>
                <div class="item">
                  <div class="block-4 text-center">
                    <figure class="block-4-image">
                      <img src="images/productos/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['nombre'];?>" class="img-fluid">
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="./shop-single.php?id=<?php echo $fila['id'];?>"><?php echo $fila['nombre'];?></a></h3>
                      <p class="mb-0"><?php echo $fila['material'];?></p>
                      <p class="text-primary font-weight-bold">S/ <?php echo number_format($fila['precio'],2,'.','');?></p>
                    </div>
                  </div>
                </div>
              <?php
                }
              ?>
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