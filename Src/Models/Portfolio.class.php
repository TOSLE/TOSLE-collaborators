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
    protected $name;
    protected $title;
    protected $value;
    protected $type;
    protected $content;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name =$name;
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->status = $value;
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
        $this->status = $type;
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






    public function configFormAddPortfolio()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;

        return [
            "config" => [
                "method" => "post",
                "action" => "",
                "submit"=>"Publier l'article",
                "save" => "Sauvegarder en brouillon",
                "form_file" => true,
            ],

            "input" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "title",
                    "required"=> true,
                    "maxString" => 100,
                    "label" => "titre",
                    "description"=>"Max 100 character",
                ],


                "image"=>[
                    "type"=>"file",
                    "required"=>false,
                    "label"=>"Select your background image",
                    "format"=>"PNG JPG JPEG",
                    "description"=>"Authorised format (png, jpg, jpeg)",
                    "multiple"=>false
                ]

                /*],
                "textarea" => [
                    "label" => " description",
                    "name" => "textarea",
                    "description" => "Un maximum de 500 caractères",
                    "placeholder" => "Maximum 500 caractères"*/
            ],
            "ckeditor" => [
                "label" => "Edition de votre article",
                "name" => "ckeditor_article",
                "description" => "Pas de limite !",
                "placeholder" => "Placeholder"
            ],
            'select_multiple' => [
                $category->configFormCategory(1)
            ],



            "exit" => $slugs["dashboard_portfolio"]


        ];
    }

    public function configFormAddArticleImagePortfolio()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        $Portfolio= new PortfolioRepository();
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
            'select_multiple' => [
                $category->configFormCategory(1)
            ],
            "exit" => $slugs["dashboard_portfolio"]
        ];
    }

    public function configFormAddArticleVideoPortfolio()
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

            'select_multiple' => [
                $category->configFormCategory(1)
            ],



            "exit" => $slugs["dashboard_portfolio"]
        ];
    }



}