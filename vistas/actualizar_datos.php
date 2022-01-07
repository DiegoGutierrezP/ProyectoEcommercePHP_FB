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
		/*if(!isset($_SESSION["codusuario"])){
			header("Location:index.php");
		}*/
		$bandera=false;
		include_once("../modelo/conexion.php");	
		include_once("../modelo/Manejo_Usuario.php");
		include_once("../modelo/Manejo_Cliente.php");
		$con= Conexion::conexione();
		$manejo_usuario= new Manejo_Usuario($con); 
	
		if(isset($_POST["verificar_pass"])){
			$valor=$manejo_usuario->verificarPass($_POST["pass"],$_SESSION["codusuario"]);
			if($valor){$bandera=true;}		
		}
	?>
	
	<?php include_once("header_cliente.php") ?>
	
	<main class="main_cambiar_contra">
		<div class="contenedor">
			<?php if(!$bandera)://bandera si el usuario introdujo contrasenia incorrecta?>
				<section class="ingresar_contra">
					<?php if(!isset($_SESSION["nomusuario"])):?>
							<a href='login.html'>Inciar Sesión</a>
					<?php else: ?>
							<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
								<p>Ingresar Contraseña</p>
								<p><input type="password" name="pass" class="campopassword"></p>
								<p><input type="submit" name="verificar_pass" class="btn-verificar-pass"></p>
							</form>
					<?php endif;?>
				</section>
			<?php else: //si contrasenia es correcta podra actualizar sus datos y contrasenia?>
				<?php 
					$mc= new Manejo_Cliente($con);
					$usu=$mc->getInfoCliente($_SESSION["codusuario"]);
				?>
				<section class="actualizar_datos">
					<h2>Actualizar Datos</h2>
					<form action="../controler/actualizar_datos_cliente.php" method="post">
						<table>
							<input type="hidden" name="codigoUsuario" value="<?php echo $_SESSION["codusuario"] ?>">
							<tr><td>ID:</td><td><input class="input_text" type="text" readonly name="id" value="<?php echo $usu->getId() ?>"></td></tr>
							<tr><td>NOMBRE DE USUARIO:</td><td><input class="input_text" type="text" name="username" required value="<?php echo $usu->getUsername() ?>"></td></tr>
							<tr><td>NOMBRES:</td><td><input class="input_text" type="text" name="nombres" required value="<?php echo $usu->getNombres() ?>"></td></tr>
							<tr><td>APELLIDOS:</td><td><input class="input_text" type="text" name="apellidos" required value="<?php echo $usu->getApellidos() ?>"></td></tr>
							<tr><td>DNI:</td><td><input class="input_text" type="text" name="dni" value="<?php echo $usu->getDni() ?>"></td></tr>
							<tr><td>EMAIL:</td><td><input class="input_text" type="text" name="email" required value="<?php echo $usu->getEmail() ?>"></td></tr>
							<tr><td>NUEVA CONTRASEÑA</td><td><input class="input_text" type="password" name="newpass"></td></tr>
							<tr class="fila_btn"><td ><a href="micuenta.php"><input class="input_btn" type="button" value="Cancelar"></a></td><td><input class="input_btn" type="submit" name="actualizar_usuario" value="Enviar"></td></tr>
						</table>
					</form>
				</section>
			<?php endif; ?>
		</div>
	</main>
	<?php include_once("footer_cliente.php") ?>
	
</body>
</html>