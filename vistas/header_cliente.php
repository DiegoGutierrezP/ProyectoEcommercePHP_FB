<header class="header">
		<div class="contenedor">
			<a href="inicio.php" class="logo"><img src="../imgs/faber-castell.png"></a>
			<!--<div class="contenedor_buscador"><input type="search" class="buscador" placeholder="Buscar Producto Faber Castel"> </div>-->
			<nav class="nav_menu_icons">
				<ul class="menu_icons">
					<li><a href="inicio.php">Inicio</a></li>
					<li><a href="catalogo.php">Catalogo</a></li>
					<li class="op_micuenta"><a href="" ><i class="fa-solid fa-user fa-xl"></i></a>
						<?php
							
							if(!isset($_SESSION["nomusuario"])){
								 include("layout_inciarsesion.php");
							}else{
								include("layout_cerrarsesion.php");
								 
							}
						?>
					</li>
					<li class="btncarrito"><a href="carrito_cliente.php" ><i class="fa-solid fa-cart-shopping fa-xl"></i><span class="contador_carrito"></span></a></li>
				</ul>
			</nav>
			<nav class="nav_menu">
				<ul class="menu">
					<li><a href="inicio.php">Inicio</a></li>
					<li><a href="catalogo.php">Catalogo</a></li>
					<li class="op_micuenta" id="op_micuenta"><a href=""><i class="fa-solid fa-user fa-lg"></i><?php if(isset($_SESSION["nomusuario"])){echo " ".$_SESSION["nomusuario"];}else{echo " Mi Cuenta";} ?></a>
						<?php 
							if(!isset($_SESSION["nomusuario"])){
								 include("layout_inciarsesion.php");
							}else{
								include("layout_cerrarsesion.php");
								 
							}
						
						?>
					</li>
					<li class="btncarrito"><a href="carrito_cliente.php"><i class="fa-solid fa-cart-shopping fa-lg"></i><span class="contador_carrito"></span></a></li>
				</ul>
			</nav>
		</div>
	</header>