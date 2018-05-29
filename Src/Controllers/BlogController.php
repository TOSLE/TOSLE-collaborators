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
        $Blog = new Blog();
        $errors = [];
        if(!empty($params["GET"])){
            echo "Il y a une recherche";
        } else {
            $target = [
                "title",
                "content",
                "datecreate",
                "id",
                "url"
            ];
            $parameter = [
                "LIKE" => [
                    "status" => 1
                ]
            ];
            $Blog->setWhereParameter($parameter, null);
            $Blog->setOrderByParameter(["id"=>"DESC"]);
            $Blog->setLimitParameter(6, 0);
            $array = $Blog->getData($target);
            $data = [];
            foreach($array as $content){
                $date = new DateTime($content->getDatecreate());
                $value["blog_datecreate"] = $date->format("l jS \of F Y H:i");
                $value["blog_title"] = $content->getTitle();

                $contentValue = strip_tags($content->getContent(), "<p>");
                $contentValue = str_replace("&nbsp;", "", $contentValue);
                $contentValue = str_replace("<p>", "", $contentValue);
                $contentValue = str_replace("</p>", " ", $contentValue);
                $value["blog_content"] = (strlen($contentValue)>200)?substr($contentValue, 0, 200):$contentValue;
                $value["blog_status"] = $content->getStatus();
                $value["blog_id"] = $content->getId();
                $value["blog_url"] = $content->getUrl();
                $data[] = $value;
            }
            $View->setData("data", $data);
            $View->setData("col", "6");
        }

    }

    /**
     * @Route("/en/view/{idArticle}")
     * @param array $params
     * View article action
     */
    function viewAction($params)
    {
        $View = new View("default", "Blog/view_article");
        $Blog = new BlogRepository();
        $Blog->getArticleByUrl($params["URI"][0]);
        $data = [
            "title" => $Blog->getTitle(),
            "content" => $Blog->getContent(),
            "datecreate" => $Blog->getDatecreate()
        ];
        $View->setData("data", $data);
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
        if(isset($params["URI"][0])){
            $getTypeNewArticle = $params["URI"][0];
            $Blog = new BlogRepository();
            if($getTypeNewArticle == "text"){
                $View = new View("dashboard", "Dashboard/add_article_blog");
                $configForm = $Blog->configFormAddArticleText();
                if(isset($params["POST"])){
                    if(!empty($params["POST"])) {
                        $tmpArray = $params["POST"];
                        $Blog->setTitle($tmpArray["title"]);
                        $Blog->setContent($tmpArray["textArea_article"]);
                        (isset($tmpArray["publish"]))?$Blog->setStatus(1):$Blog->setStatus(0);
                        $Blog->setType(1);
                        $Blog->setUrl(Access::constructUrl($Blog->getTitle()));
                        $Blog->save();
                        header('Location:'.$routes['dashboard_blog']);
                    }
                }

                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
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
            $getIdArticle = $params["URI"][0];
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
            }
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