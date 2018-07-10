<?php

/**
 * Created by PhpStorm.
 * User: Najla
 * Date: 01/06/2018
 * Time: 23:00
 */

class Portfolio extends CoreSql
{

    protected $id;
    protected $title;
    protected $description;
    protected $datecreate;
    protected $status;
    protected $url;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDateCreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function configFormAddPortfolio()
    {
        $slugs = Access::getSlugsById();

        return [
            "config" => [
                "method" => "post",
                "action" => "",
                "save" => "Sauvegarder en brouillon",
                "submit" => "Enregistrer ",
                "form_file" => false,
            ],
            "input" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Intitulé",
                    "required" => true,
                    "maxString" => 100,
                    "label" => "titre"
                ]
            ],
            "textarea" => [
                "label" => " description",
                "name" => "textarea_portfolio",
                "description" => "Un maximum de 500 caractères",
                "placeholder" => "Maximum 500 caractères"
            ],
            "exit" => $slugs["portfolio_add"]
        ];
    }

}
