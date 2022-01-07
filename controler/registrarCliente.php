<?php
	require_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Usuario.php");
	include_once("../modelo/Manejo_Cliente.php");

	$con= Conexion::conexione();

	$user=$_POST["user"];
	$nombres=$_POST["nombres"];
	$apellidos=$_POST["apellidos"];
	$sexo=$_POST["selectSexo"];
	$mail=$_POST["mail"];
	$pass=$_POST["pass"];
	
	$mu= new Manejo_Usuario($con);
	
	$valor=$mu->crearUsuario($user,$pass,3);
	
	if($valor){
		$usu=$mu->getUsuarioxNombreyPass($user,$pass);
		$mc= new Manejo_Cliente($con);
		$va=$mc->creaCliente($usu->getId(),$nombres,$apellidos,$mail,$sexo);
		if($va){
			echo "success";
		}
	}else{
		echo "error";
	}
	 	

?>