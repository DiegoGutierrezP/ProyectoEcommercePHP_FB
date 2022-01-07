<?php
	
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Productos.php");
	include_once("../modelo/Manejo_Seccion.php");
	include_once("../modelo/Manejo_Subseccion.php");
	$con=Conexion::conexione();
	$mp = new Manejo_Productos($con);

	//PARA CARGAR EL SELECT------------------------------------------
	if(isset($_POST["cargar"])){
		$op=$_POST["cargar"];
		switch($op){
			case "cargar_select":
				$ms= new Manejo_Seccion($con);
				$secc=$ms->getSecciones();
				$secciones=array();
				$cont=0;
				foreach($secc as $s){
					$mostrar="unchecked";
					if($s->getMostrar()){
						$mostrar="checked";
					}
					$seccion= array("id"=>$s->getId(),"nombre"=>$s->getNombre(),"mostrar"=>$mostrar);
					$secciones[$cont]=$seccion;
					$cont++;
				}
				
				echo json_encode($secciones);
				
				break;
				
			case "cargar_subseccion":
				$id_seccion=$_POST["seccion"];
				
				$msub= new Manejo_Subseccion($con);
				$subseccs=$msub->getSubseccionxSeccion($id_seccion);
				$subsecciones=array();
				$contador=0;
				foreach($subseccs as $sub){
					$sub=array("id"=>$sub->getId(),"nombre"=>$sub->getNombre());
					$subsecciones[$contador]=$sub;
					$contador++;
				}
				echo json_encode($subsecciones);
				break;
		}
		
	}
	//-----------------------------------------------

	if(isset($_POST["accion"])){
		$op=$_POST["accion"];
		switch($op){
				
			case "mostrarxEstado":
				$tam_pagina=10;
				
				if($_POST["estado"]=="todos"){
					$sql1="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.eliminado IS NULL";
				}else{
					$sql1="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.estado='".$_POST["estado"]."' AND p.eliminado IS NULL";
				}
				
				if(isset($_POST["pagina"])){
					$pa=paginacion($_POST["pagina"],$tam_pagina,$sql1,$con);
				}else{
					$pa=paginacion(1,$tam_pagina,$sql1,$con);
				}
				$e=$pa['empezar_desde'];
				
				if($_POST["estado"]=="todos"){
					$sql2="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.eliminado IS NULL LIMIT $e,$tam_pagina";
				}else{
					$sql2="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.estado='".$_POST["estado"]."' AND p.eliminado IS NULL LIMIT $e,$tam_pagina";
				}
				
				echo creaResponse($sql2,$pa["num_filas"],$pa["pagina"],$pa["total_paginas"],$con);
				
				break;
				
			case "mostrarSeccion"://mostrar productos por seccion
				$tam_pagina=10;

				
				$sql1="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.eliminado IS NULL ";
				if($_POST["estado"]=="todos"){
					if($_POST["seccion"]!="Todos"){
						$sql1.=" AND s.id='".$_POST["seccion"]."'";
					}
				}else{
					if($_POST["seccion"]=="Todos"){
						$sql1.=" AND p.estado='".$_POST["estado"]."'";
					}else{
						$sql1.=" AND s.id='".$_POST["seccion"]."' AND p.estado='".$_POST["estado"]."'";
					}
				}
				
				if(isset($_POST["pagina"])){
					$pa=paginacion($_POST["pagina"],$tam_pagina,$sql1,$con);
				}else{
					$pa=paginacion(1,$tam_pagina,$sql1,$con);
				}
				$e=$pa['empezar_desde'];
				
				$sql2="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.eliminado IS NULL ";
				
				if($_POST["estado"]=="todos"){
					if($_POST["seccion"]=="Todos"){
						$sql2 .= " LIMIT $e,$tam_pagina";
					}else{
						$sql2 .= " AND s.id='".$_POST["seccion"]."' LIMIT $e,$tam_pagina";
					}
				}else{
					if($_POST["seccion"]=="Todos"){
						$sql2 .= " AND p.estado='".$_POST["estado"]."' LIMIT $e,$tam_pagina";
					}else{
						$sql2 .= " AND s.id='".$_POST["seccion"]."' AND p.estado='".$_POST["estado"]."' LIMIT $e,$tam_pagina";
					}
				}

				
				echo creaResponse($sql2,$pa["num_filas"],$pa["pagina"],$pa["total_paginas"],$con);
				
				break;
				
			case "mostrarxNombre":
				
				$tam_pagina=10;
				$nom=$_POST["nombre_produc"];
				
				$sql1="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.nombre LIKE  '%".$nom."%' AND p.eliminado IS NULL ";
				
				if($_POST["estado"]!="todos"){
					$sql1 .=" AND p.estado ='".$_POST["estado"]."'";
				}
				
				if(isset($_POST["pagina"])){
					$pa=paginacion($_POST["pagina"],$tam_pagina,$sql1,$con);
				}else{
					$pa=paginacion(1,$tam_pagina,$sql1,$con);
				}
				$e=$pa['empezar_desde'];
												
				if($_POST["estado"]=="todos"){
					$sql2="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.nombre LIKE  '%".$nom."%' AND p.eliminado IS NULL LIMIT $e,$tam_pagina";
				}else{
					$sql2="SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.nombre LIKE  '%".$nom."%' AND p.estado='".$_POST["estado"]."' AND p.eliminado IS NULL LIMIT $e,$tam_pagina";
				}

				echo creaResponse($sql2,$pa["num_filas"],$pa["pagina"],$pa["total_paginas"],$con);
				
				break;
				
			case "mostrarInfoProducto":
				if(isset($_POST["id_producto"])){
					
					$producto=$mp->getProductosPorId($_POST["id_producto"]);
					
					$estadoNombre="";
					if($producto->getEstado()==1){
						$estadoNombre="Disponible";
					}else{
						$estadoNombre="No Disponible";
					}
					
					$info_producto = array(
						"id" => $producto->getId(),
						"nombre" => $producto->getNombre(),
						"descrip" => $producto->getDescrip(),
						"precio" => $producto->getPrecio(),
						"cantidad" => $producto->getCantidad(),
						"img" => $producto->getImg(),
						"seccion" => $producto->getSeccion(),
						"subseccion" => $producto->getSubSeccion(),
						"estado"=>$estadoNombre
					);

					echo json_encode($info_producto);
				}else{
					echo "Error";
				}
				break;
			case "agregarProducto":
				
				$nombre=$_POST["nombreP"];
				$descrip=$_POST["descripP"];
				$precio=$_POST["precioP"];
				$cantidad=$_POST["cantidadP"];
				$img=$_FILES['imgP']['name'];$tipo_img=$_FILES['imgP']['type'];
				$estado=$_POST["estadoP"];
				$seccion=$_POST["seccionP"];
				$subseccion=$_POST["subseccionP"];
				
				if($cantidad<=1){
					$estado=0;
				}
				
				if($_FILES['imgP']['size']<5000000){
					if($tipo_img=="image/jpeg" || $tipo_img=="image/jpg" || $tipo_img=="image/png" || $tipo_img=="image/gif"){

						$carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Fabercastel/imgs/catalogo/';
						move_uploaded_file($_FILES['imgP']['tmp_name'],$carpeta_destino.$img);

						$valor=$mp->insertProducto($nombre,$descrip,$precio,$cantidad,$img,$seccion,$subseccion,$estado);

					}else{
						$msg="<div class='alert alert-danger' role='alert'>
							<button type='button' class='btn' data-dismiss='alert'>&times;</button>
							<strong>¡Error! </strong>La imagen no esta en el formato adecuado.</div>";
					}
				}else{
					$msg="<div class='alert alert-danger' role='alert'>
							<button type='button' class='btn' data-dismiss='alert'>&times;</button>
							<strong>¡Error! </strong>La imagen es demasiado grande (5mb).</div>";
				}
				if($valor){
					$msg="<div class='alert alert-success' role='alert'>
						<button type='button' class='btn' data-dismiss='alert'>&times;</button>
						<strong>¡Bien hecho! </strong>Los datos han sido guardados satisfactoriamente.</div>";
				}else{
					$msg="<div class='alert alert-danger' role='alert'>
						<button type='button' class='btn' data-dismiss='alert'>&times;</button>
						<strong>¡Error! </strong>Lo siento algo ha salido mal intenta nuevamente.</div>";
				}
				echo $msg;
				break;
			
			case "editarProducto":
				$post = (isset($_POST['idP']) && !empty($_POST['idP']))&&
						(isset($_POST['nombreP']) && !empty($_POST['nombreP'])) &&
						//(isset($_POST['descripP']) && !empty($_POST['descripP'])) &&
        				(isset($_POST['precioP']) && !empty($_POST['precioP'])) &&
						(isset($_POST['cantidadP']) && !empty($_POST['cantidadP']))&&
						(isset($_POST['seccionP']) && !empty($_POST['seccionP']))&&
						(isset($_POST['subseccionP']) && !empty($_POST['subseccionP']));
				$msg=array();
				if($post){
					$id=$_POST["idP"];
					$nombre=$_POST["nombreP"];
					$descrip=$_POST["descripP"];
					$precio=$_POST["precioP"];
					$cantidad=$_POST["cantidadP"];
					$img=$_FILES['imgP']['name'];$tipo_img=$_FILES['imgP']['type'];
					$seccion=$_POST["seccionP"];
					$subseccion=$_POST["subseccionP"];
					$estado=$_POST["estadoP"];
					
					if($cantidad<=1){
						$estado=0;
					}
					
					if($_FILES['imgP']['name']==""){

						$v=$mp->updateProducto($nombre,$descrip,$precio,$cantidad,"",$seccion,$subseccion,$estado,$id);
					}else{
						$carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Fabercastel/imgs/catalogo/';
						if($_FILES['imgP']['size']<5000000){
							
							$produc=$mp->getProductosPorId($id);//consultamos la imagen actual
							
							unlink($carpeta_destino.$produc->getImg());//para eliminar el archivo que se encuentra en esa direccion
							move_uploaded_file($_FILES['imgP']['tmp_name'],$carpeta_destino.$img);

							$v=$mp->updateProducto($nombre,$descrip,$precio,$cantidad,$img,$seccion,$subseccion,$estado,$id);
							
						}else{
							$msg=["Error","La imagen es demasiado grande (5mb)."];
						}
					}
					if($v){
						$msg=["Exito","Los datos han sido modificados exitosamente."];
					}else{
						$msg=["Error","Lo siento algo ha salido mal intenta nuevamente."];
					}
					
				}else{
					$msg=["Error","Algunos campos son necesarios"];
				}
				echo json_encode($msg);
				break;
				
			case "eliminarProducto"://marca el campo eliminado de la tabla productos en la bd
				$msg="";
				if(isset($_POST["id"])){
					$id=$_POST["id"];
					
					//$produc=$mp->getProductosPorId($id);
					//$carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/Fabercastel/imgs/catalogo/';
					//unlink($carpeta_destino.$produc->getImg());//eliminamos la imagen del servidor
					
					$va=$mp->deleteProducto($id);
					
					if($va){
						$msg="El producto ha sido eliminado correctamente.";
					}else{
						$msg="Error al eliminar el producto. Intentelo nuevamente.";
					}
				}else{
					$msg="Error desconocido";
				}
				echo $msg;
				break;
			
		}
		
	}
	//FUNCIONES DE PAGINACION Y CREARRESPONSE------------------------------------------------------
	function paginacion($p,$tam_p,$sql1,$con){
		$pagina;
		if($p==1){
			$pagina=1;
		}else{
			$pagina=$p;
		}
		$empezar_desde=($pagina-1)*$tam_p;
		//$pa= array ($empezar_desde,$pagina);
		//return $pa;
		$resultado=$con->prepare($sql1);
		$resultado->execute(array());
		$num_filas=$resultado->rowCount();
		$total_paginas=ceil($num_filas/$tam_p);//redondea el resultado
			
		$resultado->closeCursor();
		
		$pa = array("empezar_desde"=>$empezar_desde,"pagina"=>$pagina,"num_filas"=>$num_filas,"total_paginas"=>$total_paginas);
		return $pa;
	}
	function creaResponse($sql2,$num_f,$pag,$total_pag,$con){
		
			$res=$con->prepare($sql2);
			
			$response = [
    			'productos' => array(),
    			'total_registros' => $num_f,
				'num_pagina' => $pag,
				'total_paginas' => $total_pag,
			];
		
			$res->execute();

			$cont=0;
			while($reg=$res->fetch(PDO::FETCH_ASSOC)){
				$produc=array(
						"id"=>$reg["id"],
						"nombre"=>$reg["nombre"],
						"descrip"=>$reg["descripcion"],
						"img"=>$reg["imagen"],
						"cantidad"=>$reg["cantidad"],
						"precio"=>$reg["precio"],
						"seccion"=>$reg["nombre_seccion"],
						"subseccion"=>$reg["nombre_subseccion"],
						"estado"=>$reg["estado"]//
				);

				$response['productos'][$cont] = $produc;
				$cont++;
			}
			$res->closeCursor();
			return json_encode($response);
	}

?>