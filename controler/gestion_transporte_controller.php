<?php
	include("../modelo/conexion.php");
	include("../modelo/Manejo_Transportista.php");
	include("../modelo/Manejo_Empleado.php");
	include("../modelo/Manejo_Pedido.php");
	include("../modelo/Manejo_DatoClienteEnvio.php");
	include("../modelo/Manejo_Tracking.php");	

	$con=Conexion::conexione();
	
	if(isset($_POST["accion"])){
		$op=$_POST["accion"];
		
		switch($op){
			case "cargarSelectTrans":
				
				$mtra= new Manejo_Transportista($con);
				$me = new Manejo_Empleado($con);
				
				$result=$con->prepare("SELECT DISTINCT id_transportista FROM transportista_pedido WHERE estado='Asignado'");
				$result->execute();
				
				$transConPedido = array();
				
				while($reg=$result->fetch(PDO::FETCH_ASSOC)){
					$transportista = $mtra->getTransportistaxId($reg["id_transportista"]);
					$empleado=$me->getInfoEmpleado($transportista->getIdEmpleado());
					
					$emple = array("idtrans"=>$transportista->getId(),"nombres"=>$empleado->getNombres()." ".$empleado->getApellidos());
					
					
					$transConPedido[]=$emple;
				}
				$result->closeCursor();
				$con=null;
				echo json_encode($transConPedido);
			
				break;
				
			case "cargarPedidosTransportista":
				
				$idT=$_POST["idTrans"];
				$mp = new Manejo_Pedido($con);
				
				$result=$con->prepare("SELECT id_pedido FROM transportista_pedido WHERE id_transportista='$idT' AND estado='Asignado'");
				$result->execute();
				$idpedidos=array();
				while($reg=$result->fetch(PDO::FETCH_ASSOC)){
					$idpedidos[]=$reg["id_pedido"];
				}
				$result->closeCursor();
				//$pedidos = array();
				$tbody="";
				foreach($idpedidos as $idp){
					$pedido=$mp->getPedidosXId($idp);
					
					$tbody.="<tr><td>".$pedido->getId()."</td><td>".$pedido->getIdDatosCli()."</td><td>".$pedido->getPeso()."</td><td><input  class='check-salida' type='checkbox' data-pedido='".$pedido->getId()."' class='form-check-input'></td><td><button class='btn-verDatos btn btn-sm btn-secondary' data-idDatos='".$pedido->getIdDatosCli()."'>Datos de Envio</button></td></tr>";
				}
				
				$result2=$con->prepare("SELECT count(*) as total FROM transportista_pedido WHERE id_transportista='$idT' AND estado='Salida'");
				$result2->execute();
				
				$reg=$result2->fetch(PDO::FETCH_ASSOC);
				$result2->closeCursor();
				$attr="";
				if($reg["total"]>0){
					$attr="disabled";
				}
				
				$con=null;
				
				$response=array($tbody,$attr);
				
				echo json_encode($response);
				
				break;
				
			case "cargarDatosEnvio":
				
				$idDatos = $_POST["idDatos"];
				
				$mdce = new Manejo_DatoClienteEnvio($con);
				$de=$mdce->getDatosEnvioXId($idDatos);
				
				$html = "<table class='table table-striped'><tr><th>Nombres:</th><td>".$de->getNombres()."</td></tr>".
						"<tr><th>Apellidos:</th><td>".$de->getApellidos()."</td></tr>".
						"<tr><th>Dni:</th><td>".$de->getDni()."</td></tr>".
						"<tr><th>Ciudad:</th><td>".$de->getCiudad()."</td></tr>".
						"<tr><th>Distrito:</th><td>".$de->getDistrito()."</td></tr>".
						"<tr><th>Dirección:</th><td>".$de->getDomi()."</td></tr></table>";
				
				$con=null;
				echo $html;
				
				break;
				
			case "marcarSalida":
				
				$ids=json_decode($_POST["idspedidos"]);
				$mt= new Manejo_Tracking($con);
				
				for($i=0;$i<count($ids);$i++){
					$res=$con->prepare("UPDATE transportista_pedido SET estado='Salida' WHERE id_pedido='".$ids[$i]."'");
					$res->execute();
					$res->closeCursor();
					
					$mt->marcajeSalida($ids[$i]);
				}
				$con=null;
				echo "Los pedidos cambiaron a estado enviado dirigirse a la interfaz de envios";
				
				
				break;
				
			case "cargarSelectTransConEnvios":
				
				$mtra= new Manejo_Transportista($con);
				$me = new Manejo_Empleado($con);
				
				$result=$con->prepare("SELECT DISTINCT id_transportista FROM transportista_pedido WHERE estado='Salida'");
				$result->execute();
				
				$transConPedido = array();
				
				while($reg=$result->fetch(PDO::FETCH_ASSOC)){
					$transportista = $mtra->getTransportistaxId($reg["id_transportista"]);
					$empleado=$me->getInfoEmpleado($transportista->getIdEmpleado());
					
					$emple = array("idtrans"=>$transportista->getId(),"nombres"=>$empleado->getNombres()." ".$empleado->getApellidos());
					
					
					$transConPedido[]=$emple;
				}
				$result->closeCursor();
				$con=null;
				echo json_encode($transConPedido);
			
				break;
				
				break;
				
			case "cargarPedidosEnEnvio":
				
				$idT=$_POST["idTrans"];
				$mp = new Manejo_Pedido($con);
				
				$result=$con->prepare("SELECT id_pedido FROM transportista_pedido WHERE id_transportista='$idT' AND estado='Salida'");
				$result->execute();
				$idpedidos=array();
				while($reg=$result->fetch(PDO::FETCH_ASSOC)){
					$idpedidos[]=$reg["id_pedido"];
				}
				$result->closeCursor();
				
				$tbody="";
				foreach($idpedidos as $idp){
					$pedido=$mp->getPedidosXId($idp);
					
					$tbody.="<tr><td>".$pedido->getId()."</td><td>".$pedido->getIdDatosCli()."</td><td>".$pedido->getPeso()."</td><td><button class='btn-verDatos btn btn-sm btn-secondary mx-1' data-idDatos='".$pedido->getIdDatosCli()."'>Datos de Envio</button><button class='btn-Entregado btn btn-sm btn-success mx-1' data-toggle='modal' data-target='#modalPedidoEntregado' data-Trans='".$idT."' data-idPedido='".$pedido->getId()."'>Entregado</button><button class='btn btn-sm btn-danger mx-1'>Generar Reporte</button></td></tr>";
				}
				
				$con=null;
				echo $tbody;
				
				break;
				
			case "registrarConstanciaEntrega":
				
				$idPedido = $_POST["codPedido"];
				$descripConstancia = $_POST["descripConstancia"];
				
				$result=$con->prepare("INSERT INTO constancia_entrega (id_pedido,constancia) VALUES ($idPedido,:descrip)");
				$result->bindValue(":descrip",$descripConstancia);
				$va=$result->execute();
				$result->closeCursor();
				$mt= new Manejo_Tracking($con);
				
				if($va){
					$result2=$con->prepare("UPDATE transportista_pedido SET estado='Entregado' WHERE id_pedido='".$idPedido."'");
					$va2=$result2->execute();
					if($va2){
						$mt->marcajeLlegada($idPedido);
						$mt->marcajeEntregado($idPedido);
						$msg=array("success","El pedido se marco como Entregado.");
					}else{
						$msg=array("error","Error al actualizar transportista_pedido");
					}	
				}else{
					$msg=array("error","Error al insertar constancia_entrega");
				}
				
				echo json_encode($msg);
				
				
				break;
		}
		
	}

?>
