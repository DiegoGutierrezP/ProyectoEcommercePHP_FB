<?php

	session_start();
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Productos.php");
	include_once("../modelo/Manejo_Cliente.php");
	include_once("../modelo/Manejo_DatoClienteEnvio.php");
	$base=Conexion::conexione();
	$p= new Manejo_Productos($base);
	//if(isset($_POST["finalizar_pedido"])){
		if(isset($_COOKIE["carrito_cookie"])){

			$valorSelect = $_POST["selectDatosEnvio"];
			
			$idDatos="";
			
			$envio=$_POST["metodo_envio"];
			$pago=$_POST["medio_pago"];
			$total=$_POST["total_pedido"];
			$precioEnvio=0;
			if($envio=="transporte"){
				$precioEnvio=25;
			}else{
				$precioEnvio=0;
			}
 
			$cont=0;
			$errors=array();
			
			//Ainsetamos y establecemos DATOS DEL CLIENTE
			try{

				if($valorSelect=="newDatos"){
					$idCliente=$_POST["idCliente"];
					$nombres=$_POST["nombres"];
					$apes = $_POST["apellidos"];
					$dni = $_POST["dni"];
					$ciu = $_POST["ciudad"];
					$distri = $_POST["distrito"];
					$domi = $_POST["domi"];

					$mdce = new Manejo_DatoClienteEnvio($base);
					$flag=$mdce->insertarDatosEnvio($idCliente,$nombres,$apes,$dni,$ciu,$distri,$domi);//creamos un nuevo datos para el cliente

					$result1=$base->prepare("SELECT id from dato_cliente_envio order by id desc limit 1");
					$result1->execute();
					$reg=$result1->fetch(PDO::FETCH_ASSOC);
					$idDatos=$reg["id"];
				
				}else{
					$idDatos=$valorSelect;
				}
				
			}catch(Exception $e){
				$errors[$cont]="Error en actualizar datos del cliente2 ".$e->getMessage();
				$cont++;
			}
			
			//Actualizamos el stock de los productos comprados
			try{
				
				$carrito=json_decode($_COOKIE["carrito_cookie"],true);
				
				for($i=0;$i<count($carrito);$i++){
					$prod=$p->getProductosPorId($carrito[$i]["id"]);
					$nuevo_stock=$prod->getCantidad() - $carrito[$i]["cantidad"];
					if($nuevo_stock<=1){
						$stock=$base->prepare("UPDATE productos SET cantidad='".$nuevo_stock."', estado='0' WHERE id='".$carrito[$i]["id"]."'");
					}else{
						$stock=$base->prepare("UPDATE productos SET cantidad='".$nuevo_stock."' WHERE id='".$carrito[$i]["id"]."'");
					}
					
					$stock->execute();
					$stock->closeCursor();
				}
				
			}catch(Exception $e){
				//echo "Error en la actualizacion del stock ".$e->getMessage();
				$errors[$cont]="Error en la actualizacion del stock ".$e->getMessage();
				$cont++;
			}
			
			//CREAMOS EL PEDIDO
			try{
				$resultado2=$base->prepare("INSERT INTO pedido (id_datos_cliente,fecha,total,metodopago,metodoenvio,precioenvio,estado_actual) VALUES (:dcli,:fecha,:total,:pago,:envio,:peenv,'Pago Procesado')");//creamos el pedido
				$resultado2->bindValue(":dcli",$idDatos);
				$resultado2->bindValue(":fecha",date("Y-m-d H:i:s"));
				$resultado2->bindValue(":total",$total);
				$resultado2->bindValue(":pago",$pago);
				$resultado2->bindValue(":envio",$envio);
				$resultado2->bindValue(":peenv",$precioEnvio);
				//$resultado2->bindValue(":estado","Pago Procesado");
				$resultado2->execute();
				$resultado2->closeCursor();
				
			}catch(Exception $e){
				//echo "Error en crear el pedido ".$e->getMessage();
				$errors[$cont]="Error en crear el pedido ".$e->getMessage();
				$cont++;
			}
			try{
				$resultado3=$base->prepare("SELECT id from pedido order by id desc limit 1");//dame el ultimo registro q ingrese /23
				$resultado3->execute();
				$registro=$resultado3->fetch(PDO::FETCH_ASSOC);
				$resultado3->closeCursor();
				//CREAMOS TRACKING
				//$tracking=$base->prepare("INSERT INTO tracking (id_pedido,pago_recibido,problemas,empaquetado,listo,salida,encamino,llegada,entregado,cancelado) values (:idpedido,'1','0','0','0','0','0','0','0','0')");
				//$date= new DateTime(date("Y-m-d"));
				$tracking=$base->prepare("INSERT INTO tracking (id_pedido,pago_recibido) values (:idpedido,'".date("Y-m-d")."')");
				
				$tracking->bindValue(":idpedido",$registro["id"]);
				$tracking->execute();
				$tracking->closeCursor();	
				//CREAMOS EL DETALLE PEDIDO
				$items=json_decode($_COOKIE["carrito_cookie"],true);
				for($i=0;$i<count($items);$i++){
					$idproduc=$items[$i]["id"];
					$idcant=$items[$i]["cantidad"];
					$resultado4=$base->prepare("SELECT id, nombre, precio FROM productos WHERE id='".$idproduc."'");
					$resultado4->execute();
					$producto=$resultado4->fetch(PDO::FETCH_ASSOC);
					$precio=($producto["precio"])*$idcant;
					$resultado5=$base->prepare("INSERT INTO pedido_detalle (id_pedido,id_producto,precio_producto,cantidad,precio_total) VALUES ('".$registro["id"]."','".$producto["id"]."','".$producto["precio"]."','".$items[$i]["cantidad"]."','".$precio."')");
					$resultado5->execute();
				}

			}catch(Exception $e){
				//echo "Error en crear pedido detalle".$e->getMessage();
				$errors[$cont]="Error en crear pedido Y TRACKING detalle".$e->getMessage();
				$cont++;
			}
			
			$cookie_options= array (
                'expires' => time()-60,
                'path' => '/',
                'secure' => true,     // or false
                'httponly' => true,    // or false
                'samesite' => 'None' // None || Lax  || Strict
                );
			
			//setcookie("carrito_cookie","",time()-60,"/");//eliminamos la cookie
			setcookie("carrito_cookie","",$cookie_options);
			//header("Location:../vistas/mispedidos_cliente.php");
		
			$base=null;
			if($cont==0){
				$exito=array("success","Su pedido se ha generado con Éxito");
				echo json_encode($exito);
			}else{
				echo json_encode($errors);
			}
			
		}else{
			
			$error=array("error","Lo Sentimos! Ocurrio un error inesperado.");
			echo json_encode($error);
			
		}
		
	//}
	
?>