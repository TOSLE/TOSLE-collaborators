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
            $configForm = $Chapter->configFormAdd();
            $View = new View("dashboard", "Dashboard/add_chapter");
            $View->setData("errors", "");
            if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $Chapter->addChapter($_FILES, $params["POST"]);
                if($resultAdd === 1){
                    header('Location:'.$routes['dashboard_lesson']);
                } else {
                    $View->setData("errors", $resultAdd);
                    $configForm["data_content"] = [
                        "title" => $params["POST"]["title"],
                        "select_lesson" => $params["POST"]["select_lesson"],
                        "content" => $params["POST"]["ckeditor_chapter"],
                    ];
                }
            }
            if($getTypeNewArticle == "chapter"){
                $View->setData("configForm", $configForm);
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
        if(is_numeric($params["URI"][1])){
            $Chapter = new ChapterRepository();

            $target = [
                "id",
                "status"
            ];
            $parameter = [
                "LIKE" => [
                    "id" => $params["URI"][1]
                ]
            ];
            $Chapter->setWhereParameter($parameter);
            $Chapter->getOneData($target);
            if($Chapter->getId()){
                if($Chapter->getStatus() > 0){
                    $Chapter->setStatus(0);
                } else {
                    $Chapter->setStatus(1);
                }
                $Chapter->save();
            }
        }

        header('Location:'.$routes["dashboard_chapter"].'/'.$params["URI"][0]);
    }

    /**
     * @param $params
     * Récupère l'id de l'article et modifie le status
     */
    public function orderAction($params)
    {
        $routes = Access::getSlugsById();
        if(is_numeric($params["URI"][1])){
            $Chapter = new ChapterRepository();
            $target = [
                "id",
                "status"
            ];
            $parameter = [
                "LIKE" => [
                    "id" => $params["URI"][1]
                ]
            ];
            $Chapter->setWhereParameter($parameter);
            $Chapter->getOneData($target);
            if($Chapter->getId()){
                if($Chapter->getStatus() > 0){
                    $Chapter->setStatus(0);
                } else {
                    $Chapter->setStatus(1);
                }
                $Chapter->save();
            }
        }

        //header('Location:'.$routes["dashboard_chapter"].'/'.$params["URI"][0]);
    }
}