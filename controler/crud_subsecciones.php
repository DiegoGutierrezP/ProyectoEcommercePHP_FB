<?php 
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Seccion.php");
	include_once("../modelo/Manejo_Subseccion.php");

	$con = Conexion::conexione();

	if(isset($_POST["accion"])){
		
		$op = $_POST["accion"];
		$msub = new Manejo_Subseccion($con);
		
		switch ($op){
				
			case "crearSubseccion":
														
					$idsecc = $_POST["idSeccRelacionada"];
					$nomsubsecc = $_POST["nombreNewSubsecc"];
					
					$va=$msub->insertSubseccion($nomsubsecc,$idsecc);
				
					if($va){
						$respon= array("titulo"=>"Exito","icon"=>"success","msg"=>"La Subsección se creo correctamente");
					}else{
						$respon= array("titulo"=>"Error","icon"=>"error","msg"=>"Nose pudo crear la Subsección");
					}
					
					echo json_encode($respon);
			
				break;
				
			case "editarSubseccion":
				
					$idsubsecc = $_POST["idSubseccion"];
					$nom = $_POST["nombreSubseccionEdit"];

					$va=$msub->updateSubseccion($idsubsecc,$nom);

					if($va){
						$respon= array("titulo"=>"Exito","icon"=>"success","msg"=>"La Subsección se actualizó correctamente");
					}else{
						$respon= array("titulo"=>"Error","icon"=>"error","msg"=>"Nose pudo crear actualizar");
					}

					echo json_encode($respon);
				
				break;
				
			case "consultaProdSubsecc":
				
				$idsubsecc= $_POST["idsubsecc"];
				
				$res=$con->prepare("SELECT COUNT(*) as total FROM PRODUCTOS WHERE id_subseccion='".$idsubsecc."' AND eliminado IS NULL");
				$res->execute();
				
				$reg=$res->fetch(PDO::FETCH_ASSOC);
				$res->closeCursor();
				$con=null;
				
				echo $reg["total"];
				
				break;
			
			case "eliminarSubsecc":
				
				$id= $_POST["idsubsecc"];
				
				$va=$msub->eliminarSubseccion($id);
				
				if($va){
					$msg=array("Se elimino la subseccion correctamente.","#93cf95");
				}else{
					$msg=array("No se pudo eliminar la subsección, intentelo nuevamente.","#ff9797");
				}
				//$con=null;
				echo json_encode($msg);
				
				break;
		}
	}

?>