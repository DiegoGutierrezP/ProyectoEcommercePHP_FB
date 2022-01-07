<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Catalogo - Fabercastel</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/style-footer-cliente.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../js/detalle_cuenta.js"></script>
	<script src="../js/cookie_carrito.js"></script>
	<script src="../js/loading.js"></script>
	<script src="../js/menu_catalogo.js"></script>
</head>

<body>
	<?php
		//ini_set("session.cookie_secure", 1);
		session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
		session_set_cookie_params(["Secure" => "true"]); //false, true
		session_set_cookie_params(["HttpOnly" => "true"]); //false, true
		session_start();
		
		include_once("../modelo/conexion.php");
		include_once("../modelo/Manejo_Productos.php");
		$conex=Conexion::conexione();
		$pro=new Manejo_Productos($conex);
		$conex=null;
	?>
	<div id="loading">
	  	<img src="../imgs/loading3.gif">
	</div>
	<?php include_once("header_cliente.php") ?>
	<div class="relleno">
	</div>
	<div class="banner">
		<div class="slide">
			<ul>
				<li><img src="../imgs/imgslide4.jpg"></li>
				<li><img src="../imgs/imgslide2.jpg"></li>
				<li><img src="../imgs/imgslide3.jpg"></li>
				<li><img src="../imgs/imgslide5.jpg"></li>
			</ul>
		</div>
	</div>
	
	<main class="main">
		<section class="seccion_menu_catalogo">
			<div class="contenedor">
				<h3>¿ Que Productos Buscas ?</h3>
				<ul class="menu_catalogo">

				</ul>
			</div>
		</section>
		<div class="contenedor">
			
			<div class="catalogo">
				
				<section class="catalogo_produc">
					<!--<div class="produc">
						<p class="produc_img"><img src="../imgs/catalogo/ceras_colores_iridiscentes.jpg"></p>
						<p class="produc_nom">Ceras acuareables geltados colores incandesenctes</p>
						<p class="produc_precio">s/.54.90</p>
						<p class="produc_btn"><a><input type="button" value="Agregar al Carrito"></a></p>
					</div>-->
					
					<?php if(!isset($_COOKIE["subsecc"])):?>
					
						<?php $produc=$pro->getProductosPorSeccionCatalogo("Arte") ?>
						<?php foreach($produc as $p) :?>
							<div class="produc">
							<p class="produc_img"><img src="<?php echo "../imgs/catalogo/".$p->getImg() ?>"</img></p>
							<p class="produc_nom"><a href="descripcion_producto.php?idProduc=<?php echo $p->getId() ?>"><?php echo $p->getNombre()?></a></p>
							<p class="produc_precio">s/.<?php echo $p->getPrecio()?></p>
							<p class="produc_btn"><a><input type="button" data="<?php echo $p->getId() ?>" value="Agregar al Carrito"></a></p>
							</div>
						<?php endforeach;?>
					
					<?php else: ?>
						<?php $produc=$pro->getProductosPorSubseccionCatalogo($_COOKIE["subsecc"]) ?>
						<?php foreach($produc as $p) :?>
							<div class="produc">
							<p class="produc_img"><img src="<?php echo "../imgs/catalogo/".$p->getImg() ?>"</img></p>
							<p class="produc_nom"><a href="descripcion_producto.php?idProduc=<?php echo $p->getId() ?>"><?php echo $p->getNombre()?></a></p>
							<p class="produc_precio">s/.<?php echo $p->getPrecio()?></p>
							<p class="produc_btn"><a ><input type="button" data="<?php echo $p->getId() ?>" value="Agregar al Carrito"></a></p>
							</div>
						<?php endforeach;?>
					
					<?php endif;?>
					
				</section>
			</div>
		</div>
	</main>
	
	<?php include_once("footer_cliente.php") ?>

</body>
	
</html>