<?php
class User extends CoreSql{

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;
    protected $token;
    protected $age = 0;

    protected $status = 0;

    public function __construct(){
        parent::__construct();
    }

    public function setId($id){
        $this->id=$id;
    }
    public function setFirstName($firstname){
        $this->firstname=ucfirst(strtolower(trim($firstname)));
    }
    public function setLastName($lastname){
        $this->lastname=strtoupper(trim($lastname));
    }
    public function setEmail($email){
        $this->email=strtolower(trim($email));
    }
    public function setPwd($pwd){
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
    public function setToken($token){
        $this->token=$token;
    }
    public function setAge($age){
        $this->age=$age;
    }
    public function setStatus($status){
        $this->status=$status;
    }

    public function configFormAdd()
    {
        // FAIRE LES ID ET LES CLASS POUR LE CMS
        return [
            "config"=> ["method"=>"post", "action"=>"", "submit"=>"S'inscrire"],
            "input"=> [
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom",
                    "required"=>true,
                    "maxString"=>100,
                    "minString"=>2
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "required"=>true,
                    "maxString"=>100,
                    "minString"=>2
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true
                ],
                "emailConfirm"=>[
                    "type"=>"email",
                    "placeholder"=>"Confirmez votre email",
                    "required"=>true,
                    "confirm"=>"email"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true
                ],
                "pwdConfirme"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmez votre mot de passe",
                    "required"=>true,
                    "confirm"=>"pwd"
                ],
                "age"=>[
                    "type"=>"number",
                    "placeholder"=>"Votre age",
                    "required"=>true,
                    "maxNum"=>100,
                    "minNum"=>18
                ]
            ]
        ];
    }

}