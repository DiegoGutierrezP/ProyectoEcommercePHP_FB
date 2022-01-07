<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Seccion.php");
	include_once("../modelo/Manejo_Subseccion.php");

	$con= Conexion::conexione();

	if(isset($_POST["accion"])){
		$op=$_POST["accion"];
		$ms= new Manejo_Seccion($con);
		switch($op){
			case "crearSeccion":
					if(isset($_POST["nombreSecc"])){
						$nombresecc=$_POST["nombreSecc"];
						
						$valor=$ms->insertSeccion($nombresecc,0);//inserto seccion
						if($valor){
							$secc=$ms->getSeccionesxNombre($nombresecc);
							if($secc!=""){
								$msub= new Manejo_Subseccion($con);
								if(!empty($_POST["nombreSubsecc1"])){
									$msub->insertSubseccion($_POST["nombreSubsecc1"],$secc->getId());//devuelve verdadero o falso
								}
								if(!empty($_POST["nombreSubsecc2"])){
									$msub->insertSubseccion($_POST["nombreSubsecc2"],$secc->getId());//devuelve verdadero o falso
								}
								if(!empty($_POST["nombreSubsecc3"])){
									$msub->insertSubseccion($_POST["nombreSubsecc3"],$secc->getId());//devuelve verdadero o falso
								}
								if(!empty($_POST["nombreSubsecc4"])){
									$msub->insertSubseccion($_POST["nombreSubsecc4"],$secc->getId());//devuelve verdadero o falso
								}
								$exito= array("titulo"=>"Exito","icon"=>"success","msg"=>"La Sección se creo correctamente");
								echo json_encode($exito);
							}
						}else{
							$error= array("titulo"=>"Error","icon"=>"error","msg"=>"Nose pudo crear la sección");
							echo json_encode($error);
							
						}
					}
					//echo $_POST["nombreSecc"] . " - " . !empty($_POST["nombreSubsecc1"]). " - " . !empty($_POST["nombreSubsecc2"]). " - " . !empty($_POST["nombreSubsecc3"]). " - " . !empty($_POST["nombreSubsecc4"]);
				break;
				
			case "updateMostrar":
				if(isset($_POST["arrayMostrar"])){
					$mostrarArray=json_decode($_POST["arrayMostrar"]);
					$secciones=$ms->getSecciones();

					foreach($secciones as $s){
						$ms->updateMostrar($s->getId(),0);
						for($i=0;$i<count($mostrarArray);$i++){
							if($s->getId()==$mostrarArray[$i]){
								$ms->updateMostrar($s->getId(),1);
							}
						}
					}
					echo "Se actualizo las secciones a mostrar en el catalogo";
					
				}
				break;
			
			case "updateNombreSeccion":
				
				$va=$ms->updateNombreSeccion($_POST["idSecc"],$_POST["nombreSecc"]);
				
				echo $va;
				
				break;
		}
	}
?>