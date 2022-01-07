<?php

class DatoClienteEnvio{
	private $id;
	private $idCliente;
	private $nombres;
	private $apellidos;
	private $dni;
	private $ciudad;
	private $distrito;
	private $domicilio;
	
	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	public function getIdCliente(){
		return $this->idCliente;
	}
	public function setIdCliente($ic){
		$this->idCliente=$ic;
	}
	public function getNombres(){
		return $this->nombres;
	}
	public function setNombres($n){
		$this->nombres=$n;
	}
	public function getApellidos(){
		return $this->apellidos;
	}
	public function setApellidos($ap){
		$this->apellidos=$ap;
	}
	public function getDni(){
		return $this->dni;
	}
	public function setDni($dni){
		$this->dni=$dni;
	}
	public function getCiudad(){
		return $this->ciudad;
	}
	public function setCiudad($ciu){
		$this->ciudad=$ciu;
	}
	public function getDistrito(){
		return $this->distrito;
	}
	public function setDistrito($dis){
		$this->distrito=$dis;
	}
	public function getDomi(){
		return $this->domicilio;
	}
	public function setDomi($d){
		$this->domicilio=$d;
	}
}

?>