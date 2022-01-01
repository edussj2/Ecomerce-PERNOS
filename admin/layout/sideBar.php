    <section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				Pernos & Pernos <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="../images/users/<?php echo $arregloUsuario['imagen'];?>" alt="<?php echo $arregloUsuario['nombre'];?>">
					<figcaption class="text-center text-titles"><?php echo $arregloUsuario['nombre'];?></figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="my-data.html" title="Mis datos">
							<i class="zmdi zmdi-account-circle"></i>
						</a>
					</li>
					<li>
						<a href="my-account.html" title="Mi cuenta">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<a href="#!" title="Salir del sistema" class="btn-exit-system">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="../index.php">
						<i class="zmdi zmdi-store zmdi-hc-fw"></i> Mi Tienda
					</a>
				</li>
				<li>
					<a href="./orders.php">
						<i class="zmdi zmdi-shopping-cart zmdi-hc-fw"></i> Pedidos
					</a>
				</li>
				<li>
					<a href="./products.php">
						<i class="zmdi zmdi-shopping-basket zmdi-hc-fw"></i> Productos
					</a>
				</li>
				<li>
					<a href="./cupons.php">
						<i class="zmdi zmdi-ticket-star zmdi-hc-fw"></i> Cupones
					</a>
				</li>
				<li>
					<a href="./users.php">
						<i class="zmdi zmdi-accounts zmdi-hc-fw"></i> Usuarios
					</a>
				</li>
			</ul>
		</div>
	</section>