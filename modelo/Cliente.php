<?php
	class CLiente{
		
		private $id;
		private $username;
		private $password;
		private $nombres;
		private $apellidos;
		private $dni;
		private $email;
		private $sexo;
		
		public function getId(){
			return $this->id;
		}
		public function setId($i){
			$this->id=$i;
		}
		//
		//
		public function getUsername(){
			return $this->username;
		}
		public function setUsername($user){
			$this->username=$user;
		}
		//
		public function getPass(){
			return $this->username;
		}
		public function setPass($pass){
			$this->password=$pass;
		}
		//
		public function getNombres(){
			return $this->nombres;
		}
		public function setNombres($n){
			$this->nombres=$n;
		}
		//
		public function getApellidos(){
			return $this->apellidos;
		}
		public function setApellidos($ape){
			$this->apellidos=$ape;
		}
		//
		public function getDni(){
			return $this->dni;
		}
		public function setDni($dni){
			$this->dni=$dni;
		}
		//
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($ema){
			$this->email=$ema;
		}
		//
		
		public function getSexo(){
			return $this->sexo;
		}
		public function setSexo($sex){
			$this->sexo=$sex;
		}
	}
?>