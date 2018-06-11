<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class BlogController
{
    /**
     * @Route("/en/blog(/index)")
     * @param array $params
     * Default action of BlogController
     */
    function indexAction($params)
    {
        $View = new View("default", "Blog/home");
        $Blog = new BlogRepository();
        $Comment = new CommentRepository();
        $errors = [];
        if(!empty($params["GET"])){
            if(isset($params["GET"]["colsize"]))
                if($params["GET"]["colsize"] == "4" || $params["GET"]["colsize"] == "6" || $params["GET"]["colsize"] == "12")
                    $View->setData("col", $params["GET"]["colsize"]);
                else $View->setData("col", "6");
        } else {
            $View->setData("col", "6");
        }
        $array = $Blog->getAllArticleByStatus(1);
        $data = [];
        foreach($array as $content){
            $date = new DateTime($content->getDatecreate());
            $value["blog_datecreate"] = $date->format("l jS \of F Y H:i");
            $value["blog_title"] = $content->getTitle();


            $value["blog_content"] = $Blog->getResumeContent($content->getContent());
            $value["blog_status"] = $content->getStatus();
            $value["blog_id"] = $content->getId();
            $value["blog_url"] = $content->getUrl();
            $value["blog_numberComment"] = $Comment->getAll("number_blog", $content->getId());
            $data[] = $value;
        }
        $View->setData("data", $data);
    }

    /**
     * @Route("/en/view/{idArticle}")
     * @param array $params
     * View article action
     */
    function viewAction($params)
    {
        if(isset($params["URI"][0]) && !empty($params["URI"][0])){
            $View = new View("default", "Blog/view_article");
            $Blog = new BlogRepository();
            if($Blog->getArticleByUrl($params["URI"][0])){
                $article = [
                    "title" => $Blog->getTitle(),
                    "content" => $Blog->getContent(),
                    "datecreate" => $Blog->getDatecreate()
                ];
                $commentaires = null;
                $Comment = new CommentRepository();
                $comments = $Comment->getAll("blog", $Blog->getId());
                foreach($comments as $comment){
                    $commentaires[] = [
                        "id" => $comment->getId(),
                        "content" => $comment->getContent(),
                        "tag" => $comment->getTag()
                    ];
                }

                $View->setData("article_content", $article);
                $View->setData("commentaires", $commentaires);
            } else {
                echo "L'article demandé n'est pas disponible ou n'existe pas";
            }
        } else {
            header('Location:'.Access::getSlugsById()["bloghome"]);
        }


    }

    /**
     * @Route("/en/search/{params}")
     * @param array $params
     * View filtered article action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/add/{params}")
     * @param array $params
     * Add article
     */
    function addAction($params)
    {
        $routes = Access::getSlugsById();
        /**
         * On regarde si nous avons bien un paramètre dans une URL
         */
        if(isset($params["URI"][0])){
            $getTypeNewArticle = $params["URI"][0];
            $Blog = new BlogRepository();
            $View = new View("dashboard", "Dashboard/add_article_blog");

            if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $Blog->addArticle($_FILES, $params["POST"], $getTypeNewArticle);
                if($resultAdd == 1){
                    header('Location:'.$routes['dashboard_blog']);
                }
            }

            if($getTypeNewArticle == "text"){
                $View->setData("errors", "");
                $View->setData("configForm", $Blog->configFormAddArticleText());
            } elseif ($getTypeNewArticle == "image"){
                $View->setData("errors", "");
                $View->setData("configForm", $Blog->configFormAddArticleImage());
            } elseif ($getTypeNewArticle == "video"){
                $View->setData("errors", "");
                $View->setData("configForm", $Blog->configFormAddArticleVideo());
            } else {
                header('Location:'.$routes['dashboard_blog'].'/error');
            }
        } else {
            header('Location:'.$routes['dashboard_blog']);
        }
    }

    function editAction($params)
    {
        $routes = Access::getSlugsById();
        if(isset($params["URI"][0])){
            if(is_numeric($params["URI"][0])) {
                $Blog = new BlogRepository();
                $View = new View("dashboard", "Dashboard/add_article_blog");
                $arrayReturn = $Blog->editArticle($params["URI"][0]);
                $arrayBlog = $arrayReturn["blog"];
                $pathFile = (isset($arrayReturn["file"]))?$arrayReturn["file"]->getPath().$arrayReturn["file"]->getName():null;
                $configForm = $arrayReturn["configForm"];
                $configForm["content_value"] = [
                    "title" => $arrayBlog->getTitle(),
                    "content" => $arrayBlog->getContent(),
                    "link" => $arrayBlog->getContent(),
                    "file" => $pathFile,
                ];
                switch($arrayBlog->getType()){
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
                    $resultAdd = $Blog->addArticle($_FILES, $params["POST"], $typeArticle, $params["URI"][0]);
                    if($resultAdd == 1){
                        header('Location:'.$routes['dashboard_blog']);
                    }
                }
                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            }
            /*
            if(is_numeric($getIdArticle)){
                $View = new View("dashboard", "Dashboard/add_article_blog");
                $Blog = new BlogRepository();
                $configForm = $Blog->configFormAddArticleText();

                $Blog->getArticle($getIdArticle);
                switch ($Blog->getType()){
                    case 1:
                        if(isset($params["POST"])){
                            if(!empty($params["POST"])) {
                                $tmpArray = $params["POST"];
                                $Blog->setTitle($tmpArray["title"]);
                                $Blog->setContent($tmpArray["textArea_article"]);
                                (isset($tmpArray["publish"]))?$Blog->setStatus(1):$Blog->setStatus(0);
                                $Blog->setType(1);
                                $Blog->save();
                                header('Location:'.$routes['dashboard_blog']);
                            }
                        }
                        $configForm["content_value"] = [
                            "title" => $Blog->getTitle(),
                            "ckeditor" => $Blog->getContent()
                        ];
                        break;
                    default:
                        header('Location:'.$routes['dashboard_blog']);
                        break;
                }
                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            }*/
        } else {
            header('Location:'.$routes['dashboard_blog']);
        }
    }

    function statusAction($params)
    {
        $routes = Access::getSlugsById();
        $Blog = new Blog();

        $target = [
            "id",
            "status"
        ];
        $parameter = [
            "LIKE" => [
                "id" => $params["URI"][0]
            ]
        ];
        $Blog->setWhereParameter($parameter);
        $Blog->getOneData($target);
        if($Blog->getId()){
            if($Blog->getStatus() > 0){
                $Blog->setStatus(0);
            } else {
                $Blog->setStatus(1);
            }
            $Blog->save();
        }

        header('Location:'.$routes["dashboard_blog"]);
    }
}