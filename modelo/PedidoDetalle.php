<?php

class PedidoDetalle{
	private $id;
	private $idPedido;
	private $idProducto;
	private $precioProducto;
	private $cantidad;
	private $precioTotal;
	
	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	public function getIdPedido(){
		return $this->idPedido;
	}
	public function setIdPedido($ip){
		$this->idPedido=$ip;
	}
	public function getIdProducto(){
		return $this->idProducto;
	}
	public function setIdProducto($ipro){
		$this->idProducto=$ipro;
	}
	public function getPrecioProducto(){
		return $this->precioProducto;
	}
	public function setPrecioProducto($pp){
		$this->precioProducto=$pp;
	}
	public function getCantidad(){
		return $this->cantidad;
	}
	public function setCantidad($c){
		$this->cantidad=$c;
	}
	public function getPrecioTotal(){
		return $this->precioTotal;
	}
	public function setPrecioTotal($pt){
		$this->precioTotal=$pt;
	}
}

?>