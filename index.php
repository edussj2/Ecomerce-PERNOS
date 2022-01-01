<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Inicio </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <link rel="icon" type="image/png" href="./images/img/icono.png"/>

    <?php include("./layouts/estilos.php"); ?> 
    
  </head>
  <body>
  
  <div class="site-wrap">

    <?php include("./layouts/header.php"); ?>

    <div class="site-blocks-cover" style="background-image: url(images/img/hero_1.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
            <h1 class="mb-2">Ferretería<br> Pernos & Pernos</h1>
            <div class="intro-text text-center text-md-left">
              <p class="mb-4">Te ofrecemos productos de calidad, originales y de las mejores marcas, con una línea de productos basada en tuercas y aranceles. </p>
              <p>
                <a href="products.php" class="btn btn-sm btn-primary">Comprar Ahora</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm site-blocks-1">
      <div class="container">
        <div class="row">

          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="icon-truck"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Entregas a Domicilio</h2>
              <p>Hacemos entregas a domicilio, para contribuir a la no exposición de nuestros clientes en la pandemia actual.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Devoluciones Gratis</h2>
              <p>Si encuentra algún producto con alguna falla de tienda, puede devolverlo sin costo adicional alguno, o intercambiarlo agregando valor.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
            <div class="icon mr-4 align-self-start">
              <span class="icon-help"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Atención al Cliente</h2>
              <p>Brindamos una atención personalizada, buscando la fidelización de nuestros mejores cliente, para brindarles mejores beneficios.</p>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="site-section site-blocks-2">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Categorías más importantes</h2>
          </div>
        </div>
        <div class="row mt-5">
          
          <?php 
            include('./php/conexion.php');
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
              $resultado = $conexion->query("SELECT * FROM productos ORDER BY id DESC LIMIT 6")or die($conexion->error);

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

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Ubicación de Pernos & Pernos!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <div class="d-none d-md-block">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.0658735479014!2d-79.84519778549262!3d-6.761822568000887!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904cef3121a3661f%3A0xf09ca2e8978eacda!2sPERNOS%20%26%20PERNOS!5e0!3m2!1ses-419!2spe!4v1622097514034!5m2!1ses-419!2spe" width="600" height="450" frameborder="0" style="border:0" allowfullscreen loading="lazy"></iframe>
            </div>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="contact.php">Contacta con nosotros</a></h2>
            <p class="post-meta mb-4"> <i class="fab fa-facebook" style="color:#3b5998;"></i> <a href="https://web.facebook.com/Pernos-Pernos-Ferreter%C3%ADa-225636914668370/">Facebook</a></p>
            <p>Se realizar compras en tienda, retiros en la puerta, Entrega a domicilio y muchos más beneficios para ti, contactanos ahora.</p>
            <p><a href="contact.php" class="btn btn-primary btn-sm">Contáctanos</a></p>
          </div>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <?php include("./layouts/scripts.php"); ?> 
    
  </body>
</html>