<?php
	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Productos.php");
	$con=Conexion::conexione();
	$p=new Manejo_Productos($con);

	
	//opciones de la cookie
	function cookieOptions($expire){
		$cookie_options= array (
                'expires' => $expire,
                'path' => '/',
                'secure' => true,     // or false
                'httponly' => false,    // or false
                'samesite' => 'None' // None || Lax  || Strict
                );
		return $cookie_options;
	}

	if(isset($_GET["id"])){//para elimimnar producto del carrito
		
		$idstring = $_GET["id"];
		$id=intval($idstring);
		//echo gettype($id);
		$items=json_decode($_COOKIE["carrito_cookie"],true);
		$items2;
		$vacio=false;
		//var_dump($items);
		for($i=0;$i<count($items);$i++){
			
			if($items[$i]["id"]==$id){
				unset($items[$i]);
				if(empty($items)){//si array esta vacio
					$vacio=true;
				}else{
					$vacio=false;
				}
				$items2=array_values($items);//devuelve todos los valores del array array e indexa numéricamente el array.
				
			}
		}
		
		if($vacio){
			setcookie("carrito_cookie","",cookieOptions(time()-120));
			//setcookie("carrito_cookie","",time()-120,"/");//eliminamos la cookie
			header("Location:../vistas/carrito_cliente.php");
		}else{
			//setcookie("carrito_cookie",json_encode($items2),time()+120,"/");//sobreescribimos cookkie
			setcookie("carrito_cookie",json_encode($items2),cookieOptions(time()+2400));
			header("Location:../vistas/carrito_cliente.php");
		}
		
	}else if(isset($_GET["accion"])){//para sumar o restar cantidades del producto
		
		if(isset($_COOKIE["carrito_cookie"])){
		
			$accion=$_GET["accion"];
			$items3=json_decode($_COOKIE["carrito_cookie"],true);
			$vacio=false;
			$entro=false;
			$items4;


			for($i=0;$i<count($items3);$i++){
				if($items3[$i]["id"]==$_GET["id2"]){
					if($_GET["accion"]=="sumar "){//dejar asi como esta sumar con espacio sino no reconoce
						$items3[$i]["cantidad"]=$items3[$i]["cantidad"]+1;
						//echo "vooy a sumar 2 ";
					}else if($_GET["accion"]=="restar "){
						if($items3[$i]["cantidad"]==1){
							unset($items3[$i]);
							if(empty($items3)){
								$vacio=true;
							}
							$items4=array_values($items3);
							$entro=true;
						}else{
							$items3[$i]["cantidad"]=$items3[$i]["cantidad"]-1;
						}
					}	

				}
			}
			if($vacio){
				setcookie("carrito_cookie","",cookieOptions(time()-120));
				//setcookie("carrito_cookie","",time()-60,"/");//eliminamos la cookie
				header("Location:../vistas/carrito_cliente.php");
			}else{
				if($entro){
					setcookie("carrito_cookie",json_encode($items4),cookieOptions(time()+2400));
					//setcookie("carrito_cookie",json_encode($items4),time()+120,"/");//sobreescribimos cookkie
					header("Location:../vistas/carrito_cliente.php");
				}else{
					setcookie("carrito_cookie",json_encode($items3),cookieOptions(time()+2400));
					//setcookie("carrito_cookie",json_encode($items3),time()+120,"/");//sobreescribimos cookkie
					header("Location:../vistas/carrito_cliente.php");
				}

			}
		
		}else{
			echo "ya no hay cookie carrito";
		}
	 }else if(isset($_POST["consulta"])){
		if(isset($_COOKIE["carrito_cookie"])){
			$carrito=json_decode($_COOKIE["carrito_cookie"],true);
			
			$cont=0;
			$p_cant_excedida=array();
			
			//$items2;
			$p_eliminados=array();
			$contElim=0;
			$vacio=false;
			
			for($i=0;$i<count($carrito);$i++){
				
				$va=$p->comprobarProductoEliminadoNoDisponible($carrito[$i]["id"]);
				
				$produc=$p->getProductosPorId($carrito[$i]["id"]);
				
				if($va){
					//----------
					//$produc=$p->getProductosPorId($carrito[$i]["id"]);
					if($carrito[$i]["cantidad"]>=$produc->getCantidad()){
						$p_cant_excedida[$cont]=$produc->getNombre();
						$cont++;
					}
					//--------------
				}else{
					$p_eliminados[]=$produc->getNombre();
					unset($carrito[$i]);//elimina del array
					if(empty($carrito)){//si array esta vacio
						$vacio=true;
						break;
					}else{
						$contElim++;
					}
					$carrito=array_values($carrito);
				}
					
				
			}
			
			if($vacio){
				setcookie("carrito_cookie","",cookieOptions(time()-120));
				$html="Lo sentimos!. Sus productos ya no estan Disponibles. ";
				echo $html;
				
			}else{
				setcookie("carrito_cookie",json_encode($carrito),cookieOptions(time()+2400));
				if($contElim>0){
					
					//echo json_encode($p_eliminados);
					
					$html = "<div>Lo sentimos! Cambios Inesperados! los siguiente productos ya no estan Disponibles. ";
					for($i=0;$i<count($p_eliminados);$i++){
						$html.="<p>".$p_eliminados[$i]."</p>";
					}
					$html.="</div>";
					echo $html;
					
				}else{
					//----------
					/*if($cont>0){
						echo json_encode($p_cant_excedida);
					}else{
						echo json_encode("");
					}*/
					//------------
					
					if($cont>0){
						$html = "<div>Su carrito <strong>excede en cantidades</strong> a nuestro stock en los productos:";
						for($i=0;$i<count($p_cant_excedida);$i++){
							$html.="<p>".$p_cant_excedida[$i]."</p>";
						}
						$html.="</div>";
						echo $html;
					}else{
						echo "";
					}
				}
				
				
			}
			
			
			
			
		}
	}
?>