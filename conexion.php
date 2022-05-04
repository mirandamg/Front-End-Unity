<?php
	class conexion{
		private $servername;
		private $username;
		private $password;
		private $dbName;
		public $conexion;
		public function __construct(){
				$this->servername = "localhost";
				$this->username = "root";
				$this->password = "";
				$this->dbName = "ternium";
		}
		function conectar(){
			$this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
			$this->conexion->set_charset("utf8");
		}
		function cerrar(){
			$this->conexion->close();
		}

	}
?>