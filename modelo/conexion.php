<?php
	
	class Conexion{
				
		public static function conexione(){
			
			try{
				
				$conexion= new PDO('mysql:host=localhost; dbname=fabercastel','root','');
				
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$conexion->exec("SET CHARACTER SET UTF8");
				
				
			}catch(Exception $e){
				die("ERROR " . $e->getMessage() . "Linea del error ". $e->getLine());
			}
			
			return $conexion;
			
		}
					
	}

?>