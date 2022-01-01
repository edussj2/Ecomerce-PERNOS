<?php 
  session_start();
  if(isset($_SESSION['datos_login'])){
    $usuario = $_SESSION['datos_login'];
    if($usuario['nivel']=="Cliente"){
      header("Location: ./my-orders.php");
    }else{
      header("Location: ./admin/products.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Nosotros</title>
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
           <strong class="text-black">Iniciar Sesión</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section border-bottom" data-aos="fade">
      <div class="container">
        <div class="row mb-5">

          <div class="col-lg-6 mx-auto">
            <div class="card">
              <div class="card-header">
                <i class="fas fa-user-circle"></i>&nbsp;&nbsp;Datos de inicio de sesión
              </div>
              <div class="card-body">
                <form action="./php/check.php" method="POST">
                  <?php 
                    if(isset($_GET['error'])){

                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <strong><i class="fas fa-exclamation-triangle"></i> Oops!</strong> '.$_GET['error'].'.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    }
                  ?>
                  <div class="form-group">
                    <label for="email_login">Correo Electrónico :</label>
                    <input type="email" class="form-control" id="email_login" placeholder="Ingrese correo" required name="email_login">
                    <small id="emailHelp" class="form-text text-muted"> Nunca compartiremos su correo electrónico con nadie más.</small>
                  </div>
                  <div class="form-group">
                    <label for="pass_login">Contraseña :</label>
                    <input type="password" class="form-control" id="pass_login" placeholder="Contraseña" name="pass_login" required maxlength="16" minlength="6">
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Iniciar</button>
                </form>
              </div>
              <div class="card-footer">
                <a href="">¿Olvidaste tu contraseña?</a>&nbsp;&nbsp; | &nbsp;&nbsp; 
                <a href="">Registrate</a>
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