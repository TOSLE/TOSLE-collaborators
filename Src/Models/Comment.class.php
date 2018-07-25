<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:10
 */

class Comment extends CoreSql {

    protected $id;
    protected $content;
    protected $tag;

    private $datecreate;
    private $dateupdated;

    private $user;
    public function __construct($_id = null)
    {
        parent::__construct();
        if(isset($_id) && is_numeric($_id)){
            $parameter = [
                'LIKE' => [
                    'id' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData();
        }
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     *
     */
    public function setTag()
    {
        $this->tag = uniqid();
    }

    /**
     * @return mixed
     */
    public function getDatecreate()
    {
        $date = new DateTime($this->datecreate);
        return $date->format("F j, Y");
    }

    /**
     * @param mixed $datecreate
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * @param mixed $dateupdated
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;
    }

    /**
     * @return array Comment
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $_arrayUsers
     */
    public function setUser($_arrayUsers)
    {
        foreach($_arrayUsers as $idUser){
            $User = new User($idUser);
            $this->user = $User;
        }
    }




    public function configFormAdd()
    {
        $slugs = Access::getSlugsById();
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"", "submit"=>"Send your commentary",
                "secure" => [
                    "status" => true,
                    "duration" => 8
                ],
            ],
            "textarea" => [
                "label" => "New comments",
                "name" => "textarea_comment",
                "description" => "Let your imagination speak",
                "placeholder" => "Be sure of what you want to publish."
            ],
        ];
    }
}