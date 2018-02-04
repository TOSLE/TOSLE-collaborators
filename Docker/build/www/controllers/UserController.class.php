<?php
class UserController{

	public function indexAction($params){
		echo "Action par défaut de user";
	}
	

	public function addAction($params){
		echo "Ajout d'un utilisateur<pre>";
		
		$user = new User();
		
		$user->setId(12);
		$user->setFirstname("Skrzypczyk");
		$user->setEmail("y.skrzypczyk@gmail.com");
		$user->save();
		
	}

	public function listAction($params){
		$v = new View("users","front");
	}

	public function modifyAction($params){
		echo "Modification d'un utilisateur";
		echo $params["URL"][0];
		
	}
}