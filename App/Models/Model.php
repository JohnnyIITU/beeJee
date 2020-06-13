<?php 
	class Model {
		private $login = 'root';
		private $password = '';
		private $host = 'localhost';
		private $dbname = 'beejee';
		
		public $db;
		function __construct(){
			$base = "mysql:host=$this->host;dbname=$this->dbname";
	        $this->db = new PDO($base, $this->login, $this->password);
		}

		static function init($name){
			$name = ucfirst(strtolower($name));
			if(file_exists("App/Models/$name.php")){
				include "App/Models/$name.php";
			}else{
				Router::abort404();
			}
		}
	}
?>