<?php

class EmpresaTransporte{
	private $id;
	private $nombreEm;
	private $ruc;
	
	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	public function getNombreEm(){
		return $this->nombreEm;
	}
	public function setNombreEm($ne){
		$this->nombreEm=$ne;
	}
	public function getRuc(){
		return $this->ruc;
	}
	public function setRuc($r){
		$this->ruc=$r;
	}
}

?>