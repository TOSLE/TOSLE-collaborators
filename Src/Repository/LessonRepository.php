<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 19/06/2018
 * Time: 15:38
 */

class LessonRepository extends Lesson
{
    /**
     * @param int $_colsize
     * @return array object
     * Permet de récupérer la configuration d'une modal pour les ajouts concernant les lessons
     * Le paramètre permet de définir la taille du bloc
     */
    public function getModalAdd($_colsize = 6)
    {
        $BlocGeneral = new DashboardBlocModal();

        $routes = Access::getSlugsById();

        $BlocGeneral->setColSizeBloc($_colsize);
        $BlocGeneral->setTitle("Menu général");
        $BlocGeneral->setTableHeader([
            1 => "Name of action",
            2 => "Action"
        ]);
        $BlocGeneral->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-action"
        ]);
        $BlocGeneral->setColSizeBloc(6);
        $BlocGeneral->setTableBodyContent([
            0 => [
                1 => "Créer un nouveau cours",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["class/add"]."/lesson",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ],
            1 => [
                1 => "Créer un chapitre",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["class/add"]."/chapter",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ]
        ]);
        return $BlocGeneral->getArrayData();
    }
}