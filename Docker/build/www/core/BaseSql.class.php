<?php
class BaseSql{

	private $table;
	
	/*

	define("DBUSER","root");
	define("DBPWD","root");
	define("DBHOST","localhost");
	define("DBNAME","3iwclasse2");
	define("DBPORT","3306");


	*/

	public function __construct(){
		$this->table = get_called_class();

	}

	public function save(){
		echo "Enregristrement";


	}

}