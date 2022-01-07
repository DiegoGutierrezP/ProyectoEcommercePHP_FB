<?php

	include_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Cliente.php");
	include_once("../modelo/Manejo_Productos.php");

	$base=Conexion::conexione();
	
	session_start();

	$cookie_options= array (
                'expires' => time()-60,
                'path' => '/',
                'secure' => true,     // or false
                'httponly' => false,    // or false
                'samesite' => 'None' // None || Lax  || Strict
                );
	
	if(isset($_SESSION["codusuario"])){
		
		$mcli= new Manejo_Cliente($base);
		$cli = $mcli->getInfoCliente($_SESSION["codusuario"]);
		
		if(isset($_COOKIE["carrito_cookie"])){//si se creo la cookie 

			$carrito=json_decode($_COOKIE["carrito_cookie"],true);

			$resultado=$base->prepare("SELECT * FROM carrito WHERE id_cliente='".$cli->getId()."'");//verificamos si el carrito tiene elementos
			$resultado->execute();

			if($resultado->rowCount()!=0){//si tiene elementos
				$base->query("DELETE FROM carrito WHERE id_cliente='".$cli->getId()."'");//eleminamos todo los productos
			}
			
			$mp= new Manejo_Productos($base);
			
			for($i=0;$i<count($carrito);$i++){
				$id_produc=$carrito[$i]["id"];
				$va=$mp->comprobarProductoEliminadoNoDisponible($id_produc);
				if($va){
					$cant_produc=$carrito[$i]["cantidad"];
					$resultado2=$base->prepare("INSERT INTO carrito (id_cliente,id_produc,cantidad) VALUES (:usu,:produc,:cant)");//insertamos los nuevos productos
					$resultado2->bindValue(":usu",$cli->getId());
					$resultado2->bindValue(":produc",$id_produc);
					$resultado2->bindValue(":cant",$cant_produc);
					$resultado2->execute();
					$resultado2->closeCursor();
				}
				
			}
			
			//setcookie("carrito_cookie","",time()-60,"/");//eliminamos la cookie
			setcookie("carrito_cookie","",$cookie_options);
		}else{
			$resultado=$base->prepare("SELECT * FROM carrito WHERE id_cliente='".$cli->getId()."'");//verificamos si el carrito tiene elementos
			$resultado->execute();

			if($resultado->rowCount()!=0){//si tiene elementos
				$base->query("DELETE FROM carrito WHERE id_cliente='".$cli->getId()."'");//eleminamos todo los productos
			}
		}
		
	}
	
	$base=null;
	
	
	session_destroy();
	
	header("location:../vistas/inicio.php");
	
?>