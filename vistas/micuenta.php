<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link rel="stylesheet" href="../css/stylepedidoscarrito_cliente.css">
	<link rel="stylesheet" href="../css/style-footer-cliente.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../js/detalle_cuenta.js"></script>
</head>

<body>
	<?php
		session_start();
		if(isset($_SESSION["nomusuario"])){
			include_once("../modelo/conexion.php");	
			include_once("../modelo/Manejo_Cliente.php");
			$con= Conexion::conexione();
			
			$mc= new Manejo_Cliente($con);
			$usu=$mc->getInfoCliente($_SESSION["codusuario"]);
		}
		
	?>
	<?php include_once("header_cliente.php") ?>
	<main class="main-micuenta">
		<div class="contenedor">
			<div class="info_usuario">
				<section class="info_usuario_img">
					<img src="../imgs/usuario_cliente.png">
				</section>
				<section class="info_usuario_info">
					<p><h2>Mi Cuenta</h2></p>

					<?php if(!isset($_SESSION["nomusuario"])):?>

						<a href='login.html'>Inciar Sesión</a>

					<?php else: ?>
						<table>
							<tr><td>Codigo de Usuario:</td><td><?php echo $usu->getId()?></td></tr>
							<tr><td>Nombre de Usuario:</td><td><?php echo $usu->getUsername()?></td></tr>
							<tr><td>Nombres:</td><td><?php echo $usu->getNombres()?></td></tr>
							<tr><td>Apellidos:</td><td><?php echo $usu->getApellidos()?></td></tr>
							<tr><td>Correo Electronico:</td><td><?php echo $usu->getEmail() ?></td></tr>
						</table>
						<div class="acciones">
							<a href="../controler/cerrarSesion.php"><input type="button" value="Cerrar Sesión"></a>
							<a  href="actualizar_datos.php"><input type="button"  value="Actualizar Datos"></a>
							<p><a href=""><input type="button" value="Eliminar Cuenta"></a></p>
						</div>
					<?php endif;?>
				</section>
			</div>
		</div>
	</main>
	<?php include_once("footer_cliente.php") ?>
</body>
</html>