<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class ClassController
{
    /**
     * @Route("/en/class(/index)")
     * @param array $params
     * Default action of ClassController
     */
    function indexAction($params)
    {
       // $View = new View("default");
        $View = new View("default", "Class/home");
        $Class = new Lesson();
        $errors = [];
        if(!empty($params["GET"])){
            echo "Il y a une recherche";
        } else {
            $target = [
                "title",
                "description",
                "datecreate",
                "id"
            ];
            $parameter = [
                "LIKE" => [
                    "status" => 1
                ]
            ];

            $Class->setWhereParameter($parameter, null);
            $Class->setOrderByParameter(["id"=>"DESC"]);
            $Class->setLimitParameter(5, 0);
            $array = $Class->getData($target);
            $data = [];

            foreach($array as $content){
                $date = new DateTime($content->getDatecreate());
                $value["lesson_datecreate"] = $date->format("l jS \of F Y H:i");
                $value["lesson_title"] = $content->getTitle();

                $contentValue = strip_tags($content->getContent(), "<p>");
                $contentValue = str_replace("&nbsp;", "", $contentValue);
                $contentValue = str_replace("<p>", "", $contentValue);
                $contentValue = str_replace("</p>", " ", $contentValue);
                $value["lesson_description"] = (strlen($contentValue)>200)?substr($contentValue, 0, 200):$contentValue;
                $value["lesson_status"] = $content->getStatus();
                $value["lesson_id"] = $content->getId();
                $data[] = $value;
            }

            $View->setData("data", $data);
            $View->setData("col", "6");
        }
    }

    /**
     * @Route("/en/class/{idArticle}")
     * @param array $params
     * View lessons action
     */
    function viewAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/class/{params}")
     * @param array $params
     * View filtered lessons action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/class/{params}")
     * @param array $params
     * View filtered lessons action
     */
    function addAction($params)
    {
        $routes = Access::getSlugsById();
        /**
         * On regarde si nous avons bien un paramètre dans une URL
         */
        if(isset($params["URI"][0])){
            $getTypeURI = $params["URI"][0];
            $View = new View("dashboard", "Dashboard/add_lesson");
            $Lesson = new LessonRepository();
            $View->setData("errors", "");
            if((isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $Lesson->addLesson($params["POST"]);
                if($resultAdd === 1){
                    header('Location:'.$routes['dashboard_lesson']);
                } else {
                    $View->setData("errors", $resultAdd);
                }
            }

            if($getTypeURI == "lesson"){
                $View->setData("configForm", $Lesson->configFormAddLesson());
            } else {
                header('Location:'.$routes['dashboard_lesson'].'/error');
            }
        } else {
            header('Location:'.$routes['dashboard_lesson']);
        }
    }
}