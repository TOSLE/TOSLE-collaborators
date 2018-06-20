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

    /**
     * @param array $_post
     * @param int|null $_idLesson
     * @return array|int
     */
    public function addLesson($_post, $_idLesson = null)
    {

        $errors = Form::checkForm($this->configFormAddLesson(), $_post);
        if(empty($errors)){
            $tmpPostArray = $_post;
            if(isset($_idLesson)) {
                $this->setId($_idLesson);
            }
            $this->setTitle($tmpPostArray["title"]);
            $this->setDescription($tmpPostArray["textarea_lesson"]);
            $this->setColor($tmpPostArray["select_color"]);
            (isset($tmpPostArray["publish"]))?$this->setStatus(1):$this->setStatus(0);
            $this->setUrl(Access::constructUrl($this->getTitle()));
            $this->save();

            $this->getLessonByUrl($this->getUrl());
            if(isset($tmpPostArray["category_select"]) && !empty($tmpPostArray["category_select"]))
            {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryBySelect($tmpPostArray["category_select"], 'lesson', $this->getId());
            }
            if(isset($tmpPostArray["category_input"]) && !empty($tmpPostArray["category_input"])){
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryByInput($tmpPostArray["category_input"], 'lesson', $this->getId());
                if(!is_numeric($arrayCategory)){
                    if(array_key_exists('CODE_ERROR', $arrayCategory)){
                        return $arrayCategory;
                    }
                }

            }
            return 1;
        } else {
            return $errors;
        }
    }

    public function getLessonByUrl($_url)
    {
        $parameter = [
            "LIKE" => [
                "url" => $_url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["id", "title", "description", "status", "url", "datecreate"]);
        if(!isset($this->id)){
            return false;
        } else {
            return true;
        }
    }
}