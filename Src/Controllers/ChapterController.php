<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 21/06/2018
 * Time: 10:48
 */

class ChapterController
{
    public function addAction($params)
    {
        $routes = Access::getSlugsById();
        /**
         * On regarde si nous avons bien un paramètre dans une URL
         */
        if(isset($params["URI"][0])){
            $getTypeNewArticle = $params["URI"][0];
            $Chapter = new ChapterRepository();
            $View = new View("dashboard", "Dashboard/add_chapter");
            $View->setData("errors", "");
            if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $Chapter->addChapter($_FILES, $params["POST"]);
                if($resultAdd === 1){
                    header('Location:'.$routes['dashboard_lesson']);
                } else {
                    $View->setData("errors", $resultAdd);
                }
            }
            if($getTypeNewArticle == "chapter"){
                $View->setData("configForm", $Chapter->configFormAdd());
            }  else {
                header('Location:'.$routes['dashboard_lesson'].'/error');
            }
        } else {
            header('Location:'.$routes['dashboard_lesson']);
        }
    }

    /**
     * @param $params
     * Récupère l'id de l'article et modifie le status
     */
    public function statusAction($params)
    {
        $routes = Access::getSlugsById();
        if(is_numeric($params["URI"][0])){
            $Lesson = new LessonRepository();

            $target = [
                "id",
                "status"
            ];
            $parameter = [
                "LIKE" => [
                    "id" => $params["URI"][0]
                ]
            ];
            $Lesson->setWhereParameter($parameter);
            $Lesson->getOneData($target);
            if($Lesson->getId()){
                if($Lesson->getStatus() > 0){
                    $Lesson->setStatus(0);
                } else {
                    $Lesson->setStatus(1);
                }
                $Lesson->save();
            }
        }

        header('Location:'.$routes["dashboard_lesson"]);
    }
}