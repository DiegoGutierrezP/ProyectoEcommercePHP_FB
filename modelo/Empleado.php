<?php
	class Empleado{
		
		private $id;
		private $idUsuario;
		//private $username;
		//private $password;
		private $nombres;
		private $apellidos;
		private $email;
		private $dni;
		private $telefono;
		private $areaTrabajo;
		private $sexo;
		private $estado;
		
		public function getId(){
			return $this->id;
		}
		public function setId($i){
			$this->id=$i;
		}
		public function getIdUsu(){
			return $this->idUsuario;
		}
		public function setIdUsu($iu){
			$this->idUsuario=$iu;
		}
		
/*		public function getUsername(){
			return $this->username;
		}
		public function setUsername($user){
			$this->username=$user;
		}
		
		public function getPass(){
			return $this->password;
		}
		public function setPass($pass){
			$this->password=$pass;
		}*/
		
		public function getNombres(){
			return $this->nombres;
		}
		public function setNombres($n){
			$this->nombres=$n;
		}
		public function getApellidos(){
			return $this->apellidos;
		}
		public function setApellidos($ape){
			$this->apellidos=$ape;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($ema){
			$this->email=$ema;
		}
		public function getDni(){
			return $this->dni;
		}
		public function setDni($dni){
			$this->dni=$dni;
		}
		public function getTelf(){
			return $this->telefono;
		}
		public function setTelf($tlf){
			$this->telefono=$tlf;
		}
		public function getAreaT(){
			return $this->areaTrabajo;
		}
		public function setAreaT($at){
			$this->areaTrabajo=$at;
		}
		public function getSexo(){
			return $this->sexo;
		}
		public function setSexo($sex){
			$this->sexo=$sex;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($e){
			$this->estado=$e;
		}
	}
?>