<?php
	require_once("../modelo/conexion.php");
	include("../modelo/Manejo_DatoClienteEnvio.php");

	$con=Conexion::conexione();
	if(isset($_POST["id"])){
		
		$res=$con->prepare("SELECT id_datos_cliente FROM pedido WHERE id='".$_POST["id"]."'");
		$res->execute();
		$reg=$res->fetch(PDO::FETCH_ASSOC);
		
		$mdce= new Manejo_DatoClienteEnvio($con);
		$datosCliente=$mdce->getDatosEnvioXId($reg["id_datos_cliente"]);//obtenemos los datos del cliente 
		
		$datosEnvio="<div style='padding:10px;'><div style='text-align:left;'><h3>Direccion y Datos de Envio</h3><hr><label>Datos Personales:</label><br>".$datosCliente->getNombres()." ".$datosCliente->getApellidos()."<br>".$datosCliente->getDni()."<br>".
		"<label>Dirección:</label><br>".$datosCliente->getCiudad()."<br>".$datosCliente->getDistrito()." ".$datosCliente->getDomi()."</div>";
		
		$res->closeCursor();
		
		$result=$con->prepare("SELECT id_producto,precio_producto,cantidad,precio_total FROM pedido_detalle WHERE id_pedido=:idped");

		$result->bindValue(":idped",$_POST["id"]);
		$result->execute();
		
		$detalle_pedido=array();
		$cont=0;
		
		$tableDetalle="<div style='margin-top:20px;'><h3 style='text-align:left;'>Productos Ordenados</h3><hr><table border='1' style='margin:5px;'><tr><td>Cod</td><td>Nombre</td><td>Precio Unidad</td><td>Cantidad</td><td>Precio Total</td></tr>";
		
		while($registro=$result->fetch(PDO::FETCH_ASSOC)){
			
			$result2=$con->query("SELECT nombre FROM productos WHERE id='".$registro["id_producto"]."'");
			
			$nombreProducto="";
			
			if($result2->rowCount() > 0 ){
				$regProduc=$result2->fetch(PDO::FETCH_ASSOC);
				$nombreProducto=$regProduc["nombre"];
			}else{
				$nombreProducto="El producto ya no existe o ha sido eliminado completamente";
			}
			
			$result2->closeCursor();
			
			$tableDetalle.="<tr><td>".$registro["id_producto"]."</td><td>".$nombreProducto."</td><td>".$registro["precio_producto"]."</td><td>".$registro["cantidad"]."</td><td>".$registro["precio_total"]."</td></tr>";
			
						
		}
		
		$tableDetalle.="</table></div></div>";
		$detalleTotal=$datosEnvio.$tableDetalle;
		
		$result->closeCursor();
		$con=null;
		echo $detalleTotal;

	}
	
	if(isset($_POST["id_estado"])){
		$res=$con->prepare("SELECT * FROM tracking WHERE id_pedido=:idpedi");
		$res->bindValue(":idpedi",$_POST["id_estado"]);
		$res->execute();
		$r_estado=$res->fetch(PDO::FETCH_ASSOC);
		$res->closeCursor();
		$con=null;
		echo json_encode($r_estado);
	}

?>