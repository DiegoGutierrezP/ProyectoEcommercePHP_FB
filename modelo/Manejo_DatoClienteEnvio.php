<?php

include("DatoClienteEnvio.php");

class Manejo_DatoClienteEnvio{
	
	private $con;
	
	public function __construct($c){
		$this->con=$c;
	}
	
	public function insertarDatosEnvio($idcliente,$noms,$apes,$dni,$ciu,$dis,$domi){
		$result = $this->con->prepare("INSERT INTO dato_cliente_envio (id_cliente,nombres,apellidos,dni,ciudad,distrito,domicilio) VALUES (:idcli,:noms,:apes,:dni,:ciu,:dis,:domi)");
		$result->bindValue(":idcli",$idcliente);
		$result->bindValue(":noms",$noms);
		$result->bindValue(":apes",$apes);
		$result->bindValue(":dni",$dni);
		$result->bindValue(":ciu",$ciu);
		$result->bindValue(":dis",$dis);
		$result->bindValue(":domi",$domi);
		$va=$result->execute();
		$result->closeCursor();
		return $va;
	}
	
	public function getDatosEnvio($idcliente){
		$result=$this->con->prepare("SELECT * FROM dato_cliente_envio WHERE id_cliente='$idcliente'");
		$result->execute();
		$datos =array();
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			$dat = new DatoClienteEnvio();
			$dat->setId($reg["id"]);
			$dat->setIdCliente($reg["id_cliente"]);
			$dat->setNombres($reg["nombres"]);
			$dat->setApellidos($reg["apellidos"]);
			$dat->setDni($reg["dni"]);
			$dat->setCiudad($reg["ciudad"]);
			$dat->setDistrito($reg["distrito"]);
			$dat->setDomi($reg["domicilio"]);
			
			$datos[] = $dat;
		}
		$result->closeCursor();
		return $datos;
	}
	
	public function getNumeroDatosCliente($idcliente){
		$result=$this->con->prepare("SELECT id FROM dato_cliente_envio WHERE id_cliente='$idcliente'");
		$result->execute();
		$datos = array();
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			$dat= new DatoClienteEnvio();
			$dat->setId($reg["id"]);
			$datos[] = $dat;
		}
		$result->closeCursor();
		return $datos;
	}
	
	public function getDatosEnvioXId($idDatos){
		$result=$this->con->prepare("SELECT * FROM dato_cliente_envio WHERE id='$idDatos'");
		$result->execute();
		$reg=$result->fetch(PDO::FETCH_ASSOC);
			$dat = new DatoClienteEnvio();
			$dat->setId($reg["id"]);
			$dat->setIdCliente($reg["id_cliente"]);
			$dat->setNombres($reg["nombres"]);
			$dat->setApellidos($reg["apellidos"]);
			$dat->setDni($reg["dni"]);
			$dat->setCiudad($reg["ciudad"]);
			$dat->setDistrito($reg["distrito"]);
			$dat->setDomi($reg["domicilio"]);
		
		$result->closeCursor();
		return $dat;
	}
	
}

?>