<?php
	include("Pedido.php");

	class Manejo_Pedido{
		private $con;
		
		public function __construct($c){
			$this->con=$c;
		}
		
		public function getPedidoporCli($cliente){
			//$resultado=$this->con->prepare("SELECT * FROM pedido WHERE id_usuario=:idusu");
			$resultado=$this->con->prepare("SELECT p.id,p.id_datos_cliente,p.fecha,p.total,p.metodopago,p.metodoenvio,p.precioenvio,p.estado_actual,p.peso FROM pedido AS p INNER JOIN dato_cliente_envio AS dce ON p.id_datos_cliente=dce.id INNER JOIN cliente AS c ON c.id=dce.id_cliente WHERE c.id=:id");
			$resultado->bindValue(":id",$cliente);
			$resultado->execute();
			
			$listapedidos= array();
			$cont=0;
			
			while($reg=$resultado->fetch(PDO::FETCH_ASSOC)){
				$p= new Pedido();
				$p->setId($reg["id"]);
				$p->setIdDatosCli($reg["id_datos_cliente"]);
				$p->setFecha($reg["fecha"]);
				$p->setTotal($reg["total"]);
				$p->setPago($reg["metodopago"]);
				$p->setEnvio($reg["metodoenvio"]);
				$p->setPrecioEnvio($reg["precioenvio"]);
				$p->setEstadoActual($reg["estado_actual"]);
				$p->setPeso($reg["peso"]);
				
				$listapedidos[$cont]=$p;
				$cont++;
			}
			return $listapedidos;
		}
		
		public function getPedidosXId($idpedido){
			$resultado=$this->con->prepare("SELECT * FROM pedido WHERE id=:idpedido");
			$resultado->bindValue(":idpedido",$idpedido);
			$resultado->execute();
			$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			$p= new Pedido();
				$p->setId($reg["id"]);
				$p->setIdDatosCli($reg["id_datos_cliente"]);
				$p->setFecha($reg["fecha"]);
				$p->setTotal($reg["total"]);
				$p->setPago($reg["metodopago"]);
				$p->setEnvio($reg["metodoenvio"]);
				$p->setPrecioEnvio($reg["precioenvio"]);
				$p->setEstadoActual($reg["estado_actual"]);
				$p->setPeso($reg["peso"]);
			
			$resultado->closeCursor();
			return $p;
		}
		
		public function establecerPesoPedido($peso,$idpedido){
			$resultado=$this->con->prepare("UPDATE pedido SET peso='$peso' WHERE id='$idpedido'");
			$va=$resultado->execute();
			$resultado->closeCursor();
			return $va;
		}
		
		
		public function getPesoPedido($idpedido){
			$resultado=$this->con->prepare("SELECT peso FROM pedido WHERE id='$idpedido'");
			$resultado->execute();
			$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			$resultado->closeCursor();
			return $reg["peso"];
		}
		
		public function getPedidoConNombreCLiente($id){
			$resultado=$this->con->prepare("SELECT p.id, p.fecha, p.total, p.metodopago, p.metodoenvio, p.precioenvio, dce.nombres, dce.apellidos FROM pedido AS p INNER JOIN dato_cliente_envio AS dce ON p.id_datos_cliente = dce.id WHERE p.id='$id'");
			$resultado->execute();
			$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			
			$ped=array(	"id"=>$reg["id"],
					   	"fecha"=>$reg["fecha"],
					  	"total"=>$reg["total"],
					  	"metodopago"=>$reg["metodopago"],
					  	"metodoenvio"=>$reg["metodoenvio"],
					    "precioenvio"=>$reg["precioenvio"],
					    "nombres"=>$reg["nombres"],
					    "apellidos"=>$reg["apellidos"]);
			
			$resultado->closeCursor();
			return $ped;
		}


	}
?>