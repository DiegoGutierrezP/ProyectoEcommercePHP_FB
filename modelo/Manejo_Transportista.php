<?php
include("Transportista.php");

class Manejo_Transportista{
	
	private $con;
	
	public function __construct($c){
		$this->con=$c;
	}
	
	public function getTransportistas(){
		$result=$this->con->prepare("SELECT * FROM transportista");
		$result->execute();
		$transportistas = array();
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			
			$trans= new Transportista();
			$trans->setId($reg["id"]);
			$trans->setIdEmpleado($reg["id_empleado"]);
			$trans->setIdEmpresa($reg["id_empresaT"]);
			$trans->setTipoLicencia($reg["tipoLicencia"]);
			$trans->setPlacaVehiculo($reg["placaVehiculo"]);
			
			$transportistas[]=$trans;
		}
		
		$result->closeCursor();
		//$this->con=null;
		return $transportistas;
	}
	
	public function getTransportistaxId($id){
		$result=$this->con->prepare("SELECT * FROM transportista WHERE id='$id'");
		$result->execute();
		$reg=$result->fetch(PDO::FETCH_ASSOC);
		
		$trans= new Transportista();
		$trans->setId($reg["id"]);
		$trans->setIdEmpleado($reg["id_empleado"]);
		$trans->setIdEmpresa($reg["id_empresaT"]);
		$trans->setTipoLicencia($reg["tipoLicencia"]);
		$trans->setPlacaVehiculo($reg["placaVehiculo"]);
		
		$result->closeCursor();
		//$this->con=null;
		return $trans;
		
	}
	
}

?>