<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 27/03/2018
 * Time: 22:44
 */

class PortfolioController
{
    /**
     * @Route("/en/portfolio(/index)")
     * @param array $params
     * Default action of PortfolioController
     */
    function indexAction($params)
    {
        $View = new View("default", "Portfolio/home");
        $portfolio = new PortfolioRepository();
        $Comment = new CommentRepository();
        $Category = new CategoryRepository();
        $routes = Access::getSlugsById();
        /**
         * Default var
         */
        $colSize = 6;
        $numberPortfolio = 6;
        $page = 1;
        $offset = 0;
        //  $pagination = $Portfolio->getPagination($numberPortfolio, $params["GET"]);
        $errors = [];
        if (!empty($params["GET"])) {
            if (isset($params["GET"]["colsize"])) {
                if ($params["GET"]["colsize"] == "4" || $params["GET"]["colsize"] == "6" || $params["GET"]["colsize"] == "12") {
                    $colSize = $params["GET"]["colsize"];
                }
            }
            if (isset($params["GET"]["number"])) {
                if ($params["GET"]["number"] >= 1 || $params["GET"]["number"] <= 12) {
                    $numberPortfolio = $params["GET"]["number"];
                    // $pagination = $Portfolio->getPagination($numberPortfolio, $params["GET"]);
                }
            }
            if (isset($params['GET']['page']) && array_key_exists($params['GET']['page'])) {
                $page = $params['GET']['page'];
                $offset = $numberPortfolio * $page - $numberPortfolio;
            }
        }
        $array = $portfolio->getAllArticleByStatus(1, $numberPortfolio, $offset);
        $data = [];
        foreach ($array as $content) {
            $File = new FileRepository();
            $portfolio = new PortfolioRepository();

            $value["portfolio_title"] = $content->getTitle();
            $value["portfolio_content"] = $portfolio->getResumeContent($content->getContent());
            $value["portfolio_status"] = $content->getStatus();
            $value["portfolio_id"] = $content->getId();
            $value["portfolio_url"] = $content->getUrl();
            $value["portfolio_name"] = $content->getName();
            $value["portfolio_value"] = $content->getValue();
            $value["category"] = $Category->getCategoryByIdentifier('portfolio', $content->getId());
            $value["image"] = $File->getFileById($content->getFileid());
            $data[] = $value;
        }
        // $View->setData("urlPortfoliofeed", $routes['rss_portfolio']);
        //  $View->setData("pagination", $pagination);
        $View->setData("page", $page);
        $View->setData("data", $data);
        $View->setData("col", $colSize);
    }




    /**
     * @Route("/en/view/{idArticle}")
     * @param array $params
     * View article action
     */
    function viewAction($params)
    {
        if(isset($params["URI"][0]) && !empty($params["URI"][0])){
            $View = new View("default", "Portfolio/view_article");
            $View->setData('errors', false);
            $portfolio = new PortfolioRepository();
            $Comment = new CommentRepository();
            $Category = new CategoryRepository();
            $configFormComment = $Comment->configFormAdd();
            if($portfolio->getArticleByUrl($params["URI"][0])){
                if(isset($params['POST']) && !empty($params['POST'])){
                    $errors = $Comment->addComment($configFormComment, $params['POST'], 1, $portfolio->getId());
                    if(empty($errors)){
                        header('Location:'.Access::getSlugsById()["view_portfolio_article"].'/'.$params["URI"][0]);
                    }
                    $View->setData('errors', $errors);
                }
                $article = [
                    "title" => $portfolio->getTitle(),
                    "content" => $portfolio->getContent(),
                    "value"=>$portfolio->getValue(),
                    "image"=>$portfolio->getFileid(),
                    "url" => $portfolio->getUrl(),
                    "status" => $portfolio->getStatus(),
                    "type"=> $portfolio->getType(),
                    "category"=> $Category->getCategoryByIdentifier('portfolio', $portfolio->getId()),
                ];
                if($portfolio->getType() == 3){
                    $article['content'] = $portfolio->getPlayerVideo($portfolio->getContent());
                }
                $commentaires = null;
                $comments = $Comment->getAll("portfolio", $portfolio->getId());
                foreach($comments as $comment){
                    $author = $Comment->getAuthorComment($comment->getId());
                    $date = new DateTime($comment->getDateupdated());

                    $commentaires[] = [
                        "id" => $comment->getId(),
                        "content" => $comment->getContent(),
                        "firstname" => $author['firstname'],
                        "lastname" => $author['lastname'],
                        "date" => $date->format("l jS \of F Y H:i"),

                    ];
                }

                $View->setData("article_content", $article);
                $View->setData("commentaires_all", $commentaires);
                if(isset($commentaires)){
                    $View->setData("commentaires_last", array_slice($commentaires, 0, 5));
                }
                $View->setData("formAddComment", $configFormComment);

            } else {
                echo "L'article demandé n'est pas disponible ou n'existe pas";
            }
        } else {git
            header('Location:'.Access::getSlugsById()["portfoliohome"]);
        }


    }



    /**
     * @Route("/en/portfolio/add/{params}")
     * @param array $params
     * Add Block
     */


    function addAction($params)
    {
        $routes = Access::getSlugsById();
        /**
         * On regarde si nous avons bien un paramètre dans une URL
         */{
        $View = new View("portfolio", "Portfolio/add_article_portfolio");
        $routes = Access::getSlugsById();
        $portfolio = New PortfolioRepository();
        $form = $portfolio->configFormAddPortfolio();
        if (!empty($params["POST"])) {
            $errors = Form::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $portfolio->setId($params["id"]);
                $portfolio->setName($params["name"]);
                $portfolio->setValue($params["value"]);
                $portfolio->settype($params["type"]);
                $portfolio->setContent($params["content"]);
                $portfolio->setStatus($params["status"]);
                $portfolio->setUrl($params["url"]);
                $portfolio->settitle($params["title"]);
                $portfolio->save();
            } else {
                $form["data_content"] = [
                    "content" => $params["content"],
                    "title" => $params["title"],
                    "type" => $params["type"],
                ];
            }
        }
        echo '<pre>';
        print_r($portfolio);
        echo '</pre>';
        $View->setData("config", $form);
        $View->setData("errors", "");
    }
       if(isset($params["URI"][0])){
            $getTypeNewArticle = $params["URI"][0];
            $portfolio = New PortfolioRepository();

            if($getTypeNewArticle == "text"){
                $configForm = $portfolio->configFormAddPortfolio();
                if(isset($params["POST"]["ckeditor_article"])){
                    $contentInputName = $params["POST"]["ckeditor_article"];
                }
            } elseif ($getTypeNewArticle == "image"){
                $configForm = $portfolio->configFormAddArticleImagePortfolio();
                if(isset($params["POST"]["textarea_articleImage"])){
                    $contentInputName = $params["POST"]["textarea_articleImage"];
                }
            } elseif ($getTypeNewArticle == "video"){
                $configForm = $portfolio->configFormAddArticleVideoPortfolio();
                if(isset($params["POST"]["link"])){
                    $contentInputName = $params["POST"]["link"];
                }
            } else {
                header('Location:'.$routes['dashboard_portfolio'].'/error');
            }


            $View = new View("Dashboard", "Dashboard/add_article_portfolio");
            $View->setData("errors", "");
            if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $portfolio->addArticle($_FILES, $params["POST"], $getTypeNewArticle);
                if($resultAdd === 1){
                    $GeneratorXML = new GeneratorXML('portfoliofeed');
                    $GeneratorXML->setBlogFeed($portfolio->getAllArticleByStatus(1));
                    header('Location:'.$routes['dashboard_portfolio']);
                } else {
                    $View->setData("errors", $resultAdd);
                    $configForm["data_content"] = [
                        "title" => $params["POST"]["title"],

                        "select_lesson" => $params["POST"]["select_lesson"],
                        "category_input" => $params["POST"]["category_input"],
                        "content" => $contentInputName,
                        "link" => $contentInputName,
                    ];
                }
            }
            $View->setData("configForm", $configForm);
        } else {
            header('Location:'.$routes['dashboard_portfolio']);
        }echo '<pre>';
        print_r($portfolio);
        echo '</pre>';
        $View->setData("config", $form);
        $View->setData("errors", "");

    }

















    /*   $form = $portfolio->configFormAddArticleImagePortfolio();
       if (!empty($params["POST"])) {
           $errors = Form::checkForm($form, $params["POST"]);
           if (empty($errors)) {
               $portfolio->setId($params["id"]);
               $portfolio->setName($params["name"]);
               $portfolio->setValue($params["value"]);
               $portfolio->settype($params["type"]);
               $portfolio->setContent($params["content"]);
               $portfolio->setStatus($params["status"]);
               $portfolio->setUrl($params["url"]);
               $portfolio->settitle($params["title"]);
               $portfolio->save();


           } else {
               $form["data_content"] = [
                   "content" => $params["content"],
                   "title" => $params["title"],
                   "type" => $params["type"],

               ];
           }

       }
       echo '<pre>';
       print_r($portfolio);
       echo '</pre>';
       $View->setData("config", $form);
       $View->setData("errors", "");
    }
    if (isset($params["URI"][0])) {
       $getTypeURI = $params["URI"][0];

       $View->setData("errors", "");
       if ((isset($params["POST"]) && !empty($params["POST"]))) {
           $resultAdd = $portfolio->addportfolio($params["POST"]);
           if ($resultAdd === 1) {
               header('Location:' . $routes['portfolio-view/add']);
           } else {
               $View->setData("errors", $resultAdd);
           }}}

    */

    public function editAction($params)
    {
        $routes = Access::getSlugsById();
        if (isset($params["URI"][0])) {
            if (is_numeric($params["URI"][0])) {
                $portfolio = new PortfolioRepository();
                $File= new FileRepository();
                $View = new View("Portfolio", "Portfolio/add_article_portfolio");
                $arrayReturn = $portfolio->editArticle($params["URI"][0]);
                $arrayPortfolio = $arrayReturn["portfolio"];
                $pathFile = (isset($arrayReturn["file"]))?$arrayReturn["file"]->getPath().$arrayReturn["file"]->getName():null;
                $configForm = $arrayReturn["configForm"];
                $configForm["data_content"] = [
                    "title" => $arrayPortfolio->getTitle(),
                    "content" => $arrayPortfolio->getContent(),
                    "link" => $arrayPortfolio->getContent(),
                    "value"=> $arrayPortfolio ->getContent(),
                    "file_img" => $pathFile,
                    "name"=>$arrayPortfolio->getName(),
                    "select_color" => $arrayPortfolio->getColor(),
                    "selectedOption" => $arrayReturn['selectedOption'],
                    "select_type" => $arrayPortfolio->getType(),

                ];

                switch($arrayPortfolio->getType()){
                    case 1:
                        $typeArticle = "text";
                        break;
                    case 2:
                        $typeArticle = "image";
                        break;
                    case 3:
                        $typeArticle = "video";
                        break;
                    default:
                        return -1;
                        break;

                }
                if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                    $resultAdd = $portfolio->addArticle($_FILES, $params["POST"], $typeArticle, $params["URI"][0]);
                    if($resultAdd == 1){
                        header('Location:'.$routes['dashboard_portfolio']);
                    }
                }
                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            }
        } else {
            header('Location:'.$routes['dashboard_portfolio']);
        }
    }












    /*     if (isset($params["POST"]) && !empty($params["POST"])) {
             $resultAdd = $File->addFile($params["POST"], $params["URI"][0]);
             if ($resultAdd == 1) {
                 header('Location:' . $routes['portfolio-view']);
             }
         }
         $View->setData("errors", "");
         $View->setData("configForm", $configForm);
     }
    } else {
     header('Location:' . $routes['portfolio-view-add']);
    }
    }
    */



    function statusAction($params)
    {
        $routes = Access::getSlugsById();
        if (is_numeric($params["URI"][0])) {
            $portfolio = new Portfolio();

            $target = [
                "id",
                "status"
            ];
            $parameter = [
                "LIKE" => [
                    "id" => $params["URI"][0]
                ]
            ];
            $portfolio->setWhereParameter($parameter);
            $portfolio->getOneData($target);
            if ($portfolio->getId()) {
                if ($portfolio->getStatus() > 0) {
                    $portfolio->setStatus(0);
                } else {
                    $portfolio->setStatus(1);
                }
                $portfolio->save();
            }

            header('Location:' . $routes["dashboard_portfolio"]);

        }
    }}