<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 29/04/2018
 * Time: 23:19
 */

class PortfolioRepository extends Portfolio
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
        /**
         * @param integer $status
         * @return integer
         * Retourne le nombre d'article de la table Portfolio en fonction du status (par défaut vaut 1 (publié))
         */
    /* public function countNumberOfBlogByStatus($status = 1)
     {
         $this->setWhereParameter([
             "LIKE" => [
                 "status" => $status
             ]
         ]);
         return $this->countData(["id"]);
     }
 */
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
        $this->getOneData(["id", "name", "value", "type", "title", "content", "url", "status", "fileid"]);
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
            "name",
            "title",
            "value",
            "type",
            "content",
            "type",
            "url",
            "fileid"

        ];
        $parameter = [
            "LIKE" => [
                "url" => $url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
        if (!isset($this->id)) {
            return false;
        } else {
            return true;
        }
    }






    /**
     * @param int $status
     * @param int $max
     * @param int $min
     * @return array|boolean
     * Retourne tous les articles par rapport à un status
     */
      public function getAllArticleByStatus($status = 1, $max = null, $min = 0)
      {
          if(is_numeric($status))
          {
              $target = [
                  "title",
                  "id",
                  "name",
                  "value",
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
              $this->setWhereParameter([
                  "LIKE" => [
                      "status" => $status
                  ]
              ]);
              return $this->getData($target);
          }
          return false;
      }


    /**
     * @param int $colSize
     * @return array
     * Permet de récupérer la configuration de la modal "LastArticle"
     * Le paramètre permet de définir une largeur à notre modal
     */
    public function getModalLatestArticle($colSize = 12)
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
            "target" => $routes["portfolio/status"] . "/"
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["portfolio/status"] . "/"
        ]);
        $ViewLatestBloc->setActionButtonEdit("Edit");
        $ViewLatestBloc->setActionButtonView("View");

        $ViewLatestBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        $ViewLatestBloc->setTableBodyContent($this->getLatestArticle(5), true);
        $ViewLatestBloc->setArrayHref("edit", $routes["portfolio/edit"]);
        $ViewLatestBloc->setArrayHref("view", $routes["view_portfolio_article"]);
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
        if ($status === 1)
            $ViewArticleBloc->setTitle("View article with the status : Publish");
        else if ($status === 0)
            $ViewArticleBloc->setTitle("View article with the status : Unpublish");
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
            "target" => $routes["portfolio/status"] . "/"
        ]);
        $ViewArticleBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["portfolio/status"] . "/"
        ]);
        $ViewArticleBloc->setActionButtonEdit("Edit");
        $ViewArticleBloc->setActionButtonView("View");

        $ViewArticleBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        $ViewArticleBloc->setTableBodyContent($this->getAllArticleByStatus($status), true);
        $ViewArticleBloc->setArrayHref("edit", $routes["portfolio/edit"]);
        $ViewArticleBloc->setArrayHref("view", $routes["view_portfolio_article"]);
        return $ViewArticleBloc->getArrayData();
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
            1 => "Name of action",
            2 => "Action"
        ]);
        $BlocGeneral->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-action"
        ]);
        $BlocGeneral->setColSizeBloc(6);
        $BlocGeneral->setTableBodyContent([
            0 => [
                1 => "Nouveau post de type texte",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["portfolio/add"] . "/text",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ],
            1 => [
                1 => "Nouveau post de type image",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["portfolio/add"] . "/image",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ],
            2 => [
                1 => "Nouveau post de type vidéo",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["portfolio/add"] . "/video",
                    "color" => "tosle",
                    "text" => "New post"
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
    public function getResumeContent($content)
    {
        $contentValue = strip_tags($content, "<p>");
        $contentValue = str_replace("&nbsp;", "", $contentValue);
        $contentValue = str_replace("<p>", "", $contentValue);
        $contentValue = str_replace("</p>", " ", $contentValue);

        return (strlen($contentValue) > 200) ? substr($contentValue, 0, 200) . '...' : $contentValue;
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
    public function addArticleP($_file, $_post, $_type, $_idArticle = null)
    {
        switch ($_type) {
            case "text":
                $configForm = $this->configFormAddAPortfolio();
                $typeBlog = 1;
                $inputContentName = "ckeditor_article";
                break;
            case "image":
                $configForm = $this->configFormAddArticleImagePortfolio();
                $typeBlog = 2;
                $inputContentName = "textarea_articleImage";
                break;
            case "video":
                $configForm = $this->configFormAddArticleVideoPortfolio();
                $typeBlog = 3;
                $inputContentName = "link";
                break;
            default:
                return $errorMsg["TYPE_UNDEFINED"] = "TYPE NOT FOUND";
                break;
        }
        $errors = Form::checkForm($configForm, $_post);
        $_post = Form::secureData($_post);
        if (empty($errors)) {
            $file = null;
            if (isset($_file)) {
                $errors = Form::checkFiles($_file);
                if (empty($errors) || is_numeric($errors)) {
                    if ($errors != 1) {
                        $File = new FileRepository();
                        $arrayFile = $File->addFile($_FILES, $configForm, "portfolio-view", "Background image");
                        if (!is_numeric($arrayFile)) {
                            if (array_key_exists('CODE_ERROR', $arrayFile)) {
                                return $arrayFile;
                            }
                            foreach ($arrayFile as $fileId) {
                                $file = $fileId;
                            }
                        }

                    }
                } else {
                    if (!array_key_exists('EXCEPT_ERROR', $errors)) {
                        return $errors;
                    }
                }
            }
            $tmpPostArray = $_post;
            if (isset($_idArticle)) {
                $this->setId($_idArticle);
            }

            $this->setTitle($tmpPostArray["title"]);
            $this->setContent($tmpPostArray[$inputContentName]);
            (isset($tmpPostArray["publish"])) ? $this->setStatus(1) : $this->setStatus(0);
            $this->setType($typeBlog);
            $this->setName();
            $this->setUrl(Access::constructUrl($this->getTitle()));
            $this->setValue();
            $this->setFileid($file);
            $this->save();

            $this->getArticleByUrl($this->getUrl());

            if (isset($tmpPostArray["category_select"]) && !empty($tmpPostArray["category_select"])) {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryBySelect($tmpPostArray["category_select"], 'portfolio', $this->getId());
            }
            if (isset($tmpPostArray["category_input"]) && !empty($tmpPostArray["category_input"])) {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryByInput($tmpPostArray["category_input"], 'portfolio', $this->getId());
                if (!is_numeric($arrayCategory)) {
                    if (array_key_exists('CODE_ERROR', $arrayCategory)) {
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
        if (!empty($this->id)) {
            $File = null;
            if (!empty($this->getFileid())) {
                $File = new FileRepository();
                $File->getFileById($this->getFileid());
            }
            $category = new CategoryRepository();
            $categoryFounded = $category->getCategoryByIdentifier('portfolio', $this->id);
            switch ($this->getType()) {
                case 1:
                    $configForm = $this->configFormAddPortfolio();
                    break;
                case 2:
                    $configForm = $this->configFormAddArticleImagePortfolio();
                    break;
                case 3:
                    $configForm = $this->configFormAddArticleVideoPortfolio();
                    break;
                default:
                    return -1;
                    break;
            }
            return $arrayObject = [
                "portfolio" => $this,
                "file" => $File,
                "selectedOption" => $categoryFounded,
                "configForm" => $configForm
            ];
        } else {
            return 0;
        }
    }
}
  /*  /**
     * @param int $_numberArticle
     * @param array $_get
     * @return array
     * Cette fonction retourne une pagination pour les blogs en fonction d'un tableau envoyé
     */
   /* public function getPagination($_numberArticle, $_get = null)
    {
        $pagination = [];
        $numberTotalOfPortfolio = $this->countNumberOfPortfolioByStatus();
        $totalPage = ($numberTotalOfPortfolio != $_numberArticle)?(int)($numberTotalOfPortfolio / $_numberArticle):1;
        if($totalPage < $numberTotalOfPortfolio / $_numberArticle){
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
                $pagination['first_page'] = Access::getSlugsById()['portfoliohome'].'?'.$href;
            } else {
                $pagination['first_page'] = Access::getSlugsById()['portfoliohome'];
            }
        }
        for($i=1; $i <= $totalPage; $i++){
            if($i > 1){
                if(!empty($href)){
                    $pagination[$i] = Access::getSlugsById()['portfoliohome'].'?page='.$i.'&amp;'.$href;
                } else {
                    $pagination[$i] = Access::getSlugsById()['portfoliohome'].'?page='.$i;
                }
            } else {
                if(!empty($href)){
                    $pagination[$i] = Access::getSlugsById()['portfoliohome'].'?'.$href;
                } else {
                    $pagination[$i] = Access::getSlugsById()['portfoliohome'].$href;
                }
            }
        }
        if($position != $totalPage){
            if(!empty($href)){
                $pagination['last_page'] = Access::getSlugsById()['portfoliohome'].'?page='.$totalPage.'&amp;'.$href;
            } else {
                $pagination['last_page'] = Access::getSlugsById()['portfoliohome'].'?page='.$totalPage;
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
    }}
   */