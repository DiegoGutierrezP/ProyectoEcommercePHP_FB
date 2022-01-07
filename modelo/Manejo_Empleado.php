<?php

include_once("Empleado.php");

class Manejo_Empleado{
	
	private $conexion;
		
	public function __construct($con){
		$this->conexion=$con;
	}
	
	public function getInfoEmpleado($id){
		$resultado=$this->conexion->prepare("SELECT * FROM empleado WHERE id=:id");
		$resultado->bindValue(":id",$id);
		$resultado->execute();
		$empleado =  new Empleado();
		
		$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			
		$empleado->setId($reg["id"]);
		$empleado->setIdUsu($reg["id_usuario"]);
		$empleado->setNombres($reg["nombres"]);
		$empleado->setApellidos($reg["apellidos"]);
		$empleado->setEmail($reg["email"]);
		$empleado->setDni($reg["dni"]);
		$empleado->setTelf($reg["telefono"]);
		$empleado->setSexo($reg["sexo"]);
		$empleado->setAreaT($reg["areaTrabajo"]);
		$empleado->setEstado($reg["estado"]);
		
		$resultado->closeCursor();
		return $empleado;
	}
	

	
}

?>