<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link rel="stylesheet" href="../css/stylepedidoscarrito_cliente.css">
	<link rel="stylesheet" href="../css/style-footer-cliente.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="../js/detalle_cuenta.js"></script>
	<script src="../js/carrito.js"></script>
</head>

<body>
	<?php
		session_start();
		include_once("../modelo/conexion.php");
		include_once("../modelo/Manejo_Productos.php");
		$con=Conexion::conexione();
		$manejo_produc= new Manejo_Productos($con);
		$sesion="";
		if(isset($_SESSION["codusuario"])){
			$sesion=$_SESSION["codusuario"];
		}
	?>
	<?php include_once("header_cliente.php") ?>
	<main class="main_carrito">
		<div class="contenedor">
			<h2>Carrito de Compras</h2>
			
				<?php if((!isset($_COOKIE["carrito_cookie"])) ):?>
					<div class="carrito_vacio">
						<p>Carrito vacío</p>
						<p><a href="catalogo.php">Agregar Productos</a></p>
					</div>
				<?php else:?>
				<?php $items=json_decode($_COOKIE["carrito_cookie"],true); $totalcarrito=0;?>
				<br>
				<p><?php echo count($items) ?> Productos en su carrito </p>
				<div class="carrito">
					<ul class="lista_carrito">
					<?php for($i=0;$i<count($items);$i++): ?>
						<?php $p=$manejo_produc->getProductosPorId($items[$i]["id"]); $totalitem=$p->getPrecio()*$items[$i]["cantidad"]; $totalcarrito+=$totalitem;?>
						<li class="item_carrito">
							<div class="item_carrito_img"><img src="<?php echo "../imgs/catalogo/".$p->getImg() ?>"></div>
							<div class="item_carrito_detalles">
								<p><?php echo $p->getNombre() ?></p>
								<p>Cantidad: <a href="../controler/gestion_carrito.php?accion=restar & id2=<?php echo $p->getId() ?>"><span class="btn_cant">-</span></a><?php echo $items[$i]["cantidad"] ?><a href="../controler/gestion_carrito.php?accion=sumar & id2=<?php echo $p->getId() ?>"><span class="btn_cant">+</span></a></p>
								<p><a href="../controler/gestion_carrito.php?id=<?php echo $p->getId() ?>">Eliminar</a></p>
							</div>
							<div class="item_carrito_precio"><p>S/.<?php echo $totalitem  ?></p></div>
						</li>
						<hr>
					<?php endfor?>
					</ul>
					<section class="preciototal_carrito">
						<p class="total">Precio total: S/.<?php echo $totalcarrito ?></p>
						<p class="btn_pagar"><input data-sesion="<?php echo $sesion ?>" type="button" id="proceder_pago" value="Proceder al Pago"></p>
						<p class="btn_continuarComprando"><a href='catalogo.php'><button >Continuar Comprando</button></a></p>
					</section>
				</div>
				<?php endif;?>
			
		</div>
	</main>
	<?php include_once("footer_cliente.php") ?>
</body>
</html>