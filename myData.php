<?php 
    session_start();
    include "./php/conexion.php";
    
    /*Verificamos el inicio de sesion*/
    if(isset($_SESSION['datos_login'])){
        $usuario = $_SESSION['datos_login'];
        if($usuario['nivel']=="Administrador"){
            header("Location: ./admin/products.php");
        }
    }

    if(isset($_SESSION['datos_login'])){
        $usuario2 = $_SESSION['datos_login'];
    }else{
        $usuario2 = "";
    }

    $id = $usuario2['id_usuario'];

    $resultado2= $conexion->query("SELECT * FROM usuario WHERE id = $id")or die($conexion->error);

    $data = mysqli_fetch_row($resultado2);

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Mis Datos </title>
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

        <div class="col-lg-6 pt-5 mb-5">
            <form action="./php/actualizarDatosCliente.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user"></i> Actualizar mis Datos
                    </div>
                    <div class="card-body">
                        <?php 
                            if(isset($_GET['error'])){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Error! </strong> '.$_GET['error'].'.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                            }elseif(isset($_GET['success'])){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Exito! </strong> '.$_GET['success'].'.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                            }
                        ?>
                        <div class="form-group row">
                            <label for="inputNombres" class="col-sm-3 col-form-label">Nombres :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputNombres" value="<?php echo $data[1];?>" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,70}" maxlength="70" name="nombre-up">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputTelefono" class="col-sm-3 col-form-label">Teléfono :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputTelefono" value="<?php echo $data[2];?>"  required="" pattern="[0-9+]{1,9}" maxlength="9" onkeypress="return valideKey(event);" name="telefono-up">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputCorreo" class="col-sm-3 col-form-label">Correo :</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="inputCorreo" value="<?php echo $data[3];?>" name="correo-up">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6 pt-5 mb-5">
            <form action="./php/actualizarPassCliente.php" method="POST">
                <input type="hidden" name="id-pass" value="<?php echo $id;?>">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-key"></i> Actualizar Contraseña
                    </div>
                    <div class="card-body">
                        <?php 
                            if(isset($_GET['error3'])){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Error! </strong> '.$_GET['error3'].'.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                            }elseif(isset($_GET['success2'])){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Exito! </strong> '.$_GET['success2'].'.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                            }
                        ?>
                        <div class="form-group row">
                            <label for="inputPassword1" class="col-sm-4 col-form-label">Contraseña nueva :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword1" placeholder="Nueva Contraseña" name="pass1-up" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword2" class="col-sm-4 col-form-label">Repita Contraseña :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword2" placeholder="Repita Contraseña" name="pass2-up" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-4 col-form-label">Contraseña Actual :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Contraseña Actual" name="passActual-up" required>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
        
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <?php include("./layouts/scripts.php"); ?> 
  <script>
    /*VALIDAR QUE SOLO SEA NUM*/
    function valideKey(evt){
    
        // code is the decimal ASCII representation of the pressed key.
        var code = (evt.which) ? evt.which : evt.keyCode;
            
        if(code==8) { // backspace.
              return true;
        } else if(code>=48 && code<=57) { // is a number.
            return true;
        } else{ // other keys.
            return false;
        }
    }
  </script>
    
  </body>
</html>