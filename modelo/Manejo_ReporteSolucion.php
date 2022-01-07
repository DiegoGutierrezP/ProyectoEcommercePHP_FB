<?php

include_once("ReporteSolucion.php");

class Manejo_ReporteSolucion{
	
	private $con;
	
	public function __construct($c){
		$this->con=$c;
	}
	
	public function crearSolucion($idr,$fecha,$report,$img,$solu){
		if($img==""){
			$sql="INSERT INTO solucion_reporte (id_reporte,fecha_solucion,reporte_solucion,solucion) VALUES ('$idr','$fecha','$report','$solu')";
		}else{
			$sql="INSERT INTO solucion_reporte (id_reporte,fecha_solucion,reporte_solucion,imagen,solucion) VALUES ('$idr','$fecha','$report','$img','$solu')";
		}
		
		$result=$this->con->prepare($sql);
		$valor=$result->execute();
		$result->closeCursor();
		return $valor;
	}
	
}

?>