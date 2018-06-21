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



    public function configFormAdd()
    {
        $slugs = Access::getSlugsById();
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"", "submit"=>"Envoyer votre commentaire",
            ],
            "textarea" => [
                "label" => "Nouveau commentaire",
                "name" => "textarea_comment",
                "description" => "Laissez parler votre imagination",
                "placeholder" => "Soyez sûr de ce que vous voulez publier."
            ],
        ];
    }

}