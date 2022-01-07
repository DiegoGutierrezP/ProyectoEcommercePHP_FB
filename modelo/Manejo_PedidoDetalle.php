<?php
	include("PedidoDetalle.php");

	class Manejo_PedidoDetalle{
		private $con;
		
		public function __construct($c){
			$this->con=$c;
		}
		
		public function getPedidoDetalle($idpedido){
			$result=$this->con->prepare("SELECT * FROM pedido_detalle WHERE id_pedido='$idpedido'");
			$result->execute();
			
			$detalles= array();
			$cont=0;
			
			while($reg=$result->fetch(PDO::FETCH_ASSOC)){
				$pd= new PedidoDetalle();
				$pd->setId($reg["id"]);
				$pd->setIdPedido($reg["id_pedido"]);
				$pd->setIdProducto($reg["id_producto"]);
				$pd->setPrecioProducto($reg["precio_producto"]);
				$pd->setCantidad($reg["cantidad"]);
				$pd->setPrecioTotal($reg["precio_total"]);
				
				$detalles[$cont]=$pd;
				$cont++;
			}
			$result->closeCursor();
			return $detalles;
		}
		
	}

?>