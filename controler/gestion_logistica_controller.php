<?php

	include("../modelo/conexion.php");
	include("../modelo/Manejo_Productos.php");
	include("../modelo/Manejo_PedidoDetalle.php");
	include("../modelo/Manejo_ReporteProblema.php");
	include("../modelo/Manejo_Pedido.php");
	include("../modelo/Manejo_Cliente.php");
	include("../modelo/Manejo_Transportista.php");
	include("../modelo/Manejo_Empleado.php");
	include("../modelo/Manejo_EmpresaTransporte.php");
	include("../modelo/Manejo_Tracking.php");
	include("../modelo/Manejo_DatoClienteEnvio.php");

	$con=Conexion::conexione();

	if(isset($_POST["accion"])){
		$op=$_POST["accion"];
		
		switch($op){
			case "insertarTable":
				
				$requestData= $_REQUEST;

					$columns = array( 
					// datatable column index  => database column name
						0 => 'id',
						1 => 'usuario', 
						2 => 'fecha',
					);

					$sql="SELECT p.id, p.id_datos_cliente, p.fecha FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.empaquetado IS NOT NULL AND t.listo IS NULL AND t.cancelado IS NULL";
					$result=$con->query($sql);

					$totalData = $result->rowCount();
					$result->closeCursor();
					$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


					if( !empty($requestData['search']['value']) ) {
						// if there is a search parameter
						$sql="SELECT p.id, p.id_datos_cliente, p.fecha FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.empaquetado IS NOT NULL AND t.listo IS NULL AND t.cancelado IS NULL AND ";
						
						$sql.=" ( p.id_datos_cliente LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
						$sql.=" OR p.fecha LIKE '%".$requestData['search']['value']."%' )";
						$result=$con->query($sql);
						$totalFiltered = $result->rowCount(); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
						$result->closeCursor();

						$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
						$result=$con->query($sql);// again run query with limit

					} else {	

						$sql="SELECT p.id, p.id_datos_cliente, p.fecha FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.empaquetado IS NOT NULL AND t.listo IS NULL AND t.cancelado IS NULL";
						$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
						$result=$con->query($sql);

					}

					$data = array();
					while( $row=$result->fetch(PDO::FETCH_ASSOC) ) {  // preparing an array
						$nestedData=array(); 

						$nestedData[] = $row["id"];
						$nestedData[] = $row["id_datos_cliente"];
						$nestedData[] = $row["fecha"];
						$nestedData[] = '<td><center>
										 <button data-idpedido="'.$row["id"].'" data-idcliente="'.$row["id_datos_cliente"].'" class="btn-detalleP btn btn-sm btn-secondary"> Detalle </button>
										 <button  data-idpedido="'.$row["id"].'" data-idcliente="'.$row["id_datos_cliente"].'" class="btn-asignarT btn btn-sm btn-info"> Asignar Transportista</button>
										 </center></td>';
						
								

						$data[] = $nestedData;

					}



					$json_data = array(
								"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
								"recordsTotal"    => intval( $totalData ),  // total number of records
								"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
								"data"            => $data   // total data array
								);

					$con=null;
					echo json_encode($json_data);  // send data as json format
				
				break;
				
			case "mostrarDetallePedido":
				
				//$mcli= new Manejo_Cliente($con);
				$mdce= new Manejo_DatoClienteEnvio($con);
				$mp =  new Manejo_PedidoDetalle($con);
				$mpro= new Manejo_Productos($con);
				$mpe = new Manejo_Pedido($con);
				
				//$cliente = $mcli->getInfoCliente($_POST["idcliente"]);
				$cliente = $mdce->getDatosEnvioXId($_POST["idcliente"]);
				$detalles=$mp->getPedidoDetalle($_POST["idpedido"]);
				$pesop= $mpe->getPesoPedido($_POST["idpedido"]);
				
				$tableCliente="<table class='table table-striped'><tr><td>Cliente: </td><td>".$cliente->getNombres()." ".$cliente->getApellidos()."</td></tr>
				<tr><td>Dni: </td><td>".$cliente->getDni()."</td></tr></table>";
				$tabledetalles ="<table class='table table-bordered my-3'><tr><th>Codigo Producto</th><th>Nombre</th><th>Cantidad</th></tr>";
				foreach($detalles as $d){
					
					$p=$mpro->getProductosPorId($d->getIdProducto());
					$tabledetalles .= "<tr><td>".$d->getIdProducto()."</td><td>".$p->getNombre()."</td><td>".$d->getCantidad()."</td></tr>";
				}
				$tabledetalles .="<tfoot><tr><td>Peso: </td><td colspan='2'>".$pesop."</td></tr></tfoot></table>";
				
				$con=null;
				echo $tableCliente.$tabledetalles;
				
				break;
				
			case "llenarModalAsignarT":
				
				$idCliente=$_POST["idDatoCli"];
				
				$mdce= new Manejo_DatoClienteEnvio($con);//
				$mtra= new Manejo_Transportista($con);
				$memple= new Manejo_Empleado($con);
				$memt = new Manejo_EmpresaTransporte($con);
				
				$cliente = $mdce->getDatosEnvioXId($idCliente);//
				$direcEnvio = $cliente->getCiudad()." ".$cliente->getDistrito()." ".$cliente->getDomi();
				$trans=$mtra->getTransportistas();
				
				$select="<option value=''>Seleccione un Transportista..</option>";
				foreach($trans as $t){
					$emple=$memple->getInfoEmpleado($t->getIdEmpleado());
					$empT=$memt->getEmpresaTxId($t->getIdEmpresa());
					$select.="<option value='".$t->getId()."'>".$emple->getNombres()." ".$emple->getApellidos()." - ".$empT->getNombreEm()."</option>";
				}
				
				$con=null;
								
				$response=array($direcEnvio,$select);
				
				echo json_encode($response);
				
				break;
				
			case "asignarTranportistaPedido":
				
				$idTrans=$_POST["TransportistaP"];
				$idPed=$_POST["inputIdPedido"];
				
				$mt= new Manejo_Tracking($con);
				
				$result= $con->prepare("INSERT INTO transportista_pedido (id_transportista,id_pedido,estado) VALUES ('$idTrans','$idPed','Asignado')");
				$va=$result->execute();
				$result->closeCursor();
				
				$va2=$mt->marcajeListoToEnviar($idPed);
				
				if($va && $va2){
					$msg=array("#93cf95","¡ El pedido esta listo para Enviar !");
				}else{
					$msg=array("#ff9797","Ocurrio un error inesperado");
				}	
				
				$con=null;
				echo json_encode($msg);
				
				break;
				
			case "consultarPedidosTrans":
				
				if(isset($_POST["idTrans"]) && $_POST["idTrans"]!=""){
					
					$result=$con->prepare("SELECT id_pedido FROM transportista_pedido WHERE id_transportista='".$_POST["idTrans"]."' AND estado='Asignado'");
					$result->execute();
					if($result->rowCount()>0){
						$mpe= new Manejo_Pedido($con);
						$pesoTotal=0;
						while($reg=$result->fetch(PDO::FETCH_ASSOC)){
							$pesoString=$mpe->getPesoPedido($reg["id_pedido"]);
							$peso=explode(" ",$pesoString);
							if($peso[1]=="gr."){
								$pesoTotal += floatval($peso[0])/1000;
							}else{
								$pesoTotal += floatval($peso[0]);
							}
						}
						$info=array("nPedidos"=>$result->rowCount(),"pesoTotal"=>$pesoTotal." Kg.");
						echo json_encode($info);
					}else{
						$info=array("nPedidos"=>"No tiene pedidos asignados","pesoTotal"=>0);
						echo json_encode($info);
					}
					
				}else{
					echo "mal";
				}
				
				break;
		}
	}

?>