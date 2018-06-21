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
            $getTypeURI = $params["URI"][0];
            $View = new View("dashboard", "Dashboard/add_chapter");
            $Chapter = new ChapterRepository();
            $View->setData("errors", "");

            if($getTypeURI == "chapter"){
                $View->setData("configForm", $Chapter->configFormAdd());
            } else {
                header('Location:'.$routes['dashboard_lesson'].'/error');
            }
        } else {
            header('Location:'.$routes['dashboard_lesson']);
        }
    }
}