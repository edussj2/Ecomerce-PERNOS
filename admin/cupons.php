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

	$resultado = $conexion->query("SELECT * FROM cupones")or die($conexion->error);
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Cupones</title>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-ticket-star zmdi-hc-fw"></i> Cupones <small>Gestión</small></h1>
			</div>
			<p class="lead">En el módulo cupones, usted podrá encontrar una lista de los cupones generados en el sistema, además de poder agregar cupones nuevos, modificar los actuales, y eliminarlos si se diera el caso.</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
				  	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalNewCupon"><i class="zmdi zmdi-plus"></i> &nbsp; GENERAR CUPÓN</button>
			  	</li>
			</ul>
		</div>
		
		<!-- Panel listado de productos -->
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
					<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PRODUCTOS</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover text-center" id="table_productos">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">CÓDIGO</th>
									<th class="text-center">ESTADO</th>
									<th class="text-center">TIPO</th>
									<th class="text-center">VALOR</th>
									<th class="text-center">FECHA VENCIMIENTO</th>
									<th class="text-center">ACTUALIZAR</th>
									<th class="text-center">ELIMINAR</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$contador =1;
									while($f = mysqli_fetch_array($resultado)){
								?>
								<tr>
									<td><?php echo $contador; ?></td>
									<td><?php echo $f['codigo']; ?></td>
									<td><?php echo $f['status']; ?></td>
									<td><?php echo $f['tipo']; ?></td>
									<td><?php echo $f['valor']; ?></td>
									<td><?php echo $f['fechaVencimiento']; ?></td>
									<td>
										<button type="button" class="btn btn-primary btn-raised btn-xs btnEliminar" data-toggle="modal" data-target="#ModalEliminar" data-id="<?php echo $f['idCupon']; ?>">
											<i class="zmdi zmdi-delete"></i>
										</button>
									</td>
									<td>
										<button type="button" class="btn btn-danger btn-raised btn-xs btnEliminar" data-toggle="modal" data-target="#ModalEliminar" data-id="<?php echo $f['idCupon']; ?>">
											<i class="zmdi zmdi-delete"></i>
										</button>
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

	<!-- MODAL AGREGAR -->
	<div class="modal fade" id="ModalNewCupon" tabindex="-1" role="dialog" aria-labelledby="ModalNewCupon" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalNewCupon"><i class="zmdi zmdi-plus"></i> Nuevo Producto</h5>
                </div>
				<form action="../php/insertarCupon.php" method="POST" enctype="multipart/form-data" auto-complete="off">
                <div class="modal-body m-0">

				<div class="container-fluid">
				    <div class="row">

				    	<div class="col-xs-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="codigo-reg" required="" maxlength="30" placeholder="Código *" id="codigo">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-info btn-raised" id="generar">Generar</button>
                                </div>
                            </div>
				    	</div>

				    	<div class="col-xs-12 col-sm-6">
							<div class="form-group label-floating">
								<label class="control-label">Tipo *</label>
								<select name="opcion-reg"  class="form-control" required>
									<option value="0">-- Eliga una opción --</option>
									<option value="Dinero">Dinero</option>
									<option value="Porcentaje">Porcentaje</option>
								</select>
							</div>
				    	</div>

                        <div class="col-xs-12 col-sm-6">
							<div class="form-group label-floating">
								<label class="control-label">Valor *</label>
								<input pattern="[0-9.]{1,7}" class="form-control" type="text" name="valor-reg" maxlength="7">
							</div>
				    	</div>

						<div class="col-xs-12">
							<div class="form-group">
								<label>Fecha Límite *</label>
								<input class="form-control" type="date" name="fecha-reg" required>
							</div>
				    	</div>

				    </div>
				</div>

                    <br>
                </div>
                <div class="modal-footer">
					<button type="sumbit" class="btn btn-primary btn-raised">Guardar</button>
                    <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Cerrar</button>
                </div>
				</form>
            </div>
        </div>
    </div>

	<!-- MODAL ELIMINAR -->
	<div class="modal fade" id="ModalEliminar" tabindex="-1" role="dialog" aria-labelledby="ModalEliminar" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEliminar"><i class="zmdi zmdi-delete"></i> Eliminar Producto</h5>
                </div>
                <div class="modal-body m-0">
					¿Esta seguro que quiere eliminar este registro?
                </div>
                <div class="modal-footer">
					<button type="sumbit" class="btn btn-danger btn-raised eliminar" data-dismiss="modal">Eliminar</button>
                    <button type="button" class="btn btn-secondary btn-raised" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


	<!--====== Scripts -->
	<?php include "./layout/scripts.php";?>
	<script>
		$.material.init();
	</script>
	<script>
	$(document).ready(function(){

        $('#generar').click(function(){
            var num = Math.floor(Math.random()*90000+100000);
            $('#codigo').val(num);
        });

		$('#table_productos').DataTable( {
			language: {
				url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
			}
		} );

		var idEliminar= -1;
		var idEditar=-1;
		var fila;

		$(".btnEliminar").click(function(){
			idEliminar= $(this).data('id');
			fila=$(this).parent('td').parent('tr');
		});

		$(".eliminar").click(function(){

			$.ajax({
				url: '../php/eliminarProducto.php',
				method:'POST',
				data:{
				id:idEliminar
				}
			}).done(function(res){
				$(fila).fadeOut(1000);
			});
		
		});
	});
	</script>
</body>
</html>