<?php


class Database{

	public function __construct(){
		echo "Connexion a la bdd";
	}

	public function save(){
		echo "Sauvegarde en base de données de l'utilisateur ".$this->firstname;
	}

}


class User extends Database{

	protected $firstname;
	private $lastname;
	private $email;
	private $pwd;

	public function __construct($firstname=null, $lastname=null, $email=null, $pwd=null){
		$this->setFirstname($firstname);
		$this->setLastname($lastname);
		$this->setEmail($email);
		$this->setPwd($pwd);

		parent::__construct();
		
	}


	public function setFirstname($firstname){
		$this->firstname = ucfirst(strtolower(trim($firstname)));
	}
	public function setLastname($lastname){
		$this->lastname = strtoupper(trim($lastname));
	}
	public function setEmail($email){
		$this->email = strtolower(trim($email));
	}
	public function setPwd($pwd){
		$this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
	}

	public function getFirstname(){
		return $this->firstname;
	}
	public function getLastname(){
		return $this->lastname;
	}
	public function getEmail(){
		return $this->email;
	}


	public function __destruct(){
		echo "On utilise plus l'objet";

	}

	public static function hashPwd($pwd){
		password_hash($pwd, PASSWORD_DEFAULT);
	}

}


User::hashPwd();

$user = new User("yves", "skrzypczyk", "y.skrzypczyk@gmail.com", "Test1234");




$user->save();


















