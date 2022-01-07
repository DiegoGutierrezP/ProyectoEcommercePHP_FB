<?php

	require_once("../modelo/conexion.php");
	include_once("../modelo/Manejo_Usuario.php");
	include_once("../modelo/Usuario.php");
	include_once("../modelo/Manejo_Cliente.php");
		
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

		try{
			$base=Conexion::conexione();
			$mu=new Manejo_Usuario($base);

			$user=htmlentities(addslashes($_POST["user"]));
			$pass=htmlentities(addslashes($_POST["pass"]));
			
			$usu= new Usuario();
			$usu=$mu->getUsuarioxNombreyPass($user,$pass);

			
			if($usu->getId()==""){
				echo "incorrect";
			}else{
				
				session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
				session_set_cookie_params(["Secure" => "true"]); //false, true
				session_set_cookie_params(["HttpOnly" => "true"]); //false, true
				
				session_start();

				$_SESSION["codusuario"]=$usu->getId();
				$_SESSION["nomusuario"]=$usu->getNombre();
				
				if($usu->getCategoria()!=1 && $usu->getCategoria()!=2){
					try{
						
						$mcli = new Manejo_Cliente($base);
						$cliente=$mcli->getInfoCliente($usu->getId());
						
							$resultado2=$base->prepare("SELECT * FROM carrito WHERE id_cliente=:idcli");
							$resultado2->bindValue(":idcli",$cliente->getId());
							$resultado2->execute();
							if($resultado2->rowCount()!=0){
								
								$carrito=array();
								while($registro2=$resultado2->fetch(PDO::FETCH_ASSOC)){
									
									$id=$registro2["id_produc"];
									$cant=$registro2["cantidad"];
									$produc=["id"=>$id,"cantidad"=>$cant];
									array_push($carrito,$produc);
									
										
								}
								$resultado2->closeCursor();
								$base=null;
								setcookie("carrito_cookie",json_encode($carrito),cookieOptions(time()+2400));
								//setcookie("carrito_cookie",json_encode($carrito),time()+120,"/");//ssobreescribimos la cookie
							}else{
								if(isset($_COOKIE["carrito_cookie"])){
									setcookie("carrito_cookie","",cookieOptions(time()-120));
									//setcookie("carrito_cookie","",time()-60,"/");//eliminamos la cookie
								}
							}
							echo "correcto1";
						}catch(Exception $e){
							die("Error al buscar carrito " . $e->getMessage());
						}
				}else{
					echo "correcto2";
				}
			}

		}catch(Exception $e){
			die("Error al comprobar el login " . $e->getMessage());
		}

?>