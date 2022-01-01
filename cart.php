<?php 
  session_start();

  include './php/conexion.php';

  if(isset($_SESSION['carrito'])){

    if(isset($_GET['id_producto'])){

      $arreglo = $_SESSION['carrito'];
      $encontro = false;
      $numero = 0;

      for($i=0;$i<count($arreglo);$i++){
        if($arreglo[$i]['Id'] == $_GET['id_producto']){
          $encontro = true;
          $numero = $i;
        }
      }

      if($encontro == true){

        $arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+$_GET['cantidad_producto'];
        $_SESSION['carrito'] = $arreglo;
        header("Location: ./cart.php");

      }else{

        $nombre = "";
        $precio = "";
        $imagen = "";
        $cantidad = "";
  
        $res = $conexion->query('SELECT * FROM productos WHERE id='.$_GET['id_producto'])or die($conexion->error);
        $fila = mysqli_fetch_row($res); 
  
        $nombre = $fila[1];
        $precio = $fila[3];
        $imagen = $fila[4];
        $cantidad = $_GET['cantidad_producto'];
  
        $arregloNuevo = array(
          'Id' => $_GET['id_producto'],
          'Nombre'=> $nombre,
          'Precio'=> $precio,
          'Imagen'=> $imagen,
          'Cantidad' => $cantidad
        );

        array_push($arreglo, $arregloNuevo);
        $_SESSION['carrito']=$arreglo;
        header("Location: ./cart.php");
      }

    }
  }else{
    if(isset($_GET['id_producto'])){

      $nombre = "";
      $precio = "";
      $imagen = "";
      $cantidad = "";

      $res = $conexion->query('SELECT * FROM productos WHERE id='.$_GET['id_producto'])or die($conexion->error);
      $fila = mysqli_fetch_row($res); 

      $nombre = $fila[1];
      $precio = $fila[3];
      $imagen = $fila[4];
      $cantidad = $_GET['cantidad_producto'];

      $arreglo[] = array(
        'Id' => $_GET['id_producto'],
        'Nombre'=> $nombre,
        'Precio'=> $precio,
        'Imagen'=> $imagen,
        'Cantidad' => $cantidad
      );

      $_SESSION['carrito'] = $arreglo;
      header("Location: ./cart.php");

    }
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Carrito </title>
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
           <strong class="text-black">Carrito</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Imagen</th>
                    <th class="product-name">Producto</th>
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                <?php 

                  $subtotal = 0;
                  if(isset($_SESSION['carrito'])){
                    $arregloCarrito =  $_SESSION['carrito'];
                    for($i=0; $i<count($arregloCarrito);$i++){
                      $subtotal=$subtotal + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'])
                ?>
                  <tr>

                    <td class="product-thumbnail">
                      <img src="images/productos/<?php echo $arregloCarrito[$i]['Imagen']?>" alt="<?php echo $arregloCarrito[$i]['Nombre']?>" class="img-fluid">
                    </td>

                    <td class="product-name">
                      <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Nombre']?></h2>
                    </td>

                    <td>
                      S/ <?php echo number_format($arregloCarrito[$i]['Precio'],2,'.','');?>
                    </td>

                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus btnIncrementar" type="button">&minus;</button>
                        </div>

                        <input type="text" class="form-control text-center txtCantidad" data-precio="<?php echo $arregloCarrito[$i]['Precio']?>" data-id="<?php echo $arregloCarrito[$i]['Id']?>" value="<?php echo $arregloCarrito[$i]['Cantidad']?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">

                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus btnIncrementar" type="button">&plus;</button>
                        </div>
                      </div>

                    </td>

                    <td class="cant<?php echo $arregloCarrito[$i]['Id']; ?>">
                      S/ <?php echo number_format($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'],2,'.',''); ?>
                    </td>

                    <td>
                      <a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id']; ?>">X</a>
                    </td>

                  </tr>
                <?php 
                    }
                  }
                ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">

          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                <a href="cart.php" class="btn btn-primary btn-sm btn-block">Actualizar Carrito</a>
              </div>
              <div class="col-md-6">
                <a href="products.php" class="btn btn-outline-primary btn-sm btn-block">Continuar comprando</a>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Pernos & Pernos</label>
                <p>La empresa Pernos & Penos esta compromitida con la calidad, seguridad y confibialidad tanto como en la entrega como en el pago de los productos. Conoces nuestros término y condiciones del uso de nuestra platafomra web para que tengas conocimientos de las póliticas que rigen el proceso de venta de nuestra empresa, gracias.</p>
              </div>
            </div>

          </div>

          <div class="col-md-6">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Totales del Carrito</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">S/ <?php echo number_format($subtotal,2,".","");?></strong>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">IGV (16%)</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">S/ <?php echo $igv = $subtotal*0.16;?></strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">S/ <?php echo $total = $subtotal+$igv;?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceder a Comprar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <?php include("./layouts/scripts.php"); ?> 

  <script>
    $(document).ready(function(){

      $(".btnEliminar").click(function(event){

        event.preventDefault();
        var id = $(this).data('id');
        var boton = $(this);
        $.ajax({
          method:'POST',
          url:'./php/eliminarCarrito.php',
          data: {
            id:id
          }
        }).done(function(respuesta){
          boton.parent('td').parent('tr').fadeOut(1000);
        });

      });

      $(".txtCantidad").keyup(function(){

        var cantidad = $(this).val();
        var precio = $(this).data('precio');
        var id = $(this).data('id');
        incrementar(cantidad,precio,id);
      });

      $(".btnIncrementar").click(function(){
        var precio = $(this).parent('div').parent('div').find('input').data('precio');
        var id = $(this).parent('div').parent('div').find('input').data('id');
        var cantidad = $(this).parent('div').parent('div').find('input').val();
        incrementar(cantidad,precio,id);
      });

      function incrementar(cantidad,precio,id){
        var mult = parseFloat(cantidad)* parseFloat(precio);
        $(".cant"+id).text("S/"+mult);

        $.ajax({
          method:'POST',
          url:'./php/actualizarCantidadCarrito.php',
          data: {
            id:id,
            cantidad:cantidad
          }
        }).done(function(respuesta){
          
        });

      }

    });
  </script>
  
  </body>
</html>