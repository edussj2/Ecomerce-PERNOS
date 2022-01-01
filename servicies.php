<?php 
  session_start();
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
           <strong class="text-black">Servicios</strong></div>
        </div>
      </div>
    </div>

    <div class="container2">
       
       <div class="card2">
           <img src="./images/servicios/servicios_corte.jpg">
           <h4>CORTE</h4>
           <p>Realizamos el corte de su producto a la medida que Ud. nos indique.</p>
       </div>
       
       <div class="card2">
           <img src="./images/servicios/servicios_roscado.jpg">
           <h4>ROSCADO</h4>
           <p>Servicio de roscado de sus productos, consulte a nuestros teléfonos</p>
       </div>
       
       <div class="card2">
           <img src="./images/servicios/servicios_galvanizado.jpg">
           <h4>ZINCADO</h4>
           <p>Realizamos el servicio de zincado de sus productos, un baño de protección.</p>
       </div>

       <div class="card2">
           <img src="./images/servicios/servicios_galvanizado_caliente.jpg">
           <h4>TROPICALIZADO</h4>
           <p>Realizamos este baño de protección que se dá para evitar la oxidación o corrosión.</p>
       </div>

       <div class="card2">
           <img src="./images/servicios/servicios_corte.jpg">
           <h4>FABRICACIONES ESPECIALES</h4>
           <p>Realizamos estas fabricaciones si tiene un diseño en particular, sujeto a volumen mínimo.</p>
       </div>

       <div class="card2">
           <img src="./images/servicios/servicios_asesoria.jpg">
           <h4>ASESORIA TOTAL</h4>
           <p>Estamos a su disposición ante cualquier duda o consulta sobre el producto más adecuado.</p>
       </div>
       
   </div>

    <?php include("./layouts/footer.php"); ?> 

  </div>

  <?php include("./layouts/scripts.php"); ?>
    
  </body>
</html>