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
                "id"
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
        $View = new View("default");
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
        if(isset($params["URI"][0])){
            $getTypeNewArticle = $params["URI"][0];
            if($getTypeNewArticle == "text"){
                $View = new View("dashboard", "Dashboard/add_article_blog");
                $Blog = new BlogRepository();
                $configForm = $Blog->configFormAddArticleText();
                if(isset($params["POST"])){
                    $tmpArray = $params["POST"];
                    $Blog->setTitle($tmpArray["title"]);
                    $Blog->setContent($tmpArray["textArea_article"]);
                    (isset($tmpArray["publish"]))?$Blog->setStatus(1):$Blog->setStatus(0);
                    $Blog->save();
                }

                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            } else {
                echo "Le chemin n'existe pas";
            }
        } else {
            echo "coucou";
        }
    }

    function statusAction($params)
    {
        global $language;

        $Access = new Access();
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


        $redirection = $Access->getSlugs($language);

        header('Location:'.$redirection["dashboard_blog"]);
    }
}