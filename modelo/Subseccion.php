<?php
	class Subseccion{
		private $id;
		private $seccion;
		private $nombre;
		
		public function getId(){
			return $this->id;
		}
		public function setId($i){
			$this->id=$i;
		}
		public function getSeccion(){
			return $this->id;
		}
		public function setSeccion($s){
			$this->seccion=$s;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($n){
			$this->nombre=$n;
		}
	}
?>