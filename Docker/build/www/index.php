<?php 
	session_start();
	require "conf.inc.php";

	function myAutoloader($class){
		$class = $class .".class.php";
		if( file_exists("core/".$class) ){
			include "core/".$class;
		}else if ( file_exists("models/".$class) ){
			include "models/".$class;
		}
	}

	spl_autoload_register("myAutoloader");


	// /3IW%20classe%201/user/add?id=2
	/*
		/
		/user/add
	*/

	/*
		/3IW classe 1
		/3IW%20classe%201/user/add
	*/

	//   user/add

	$uri = substr(urldecode($_SERVER["REQUEST_URI"]), strlen(dirname($_SERVER["SCRIPT_NAME"])));

	
	/*
		/
		user/add
	*/

	/*
		/3IW classe 1
		/user/add
	*/

	$uri = ltrim($uri, "/");

		/*
		/
		user/add
	*/

	/*
		/3IW classe 1
		user/add
	*/


	// /user/add?id=2

	$uri = explode("?", $uri);
	// user/add
	$uriExploded = explode("/", $uri[0]);

	//Utiliser des conditions ternaires pour mettre la chaine
	//"index" si la clé n'existe pas :
	$c = (empty($uriExploded[0]))?"index":$uriExploded[0];
	$a = (empty($uriExploded[1]))?"index":$uriExploded[1];

	//Controller : NomController
	$c = ucfirst(strtolower($c))."Controller";
	//Action : nomAction
	$a = strtolower($a)."Action";

	// user/modify/12/name/skrzypczyk
	// $uriExploded[0]=>user
	// $uriExploded[1]=>modify
	// $uriExploded[2]=>12
	// ...
	unset($uriExploded[0]);
	unset($uriExploded[1]);
	// user/modify/12/name/skrzypczyk
	// $uriExploded[2]=>12
	// ...

	$uriExploded = array_values($uriExploded);
	// user/modify/12/name/skrzypczyk
	// $uriExploded[0]=>12
	// ...

	$params = [
					"POST"=>$_POST,
					"GET"=>$_GET,
					"URL"=>$uriExploded
				];


	if(file_exists("controllers/".$c.".class.php")){
		include "controllers/".$c.".class.php";
		if( class_exists($c) ){
			
			$objC = new $c();

			if( method_exists($objC, $a) ){
				$objC->$a($params);
			}else{
				die("L'action ".$a." n'existe pas");
			}
		}else{
			die("Le controller ".$c." n'existe pas");
		}
	}else{
		die("Le fichier ".$c." n'existe pas");
	}







