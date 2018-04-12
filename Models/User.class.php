<?php
class User extends CoreSql{

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $token;
    protected $dateconnection;
    protected $newsletter = 0;
    protected $fileid = null;
    protected $birthday = null;

    protected $status = 0;

    public function __construct(){
        parent::__construct();
    }

    public function setId($id)
    {
        $this->id=$id;
    }
    public function setFirstName($firstname)
    {
        $this->firstname=ucfirst(strtolower(trim($firstname)));
    }
    public function setLastName($lastname)
    {
        $this->lastname=strtoupper(trim($lastname));
    }
    public function setEmail($email)
    {
        $this->email=strtolower(trim($email));
    }
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function setToken()
    {
        $this->token=uniqid('token_', true);
    }
    public function setStatus($status)
    {
        $this->status=$status;
    }
    public function setDateConnection($dateconnection)
    {
        $this->dateconnection = date("Y-m-d H:i:s", $dateconnection);
    }
    public function setNewsLetter($newsletter)
    {
        $this->newsletter = $newsletter;
    }
    public function setFileId($fileid)
    {
        $this->fileid = $fileid;
    }
    public function setBirthDay($birthday)
    {
        $this->birthday = $birthday;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstname;
    }
    public function getLastName()
    {
        return $this->lastname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getToken()
    {
        return $this->token;
    }
    public function getDateConnection()
    {
        return $this->dateconnection;
    }
    public function getNewsLetter()
    {
        return $this->newsletter;
    }
    public function getFileId()
    {
        return $this->fileid;
    }
    public function getBirthDay()
    {
        return $this->birthday;
    }
    public function getStatus()
    {
        return $this->status;
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