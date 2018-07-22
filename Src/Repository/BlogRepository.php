<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 29/04/2018
 * Time: 23:19
 */

class BlogRepository extends Blog
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return integer
     * Retourne le nombre d'article de la table Blog
     */
    public function countNumberOfBlog()
    {
        return $this->countData(["id"]);
    }

    /**
     * @param integer $status
     * @return integer
     * Retourne le nombre d'article de la table Blog en fonction du status (par défaut vaut 1 (publié))
     */
    public function countNumberOfBlogByStatus($status = 1)
    {
        $this->setWhereParameter([
            "LIKE" => [
                "status" => $status
            ]
        ]);
        return $this->countData(["id"]);
    }

    /**
     * @param integer $id
     * Retourne tous les éléments d'un article en fonction de son id
     */
    public function getArticle($id)
    {
        $parameter = [
            "LIKE" => [
                "id" => $id
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["id", "title", "content", "type", "url", "fileid"]);
    }
    /**
     * @param integer $id
     * @return bool
     * Retourne tous les éléments d'un article en fonction de son id
     */
    public function getArticleByUrl($url)
    {
        $target = [
            "id",
            "title",
            "content",
            "type",
            "url",
            "datecreate",
            "fileid"
        ];
        $parameter = [
            "LIKE" => [
                "url" => $url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
        if(!isset($this->id)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param int $number
     * @return array|boolean
     */
    public function getLatestArticle($number)
    {
        if(is_numeric($number))
        {
            $target = [
                "title",
                "datecreate",
                "id",
                "status",
                "type"
            ];
            $this->setOrderByParameter(["id" => "DESC"]);
            $this->setLimitParameter($number);
            return $this->getData($target);
        }
        return false;
    }
    /**
     * @param int $status
     * @param int $max
     * @param int $min
     * @return array|boolean
     * Retourne tous les articles par rapport à un status
     */
    public function getAllArticleByStatus($status = null, $max = null, $min = 0)
    {
        if(is_numeric($status))
        {
            $target = [
                "title",
                "datecreate",
                "id",
                "status",
                "type",
                "content",
                "url",
                "fileid"
            ];
            $this->setOrderByParameter(["id" => "DESC"]);
            if(isset($max)) {
                $this->setLimitParameter($max, $min);
            }
            if(isset($status)){
                $parameter = [
                    'LIKE' => [
                        'status' => $status
                    ]
                ];
                $this->setWhereParameter($parameter);
            }
            return $this->getData($target);
        }
        return false;
    }


    /**
     * @param int $colSize
     * @param int|null $limit
     * @param bool|null $access
     * @return array
     * Permet de récupérer la configuration de la modal "LastArticle"
     * Le paramètre permet de définir une largeur à notre modal
     */
    public function getModalLatestArticle($colSize = 12, $limit = 5,$access= null)
    {
        $routes = Access::getSlugsById();
        $ViewLatestBloc = new DashboardBlocModal();
        $ViewLatestBloc->setTitle("View latest post on your blog");
        $ViewLatestBloc->setIconHeader("modal_view_all_posts", "modal");
        $ViewLatestBloc->setTableHeader([
            1 => "Titre",
            2 => "Date de publication",
            3 => "Action"
        ]);
        $ViewLatestBloc->setColSizeBloc($colSize);
        $ViewLatestBloc->setActionButtonStatus(0, [
            "color" => "green",
            "text" => "Publish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonEdit("Edit");
        $ViewLatestBloc->setActionButtonView("View");

        $ViewLatestBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        if(isset($access)){
            $ViewLatestBloc->setIconHeader("dashboard_blog", "access");
        }
        $ViewLatestBloc->setTableBodyContent($this->getLatestArticle($limit), true);
        $ViewLatestBloc->setArrayHref("edit", $routes["blog/edit"]);
        $ViewLatestBloc->setArrayHref("view", $routes["view_blog_article"]);
        return $ViewLatestBloc->getArrayData();
    }

    /**
     * @param int $colSize
     * @param int $status
     * @return array
     * Permet de récupérer la configuration de la modal "allArticle"
     * Le paramètre permet de définir une largeur à notre modal
     */
    public function getModalAllArticle($colSize = 12, $status = 1)
    {
        $routes = Access::getSlugsById();
        $ViewArticleBloc = new DashboardBlocModal();
        $ViewArticleBloc->setTitle("Your articles");
        $ViewArticleBloc->setTableHeader([
            1 => "Titre",
            2 => "Date de publication",
            3 => "Action"
        ]);
        $ViewArticleBloc->setColSizeBloc($colSize);
        $ViewArticleBloc->setActionButtonStatus(0, [
            "color" => "green",
            "text" => "Publish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewArticleBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewArticleBloc->setActionButtonEdit("Edit");
        $ViewArticleBloc->setActionButtonView("View");

        $ViewArticleBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        $ViewArticleBloc->setTableBodyContent($this->getAllArticleByStatus(), true);
        $ViewArticleBloc->setArrayHref("edit", $routes["blog/edit"]);
        $ViewArticleBloc->setArrayHref("view", $routes["view_blog_article"]);
        return $ViewArticleBloc->getArrayData();
    }

    /**
     * @return array object
     * Permet de récupérer la modal statistique
     */
    public function getModalStats()
    {
        $StatsBlog = new DashboardBlocModal();
        $StatsBlog->setTitle("Blog Analytics");
        $StatsBlog->setTableHeader([
            1 => "Type",
            2 => "Value"
        ]);
        $StatsBlog->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-number"
        ]);
        $StatsBlog->setColSizeBloc(6);
        $StatsBlog->setTableBodyContent([
            0 => [
                1 => "Nombre d'article",
                2 => $this->countNumberOfBlog()
            ],
            1 => [
                1 => "Nombre d'article publié",
                2 => $this->countNumberOfBlogByStatus(1)
            ],
            2 => [
                1 => "Nombre d'article dépublié",
                2 => $this->countNumberOfBlogByStatus(0)
            ],
            3 => [
                1 => "Nombre de commentaires",
                2 => $this->getAllComment()
            ],
            4 => [
                1 => "Nombre d'articles avec fichier",
                2 => $this->getNumberArticleWithFile()
            ]
        ]);
        return $StatsBlog->getArrayData();
    }

    public function getAllComment()
    {
        $joinParameter = [
            'blogcomment' => [
                'blog_id'
            ]
        ];
        $this->setLeftJoin($joinParameter);
        return $this->countData(['id']);
    }

    /**
     * @return array object
     * Permet de récupérer la configuration d'une modal pour ajouter un poste
     */
    public function getModalAddPost()
    {
        $BlocGeneral = new DashboardBlocModal();

        $routes = Access::getSlugsById();

        $BlocGeneral->setTitle("Principal menu");
        $BlocGeneral->setTableHeader([
            1 => "Action",
        ]);
        $BlocGeneral->setTableBodyClass([
            1 => "td-content-text",
        ]);
        $BlocGeneral->setColSizeBloc(3);
        $BlocGeneral->setTableBodyContent([
            0 => [
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["blog/add"]."/text",
                    "color" => "tosle",
                    "text" => "Add article"
                ]
            ],
            1 => [
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["blog/add"]."/image",
                    "color" => "tosle",
                    "text" => "Add image"
                ]
            ],
            2 => [
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["blog/add"]."/video",
                    "color" => "tosle",
                    "text" => "Add video"
                ]
            ]
        ]);
        return $BlocGeneral->getArrayData();
    }

    /**
     * @param string $content
     * @return string
     * Permet de récupérer un résumé de 200 caractères au maximum d'un contenu, le tout en enlevant certaines balises
     */
    public function getResumeContent($content){
        $contentValue = strip_tags($content, "<p>");
        $contentValue = str_replace("&nbsp;", "", $contentValue);
        $contentValue = str_replace("<p>", "", $contentValue);
        $contentValue = str_replace("</p>", " ", $contentValue);

        return (strlen($contentValue)>200)?substr($contentValue, 0, 200).'...':$contentValue;
    }

    /**
     * @return int
     * Permet de récupérer le nombre d'article qui possède une jointure avec un fichier
     */
    public function getNumberArticleWithFile()
    {
        $target = [
            "id"
        ];
        $parameter = [
            "NOT LIKE" => [
                "fileid" => null
            ]
        ];
        $this->setWhereParameter($parameter);
        return $this->countData($target);
    }

    /**
     * @param array $_file
     * @param array $_post
     * @param string $_type
     * @param int|bool $_idArticle
     * @return array|int
     * Permet d'ajouter un article et vérifie les informations. Retourne un tableau d'erreur s'il y en a une
     */
    public function addArticle($_file, $_post, $_type, $_idArticle = null)
    {
        switch($_type) {
            case "text":
                $configForm = $this->configFormAddArticleText();
                $typeBlog = 1;
                $inputContentName = "ckeditor_article";
                break;
            case "image":
                $configForm = $this->configFormAddArticleImage();
                $typeBlog = 2;
                $inputContentName = "textarea_articleImage";
                break;
            case "video":
                $configForm = $this->configFormAddArticleVideo();
                $typeBlog = 3;
                $inputContentName = "link";
                break;
            default:
                return $errorMsg["TYPE_UNDEFINED"] = "TYPE NOT FOUND";
                break;
        }
        $errors = Form::checkForm($configForm, $_post);
        $_post = Form::secureData($_post);
        if(empty($errors)){
            $file = null;
            if(isset($_file)){
                $errors = Form::checkFiles($_file);
                if(empty($errors) || is_numeric($errors)){
                    if( $errors != 1) {
                        $File = new FileRepository();
                        $arrayFile = $File->addFile($_FILES, $configForm, "Blog/Article", "Background image");
                        if(!is_numeric($arrayFile)){
                            if(array_key_exists('CODE_ERROR', $arrayFile)){
                                return $arrayFile;
                            }
                            foreach ($arrayFile as $fileId) {
                                $file = $fileId;
                            }
                        }

                    }
                } else {
                    if(!array_key_exists('EXCEPT_ERROR', $errors)){
                        return $errors;
                    }
                }
            }
            $tmpPostArray = $_post;
            if(isset($_idArticle)) {
                $this->setId($_idArticle);
            }

            $this->setTitle($tmpPostArray["title"]);
            $this->setContent($tmpPostArray[$inputContentName]);
            (isset($tmpPostArray["publish"]))?$this->setStatus(1):$this->setStatus(0);
            $this->setType($typeBlog);
            $this->setUrl(Access::constructUrl($this->getTitle()));
            $this->setFileid($file);
            $this->save();

            $this->getArticleByUrl($this->getUrl());

            if(isset($tmpPostArray["category_select"]) && !empty($tmpPostArray["category_select"]))
            {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryBySelect($tmpPostArray["category_select"], 'blog', $this->getId());
            }
            if(isset($tmpPostArray["category_input"]) && !empty($tmpPostArray["category_input"])){
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryByInput($tmpPostArray["category_input"], 'blog', $this->getId());
                if(!is_numeric($arrayCategory)){
                    if(array_key_exists('CODE_ERROR', $arrayCategory)){
                        return $arrayCategory;
                    }
                }

            }
            return 1;
        } else {
            return $errors;
        }
    }

    /**
     * @param $_idArticle
     * @return array|int
     * Cette fonction retourne les éléments nécessaires à l'affichage des formulaires pour editer un article
     */
    public function editArticle($_idArticle)
    {
        $this->getArticle($_idArticle);
        if(!empty($this->id)){
            $File = null;
            if(!empty($this->getFileid())){
                $File = new FileRepository();
                $File->getFileById($this->getFileid());
            }
            $category = new CategoryRepository();
            $categoryFounded = $category->getCategoryByIdentifier('blog', $this->id);
            switch($this->getType()){
                case 1:
                    $configForm = $this->configFormAddArticleText();
                    break;
                case 2:
                    $configForm = $this->configFormAddArticleImage();
                    break;
                case 3:
                    $configForm = $this->configFormAddArticleVideo();
                    break;
                default:
                    return -1;
                    break;
            }
            return $arrayObject = [
                "blog" => $this,
                "file" => $File,
                "selectedOption" => $categoryFounded,
                "configForm" => $configForm
            ];
        } else {
            return 0;
        }
    }

    /**
     * @param int $_numberArticle
     * @param array $_get
     * @return array
     * Cette fonction retourne une pagination pour les blogs en fonction d'un tableau envoyé
     */
    public function getPagination($_numberArticle, $_get = null)
    {
        $pagination = [];
        $numberTotalOfBlog = $this->countNumberOfBlogByStatus();
        $totalPage = ($numberTotalOfBlog != $_numberArticle)?(int)($numberTotalOfBlog / $_numberArticle):1;
        if($totalPage < $numberTotalOfBlog / $_numberArticle){
            $totalPage++;
        }
        if($totalPage <= 1) {
            return 0;
        }
        $position = (isset($_get['page']) && ($_get['page'] <= $totalPage && $_get['page'] >= 1))?$_get['page']:1;
        unset($_get['page']);
        $href = "";
        $arrayHref=[];
        foreach ($_get as $key => $value){
            $arrayHref[] = $key.'='.$value;
        }
        if(isset($_get) && !empty($_get)){
            $href = implode('&amp;', $arrayHref);
        }
        if($position != 1){
            if(!empty($href)){
                $pagination['first_page'] = Access::getSlugsById()['bloghome'].'?'.$href;
            } else {
                $pagination['first_page'] = Access::getSlugsById()['bloghome'];
            }
        }
        for($i=1; $i <= $totalPage; $i++){
            if($i > 1){
                if(!empty($href)){
                    $pagination[$i] = Access::getSlugsById()['bloghome'].'?page='.$i.'&amp;'.$href;
                } else {
                    $pagination[$i] = Access::getSlugsById()['bloghome'].'?page='.$i;
                }
            } else {
                if(!empty($href)){
                    $pagination[$i] = Access::getSlugsById()['bloghome'].'?'.$href;
                } else {
                    $pagination[$i] = Access::getSlugsById()['bloghome'].$href;
                }
            }
        }
        if($position != $totalPage){
            if(!empty($href)){
                $pagination['last_page'] = Access::getSlugsById()['bloghome'].'?page='.$totalPage.'&amp;'.$href;
            } else {
                $pagination['last_page'] = Access::getSlugsById()['bloghome'].'?page='.$totalPage;
            }
        }
        return $pagination;
    }

    public function getPlayerVideo($_contentArticle)
    {
        $parseUrl = parse_url($_contentArticle);
        switch($parseUrl['host']){
            case 'www.youtube.com':
                $query = explode('=', $parseUrl['query'])[1];
                return '<iframe width="800" height="500" src="https://www.youtube.com/embed/'.$query.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                break;
            case 'www.dailymotion.com':
                $query = $parseUrl['path'];
                return '<iframe frameborder="0" width="800" height="500" src="//www.dailymotion.com/embed/'.$query.'" allowfullscreen allow="autoplay"></iframe>';
                break;
            case 'vimeo.com':
                $query = explode('/', $parseUrl['path'])[3];
                return '<iframe src="https://player.vimeo.com/video/'.$query.'" width="800" height="500" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                break;
            default:
                return $_contentArticle;
                break;
        }
    }
    public function getAllArticle(){

        $target = [
            "id"
        ];

        $arrayAllArticle = $this->getData();
        return count($arrayAllArticle);
    }
}