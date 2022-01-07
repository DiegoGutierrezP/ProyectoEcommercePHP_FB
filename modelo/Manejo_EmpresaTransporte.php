<?php

include("EmpresaTransporte.php");

class Manejo_EmpresaTransporte{
	private $con;
	
	public function __construct($c){
		$this->con=$c;
	}
	
	public function getEmpresaT(){
		$result=$this->con->prepare("SELECT * FROM empresa_transporte");
		$result->execute();
		
		$empresas = array();
		
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			$empre = new EmpresaTransporte();
			$empre->setId($reg["id"]);
			$empre->setNombreEm($reg["nombreEmpresa"]);
			$empre->setRuc($reg["ruc"]);
			
			$empresas[]=$empre;
		}
		$result->closeCursor();
		return $empresas;
	}
	
	public function getEmpresaTxId($id){
		$result=$this->con->prepare("SELECT * FROM empresa_transporte WHERE id='$id'");
		$result->execute();
		
		$reg=$result->fetch(PDO::FETCH_ASSOC);
			
		$empre = new EmpresaTransporte();
		$empre->setId($reg["id"]);
		$empre->setNombreEm($reg["nombreEmpresa"]);
		$empre->setRuc($reg["ruc"]);
			
		$result->closeCursor();
		
		return $empre;
	}
	
}

?>