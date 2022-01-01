<?php 
	session_start();
	include "../php/conexion.php";
	if(!isset($_SESSION['datos_login'])){
		header("Location: ../login.php");
	}else{
		$arregloUsuario =  $_SESSION['datos_login'];
		if($arregloUsuario['nivel']=="Cliente"){
			header("Location: ../login.php");
		}
	}

	$resultado = $conexion->query("SELECT ventas.*, usuario.nombre AS usuario_nombre , usuario.id AS usuario_id FROM ventas INNER JOIN usuario ON ventas.id_usuario = usuario.id ORDER BY nombre")or die($conexion->error);
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Pedidos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="./dashboard/css/main.css">
	<link rel="icon" type="image/png" href="../images/img/icono.png"/>
</head>
<body>
	<!-- SideBar -->
	<?php include "./layout/sideBar.php";?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<?php include "./layout/navBar.php";?>
		
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i> Pedidos <small>Gestión</small></h1>
			</div>
			<p class="lead">En el módulo pedidos, usted podrá encontrar una lista de los pedidos registrados en el sistema, además de poder agregar actualizarlos, y eliminarlos si se diera el caso.</p>
		</div>
		
		<!-- Panel listado de Pedidos -->
		<div class="container-fluid">
			<?php 
				if(isset($_GET['error'])){
					echo '	<div class="alert alert-dimissible alert-danger text-center">
								<button type="button" class="close" data-dismiss="alert">x</button>
								<p>
									<i class="zmdi zmdi-alert-triangle"></i> '.$_GET['error'].'
								</p>
							</div>';
				}

				if(isset($_GET['success'])){
					echo '	<div class="alert alert-dimissible alert-success text-center">
								<button type="button" class="close" data-dismiss="alert">x</button>
								<p>
									<i class="zmdi zmdi-check-circle"></i> '.$_GET['success'].'
								</p>
							</div>';
				}
			?>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PEDIDOS</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover text-center" id="table_pedidos">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">NOMBRE</th>
									<th class="text-center">FECHA</th>
									<th class="text-center">TOTAL</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center">DETALLES</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$contador =1;
									while($f = mysqli_fetch_array($resultado)){
								?>
								<tr>
									<td><?php echo $contador; ?></td>
									<td><?php echo $f['usuario_nombre']; ?></td>
									<td><?php echo $f['fecha']; ?></td>
									<td><?php echo $f['total']; ?></td>
									<td><?php echo $f['status']; ?></td>
									<td>
										<a href="./orders-details.php?id=<?php echo $f['id']; ?>" class="btn btn-info btn-raised btn-xs">
											<i class="zmdi zmdi-alert-circle-o"></i>
										</a>
									</td>
								</tr>
								<?php 
										$contador++;
									}
								?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!--====== Scripts -->
	<?php include "./layout/scripts.php";?>
	<script>
		$.material.init();
	</script>
	<script>
	$(document).ready(function(){

		$('#table_pedidos').DataTable( {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
			}
		} );

	});
	</script>
</body>
</html>