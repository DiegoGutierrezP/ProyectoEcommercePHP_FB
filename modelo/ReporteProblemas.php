<?php

class ReporteProblema{
	private $id;
	private $idPedido;
	private $area;
	private $fechaReporte;
	private $motivo;
	private $reporte;
	private $img;
	private $estado;
	
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
	
	public function getArea(){
		return $this->area;
	}
	public function setArea($ar){
		$this->area=$ar;
	}
	
	public function getFechaReporte(){
		return $this->fechaReporte;
	}
	public function setFechaReporte($fr){
		$this->fechaReporte=$fr;
	}
	public function getMotivo(){
		return $this->motivo;
	}
	public function setMotivo($m){
		$this->motivo=$m;
	}
	public function getReporte(){
		return $this->reporte;
	}
	public function setReporte($r){
		$this->reporte=$r;
	}
	public function getImg(){
		return $this->img;
	}
	public function setImg($img){
		$this->img=$img;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function setEstado($e){
		$this->estado=$e;
	}
}

?>