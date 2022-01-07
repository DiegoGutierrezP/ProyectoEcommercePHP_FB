<?php
	
	include_once("Subseccion.php");
	include_once("Manejo_Productos.php");
	
	class Manejo_Subseccion{
		private $conexion;
		
		public function __construct($con){
			$this->conexion=$con;
		}
		
		public function insertSubseccion($nombre,$idseccion){
			$resultado=$this->conexion->prepare("INSERT INTO subseccion (id_seccion,nombre_subseccion) VALUES ('$idseccion','$nombre')");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
		}
		
		public function getSubseccionxSeccion($id_seccion){
			$resultado=$this->conexion->prepare("SELECT * FROM subseccion WHERE id_seccion='$id_seccion' AND eliminado IS NULL");
			$resultado->execute();
			$subsecciones=array();
			$cont=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				$sub= new Subseccion();
				$sub->setId($registro["id"]);
				$sub->setSeccion($registro["id_seccion"]);
				$sub->setNombre($registro["nombre_subseccion"]);
				$subsecciones[$cont]=$sub;
				$cont++;
			}
			$resultado->closeCursor();
			return $subsecciones;
		}
		
		public function updateSubseccion($id,$nom){
			$resultado=$this->conexion->prepare("UPDATE subseccion SET nombre_subseccion='$nom' WHERE id='$id'");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
		}
		
		public function eliminarSubseccion($id){
			$resultado=$this->conexion->prepare("UPDATE subseccion SET eliminado='".date("Y-m-d H:i:s")."' WHERE id='$id'");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			
			$res2=$this->conexion->prepare("SELECT id FROM productos WHERE id_subseccion='".$id."'");
			$res2->execute();
			$mp= new Manejo_Productos($this->conexion);
			while($reg=$res2->fetch(PDO::FETCH_ASSOC)){
				$mp->deleteProducto($reg["id"]);
			}
			$res2->closeCursor();
			return $valor;
		}
		
	}

?>