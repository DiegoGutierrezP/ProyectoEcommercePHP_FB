<?php

	include ("../modelo/conexion.php");
	include("../modelo/Manejo_Tracking.php");
	include("../modelo/Manejo_PedidoDetalle.php");
	include("../modelo/Manejo_Productos.php");
	include("../modelo/Manejo_ReporteProblema.php");
	include("../modelo/Manejo_Pedido.php");
	include("../modelo/Manejo_Cliente.php");
	include("../modelo/Manejo_DatoClienteEnvio.php");

	$con=Conexion::conexione();


	if($_POST["accion"]){
		
		$op = $_POST["accion"];
		
		switch($op){
			case "insertarTable":
					$tablapara = $_POST["para"];
				
					// storing  request (ie, get/post) global array to a variable  
					$requestData= $_REQUEST;


					$columns = array( 
					// datatable column index  => database column name
						0 => 'id',
						1 => 'idDatoCliente',
						2 => 'fecha',
						3 => 'total',
						4 => 'mPago'  
					);


					//$sql = "SELECT id, id_usuario, direccion_envio, fecha,total, metodopago ";
					//$sql.=" FROM pedido";
					if($tablapara=="empaquetar"){
						$sql="SELECT p.id,p.id_datos_cliente, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.empaquetado IS NULL AND t.problemas IS NULL";
					}else if($tablapara=="reporte"){
						//$sql="SELECT p.id, p.id_usuario, p.direccion_envio, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.problemas = '1'";
						//$sql="SELECT p.id, p.id_usuario, p.direccion_envio, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN reporte_problemas AS rp ON p.id = rp.id_pedido WHERE rp.estado='1'";
						$sql="SELECT p.id,p.id_datos_cliente, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido INNER JOIN reporte_problemas AS rp ON p.id=rp.id_pedido WHERE t.problemas = '1' AND rp.area='Almacén'";
					}
					
					$result=$con->query($sql);

					$totalData = $result->rowCount();
					$result->closeCursor();
					$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


					if( !empty($requestData['search']['value']) ) {
						// if there is a search parameter
						//$sql = "SELECT id, id_usuario, direccion_envio, fecha,total, metodopago  ";
						//$sql.=" FROM pedido";
						if($tablapara=="empaquetar"){
							$sql="SELECT p.id,p.id_datos_cliente, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.empaquetado IS NULL AND t.problemas IS NULL AND";
						}else if($tablapara=="reporte"){
							//$sql="SELECT p.id, p.id_usuario, p.direccion_envio, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.problemas = '1' AND";
							//$sql="SELECT p.id, p.id_usuario, p.direccion_envio, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN reporte_problemas AS rp ON p.id = rp.id_pedido WHERE rp.estado='1' AND";
							$sql="SELECT p.id,p.id_datos_cliente, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido INNER JOIN reporte_problemas AS rp ON p.id=rp.id_pedido WHERE t.problemas = '1' AND rp.area='Almacén' AND ";
						}
						
						$sql.=" ( p.id LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
						$sql.=" OR p.id_datos_cliente LIKE '%".$requestData['search']['value']."%' ";
						$sql.=" OR p.fecha LIKE '%".$requestData['search']['value']."%' ";
						$sql.=" OR p.total LIKE '%".$requestData['search']['value']."%' ";
						$sql.=" OR p.metodopago LIKE '%".$requestData['search']['value']."%' )";
						$result=$con->query($sql);
						$totalFiltered = $result->rowCount(); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
						$result->closeCursor();

						$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
						$result=$con->query($sql);// again run query with limit

					} else {	

						//$sql = "SELECT id, id_usuario, direccion_envio, fecha,total, metodopago ";
						//$sql.=" FROM pedido";
						if($tablapara == "empaquetar"){
							$sql="SELECT p.id,p.id_datos_cliente, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.empaquetado IS NULL AND t.problemas IS NULL";
						}else if($tablapara=="reporte"){
							//$sql="SELECT p.id, p.id_usuario, p.direccion_envio, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido WHERE t.problemas = '1'";
							//$sql="SELECT p.id, p.id_usuario, p.direccion_envio, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN reporte_problemas AS rp ON p.id = rp.id_pedido WHERE rp.estado='1'";
							$sql="SELECT p.id,p.id_datos_cliente, p.fecha, p.total, p.metodopago FROM pedido AS p INNER JOIN tracking AS t ON p.id = t.id_pedido INNER JOIN reporte_problemas AS rp ON p.id=rp.id_pedido WHERE t.problemas = '1' AND rp.area='Almacén'";
						}
						
						$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
						$result=$con->query($sql);

					}

					$data = array();
					while( $row=$result->fetch(PDO::FETCH_ASSOC) ) {  // preparing an array
						$nestedData=array(); 

						$nestedData[] = $row["id"];
						$nestedData[] = $row["id_datos_cliente"];
						$nestedData[] = $row["fecha"];
						$nestedData[] = $row["total"];
						$nestedData[] = $row["metodopago"];
						if($tablapara=="empaquetar"){
							$nestedData[] = '<td><center>
										 <button data-idpedido="'.$row["id"].'" data-idcliente="'.$row["id_datos_cliente"].'" class="btn-detalle-pedido btn btn-sm btn-secondary"> Detalle </button>
										 <button  data-idpedido="'.$row["id"].'" class="btn-empaquetado btn btn-sm btn-info"> Empaquetado </button>
										 <button  data-idpedido="'.$row["id"].'" class="btn-reporte-problema btn btn-sm btn-danger"> Generar Reporte</button>
										 </center></td>';
						}else if($tablapara=="reporte"){
							$nestedData[] = '<td><center>
										 <button data-idpedido="'.$row["id"].'" data-idcliente="'.$row["id_datos_cliente"].'" class="btn-detalle-pedido btn btn-sm btn-secondary"> Detalle </button>
										 <a href="gestion_reporte_problemas.php?idpedido='.$row["id"].'"><button  data-idpedido="'.$row["id"].'" class="btn-gestionar-reporte btn btn-sm btn-info"> Gestionar Reporte </button></a>
										 </center></td>';
						}
								

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
				
			case "marcarEmpaquetado":
				
					$idpedido= $_POST["idPedidoPeso"];
					$peso = $_POST["pesoPedido"];
					$unidad = $_POST["selectUnidad"];
					$check=$_POST["checkEmpaquetado"];
					$pesop = $peso." ".$unidad;
					
					if($check){
						$mpe =  new Manejo_Pedido($con);
						$mt = new Manejo_Tracking($con);
						
						$va1=$mpe->establecerPesoPedido($pesop,$idpedido);
						
						if($va1){
							$va=$mt->marcajeEmpaquetado($idpedido);
							if($va){
								$msg= array("El producto se ha cambio de estado a Empaquetado","#93cf95");
							}else{
								$msg= array("Ocurrio un error 2","#ff9797");
							}
						}else{
							$msg= array("Ocurrio un error 1","#ff9797");
						}
					}else{
						$msg= array("Ocurrio un error 0 ","#ff9797");
					}

					$con=null;
					echo json_encode($msg);		
	
				break;
				
			case "mostrarItemsPedido":
				
				//$mcli= new Manejo_Cliente($con);
				$mdce = new Manejo_DatoClienteEnvio($con);
				$mp =  new Manejo_PedidoDetalle($con);
				$mpro= new Manejo_Productos($con);
				$cliente = $mdce->getDatosEnvioXId($_POST["idcliente"]);
				//$cliente = $mcli->getInfoCliente($_POST["idcliente"]);
				
				$detalles=$mp->getPedidoDetalle($_POST["idpedido"]);
				
				$tableCliente="<table class='table table-striped'><tr><td>Cliente: </td><td>".$cliente->getNombres()." ".$cliente->getApellidos()."</td></tr>
				<tr><td>Dni: </td><td>".$cliente->getDni()."</td></tr><tr><td colspan='2'>Direccion Envío </td></tr><tr><td colspan='2'>".$cliente->getCiudad()." ".$cliente->getDistrito()." ".$cliente->getDomi()."</td></tr></table>";
				$tabledetalles ="<table class='table table-bordered my-3'><tr><th>Codigo Producto</th><th>Nombre</th><th>Cantidad</th></tr>";
				foreach($detalles as $d){
					
					$p=$mpro->getProductosPorId($d->getIdProducto());
					$tabledetalles .= "<tr><td>".$d->getIdProducto()."</td><td>".$p->getNombre()."</td><td>".$d->getCantidad()."</td></tr>";
				}
				$tabledetalles .="</table>";
				
				$con=null;
				echo $tableCliente.$tabledetalles;
				
				break;
				
			case "generarReporte"://se genera el reporte por parte de  Almacen
				
				$idp= $_POST["idPedido"];
				$motivo=$_POST["motivoReporte"];
				$obs=$_POST["observacionReporte"];
				$img=$_FILES["imgObservacionReporte"]["name"];$tipo_img=$_FILES["imgObservacionReporte"]["type"];
				
				$mrp= new Manejo_ReporteProblema($con);
				$mt= new Manejo_Tracking($con);
				
				if($img!=""){
					if($_FILES['imgObservacionReporte']['size']<3000000){
						if($tipo_img=="image/jpeg" || $tipo_img=="image/jpg" || $tipo_img=="image/png" || $tipo_img=="image/gif"){

							$carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Fabercastel/imgs/reportes/problemas/';
							move_uploaded_file($_FILES['imgObservacionReporte']['tmp_name'],$carpeta_destino.$img);
							
							$va1=$mt->marcajeConProblemas($idp);
							if($va1){
								$va2=$mrp->crearReporte($idp,"Almacén",date("Y-m-d"),$motivo,$obs,$img);
							
								if($va2){
									$msg=array("success","El reporte se genero correctamente.");
								}else{
									$msg=array("error","No se pudo generar el reporte");
								}
							}else{
								$msg=array("error","No se pudo generar el reporte");
							}
							

						}else{
							$msg=array("error","La imagen no esta en el formato correcto.");
						}
					}else{
						$msg=array("error","La imagen es demasiado grande (3mb).");
					}
				}else{
					$va1=$mt->marcajeConProblemas($idp);
					if($va1){
						$va2=$mrp->crearReporte($idp,"Almacén",date("Y-m-d"),$motivo,$obs,"");
						if($va2){
							$msg=array("success","El reporte se genero correctamente.");
						}else{
							$msg=array("error","No se pudo generar el reporte");
						}
					}else{
						$msg=array("error","No se pudo generar el reporte");
					}
					
				}
				
				$con=null;
				echo json_encode($msg);
				
				break;
		}

		
 
	}


?>