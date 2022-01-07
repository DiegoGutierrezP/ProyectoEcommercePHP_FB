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
	<script src="../js/modal_mispedidos.js"></script>
</head>

<body>
	<?php
		session_start();
		include_once("../modelo/conexion.php");
		include_once("../modelo/Manejo_Pedido.php");
		include_once("../modelo/Manejo_Cliente.php");
		$cpedido= new Manejo_Pedido(Conexion::conexione());
		$mcli = new Manejo_Cliente(Conexion::conexione());
	?>
	
	<?php include_once("header_cliente.php") ?>
	
	<main class="main_pedidos">
		<div class="contenedor_tracking">
			<div class='tracking'>
				<div class='step' id='step1'>
				   <div>
					  <div class='circle'>1</div>
				   </div>
				   <div>
					  <div class='title'>Pago procesado</div>
					  <div class='fecha'></div>
				   </div>
				</div>
				<div class='step' id='step2'>
				   <div>
					  <div class='circle'>2</div>
				   </div>
				   <div>
					  <div class='title'>Empaquetado</div>
					  <div class='fecha'></div>
				   </div>
				</div>
				<div class='step' id='step3'>
				   <div>
					  <div class='circle'>3</div>
				   </div>
				   <div>
					  <div class='title'>Listo para enviar</div>
					  <div class='fecha'></div>
				   </div>
				</div>
				<div class='step' id='step4'>
				   <div>
					  <div class='circle'>4</div>
				   </div>
				   <div>
					  <div class='title'>En camino</div>
					   <div class='fecha'></div>
				   </div>
				</div>
				<div class='step' id='step5'>
				   <div>
					  <div class='circle'>5</div>
				   </div>
				   <div>
					  <div class='title'>Entregado</div>
					   <div class='fecha'></div>
				   </div>
				</div>
			</div>
		</div>
		<div class="contenedor">
			<h2>Mis pedidos</h2>
			<?php if(isset($_SESSION["codusuario"])):?>
			<?php $cli=$mcli->getIdClienteXIdUsu($_SESSION["codusuario"]); ?>
				<table class="tabla_pedidos">
					<thead><tr><th>Codigo</th><th>Fecha</th><th>Total</th><th>Metodo de Pago</th><th>Estado</th></tr></thead>
					<tbody>
				<?php 
						
					$listap=$cpedido->getPedidoporCli($cli->getId());
					foreach($listap as $p){ ?>
						<tr><td><?php echo $p->getId() ?></td><td><?php echo $p->getFecha() ?></td><td><?php echo $p->getTotal() ?></td><td><?php echo $p->getPago() ?></td><td><?php echo $p->getEstadoActual() ?></td><td><input type="button" class="btn_detalle" data-pedido="<?php echo $p->getId() ?>" value="Ver detalle"></td><td><input type="button" data-pedido="<?php echo $p->getId() ?>" class="btn_estado" value="Estado"></td></tr>

				<?php } ?>
					</tbody>
				</table>
			<?php else: ?>
				<p>Inicie Sesion para ver sus pedidos.</p>
				<p><a href="login.html">Iniciar Sesión</a></p>
			<?php endif;?>
		</div>
		
	</main>
	<?php include_once("footer_cliente.php") ?>

</body>
</html>