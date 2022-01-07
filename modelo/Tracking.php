<?php

class Tracking{
	
	private $id;
	private $id_pedido;
	private $pago_recibido;
	private $problemas;
	private $empaquetado;
	private $listoParaEnviar;
	private $salida;
	private $encamino;
	private $llegada;
	private $entregado;
	private $cancelado;
	
	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	//
	public function getIdPedido(){
		return $this->id_pedido;
	}
	public function setIdPedido($ip){
		$this->id_pedido=$ip;
	}
	//
	public function getPagoR(){
		return $this->pago_recibido;
	}
	public function setPagoR($pr){
		$this->pago_recibido=$pr;
	}
	//
	public function getProblemas(){
		return $this->problemas;
	}
	public function setProblemas($prob){
		$this->problemas=$prob;
	}
	//
	public function getEmpaquetado(){
		return $this->empaquetado;
	}
	public function setEmpaquetado($emp){
		$this->empaquetado=$emp;
	}
	//
	public function getListo(){
		return $this->listoParaEnviar;
	}
	public function setListo($l){
		$this->listoParaEnviar=$l;
	}
	//
	public function getSalida(){
		return $this->salida;
	}
	public function setSalida($s){
		$this->salida=$s;
	}
	//
	public function getEncamino(){
		return $this->encamino;
	}
	public function setEncamino($enc){
		$this->encamino=$enc;
	}
	//
	public function getLlegada(){
		return $this->llegada;
	}
	public function setLlegada($lle){
		$this->llegada=$lle;
	}
	//
	public function getEntregado(){
		return $this->entregado;
	}
	public function setEntregado($entre){
		$this->entregado=$entre;
	}
	//
	public function getCancelado(){
		return $this->cancelado;
	}
	public function setCancelado($cance){
		$this->cancelado=$cance;
	}
}


?>