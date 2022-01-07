<?php

include_once("Cliente.php");

class Manejo_Cliente{
	
	private $conexion;
		
	public function __construct($con){
		$this->conexion=$con;
	}
	
	public function getInfoCliente($id){
		$resultado=$this->conexion->prepare("SELECT u.user, u.password, c.id, c.nombres, c.apellidos, c.dni, c.email, c.sexo FROM usuarios AS u INNER JOIN cliente AS c ON u.id=c.id_usuario WHERE u.id=:id");
		$resultado->bindValue(":id",$id);
		$resultado->execute();
		$cliente =  new CLiente();
		
		$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			
		$cliente->setId($reg["id"]);
		$cliente->setUsername($reg["user"]);
		$cliente->setPass($reg["password"]);
		$cliente->setNombres($reg["nombres"]);
		$cliente->setApellidos($reg["apellidos"]);
		$cliente->setDni($reg["dni"]);
		$cliente->setEmail($reg["email"]);
		$cliente->setSexo($reg["sexo"]);
		
		$resultado->closeCursor();
		return $cliente;
	}
	
	public function getIdClienteXIdUsu($idusu){
		$resultado=$this->conexion->prepare("SELECT id FROM cliente WHERE id_usuario=:id");
		$resultado->bindValue(":id",$idusu);
		$resultado->execute();
		$cliente =  new CLiente();
		$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			
		$cliente->setId($reg["id"]);
		$resultado->closeCursor();
		return $cliente;
	}
	
	public function getInfoCLienteXId($id){
		$resultado=$this->conexion->prepare("SELECT * FROM cliente WHERE id=:id");
		$resultado->bindValue(":id",$id);
		$resultado->execute();
		$cliente =  new CLiente();
		
		$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			
		$cliente->setId($reg["id"]);
		$cliente->setNombres($reg["nombres"]);
		$cliente->setApellidos($reg["apellidos"]);
		$cliente->setDni($reg["dni"]);
		$cliente->setEmail($reg["email"]);
		$cliente->setSexo($reg["sexo"]);
		
		$resultado->closeCursor();
		return $cliente;
	}
	
	public function creaCliente($id_usu,$nombres,$apellidos,$email,$sexo){
		$resultado=$this->conexion->prepare("INSERT INTO cliente (id_usuario,nombres,apellidos,email,sexo) VALUES ('$id_usu','$nombres','$apellidos','$email','$sexo')");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	
	public function actualizaDatosCliente($id,$nom,$ape,$dni,$mail){
		
		$resultado=$this->conexion->prepare("UPDATE cliente SET nombres=:noms, apellidos=:apes, dni=:dni, email=:mail WHERE id=:id");
		
		$resultado->bindValue(":noms",$nom);
		$resultado->bindValue(":apes",$ape);
		$resultado->bindValue(":dni",$dni);
		$resultado->bindValue(":mail",$mail);
		$resultado->bindValue(":id",$id);
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	
}

?>