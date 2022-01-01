<?php 
    include('./php/conexion.php');
    
    session_start();

    if(!isset($_GET['busqueda'])){
        header("Location: ./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda</title>
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
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
           <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Buscando resultados para <?php echo $_GET['busqueda']; ?></h2></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Ordenar</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                      <a class="dropdown-item" href="#">Nombre, A - Z</a>
                      <a class="dropdown-item" href="#">Nombre, Z - A</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Precio, Bajo - Alto</a>
                      <a class="dropdown-item" href="#">Precio, Alto - Bajo</a>
                      </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- ***************************************************** -->
            <!-- **** Listando los productos de la base de datos ***** -->
            <!-- ***************************************************** -->
            <div class="row mb-5">
            <?php 
                $resultado = $conexion->query("SELECT productos.*, categorias.nombre as cate FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id WHERE productos.nombre LIKE '%".$_GET['busqueda']."%' OR productos.descripcion LIKE '%".$_GET['busqueda']."%' OR categorias.nombre LIKE '%".$_GET['busqueda']."%' ORDER BY id DESC")or die($conexion->error);

                if(mysqli_num_rows($resultado) > 0){

                    while($fila = mysqli_fetch_array($resultado)){
            ?>
              <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="block-4 text-center border">
                  <figure class="block-4-image">
                    <a href="shop-single.php?id=<?php echo $fila['id'];?>"><img src="images/productos/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['nombre'];?>" class="img-fluid"></a>
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?id=<?php echo $fila['id'];?>"><?php echo $fila['nombre'];?></a></h3>
                    <p class="mb-0"><?php echo $fila['descripcion'];?></p>
                    <p class="text-primary font-weight-bold">S/ <?php echo $fila['precio'];?></p>
                  </div>
                </div>
              </div>
            <?php 
                    }
                }else{ echo '<div class="text-center w-100"><h2 class="p-4"><i class="far fa-frown-open"></i> Sin Resultados</h2></div>';}
            ?>


            </div>
          </div>

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categorías</h3>
              <ul class="list-unstyled mb-0">
                <?php 
                  $resultado = $conexion->query("SELECT * FROM categorias  ORDER BY nombre ASC")or die($conexion->error);

                  while($fila = mysqli_fetch_array($resultado)){
                ?>
                <li class="mb-1">
                  <a href="./busqueda.php?busqueda=<?php echo $fila['nombre']?>" class="d-flex">
                    <span><?php echo $fila['nombre'];?></span> 
                    <?php 
                      $re2 = $conexion->query("SELECT COUNT(*) FROM productos WHERE id_categoria=".$fila['id']);
                      $fila2 = mysqli_fetch_row($re2);
                    ?>
                    <span class="text-black ml-auto">(<?php echo $fila2[0];?>)</span>
                  </a>
                </li>
                <?php 
                  }
                ?>
              </ul>
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