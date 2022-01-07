<?php
		
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Usuario.php");
	include_once("../modelo/Manejo_Cliente.php");
	$conex=Conexion::conexione();

	$mu= new Manejo_Usuario($conex);
	
	if(isset($_POST["actualizar_usuario"])){
		$idusuario=$_POST["codigoUsuario"];
		$id=$_POST["id"];//id del cliente
		$username= $_POST["username"];
		$nombres= $_POST["nombres"];
		$apellidos= $_POST["apellidos"];
		$dni=$_POST["dni"];
		$email= $_POST["email"];
		$newpass= $_POST["newpass"];

		$va1=$mu->actualizarUsu($idusuario,$username,$newpass);
		if($va1){
			$mc= new Manejo_Cliente($conex);
			$va2=$mc->actualizaDatosCliente($id,$nombres,$apellidos,$dni,$email);
			if($va2){
				session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
				session_set_cookie_params(["Secure" => "true"]); //false, true
				session_set_cookie_params(["HttpOnly" => "true"]); //false, true
				session_start();
				if(isset($_SESSION["codusuario"])){
					$_SESSION["nomusuario"]=$username;
				}
				header("Location:../vistas/micuenta.php");
			}else{
				echo "ERROR AL ACTUALIZAR DATOS CLIENTE";
			}
		}else{
			echo "ERROR AL ACTUALIZAR DATOS USUARIO";
		}
		
		
	}
?>