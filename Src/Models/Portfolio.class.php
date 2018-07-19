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
    protected $description;
   // protected $datecreate;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $title
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
     * @param mixed $description
     */
    public function setDescription($content)
    {
        $this->content = $content;
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
        //$category = new CategoryRepository;
        $file=new FileRepository();
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
                    "description"=>100,
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
            "textarea" => [
        "label" => " description",
        "name" => "textarea_portfolio",
        "description" => "Un maximum de 500 caractères",
        "placeholder" => "Maximum 500 caractères"
    ],
             "ckeditor" => [
        "label" => "Edition de votre article",
        "name" => "ckeditor_article",
        "description" => "Pas de limite !",
        "placeholder" => "Placeholder"
    ],
            'select_multiple' => [
       // $category->configFormCategory(1)
    ],



            "exit" => $slugs["portfolio_add"]


        ];
    }

    public function configFormAddArticleImagePortfolio()
    {
        $slugs = Access::getSlugsById();
        //$category = new CategoryRepository;
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
           // 'select_multiple' => [
              //  $category->configFormCategory(1)
           // ],
            "exit" => $slugs["dashboard_portfolio"]
        ];
    }

    public function configFormAddArticleVideoPortfolio()
    {
        $slugs = Access::getSlugsById();
       // $category = new CategoryRepository;
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

            "exit" => $slugs["portfolio_add"]
        ];
    }


}