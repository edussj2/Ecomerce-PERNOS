<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Productos</title>
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
           <strong class="text-black">Productos</strong></div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Todos los Productos</h2></div>

              </div>
            </div>


            <!-- ***************************************************** -->
            <!-- **** Listando los productos de la base de datos ***** -->
            <!-- ***************************************************** -->
            <div class="row mb-5">
              <?php 
                include('./php/conexion.php');
                
                $limite = 9;
                $totalQuery = $conexion->query('SELECT count(*) FROM productos')or die($conexion->error);
                $totalProductos = mysqli_fetch_row($totalQuery);
                $totalBotones = round($totalProductos[0] /$limite);

                if(isset($_GET['limite'])){
                  $resultado = $conexion->query("SELECT * FROM productos WHERE inventario > 0 ORDER BY id DESC LIMIT ".$_GET['limite'].",".$limite)or die($conexion->error);
                }else{
                  $resultado = $conexion->query("SELECT * FROM productos WHERE inventario > 0 ORDER BY id DESC LIMIT ".$limite)or die($conexion->error);
                }

                while($fila = mysqli_fetch_array($resultado)){
              ?>
                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <div class="block-4 text-center border">
                    <figure class="block-4-image">
                      <a href="shop-single.php?id=<?php echo $fila['id'];?>"><img src="images/productos/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['nombre'];?>" class="img-fluid"></a>
                    </figure>
                    <div class="block-4-text p-4">
                      <h3><a href="shop-single.php?id=<?php echo $fila['id'];?>"><?php echo $fila['nombre'];?></a></h3>
                      <p class="mb-0"><?php echo $fila['material'];?></p>
                      <p class="text-primary font-weight-bold">S/ <?php echo number_format($fila['precio'],2,'.','');?></p>
                    </div>
                  </div>
                </div>
              <?php 
                }
              ?>
            </div>
            
            <!-- ***************************************************** -->
            <!-- ****** Paginador de Resultado - Limite de 9   ******* -->
            <!-- ***************************************************** -->
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                  <?php 
                        if(isset($_GET['limite'])){
                          if($_GET['limite']>0){
                            echo ' <li><a href="products.php?limite='.($_GET['limite']-9).'">&lt;</a></li>';
                          }
                        }

                        for($k=0;$k<$totalBotones;$k++){
                          echo  '<li><a href="products.php?limite='.($k*9).'">'.($k+1).'</a></li>';
                        }

                        if(isset($_GET['limite'])){
                          if($_GET['limite']+9 < $totalBotones*9){
                            echo ' <li><a href="products.php?limite='.($_GET['limite']+9).'">&gt;</a></li>';
                          }elseif($_GET['limite']==0){
                            echo ' <li><a href="products.php?limite=9">&gt;</a></li>';
                          }
                        }
                    ?>
                  </ul>
                </div>
              </div>
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

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">

                <div class="row justify-content-center text-center mb-5">
                  <div class="col-md-7 site-section-heading pt-4">
                    <h2>Categorías</h2>
                  </div>
                </div>
          
                <div class="row">

                <?php 
                  $resultado = $conexion->query("SELECT * FROM categorias  ORDER BY id ASC LIMIT 3")or die($conexion->error);

                  while($fila = mysqli_fetch_array($resultado)){
                ?>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                    <a class="block-2-item" href="./busqueda.php?busqueda=<?php echo $fila['nombre'];?>">
                      <figure class="image">
                        <img src="images/categorias/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['nombre'];?>" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="text-uppercase">Categoría</span>
                        <h3><?php echo $fila['nombre'];?></h3>
                      </div>
                    </a>
                  </div>
                <?php 
                  }
                ?>

                </div>
              
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