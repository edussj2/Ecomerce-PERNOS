<?php   
  $bandera = 0;
  session_start();

  /*Verificamos el carrito exista*/
  if(!isset($_SESSION['carrito'])){
    header('Location: ./index.php');
  }
  $arreglo = $_SESSION['carrito'];

  
  /*Verificamos el inicio de sesion*/
  if(isset($_SESSION['datos_login'])){
    $usuario = $_SESSION['datos_login'];
    $bandera = 1;
    if($usuario['nivel']=="Administrador"){
      header("Location: ./admin/products.php");
    }
  }
  if(isset($_SESSION['datos_login'])){
    $usuario2 = $_SESSION['datos_login'];
  }else{
    $usuario2 = "";
  }

  include './php/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Pernos & Pernos | Compra</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <link rel="icon" type="image/png" href="./images/img/icono.png"/>

    <?php include("./layouts/estilos.php"); ?>
    
  </head>
  <body>
  
  <div class="site-wrap">

    <?php include("./layouts/header.php"); ?> 

    <div class="site-section">
      <div class="container">

        <?php if($bandera == 0){?>
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              ¿Eres cliente? <a href="./login.php">Haga clic aquí</a> para ingresar
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if(isset($_GET['error'])){?>
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Oops</strong> <?php echo $_GET['error'];?>. <a href="./login.php">Logueate aquí</a>.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>
        <?php } ?>

        <form action="./thankyou.php" method="POST" autocomplete="off">
          <div class="row">

            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Detalles de Facturación</h2>
              <div class="p-3 p-lg-5 border">

                <?php if($bandera == 1){?>
                  <input type="hidden" name="idUsuario" value="<?php echo $usuario2['id_usuario'];?>">
                <?php }?>

                <div class="form-group">
                  <label for="departamento_reg" class="text-black">Departamento <span class="text-danger">*</span></label>
                  <select id="departamento_reg" class="form-control" name="departamento_reg" required="">
                    <option value="Sin Datos">Seleccione un departamento</option>
                    <?php 
                      $resultado = $conexion->query("SELECT * FROM departamento ORDER BY DepDescripcion ASC")or die($conexion->error);
                      while($fila = mysqli_fetch_array($resultado)){
                    ?>    
                      <option value="<?php echo $fila['idDepartamento']?>"><?php echo $fila['DepDescripcion']?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="provincia_reg" class="text-black">Provincia <span class="text-danger">*</span></label>
                  <select id="provincia_reg" class="form-control" name="provincia_reg" required="">
                  </select>
                </div>

                <div class="form-group">
                  <label for="distrito_reg" class="text-black">Distrito <span class="text-danger">*</span></label>
                  <select id="distrito_reg" class="form-control" name="distrito_reg" required="">
                       
                  </select>
                </div>

                <?php if($bandera == 0){?>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="nombres_reg" class="text-black">Nombres <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nombres_reg" name="nombres_reg" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30">
                  </div>
                  <div class="col-md-6">
                    <label for="apellidos_reg" class="text-black">Apellidos <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="apellidos_reg" name="apellidos_reg" required="" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30">
                  </div>
                </div>

                <?php } ?>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="direccion_reg" class="text-black">Dirección <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="direccion_reg" name="direccion_reg" placeholder="Dirección" required="" required="" maxlength="50">
                  </div>
                </div>

                <div class="form-group row">

                  <div class="col-md-6">
                    <label for="ciudad_reg" class="text-black">Referencia <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="ciudad_reg" name="ciudad_reg" required="" maxlength="30"> 
                  </div>

                  <div class="col-md-6">
                    <label for="cp_reg" class="text-black">Postal / Zip <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cp_reg" name="cp_reg" required="" pattern="[0-9+]{1,8}" onkeypress="return valideKey(event);" maxlength="8">
                  </div>

                </div>

                <?php if($bandera == 0){?>

                <div class="form-group row">

                  <div class="col-md-6">
                    <label for="correo_reg" class="text-black">Correo Electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="correo_reg" name="correo_reg" required="">
                  </div>

                  <div class="col-md-6">
                    <label for="telefono_reg" class="text-black">Teléfono <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="telefono_reg" name="telefono_reg" placeholder="Número de Telf." required="" pattern="[0-9+]{1,9}" maxlength="9" onkeypress="return valideKey(event);">
                  </div>

                </div>

                <?php } ?>
                
                <?php if($bandera == 0){?>

                <div class="form-group">
                    <div class="py-2">
                      <p class="mb-3">Cree una cuenta ingresando la información a continuación. Si es un cliente recurrente, inicie sesión en la parte superior de la página.(Entre 6-16 carácteres)</p>
                      <div class="form-group">
                        <label for="clave_reg" class="text-black">Contraseña de la cuenta</label>
                        <input type="password" class="form-control" id="clave_reg" name="clave_reg" placeholder="" required maxlength="16" minlength="6">
                      </div>
                    </div>
                </div>

                <?php } ?>

                <div class="form-group">
                  <label for="notas_reg" class="text-black">Observaciones</label>
                  <textarea name="notas_reg" id="notas_reg" cols="30" rows="5" class="form-control" placeholder="Escriba sus notas aquí ..."></textarea>
                </div>

              </div>
            </div>

            <div class="col-md-6">

              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Código Promocional</h2>
                  <div class="p-3 p-lg-5 border">
                    
                    <label for="c_code" class="text-black mb-3">Ingrese su código de cupón si tiene uno</label>

                    <!-- Agregar cupon -->
                    <div class="input-group w-75" id="formCupon">
                      <input type="text" class="form-control" id="c_code" placeholder="Código del cupón" aria-label="Coupon Code" aria-describedby="button-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Aplicar</button>
                      </div>
                    </div> <small id="error" class="text-danger p-1" style="display:none;"><i class="far fa-question-circle"></i> No es válido</small>

                    <!-- Cupon valido -->
                    <div id="datosCupon" style="display:none;">
                        <h4 class="text-success" id="texto-cupon"></h4>
                    </div>

                    <!-- id Cupon-->
                    <input type="hidden" name="id_cupon" id="id_cupon">

                  </div>
                </div>
              </div>
              
              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Su Pedido</h2>
                  <div class="p-3 p-lg-5 border">

                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Producto</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                      <?php 
                        $subtotal = 0;
                        for($i=0;$i<count($arreglo);$i++){
                          $subtotal = $subtotal + ($arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']);
                      ?>
                        <tr>
                          <td><?php echo $arreglo[$i]['Nombre'] ?> <strong class="mx-2">x</strong> <?php echo $arreglo[$i]['Cantidad'] ?></td>
                          <td>S/ <?php $totalUnidad = $arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']; echo number_format($totalUnidad,2,'.',''); ?></td>
                        </tr>
                      <?php } ?>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Total del pedido</strong></td>
                          <td class="text-black font-weight-bold"><strong>S/ <?php $total= $subtotal + ($subtotal*0.16); echo number_format($total,2,'.',''); ?></strong></td>
                        </tr>
                        <tr id="trdescuento" style="display:none;">
                          <td class="text-success font-weight-bold "><strong>Descuento</strong></td>
                          <td id="tddescuento"></td>
                        </tr>
                        
                        <tr id="trtotal" style="display:none;">
                          <td class="text-info font-weight-bold"><strong>Nuevo Total</strong></td>
                          <td  id="tdtotal" data-total="<?php echo $total?>"></td>
                        </tr>
                      </tbody>
                    </table>
                    
                    <div class="row pt-3 pb-3">
                          <div class="col-6">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipoventa" id="tipoventa1" value="Recojo en tienda">
                              <label class="form-check-label" for="tipoventa1">
                                Recojo en tienda
                              </label>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipoventa" id="tipoventa2" checked value="Delivery">
                              <label class="form-check-label" for="tipoventa2">
                                Delivery
                              </label>
                            </div>
                          </div>
                    </div>

                    <div class="border p-3 mb-3">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Proceso de adquisión <i class="fas fa-caret-down"></i></a></h3>
                      <div class="collapse" id="collapsebank">
                        <div class="py-2">
                          <p class="mb-0">Tu orden se registrará en nuestro sistema y puedes verificar cuándo esta listo para ir a recojerlo, o de lo contrario podrás optar por la opción de delivery para orden.</p>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Realizar Pedido</button>
                    </div>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </form> 
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?> 
  </div>

  <?php include("./layouts/scripts.php"); ?> 

  <script>
        $(document).ready(function(){

            $('#button-addon2').click(function(){
              var codigo= $('#c_code').val();
              
              if(codigo!=""){
                  $.ajax({
                    url:"./php/validar-codigo.php",
                    data:{
                      codigo:codigo
                    },
                    method:"POST"
                  }).done(function(respuesta){

                    if(respuesta==="error"){
                      $('#error').show();
                      $("#id_cupon").val("");
                    }else{
                      var arreglo = JSON.parse(respuesta);

                      if(arreglo.tipo === "Dinero"){
                        $("#texto-cupon").text("Usted tiene un descuento de S/"+arreglo.valor+ " soles.");
                        $("#tddescuento").text("S/ " +arreglo.valor);
                        var totalfinal= parseFloat($("#tdtotal").data('total')- arreglo.valor);

                        if(totalfinal<=0){
                          totalfinal= 0.0;
                        }
                        $("#tdtotal").text("S/ "+ totalfinal.toFixed(2));
                      }else{
                        $("#texto-cupon").text("Usted tiene un descuento del "+arreglo.valor+ "%.");
                        $("#tddescuento").text(arreglo.valor+" %");
                        
                        var totalfinal= parseFloat($("#tdtotal").data('total')) - ((arreglo.valor/100) * parseFloat($("#tdtotal").data('total')));

                        $("#tdtotal").text("S/ "+ totalfinal.toFixed(2));
                      }

                      $("#formCupon").hide();
                      $("#datosCupon").show();
                      $("#trdescuento").show();
                      $("#trtotal").show();
                      $("#id_cupon").val(arreglo.id);
                    }

                  });
              }else{
                alert("Campo vacío");
              }
            });

            $("#c_code").keyup(function(){
              $('#error').hide();
            });

            $("#departamento_reg").change(function(){

                $('#distrito_reg').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                $("#departamento_reg option:selected").each(function(){
                    idDepartamento = $(this).val();
                    $.post("php/provincia.php",{idDepartamento: idDepartamento},function(data){
                        $("#provincia_reg").html(data);
                    })
                })
            })

            $("#provincia_reg").change(function () {
                $("#provincia_reg option:selected").each(function () {
                    idProvincia = $(this).val();
                    $.post("php/distrito.php", { idProvincia: idProvincia }, function(data){
                        $("#distrito_reg").html(data);
                    });            
                });
            })
            
        })

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