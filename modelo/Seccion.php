<?php
class Seccion{
	private $id;
	private $nombre;
	private $mostrar;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id=$id;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function setNombre($nom){
		$this->nombre=$nom;
	}
	public function getMostrar(){
		return $this->mostrar;
	}
	public function setMostrar($m){
		$this->mostrar=$m;
	}
}

?>