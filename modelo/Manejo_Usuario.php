<?php
	include_once("Usuario.php");

	class Manejo_Usuario{
		
		private $conexion;
		
		public function __construct($con){
			$this->conexion=$con;
		}
		
		
		public function getUsuarioxNombreyPass($user,$contra){//para login
			$resultado=$this->conexion->prepare("SELECT * FROM usuarios WHERE user= :usuario AND password= :contra");
			$resultado->bindValue(":usuario",$user);
			$resultado->bindValue(":contra",$contra);
			$resultado->execute();
			$usuario =  new Usuario();
			if($resultado->rowCount()!=0){
				$registro=$resultado->fetch(PDO::FETCH_ASSOC);
				
				$usuario->setId($registro["id"]);
				$usuario->setNombre($registro["user"]);
				$usuario->setCategoria($registro["categoria"]);
				
				
			}
			$resultado->closeCursor();
			return $usuario;
		}
		
		public function crearUsuario($user,$contra,$categoria){
			$resultado=$this->conexion->prepare("INSERT INTO usuarios (user,password,categoria) VALUES (:usuario, :password, :categoria)");
			$resultado->bindValue(":usuario",$user);
			$resultado->bindValue(":password",$contra);
			$resultado->bindValue(":categoria",$categoria);
			$valor=$resultado->execute();
			$resultado->closeCursor();
			return $valor;
		}
		
		public function verificarPass($pass,$codigo){
			$resultado=$this->conexion->prepare("SELECT * FROM usuarios WHERE password=:pass AND id=:cod");
			$resultado->bindValue(":pass",$pass);
			$resultado->bindValue(":cod",$codigo);
			$resultado->execute();
			$valor=$resultado->rowCount();
			$valor2;
			if($valor>0){
				$valor2=true;
			}else{
				$valor2=false;
			}
			$resultado->closeCursor();
			return $valor2;
		}
		
		public function actualizarUsu($id,$username,$pass){
			$valor="";
			if($pass==""){
				$resultado=$this->conexion->prepare("UPDATE usuarios set user=:user WHERE id=:id");
				$valor=$resultado->execute(array(":id"=>$id,":user"=>$username));
			}else{
				$resultado=$this->conexion->prepare("UPDATE usuarios set user=:user, password=:pass WHERE id=:id");
				$valor=$resultado->execute(array(":id"=>$id,":user"=>$username,":pass"=>$pass));
			}
			$resultado->closeCursor();
			return $valor;
			
		}
	
	}
?>