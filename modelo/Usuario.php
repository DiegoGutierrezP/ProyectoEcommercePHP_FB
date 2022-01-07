<?php
	class Usuario{
		private $id;
		private $nombre;
		private $contra;
		private $categoria;
		
		public function getId(){
			return $this->id;
		}
		public function setId($i){
			 $this->id=$i;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($n){
			 $this->nombre=$n;
		}
		public function getContra(){
			return $this->contra;
		}
		public function setContra($c){
			 $this->contra=$c;
		}
		public function getCategoria(){
			return $this->categoria;
		}
		public function setCategoria($cate){
			$this->categoria=$cate;
		}
	}
?>