<?php

include("ReporteProblemas.php");

class Manejo_ReporteProblema{
	
	private $con;
	
	public function __construct($c){
		$this->con=$c;
	}
	
	public function crearReporte($idp,$area,$fecha,$motivo,$reporte,$img){
		if($img==""){
			$sql="INSERT INTO reporte_problemas (id_pedido,area,fecha_reporte,motivo,reporte,estado) VALUES ('$idp','$area','$fecha','$motivo','$reporte','1')";
		}else{
			$sql="INSERT INTO reporte_problemas (id_pedido,area,fecha_reporte,motivo,reporte,imagen,estado) VALUES ('$idp','$area','$fecha','$motivo','$reporte','$img','1')";
		}
		
		$result=$this->con->prepare($sql);
		$valor=$result->execute();
		$result->closeCursor();
		return $valor;
	}
	
	public function getReporte($idp){
		$result=$this->con->prepare("SELECT * FROM reporte_problemas WHERE id_pedido='$idp'");
		$result->execute();
		$reg=$result->fetch(PDO::FETCH_ASSOC);
		$reporte = new ReporteProblema();
		$reporte->setId($reg["id"]);
		$reporte->setIdPedido($reg["id_pedido"]);
		$reporte->setArea($reg["area"]);
		$reporte->setFechaReporte($reg["fecha_reporte"]);
		$reporte->setMotivo($reg["motivo"]);
		$reporte->setReporte($reg["reporte"]);
		$reporte->setImg($reg["imagen"]);
		if($reg["estado"]==1){
			$reporte->setEstado("Activo");
		}else{
			$reporte->setEstado("Inactivo");
		}
		
		
		$result->closeCursor();
		return $reporte;
		
	}
	
	public function cambiarEstadoReporte($idr){
		$resultado=$this->con->prepare("UPDATE reporte_problemas SET estado='0'  WHERE id='$idr'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	
}

?>