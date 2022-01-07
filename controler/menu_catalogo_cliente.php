<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Seccion.php");
	include_once("../modelo/Manejo_Subseccion.php");

	$con=Conexion::conexione();

	if(isset($_POST["accion"])){
		if($_POST["accion"]=="cargar_menu_catalogo"){
			$ms= new Manejo_Seccion($con);
			$msub= new Manejo_Subseccion($con);
			$secciones=$ms->getSeccionesxMostrar(1);
			$menu=array();
			$cont=0;
			foreach($secciones as $s){
				$subsecc=$msub->getSubseccionxSeccion($s->getId());
				$subsecciones=array();
				$cont2=0;
				foreach($subsecc as $sub){
					$subsecciones[$cont2]=$sub->getNombre();
					$cont2++;
					
				}
				$secysubsec=array("seccion"=>$s->getNombre(),"subsecciones"=>$subsecciones);
				$menu[$cont]=$secysubsec;
				$cont++;
			}
			echo json_encode($menu);
		}
	}
?>