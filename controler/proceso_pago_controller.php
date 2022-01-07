<?php

	include("../modelo/conexion.php");
	include("../modelo/Manejo_DatoClienteEnvio.php");
	include("../modelo/Manejo_Cliente.php");

	$con= Conexion::conexione();

	if(isset($_POST["accion"])){
		$op= $_POST["accion"];
		switch($op){
			case "consultarClienteDatos":
					if(isset($_POST["idce"])){
						$mdce = new Manejo_DatoClienteEnvio($con);
						$dat=$mdce->getDatosEnvioXId($_POST["idce"]);

						$html="<tr><td><label>Nombres</label><br><input type='text' value='".$dat->getNombres()."' class='readonly' readonly></td><td><label>Apellidos</label><br><input type='text' value='".$dat->getApellidos()."' class='readonly' readonly></td></tr>".
							"<tr><td><label>Dni</label><br><input type='text' value='".$dat->getDni()."' class='readonly' readonly></td><td><label>Ciudad</label><br><input type='text' value='".$dat->getCiudad()."' class='readonly' readonly></td></tr>".
							"<tr><td><label>Distrito</label><br><input type='text' value='".$dat->getDistrito()."' class='readonly' readonly></td><td><label>Domicilio</label><br><input type='text' value='".$dat->getDomi()."' class='readonly' readonly></td></tr>";

						echo $html;
		
					}
				break;
				
			case "consultarCliente":
				$idcli= $_POST["idc"];//id del cliente no del usuario
				$mcli =  new Manejo_Cliente($con);
				$cli=$mcli->getInfoCLienteXId($idcli);
				
				$form="<tr><td><label>Nombres *</label><br><input type='text' id='txt_nombres' name='nombres' value='".$cli->getNombres()."'></td><td><label>Apellidos *</label><br><input type='text' id='txt_apellidos' name='apellidos' value='".$cli->getApellidos()."'></td></tr>".
				"<tr><td><label>Dni *</label><br><input type='text' id='txt_dni' name='dni' value='".$cli->getDni()."'></td><td><label>Ciudad *</label><br><input type='text' id='txt_ciudad' name='ciudad'></td></tr>".
				"<tr><td><label>Distrito *</label><br><input type='text' id='txt_distrito' name='distrito'></td><td><label>Domicilio *</label><br><input type='text' id='txt_domi' name='domi'></td></tr>".
				"<tr><td colspan='2' id='msg_error_form' style='color:red'></td></tr>";
				
				echo $form;
				
				break;
		}
	}


	

?>