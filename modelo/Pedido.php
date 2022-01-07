<?php
	class Pedido{
		
		private $id;
		private $id_datosCliente;
		private $fecha;
		private $total;
		private $metodopago;
		private $metodoenvio;
		private $precioEnvio;
		private $estado_actual;
		private $peso;
		
		public function getId(){
			return $this->id;
		}
		public function setId($i){
			$this->id=$i;
		}
		public function getIdDatosCli(){
			return $this->id_datosCliente;
		}
		public function setIdDatosCli($idc){
			$this->id_datosCliente=$idc;
		}

		public function getFecha(){
			return $this->fecha;
		}
		public function setFecha($f){
			$this->fecha=$f;
		}
		public function getTotal(){
			return $this->total;
		}
		public function setTotal($t){
			$this->total=$t;
		}
		public function getPago(){
			return $this->metodopago;
		}
		public function setPago($p){
			$this->metodopago=$p;
		}
		public function getEnvio(){
			return $this->metodoenvio;
		}
		public function setEnvio($e){
			$this->metodoenvio=$e;
		}
		public function getPrecioEnvio(){
			return $this->precioEnvio;
		}
		public function setPrecioEnvio($pe){
			$this->precioEnvio=$pe;
		}
		public function getEstadoActual(){
			return $this->estado_actual;
		}
		public function setEstadoActual($ea){
			$this->estado_actual=$ea;
		}
		public function getPeso(){
			return $this->peso;
		}
		public function setPeso($peso){
			$this->peso=$peso;
		}
	}
?>