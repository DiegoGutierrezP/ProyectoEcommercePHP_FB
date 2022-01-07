<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="../css/style-footer-cliente.css">
<link rel="stylesheet" href="../css/style_descripcion_produc.css">	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/detalle_cuenta.js"></script>
<script src="../js/descripcion_producto.js"></script>
</head>
<?php
		session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
		session_set_cookie_params(["Secure" => "true"]); //false, true
		session_set_cookie_params(["HttpOnly" => "true"]); //false, true
		session_start();
	
		/*if(!isset($_GET["idProduc"])){
			header("Location:catalogo.php");
		}*/
		include_once("../modelo/conexion.php");
		include_once("../modelo/Manejo_Productos.php");
		include_once("../modelo/Manejo_Seccion.php");
		$con=Conexion::conexione();
		$mp= new Manejo_Productos($con);
		$ms= new Manejo_Seccion($con);
	
		$pp=$mp->getProductosPorId($_GET["idProduc"]);
	?>
<body>
	<?php include_once("header_cliente.php")?>
	<main class="main_descrip">
		<div class="contenedor">
			<div class="descripcion-content">
				<h2>Descripción del Producto</h2><br>	
				<div class="descripcion">
					<div class="img-produc"><img src="../imgs/catalogo/<?php echo $pp->getImg() ?>"></div>
					<div class="contenido-descrip">
						
						<p class="nombre"><h3><?php echo $pp->getNombre() ?></h3></p>
						<p class="descrip"><?php echo $pp->getDescrip() ?></p>
						<p class="cantidad"><span class="btn_cant" id="restar">-</span><input  class="inputCant" type="text" value="1" disabled><span class="btn_cant" id="sumar">+</span></p>
						<p>Estado: <?php if($pp->getEstado()){ echo " Disponible"; }else{ echo " No Disponible"; } ?></p>
						<p class="precio">S/. <?php echo $pp->getPrecio() ?></p>
						
						<p class="btn"><button id="btn-agregar-carrito" data-idP="<?php echo $pp->getId() ?>">Agregar al Carrito</button></p>
					</div>
				</div>
			</div>
			<div class="productos-relacionados">
				<h2>Productos Relacionados</h2>
				<?php
	
					$producs=$mp->getProductosPorSeccionYEstado($pp->getSeccion(),1); 
				?>
				<?php if(count($producs)>= 6): ?>
					<div class="slide-productos">
					<ul>
					<?php if(count($producs)>8):?>
						<?php $amostrar= array_rand($producs,8); ?>
						<?php foreach($amostrar as $am): ?>
							<li>
							<p class="pr-img"><img src="../imgs/catalogo/<?php echo $producs[$am]->getImg() ?>"></p>
							<p class="pr-nombre"><a href="descripcion_producto.php?idProduc=<?php echo $producs[$am]->getId() ?>"><?php echo $producs[$am]->getNombre() ?></a></p>
							<p class="pr-precio">S/.<?php echo $producs[$am]->getPrecio() ?></p>
							</li>
						<?php endforeach; ?>
					<?php else: ?>
						<?php $amostrar= array_rand($producs,6); ?>
						<?php foreach($amostrar as $am): ?>
							<li>
							<p class="pr-img"><img src="../imgs/catalogo/<?php echo $producs[$am]->getImg() ?>"></p>
							<p class="pr-nombre"><a href="descripcion_producto.php?idProduc=<?php echo $producs[$am]->getId() ?>"><?php echo $producs[$am]->getNombre() ?></a></p>
							<p class="pr-precio">S/.<?php echo $producs[$am]->getPrecio() ?></p>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
					</ul>
					</div>
				<?php else:?>
					<?php if(count($producs)>=4):?>
						<?php $amostrar= array_rand($producs,4); ?>
						<?php foreach($amostrar as $am): ?>
							<div class="produc-relacionados-4">
								<p class="pr-img"><img src="../imgs/catalogo/<?php echo $producs[$am]->getImg() ?>"></p>
								<p class="pr-nombre"><a href="descripcion_producto.php?idProduc=<?php echo $producs[$am]->getId() ?>"><?php echo $producs[$am]->getNombre() ?></a></p>
								<p class="pr-precio">S/.<?php echo $producs[$am]->getPrecio() ?></p>
							</div>
						<?php endforeach; ?>
					<?php elseif(count($producs)<4 && count($producs)>=2): ?>
						<?php foreach($producs as $p): ?>
							<div class="produc-relacionados-4">
								<p class="pr-img"><img src="../imgs/catalogo/<?php echo $p->getImg() ?>"></p>
								<p class="pr-nombre"><a href="descripcion_producto.php?idProduc=<?php echo $producs[$am]->getId() ?>"><?php echo $p->getNombre() ?></a></p>
								<p class="pr-precio">S/.<?php echo $p->getPrecio() ?></p>
							</div>
						<?php endforeach; ?>
					<?php else:?>
							<div class="no-produc-relacionados"><h3>No hay productos relacionados</h3></div>
					<?php endif; ?>
				<?php endif; ?>
				
				<!--<div class="slide-productos">
					<ul>
						<li>
							<p class="pr-img"><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p class="pr-nombre"><a href="">Óleos Pastel neón y metálico en estuche rígido de 12 colores</a></p>
							<p class="pr-precio">S/. 154.90</p>
						</li>
						<li>
							<p class="pr-img"><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p class="pr-nombre"><a href="">Óleos Pastel neón y metálico en estuche rígido de 12 colores</a></p>
							<p class="pr-precio">S/. 154.90</p>
						</li>
						<li>
							<p class="pr-img"><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p class="pr-nombre"><a href="">Óleos Pastel neón y metálico en estuche rígido de 12 colores</a></p>
							<p class="pr-precio">S/. 154.90</p>
						</li>
						<li>
							<p class="pr-img"><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p class="pr-nombre"><a href="">Óleos Pastel neón y metálico en estuche rígido de 12 colores</a></p>
							<p class="pr-precio">S/. 154.90</p>
						</li>
						<li>
							<p><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p>Óleos Pastel neón y metálico en estuche rígido de 12 colores</p>
							<p>S/. 154.90</p>
						</li>
						<li>
							<p><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p>Óleos Pastel neón y metálico en estuche rígido de 12 colores</p>
							<p>S/. 154.90</p>
						</li>
						<li>
							<p><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p>Óleos Pastel neón y metálico en estuche rígido de 12 colores</p>
							<p>S/. 154.90</p>
						</li>
						<li>
							<p><img src="../imgs/catalogo/acuarelas1.jpg"></p>
							<p>Óleos Pastel neón y metálico en estuche rígido de 12 colores</p>
							<p>S/. 154.90</p>
						</li>
					</ul>
				</div>-->
			</div>	
		</div>
	</main>
	<?php include_once("footer_cliente.php")?>
</body>
</html>