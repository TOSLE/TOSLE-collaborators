<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 05/04/2018
 * Time: 23:58
 */

class Group extends CoreSql {

    protected $id;
    protected $name;
    protected $fileid; /** a verif */

    private $image = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFileid()
    {
        if(!empty($this->fileid)){
            return new File($this->fileid);
        } else {
            return null;
        }

    }

    /**
     * @param mixed $fileid
     */
    public function setFileid($fileid)
    {
        $this->fileid = $fileid;
    }

    public function configFormAdd()
    {
        $User = new UserRepository();
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"",
                "submit"=>"Enregistrer",
                "form_file"=>true,
            ],
            "input"=> [
                "name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom du groupe",
                    "required"=>true,
                    "maxString"=>20,
                    "label"=>"Nom du groupe",
                    "description"=>"20 caractères maximum"
                ],
                "file"=>[
                    "type"=>"file",
                    "required"=>false,
                    "label"=>"Ajouter un avatar au groupe",
                    "format"=>"JPEG JPG PNG",
                    "description"=>"Authorised format (JPEG, PNG, JPG)",
                    "multiple"=>false
                ]
            ],
            'select_multiple' => [
                $User->getSelectUsers()
            ],
            "exit" => $this->routes["dashboard_student"]
        ];
    }
}