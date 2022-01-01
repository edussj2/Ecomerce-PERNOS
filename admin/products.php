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

	$resultado = $conexion->query("SELECT productos.*, categorias.nombre AS cat_nombre , categorias.id AS cat_id FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id ORDER BY nombre")or die($conexion->error);
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Productos</title>
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
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Productos <small>Gestión</small></h1>
			</div>
			<p class="lead">En el módulo productos, usted podrá encontrar una lista de los productos registrados en el sistema, además de poder agregar productos nuevos, modificar los actuales, y eliminarlos si se diera el caso.</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
				  	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalNewProduct"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO PRODUCTO</button>
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
									<th class="text-center">NOMBRE</th>
									<th class="text-center">INVENTARIO</th>
									<th class="text-center">CATEGORÍA</th>
									<th class="text-center">PRECIO</th>
									<th class="text-center">DETALLES</th>
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
									<td><?php echo $f['nombre']; ?></td>
									<td><?php echo $f['inventario']; ?></td>
									<td><?php echo $f['cat_nombre']; ?></td>
									<td><?php echo $f['precio']; ?></td>
									<td>
										<button type="button" class="btn btn-info btn-raised btn-xs btnInfo" data-toggle="modal" data-target="#ModalInfo" data-id="<?php echo $f['id']; ?>" data-nombre="<?php echo $f['nombre']; ?>" data-descripcion="<?php echo $f['descripcion']; ?>" data-precio="<?php echo $f['precio']; ?>" data-imagen="<?php echo $f['imagen']; ?>" data-inventario="<?php echo $f['inventario']; ?>" data-categoria="<?php echo $f['cat_id']; ?>" data-norma="<?php echo $f['norma']; ?>" data-material="<?php echo $f['material']; ?>">
											<i class="zmdi zmdi-alert-circle-o"></i>
										</button>
									</td>
									<td>
										<button type="button" class="btn btn-primary btn-raised btn-xs btnEditar" data-toggle="modal" data-target="#ModalEditar" data-id="<?php echo $f['id']; ?>" data-nombre="<?php echo $f['nombre']; ?>" data-descripcion="<?php echo $f['descripcion']; ?>" data-precio="<?php echo $f['precio']; ?>" data-inventario="<?php echo $f['inventario']; ?>" data-categoria="<?php echo $f['cat_id']; ?>" data-norma="<?php echo $f['norma']; ?>" data-material="<?php echo $f['material']; ?>">
											<i class="zmdi zmdi-refresh"></i>
										</button>
									</td>
									<td>
										<button type="button" class="btn btn-danger btn-raised btn-xs btnEliminar" data-toggle="modal" data-target="#ModalEliminar" data-id="<?php echo $f['id']; ?>">
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
	<div class="modal fade" id="ModalNewProduct" tabindex="-1" role="dialog" aria-labelledby="ModalNewProduct" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalNewProduct"><i class="zmdi zmdi-plus"></i> Nuevo Producto</h5>
                </div>
				<form action="../php/insertarProducto.php" method="POST" enctype="multipart/form-data" auto-complete="off">
                <div class="modal-body m-0">

				<div class="container-fluid">
				    <div class="row">

				    	<div class="col-xs-12 col-sm-6">
							<div class="form-group label-floating">
								<label class="control-label">Nombre *</label>
								<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" maxlength="30">
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-3">
							<div class="form-group label-floating">
								<label class="control-label">Precio *</label>
								<input pattern="[0-9.]{1,7}" class="form-control" type="text" name="precio-reg" maxlength="7">
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-3">
							<div class="form-group label-floating">
								<label class="control-label">Cantidad *</label>
								<input pattern="[0-9+]{1,10}" class="form-control" type="number" name="cantidad-reg" required="" maxlength="30">
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-4">
							<div class="form-group label-floating">
								<label class="control-label">Categoría *</label>
								<select name="categoria-reg"  class="form-control" required>
									<option value="0">-- Eliga una opción --</option>
								<?php 
									$consulta = $conexion->query("SELECT * FROM categorias")or die($conexion->error);

									while($r=mysqli_fetch_array($consulta)){
										echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
									}
								?>
								</select>
							</div>
				    	</div>

						<div class="col-xs-12 col-sm-4">
							<div class="form-group label-floating">
								<label class="control-label">Norma *</label>
								<input pattern="{1,30}" class="form-control" type="text" name="norma-reg" required="" maxlength="30">
							</div>
				    	</div>

						<div class="col-xs-12 col-sm-4">
							<div class="form-group label-floating">
								<label class="control-label">Material *</label>
								<input pattern="{1,30}" class="form-control" type="text" name="material-reg" required="" maxlength="30">
							</div>
				    	</div>

				    	<div class="col-xs-12">
							<div class="form-group label-floating">
								<label class="control-label">Descripción *</label>
								<textarea name="descripcion-reg" class="form-control" rows="2" maxlength="100"></textarea>
							</div>
				    	</div>

						<div class="col-xs-12">
		    				<div class="form-group">
		    					<span class="control-label">Imágen *</span>
								<input type="file" name="imagen-reg" accept=".jpg, .png, .jpeg">
								<div class="input-group">
									<input type="text" readonly="" class="form-control" placeholder="Elija la imágen...">
									<span class="input-group-btn input-group-sm">
										<button type="button" class="btn btn-fab btn-fab-mini">
											<i class="zmdi zmdi-attachment-alt"></i>
										</button>
									</span>
								</div>
								<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG y JPG</small></span>
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

	<!-- MODAL EDITAR -->
	<div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="ModalEditar" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEditar"><i class="zmdi zmdi-refresh"></i> Editar Producto</h5>
                </div>
				<form action="../php/editarProducto.php" method="POST" enctype="multipart/form-data" auto-complete="off">
                <div class="modal-body m-0">

				<div class="container-fluid">
				    <div class="row">
						
						<input type="hidden" name="id-up" id="id_up">

				    	<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label class="control-label">Nombre *</label>
								<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-up" required="" maxlength="30" id="nombre_up">
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Precio *</label>
								<input pattern="[0-9.]{1,7}" class="form-control" type="text" name="precio-up" maxlength="7" id="precio_up">
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Cantidad *</label>
								<input pattern="[0-9+]{1,10}" class="form-control" type="number" name="cantidad-up" required="" maxlength="30" id="cantidad_up">
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Categoría</label>
								<select name="categoria-up"  class="form-control" required id="categoria_up">
									<option value="0">-- Eliga una opción --</option>
								<?php 
									$consulta = $conexion->query("SELECT * FROM categorias")or die($conexion->error);

									while($r=mysqli_fetch_array($consulta)){
										echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
									}
								?>
								</select>
							</div>
				    	</div>

						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Norma *</label>
								<input class="form-control" type="text" name="norma-up" required="" maxlength="30" id="norma_up">
							</div>
				    	</div>

						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Material *</label>
								<input class="form-control" type="text" name="material-up" required="" maxlength="30" id="material_up">
							</div>
				    	</div>

				    	<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">Descripción *</label>
								<textarea name="descripcion-up" class="form-control" rows="2" maxlength="100" id="descripcion_up"></textarea>
							</div>
				    	</div>

				    </div>
				</div>

                    <br>
                </div>
                <div class="modal-footer">
					<button type="sumbit" class="btn btn-primary btn-raised">Editar</button>
                    <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Cerrar</button>
                </div>
				</form>
            </div>
        </div>
    </div>

	<!-- MODAL INFORMACIÓN -->
	<div class="modal fade" id="ModalInfo" tabindex="-1" role="dialog" aria-labelledby="ModalInfo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalInfo"><i class="zmdi zmdi-alert-circle-o"></i> Información del Producto</h5>
                </div>
                <div class="modal-body m-0">

				<div class="container-fluid">
				    <div class="row">

				    	<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<label class="control-label">Nombre</label>
								<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-up" required="" maxlength="30" id="nombre_info" readonly>
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Precio</label>
								<input pattern="[0-9.]{1,7}" class="form-control" type="text" name="precio-up" maxlength="7" id="precio_info" readonly>
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-3">
							<div class="form-group">
								<label class="control-label">Cantidad</label>
								<input pattern="[0-9+]{1,10}" class="form-control" type="number" name="cantidad-up" required="" maxlength="30" id="cantidad_info" readonly>
							</div>
				    	</div>

				    	<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Categoría</label>
								<select name="categoria-up"  class="form-control" required id="categoria_info" readonly>
									<option value="0">-- Eliga una opción --</option>
								<?php 
									$consulta = $conexion->query("SELECT * FROM categorias")or die($conexion->error);

									while($r=mysqli_fetch_array($consulta)){
										echo '<option value="'.$r['id'].'">'.$r['nombre'].'</option>';
									}
								?>
								</select>
							</div>
				    	</div>

						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Norma</label>
								<input pattern="{1,30}" class="form-control" type="text" name="norma-up" required="" maxlength="30" id="norma_info" readonly>
							</div>
				    	</div>

						<div class="col-xs-12 col-sm-4">
							<div class="form-group">
								<label class="control-label">Material</label>
								<input pattern="{1,30}" class="form-control" type="text" name="material-up" required="" maxlength="30" id="material_info" readonly>
							</div>
				    	</div>

				    	<div class="col-xs-12">
							<div class="form-group">
								<label class="control-label">Descripción</label>
								<textarea name="descripcion-up" class="form-control" rows="2" maxlength="100" id="descripcion_info" readonly></textarea>
							</div>
				    	</div>

						<div class="col-xs-12 text-center">
		    				<img src="" alt="" id="imagen_info" style="width:180px;">
		    			</div>

				    </div>
				</div>

                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal">Cerrar</button>
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

		$(".btnEditar").click(function(){
			idEditar=$(this).data('id');
			var nombre=$(this).data('nombre');
			var descripcion=$(this).data('descripcion');
			var precio=$(this).data('precio');
			var inventario=$(this).data('inventario');
			var categoria=$(this).data('categoria');
			var norma=$(this).data('norma');
			var material=$(this).data('material');
			$("#nombre_up").val(nombre);
			$("#descripcion_up").val(descripcion);
			$("#precio_up").val(precio);
			$("#cantidad_up").val(inventario);
			$("#categoria_up").val(categoria);
			$("#norma_up").val(norma);
			$("#material_up").val(material);
			$("#id_up").val(idEditar);
		});

		$(".btnInfo").click(function(){
			idEditar=$(this).data('id');
			var nombre=$(this).data('nombre');
			var descripcion=$(this).data('descripcion');
			var precio=$(this).data('precio');
			var imagen=$(this).data('imagen');
			var inventario=$(this).data('inventario');
			var categoria=$(this).data('categoria');
			var norma=$(this).data('norma');
			var material=$(this).data('material');
			$("#nombre_info").val(nombre);
			$("#nombre_info").focus();
			$("#descripcion_info").val(descripcion);
			$("#precio_info").val(precio);
			$("#imagen_info").attr("src","../images/productos/"+imagen);
			$("#cantidad_info").val(inventario);
			$("#categoria_info").val(categoria);
			$("#norma_info").val(norma);
			$("#material_info").val(material);
		});
	});
	</script>
</body>
</html>