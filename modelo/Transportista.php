<?php

class Transportista{
	private $id;
	private $idEmpleado;
	private $idEmpresa;
	private $tipoLicencia;
	private $placaVehiculo;
	
	
	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	public function getIdEmpleado(){
		return $this->idEmpleado;
	}
	public function setIdEmpleado($ie){
		$this->idEmpleado=$ie;
	}
	public function getIdEmpresa(){
		return $this->idEmpresa;
	}
	public function setIdEmpresa($iem){
		$this->idEmpresa=$iem;
	}
	public function getTipoLicencia(){
		return $this->tipoLicencia;
	}
	public function setTipoLicencia($tl){
		$this->tipoLicencia=$tl;
	}
	public function getPlacaVehiculo(){
		return $this->placaVehiculo;
	}
	public function setPlacaVehiculo($pv){
		$this->placaVehiculo=$pv;
	}
}

?>