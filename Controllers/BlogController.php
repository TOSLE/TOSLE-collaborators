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
            $response = $Blog->getData($target, $parameter);
            $data = [];
            foreach($response as $key => $value){
                $date = new DateTime($value["blog_datecreate"]);
                $value["blog_datecreate"] = $date->format("l jS \of F Y H:i");
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
        $View = new View("dashboard", "Dashboard/add_article_blog");
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