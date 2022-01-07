<?php
	
	class Producto{
		
		private $id;
		private $nombre;
		private $descrip;
		private $precio;
		private $cantidad;
		private $img;
		private $seccion;
		private $subseccion;
		private $estado;
		
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
		public function getDescrip(){
			return $this->descrip;
		}
		public function setDescrip($des){
			$this->descrip=$des;
		}
		public function getPrecio(){
			return $this->precio;
		}
		public function setPrecio($pre){
			$this->precio=$pre;
		}
		public function getCantidad(){
			return $this->cantidad;
		}
		public function setCantidad($cant){
			$this->cantidad=$cant;
		}
		public function getImg(){
			return $this->img;
		}
		public function setImg($img){
			$this->img=$img;
		}
		public function getSeccion(){
			return $this->seccion;
		}
		public function setSeccion($sec){
			$this->seccion=$sec;
		}
		public function getSubSeccion(){
			return $this->subseccion;
		}
		public function setSubSeccion($subsec){
			$this->subseccion=$subsec;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($e){
			$this->estado=$e;
		}
		
	}

?>