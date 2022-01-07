<?php

include_once("Tracking.php");

class Manejo_Tracking{
	
	private $conexion;
	
	public function __construct($con){
		$this->conexion=$con;
	}
	
	//get Pedidos para Almacen
	public function getIdPedidosToAlmacen(){
		$result=$this->conexion->query("SELECT id_pedido FROM tracking WHERE empaquetado IS NULL");
		
		$idsPedidos = array();
		$cont=0;
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			$idsPedidos[$cont]=$reg["id_pedido"];
			$cont++;
		}
		$result->closeCursor();
		return $idsPedidos;
		
	}
	
	public function marcajeConProblemas($id){
		$resultado=$this->conexion->prepare("UPDATE tracking SET problemas='1'  WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	
	public function marcajeSinProblemas($id){
		$resultado=$this->conexion->prepare("UPDATE tracking SET problemas='0'  WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	
	public function marcajeEmpaquetado($id){
		$resultado=$this->conexion->prepare("UPDATE tracking SET empaquetado='".date("Y-m-d")."'  WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	public function marcajeListoToEnviar($id){
		$resultado=$this->conexion->prepare("UPDATE tracking SET listo='".date("Y-m-d")."'  WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	public function marcajeCancelado($id){
		$resultado=$this->conexion->prepare("UPDATE tracking SET cancelado='1'  WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	public function marcajeSalida($id){
		$fecha=date("Y-m-d");
		$resultado=$this->conexion->prepare("UPDATE tracking SET salida='$fecha',encamino='$fecha'  WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	public function marcajeLlegada($id){
		$fecha=date("Y-m-d");
		$resultado=$this->conexion->prepare("UPDATE tracking SET llegada='$fecha' WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	public function marcajeEntregado($id){
		$fecha=date("Y-m-d");
		$resultado=$this->conexion->prepare("UPDATE tracking SET entregado='$fecha' WHERE id_pedido='$id'");
		$va=$resultado->execute();
		$resultado->closeCursor();
		return $va;
	}
	
	public function getPedidosEntregados(){
		$result=$this->conexion->prepare("SELECT id_pedido FROM tracking WHERE entregado IS NOT NULL");
		$result->execute();
		$idsPedidos = array();
		$cont=0;
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			$idsPedidos[$cont]=$reg["id_pedido"];
			$cont++;
		}
		$result->closeCursor();
		return $idsPedidos;
	}
	
	public function getPedidosPendientes(){
		$result=$this->conexion->prepare("SELECT id_pedido FROM tracking WHERE entregado IS NULL AND cancelado IS NULL");
		$result->execute();
		$idsPedidos = array();
		$cont=0;
		while($reg=$result->fetch(PDO::FETCH_ASSOC)){
			$idsPedidos[$cont]=$reg["id_pedido"];
			$cont++;
		}
		$result->closeCursor();
		return $idsPedidos;
	}
	
}

?>