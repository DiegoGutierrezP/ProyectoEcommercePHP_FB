<?php

class ReporteSolucion{
	private $id;
	private $idReporte;
	private $fechaSolucion;
	private $reporteSol;
	private $img;
	private $solucion;
	
	public function getId(){
		return $this->id;
	}
	public function setId($i){
		$this->id=$i;
	}
	public function getIdReporte(){
		return $this->idReporte;
	}
	public function setIdReporte($ir){
		$this->idReporte=$ir;
	}
	public function getFechaSolucion(){
		return $this->fechaSolucion;
	}
	public function setFechaSolucion($fs){
		$this->fechaSolucion=$fs;
	}
	public function getReporteSol(){
		return $this->reporteSol;
	}
	public function setReporteSol($rs){
		$this->reporteSol=$rs;
	}
	
	public function getImg(){
		return $this->img;
	}
	public function setImg($img){
		$this->img=$img;
	}
	public function getSolucion(){
		return $this->solucion;
	}
	public function setSolucion($s){
		$this->solucion=$s;
	}
}

?>