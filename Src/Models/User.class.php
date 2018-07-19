<?php
class User extends CoreSql{

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $token;
    protected $dateconnection;
    protected $pseudo;
    protected $newsletter = null;
    protected $fileid = null;
    protected $birthday = null;

    protected $status = null;

    private $dateInscription;
    private $dateUpdated;
    private $groups = [];

    public function __construct($_id = null){
        parent::__construct();
        if(isset($_id) && is_numeric($_id)){
            $Group = new GroupRepository();
            $parameter = [
                'LIKE' => [
                    'id' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData();
            $this->groups = $Group->getGroupsUser($this->id);
        }
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
    public function setDateconnection()
    {
        $this->dateconnection = date("Y-m-d H:i:s", time());
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
    public function getDateconnection()
    {
        return $this->dateconnection;
    }
    public function getNewsletter()
    {
        return $this->newsletter;
    }
    public function getFileid()
    {
        return $this->fileid;
    }
    public function getBirthday()
    {
        return $this->birthday;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setDateinscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    public function getDateinscription()
    {
        return $this->dateInscription;
    }

    public function setDateupdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
    }

    public function getDateupdated()
    {
        return $this->dateUpdated;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setGroups($_arrayGroups)
    {
        if(isset($_arrayGroups) && is_array($_arrayGroups)){
            foreach($_arrayGroups as $groupId){
                $this->groups[] = new Group($groupId);
            }
        } else {
            $this->groups = null;
        }
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
                    "maxString"=>100
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "required"=>true,
                    "maxString"=>100
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
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmez votre mot de passe",
                    "required"=>true,
                    "confirm"=>"pwd"
                ]
            ],
            "captcha" => true
        ];
    } 
    public function passwordFormAdd()
    {
        // FAIRE LES ID ET LES CLASS POUR LE CMS
        return [
            "config"=> ["method"=>"post", "action"=>"", "submit"=>"Envoie lien pour mot de passe"],
            "input"=> [
                
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true
                ]
            ],
            "captcha" => true
        ];
    } 
    public function setnewpasswordFormAdd()
    {
        // FAIRE LES ID ET LES CLASS POUR LE CMS
        return [
            "config"=> ["method"=>"post", "action"=>"", "submit"=>"Modifier mot de passe"],
            "input"=> [
                
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre nouveau mot de passe",
                    "required"=>true
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmez votre nouveau mot de passe",
                    "required"=>true,
                    "confirm"=>"pwd"
            ],
            "captcha" => true
        ]
        ];
    }

    public function configFormConnect($action = "")
    {
        return [
            "config"=> [
                "method"=>"post",
                "action"=>$action,
                "submit"=>"Se connecter",
                "secure" => [
                    "status" => true,
                    "duration" => 5
                ],
            ],
            "input"=> [
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true,
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                ]
            ]
        ];
    }
}