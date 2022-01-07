<?php
	include("../modelo/conexion.php");
	include("../modelo/Manejo_ReporteSolucion.php");
	include("../modelo/Manejo_Tracking.php");
	include("../modelo/Manejo_ReporteProblema.php");
	include("../modelo/Manejo_Pedido.php");

	$con= Conexion::conexione();

	$idpedido = $_POST["idPedido"];
	$idreport = $_POST["idReporte"];
	$fecha = date("Y-m-d");
	$reporteSol=$_POST["reportSolucion"];
	$solu=$_POST["selectSolucion"];

	$img=$_FILES["imgSolucion"]["name"];$tipo_img=$_FILES["imgSolucion"]["type"];

	if(isset($_POST["checkEmpaquetado"])){
		$peso=$_POST["pesoPedido"];
		$unidmedida=$_POST["selectUnidad"];
		$pesop=$peso." ".$unidmedida;
	}


	$mt = new Manejo_Tracking($con);
	$mrs =  new Manejo_ReporteSolucion($con);
	$mrp=  new Manejo_ReporteProblema($con);
	$mpe= new Manejo_Pedido($con);
	
	if($img!=""){
		if($_FILES['imgSolucion']['size']<3000000){
			if($tipo_img=="image/jpeg" || $tipo_img=="image/jpg" || $tipo_img=="image/png" || $tipo_img=="image/gif"){
				
				$carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Fabercastel/imgs/reportes/solucion/';
				move_uploaded_file($_FILES['imgSolucion']['tmp_name'],$carpeta_destino.$img);

				$va1=$mrs->crearSolucion($idreport,$fecha,$reporteSol,$img,$solu);//creamos el reporte de solucion para el reporte de problema
				if($va1){
					$va2=$mrp->cambiarEstadoReporte($idreport);//cambiamos el estado del reporte de 1 a 0
					$mt->marcajeSinProblemas($idpedido);//cambiamos de 1 a 0 el campo problemas de la tabla tracking
					if($va2){
						if(isset($_POST["checkEmpaquetado"])){
							$va3=$mt->marcajeEmpaquetado($idpedido);//ingrsamos la fecha del empaquetado
							$mpe->establecerPesoPedido($pesop,$idpedido);
						}else{
							$va3=$mt->marcajeCancelado($idpedido);//marcamos como pedido cancelado
						}
						if($va3){
							$msg=array("success","Se genero la solucion del reporte correctamente.");
						}else{
							$msg=array("error","Hubo un error al cambiar el tracking");
						}
					}else{
						$msg=array("error","Hubo un error al cambiar estado del reporte");
					}
				}else{
					$msg=array("error","Hubo un error al generar el reporte de solucion");
				}
				
			}else{
				$msg=array("error","La imagen no esta en el formato correcto.");
			}
		}else{
			$msg=array("error","La imagen es demasiado grande(3mb).");
		}
	}else{
		
		$va1=$mrs->crearSolucion($idreport,$fecha,$reporteSol,"",$solu);//creamos el reporte de solucion para el reporte de problema
		if($va1){
			$va2=$mrp->cambiarEstadoReporte($idreport);//cambiamos el estado del reporte de 1 a 0(activo , inactivo)
			$mt->marcajeSinProblemas($idpedido);//cambiamos de 1 a 0 el campo problemas de la tabla tracking
			if($va2){
				if(isset($_POST["checkEmpaquetado"])){
					$va3=$mt->marcajeEmpaquetado($idpedido);//ingrsamos la fecha del empaquetado
					$mpe->establecerPesoPedido($pesop,$idpedido);
				}else{
					$va3=$mt->marcajeCancelado($idpedido);//marcamos como pedido cancelado
				}
				if($va3){
					$msg=array("success","Se genero la solucion del reporte correctamente.");
				}else{
					$msg=array("error","Hubo un error al cambiar el tracking");
				}
			}else{
				$msg=array("error","Hubo un error al cambiar estado del reporte");
			}
		}else{
			$msg=array("error","Hubo un error al generar el reporte de solucion");
		}
		
	}
	$con=null;
	echo json_encode($msg);


?>