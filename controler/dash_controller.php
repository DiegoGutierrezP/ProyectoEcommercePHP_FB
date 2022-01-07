<?php

include("../modelo/Conexion.php");
include_once("../modelo/Manejo_Tracking.php");
include_once("../modelo/Manejo_Productos.php");
include_once("../modelo/Manejo_Pedido.php");

	if(isset($_POST["accion"])){
		$op = $_POST["accion"];
		
		$con= Conexion::conexione();
		$mtra= new Manejo_Tracking($con);
		$mpro =  new Manejo_Productos($con);
		
		switch($op){
			case "cardsDash":
				
				//pedidos entregados;
				$entre=$mtra->getPedidosEntregados();
				$numEntregados = count($entre);
				
				//total pedidos
				$pend=$mtra->getPedidosPendientes();
				$numPendientes = count($pend);
				
				//Total productos
				$totalprod = $mpro->totalProductos();
				
				//total clientes
				$result=$con->prepare("SELECT COUNT(*) as total FROM cliente");
				$result->execute();
				$reg=$result->fetch(PDO::FETCH_ASSOC);
				$result->closeCursor();
				$totalClientes = $reg["total"];

				$cards = array("entregados"=>$numEntregados,"pendientes"=>$numPendientes,"totalprod"=>$totalprod,"totalcli"=>$totalClientes);
				
				$con=null;
				echo json_encode($cards);
				
				break;
				
			case "getPedidosRecientes":
				
				$result=$con->prepare("SELECT id_pedido FROM tracking WHERE empaquetado IS NULL AND (problemas IS NULL OR problemas = 0) order by id desc limit 10");
				$result->execute();
				$mp= new Manejo_Pedido($con);
				
				$tbody="";
				while($reg=$result->fetch(PDO::FETCH_ASSOC)){
					$pedido=$mp->getPedidoConNombreCLiente($reg["id_pedido"]);
					$tbody.="<tr><td>".$pedido["fecha"]."</td><td>".$pedido["nombres"]." ".$pedido["apellidos"]."</td><td>".$pedido["metodopago"]."</td><td>S/. ".$pedido["total"]."</td></tr>";
				}
				
				$result->closeCursor();
				$con=null;
				
				echo  $tbody;
				
				break;
				
			case "getTopProductos":
				
				$result=$con->prepare("SELECT nombre, precio FROM productos AS p1 JOIN (SELECT id FROM productos WHERE cantidad<10 ORDER BY RAND() LIMIT 10) as p2 ON p1.id=p2.id");
				$result->execute();
				
				$tbody="";
				while($reg=$result->fetch(PDO::FETCH_ASSOC)){
					$tbody.="<tr><td>".$reg["nombre"]."</td><td>S/. ".$reg["precio"]."</td></tr>";
				}
				
				$result->closeCursor();
				$con=null;
				
				echo  $tbody;
				
				break;
				
		}
	}

?>
