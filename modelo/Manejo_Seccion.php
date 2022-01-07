<?php

	include_once("conexion.php");
	include_once("Seccion.php");
		
	class Manejo_Seccion{
		
		private $conexion;
		
		public function __construct($con){
			$this->conexion=$con;
		}
		
		public function insertSeccion($nombre,$mostrar){
			$resultado=$this->conexion->prepare("INSERT INTO seccion (nombre_seccion, mostrar) VALUES ('$nombre','$mostrar')");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
			
		}
		
		public function getSecciones(){
			$resultado=$this->conexion->prepare("SELECT * FROM seccion");
			$resultado->execute();
			$secciones=array();
			$contador=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				$seccion= new Seccion();
				$seccion->setId($registro["id"]);
				$seccion->setNombre($registro["nombre_seccion"]);
				$seccion->setMostrar($registro["mostrar"]);
				$secciones[$contador]=$seccion;
				$contador++;
			}
			$resultado->closeCursor();
			return $secciones;
			
		}
		
		public function getSeccionxId($id){
			$resultado=$this->conexion->prepare("SELECT * FROM seccion WHERE id='$id'");
			$valor=$resultado->execute();
			if($valor){
				$registro=$resultado->fetch(PDO::FETCH_ASSOC);
				$secc= new Seccion();
				$secc->setId($registro["id"]);
				$secc->setNombre($registro["nombre_seccion"]);
				$secc->setMostrar($registro["mostrar"]);
				$resultado->closeCursor();
				return $secc;
			}else{
				$resultado->closeCursor();
				return "";
			}
			
		}
		
		public function getSeccionesxNombre($nom){
			$resultado=$this->conexion->prepare("SELECT * FROM seccion WHERE nombre_seccion='$nom'");
			$valor=$resultado->execute();
			if($valor){
				$registro=$resultado->fetch(PDO::FETCH_ASSOC);
				$secc= new Seccion();
				$secc->setId($registro["id"]);
				$secc->setNombre($registro["nombre_seccion"]);
				$secc->setMostrar($registro["mostrar"]);
				$resultado->closeCursor();
				return $secc;
			}else{
				$resultado->closeCursor();
				return "";
			}
			
		}
		
		public function getSeccionesxMostrar($mostrar){
			$resultado=$this->conexion->prepare("SELECT * FROM seccion WHERE mostrar='$mostrar'");
			$resultado->execute();
			$secciones= array();
			$cont=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				$seccion = new Seccion();
				$seccion->setId($registro["id"]);
				$seccion->setNombre($registro["nombre_seccion"]);
				$seccion->setMostrar($registro["mostrar"]);
				$secciones[$cont]=$seccion;
				$cont++;
			}
			$resultado->closeCursor();
			return $secciones;
		}
		
		public function updateSeccion($nombre,$mostrar,$id){
			$resultado=$this->conexion->prepare("UPDATE seccion SET nombre_seccion='$nombre' , mostrar='$mostrar' WHERE id='$id'");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
		}
		
		public function updateMostrar($id,$mostrar){
			$resultado=$this->conexion->prepare("UPDATE seccion SET mostrar='$mostrar' WHERE id='$id'");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
		}
		public function updateNombreSeccion($id,$nombre){
			$resultado=$this->conexion->prepare("UPDATE seccion SET nombre_seccion='$nombre' WHERE id='$id'");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
		}
		
	}
	
?>