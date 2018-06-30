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
        if(isset($params["URI"][0]) && isset($params["URI"][1]) && isset($params["URI"][2])){
            if(is_numeric($params["URI"][2])){
                $Chapter = new ChapterRepository();
                if($Chapter->orderUpdate($params["URI"][1], $params["URI"][2])) {
                    header('Location:'.$routes["dashboard_chapter"].'/'.$params["URI"][0]);
                } else {
                    header('Location:'.$routes["dashboard_chapter"].'/'.$params["URI"][0].'?error=1');
                }
            }
        } else {
            header('Location:'.$routes["dashboard_lesson"].'?error=1');
        }

    }

    public function editAction($params)
    {
        $routes = Access::getSlugsById();
        if(isset($params["URI"][1])){
            if(is_numeric($params["URI"][1])) {
                $errors = "";
                $Chapter = new ChapterRepository();
                $View = new View("dashboard", "Dashboard/add_chapter");
                $arrayReturn = $Chapter->editChapter($params["URI"][1]);
                $arrayChapter = $arrayReturn["chapter"];
                $pathFile = (isset($arrayReturn["file"]))?$arrayReturn["file"]->getPath().$arrayReturn["file"]->getName():null;
                $configForm = $arrayReturn["configForm"];
                $configForm["data_content"] = [
                    "title" => $arrayChapter->getTitle(),
                    "content" => $arrayChapter->getContent(),
                    "file_path" => $pathFile,
                    "select_lesson" => $arrayChapter->getLessonchapter()->getLessonId()
                ];
                if(isset($params["POST"]) && !empty($params["POST"])){
                    $errors = $Chapter->addChapter($_FILES, $params["POST"], $params["URI"][1]);
                    if($errors === 1){
                        header('Location:'.$routes["dashboard_chapter"].'/'.$params["URI"][0]);
                    }
                }
                $View->setData("errors", $errors);
                $View->setData("configForm", $configForm);
            }
        } else {
            header('Location:'.$routes["dashboard_chapter"].'/'.$params["URI"][0]);
        }
    }
}