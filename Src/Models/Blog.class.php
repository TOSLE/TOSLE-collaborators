<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:12
 */

class Blog extends CoreSql {

    protected $id;
    protected $title;
    protected $type;
    protected $content;
    protected $datecreate;
    protected $status;
    protected $url;
    protected $fileid;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    public function getDatecreate()
    {
        return $this->datecreate;
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
     * @return mixed
     */
    public function getFileid()
    {
        return $this->fileid;
    }

    /**
     * @param mixed $fileid
     */
    public function setFileid($fileid)
    {
        $this->fileid = $fileid;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }



    public function configFormAddArticleText()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"", "submit"=>"Publier l'article",
                "save"=>"Sauvegarder sans publier",
                "form_file"=>true,
            ],
            "input"=> [
                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Your title",
                    "required"=>true,
                    "maxString"=>100,
                    "label"=>"Insert title of your article",
                    "description"=>"Max 100 character"
                ],
                "image"=>[
                    "type"=>"file",
                    "required"=>false,
                    "label"=>"Select your background image",
                    "format"=>"PNG JPG JPEG",
                    "description"=>"Authorised format (png, jpg, jpeg)",
                    "multiple"=>false
                ]
            ],
            "ckeditor" => [
                "label" => "Edition de votre article",
                "name" => "ckeditor_article",
                "description" => "Pas de limite !",
                "placeholder" => "Placeholder"
            ],
            'select' => $category->configFormCategory(1),
            "exit" => $slugs["dashboard_blog"]
        ];
    }
    public function configFormAddArticleImage()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"", "submit"=>"Publier l'article",
                "save"=>"Sauvegarder sans publier",
                "form_file"=>true,
            ],
            "input"=> [
                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Your title",
                    "required"=>true,
                    "maxString"=>100,
                    "label"=>"Insert title of your article"
                ],
                "image"=>[
                    "type"=>"file",
                    "required"=>true,
                    "label"=>"Select your image",
                    "format"=>"PNG JPG JPEG",
                    "description"=>"Authorised format (png, jpg, jpeg)",
                    "multiple"=>false
                ]
            ],
            "textarea" => [
                "label" => "Image description",
                "name" => "textarea_articleImage",
                "description" => "Un maximum de 500 caractères",
                "placeholder" => "Maximum 500 caractères"
            ],
            'select' => $category->configFormCategory(1),
            "exit" => $slugs["dashboard_blog"]
        ];
    }

    public function configFormAddArticleVideo()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"", "submit"=>"Publier l'article",
                "save"=>"Sauvegarder sans publier",
                "form_file"=>true,
            ],
            "input"=> [
                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Your title",
                    "required"=>true,
                    "maxString"=>100,
                    "label"=>"Insert title of your article"
                ],
                "link"=>[
                    "type"=>"text",
                    "required"=>true,
                    "label"=>"Insert link of your video",
                    "placeholder"=>"Link of your video",
                    "description" => "YouTube is only player supported by our Framework",
                ]
            ],
            'select' => $category->configFormCategory(1),
            "exit" => $slugs["dashboard_blog"]
        ];
    }
}