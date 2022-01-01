<header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="./busqueda.php" class="site-block-top-search" method="GET">
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" placeholder="Buscar" name="busqueda">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="./" class="js-logo-clone">Pernos & Pernos</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>

                  <li>
                    <a href="cart.php" class="site-cart">
                      <span class="icon icon-shopping_cart"></span>
                      <span class="count">
                      <?php 
                        if(isset($_SESSION['carrito'])){
                          echo count($_SESSION['carrito']);
                        }else{
                          echo 0;
                        }
                      ?>
                      </span>
                    </a>
                  </li> 

                  <?php if(!isset($_SESSION['datos_login'])){?>

                  <li>
                    <a href="./login.php"><span class="icon icon-person"></span></a>
                  </li>

                  <?php }else{ 

                    $InfoUser = $_SESSION['datos_login'];   
                  ?>

                  <li>
                    <a href="./login.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon icon-person"></span></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <?php if($InfoUser['nivel']=="Administrador"){?>
                      <a class="dropdown-item" href="./admin/products.php"><i class="fas fa-tachometer-alt"></i> Administración</a>
                      <a class="dropdown-item" href="./admin/myData.php?id=<?php echo $InfoUser['id_usuario'];?>"><i class="fas fa-address-card"></i> Mis Datos</a>
                      <?php }else{?>
                        <a class="dropdown-item" href="myData.php?id=<?php echo $InfoUser['id_usuario'];?>"><i class="fas fa-address-card"></i> Mis Datos</a>
                      <?php }?>
                      <a href="!#" class="dropdown-item btn-exit-system"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </div>
                  </li>
                  <?php }?>
                  
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li>
              <a href="./">Inicio</a>
            </li>
            <li>
              <a href="about.php">Nosotros</a>
            </li>
            <li>
              <a href="products.php?limite=0">Productos</a>
            </li>
            <li>
              <a href="servicies.php">Servicios</a>
            </li>
            <?php
              if(isset($_SESSION['datos_login'])){
            ?>
            <li>
              <a href="my-orders.php">Mis Pedidos</a>
            </li>
            <?php 
              }
            ?>
            <li>
              <a href="contact.php">Contacto</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

