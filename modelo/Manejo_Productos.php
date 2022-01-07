<?php
	include_once("Producto.php");

	class Manejo_Productos{
		
		private $conexion;
		
		public function __construct($con){
			$this->conexion=$con;
		}
		
		public function totalProductos(){
			$resultado=$this->conexion->prepare("SELECT COUNT(*) as total FROM productos WHERE eliminado IS NULL");
			$resultado->execute();
			$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			$resultado->closeCursor();
			return $reg["total"];
		}
		
		public function insertProducto($nombre,$descrip,$precio,$cantidad,$img,$seccion,$subseccion,$estado){
			$resultado=$this->conexion->prepare("INSERT INTO productos (nombre,descripcion,precio,cantidad,imagen,id_seccion,id_subseccion,estado) VALUES ('$nombre','$descrip','$precio','$cantidad','$img','$seccion','$subseccion','$estado')");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			
			return $valor;
		}
		
		public function getProductoPorSeccion($secc){
			$matriz_produc=array();
			$cont=0;
			
			//$resultado=$this->conexion->prepare("SELECT * FROM productos WHERE seccion= :secc");
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE s.nombre_seccion=:secc");
			$resultado->bindValue(":secc",$secc);
			$resultado->execute();
			
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				
				$matriz_produc[$cont]=$p;
				$cont++;
					
			}
			$resultado->closeCursor();
			
			return $matriz_produc;
			
		}
		//---------------------------------------------------------------------
		public function getProductosPorSeccionYEstado($seccion,$estado){
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,p.estado,s.nombre_seccion,sub.nombre_subseccion FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE s.nombre_seccion=:secc AND p.estado=:est");
			$resultado->bindValue(":secc",$seccion);
			$resultado->bindValue(":est",$estado);
			$resultado->execute();
			
			$matriz_produc=array();
			$cont=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				$p->setEstado($registro["estado"]);
				
				$matriz_produc[$cont]=$p;
				$cont++;
					
			}
			
			$resultado->closeCursor();
			
			return $matriz_produc;
		}
		
		public function getProductosPorSubseccionYEstado($subsecc,$estado){
			
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,p.estado,s.nombre_seccion,sub.nombre_subseccion FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE sub.nombre_subseccion=:subsecc AND p.estado=:est");
			$resultado->bindValue(":subsecc",$subsecc);
			$resultado->bindValue(":est",$estado);
			$resultado->execute();
			
			$matriz_produc=array();
			$cont=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				$p->setEstado($registro["estado"]);
				
				$matriz_produc[$cont]=$p;
				$cont++;	
			}
			$resultado->closeCursor();
			
			return $matriz_produc;
		}
		//PARA CATALOGO-------------------------------------------------------------------------------------
		
		public function getProductosPorSeccionCatalogo($seccion){
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,p.estado,s.nombre_seccion,sub.nombre_subseccion FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE s.nombre_seccion=:secc AND p.estado='1' AND p.cantidad > 1 AND p.eliminado IS NULL");
			$resultado->bindValue(":secc",$seccion);
			$resultado->execute();
			
			$matriz_produc=array();
			$cont=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				$p->setEstado($registro["estado"]);
				
				$matriz_produc[$cont]=$p;
				$cont++;
					
			}
			
			$resultado->closeCursor();
			
			return $matriz_produc;
		}
		
		public function getProductosPorSubseccionCatalogo($subsecc){
			
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,p.estado,s.nombre_seccion,sub.nombre_subseccion FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE sub.nombre_subseccion=:subsecc AND p.estado='1' AND p.cantidad > 1 AND p.eliminado IS NULL");
			$resultado->bindValue(":subsecc",$subsecc);
			$resultado->execute();
			
			$matriz_produc=array();
			$cont=0;
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				$p->setEstado($registro["estado"]);
				
				$matriz_produc[$cont]=$p;
				$cont++;	
			}
			$resultado->closeCursor();
			
			return $matriz_produc;
		}
		//----------------------------------------------------------------------
		
		public function getProductosPorSubseccion($subsecc){
			$matriz_produc=array();
			$cont=0;
			
			//$resultado=$this->conexion->prepare("SELECT * FROM productos WHERE subseccion=:subsecc");
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE sub.nombre_subseccion=:subsecc");
			$resultado->bindValue(":subsecc",$subsecc);
			$resultado->execute();
			
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				
				$matriz_produc[$cont]=$p;
				$cont++;
					
			}
			$resultado->closeCursor();
			
			return $matriz_produc;
		}
		
		public function getProductosPorId($id){
			
			//$resultado=$this->conexion->prepare("SELECT * FROM productos WHERE id=:id");
			$resultado=$this->conexion->prepare("SELECT p.id,p.nombre,p.descripcion,p.precio,p.cantidad,p.imagen,s.nombre_seccion,sub.nombre_subseccion,p.estado FROM productos AS p INNER JOIN subseccion AS sub ON p.id_subseccion=sub.id INNER JOIN seccion AS s ON s.id=p.id_seccion WHERE p.id=:id");
			$resultado->bindValue(":id",$id);
			$resultado->execute();
			
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
				
				$p= new Producto();
				
				$p->setId($registro["id"]);
				$p->setNombre($registro["nombre"]);
				$p->setDescrip($registro["descripcion"]);
				$p->setPrecio($registro["precio"]);
				$p->setCantidad($registro["cantidad"]);
				$p->setImg($registro["imagen"]);
				$p->setSeccion($registro["nombre_seccion"]);
				$p->setSubSeccion($registro["nombre_subseccion"]);
				$p->setEstado($registro["estado"]);
					
			}
			$resultado->closeCursor();
			
			return $p;
		}
		
		public function updateProducto($nombre,$descrip,$precio,$cantidad,$img,$seccion,$subseccion,$estado,$id){
			if($img==""){
				$sql="UPDATE productos SET nombre='$nombre', descripcion='$descrip', precio='$precio', cantidad='$cantidad', id_seccion='$seccion',id_subseccion='$subseccion',estado='$estado' WHERE id='$id'";
			}else{
				$sql="UPDATE productos SET nombre='$nombre', descripcion='$descrip', precio='$precio', cantidad='$cantidad', imagen='$img', id_seccion='$seccion',id_subseccion='$subseccion',estado='$estado' WHERE id='$id'";
			}
			$resultado=$this->conexion->prepare($sql);
			$valor=$resultado->execute();
			$resultado->closeCursor();
			
			if($estado==0){
				$res=$this->conexion->prepare("DELETE FROM carrito WHERE id_produc='$id'");
				$res->execute();
				$res->closeCursor();
			}
			
			return $valor;
		}
		
		public function deleteProducto($id){
			//$resultado=$this->conexion->prepare("DELETE FROM productos WHERE id='$id'");
			$resultado=$this->conexion->prepare("UPDATE productos SET eliminado='".date("Y-m-d H:i:s")."', estado='0' WHERE id='$id'");
			$valor=$resultado->execute();
			$resultado->closeCursor();
			
			$resultado2=$this->conexion->prepare("DELETE FROM carrito WHERE id_produc='$id'");
			$valor2=$resultado2->execute();
			$resultado2->closeCursor();
			
			return $valor;
		}
		
		//PARA CARRITO-----------------------------
		public function comprobarProductoEliminadoNoDisponible($id){
			$resultado=$this->conexion->prepare("SELECT estado, eliminado FROM productos WHERE id='$id'");
			$resultado->execute();
			$reg=$resultado->fetch(PDO::FETCH_ASSOC);
			$valor=false;
			if($reg["estado"]==1){
				$valor=true;
			}else{
				$valor=false;
			}
			
			return $valor;
		}
		
	}
?>