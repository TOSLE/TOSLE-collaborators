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
                    "target" => $routes["chapter/add"]."/chapter",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ]
        ]);
        return $BlocGeneral->getArrayData();
    }
    /**
     * @return array object
     * Permet de récupérer la modal statistique
     */
    public function getModalStats()
    {
        $StatsBlog = new DashboardBlocModal();
        $StatsBlog->setTitle("Lesson Analytics");
        $StatsBlog->setTableHeader([
            1 => "Type",
            2 => "Value"
        ]);
        $StatsBlog->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-number"
        ]);
        $StatsBlog->setColSizeBloc(6);
        $StatsBlog->setTableBodyContent([
            0 => [
                1 => "Nombre de cours",
                2 => 1
            ],
            1 => [
                1 => "Nombre de chapitre",
                2 => 2
            ],
        ]);
        return $StatsBlog->getArrayData();
    }

    /**
     * @param int $colSize
     * @return array
     * Permet de récupérer la configuration de la modal "LastArticle"
     * Le paramètre permet de définir une largeur à notre modal
     */
    public function getModalLatestLesson($colSize = 12)
    {
        $routes = Access::getSlugsById();
        $ViewLatestBloc = new DashboardBlocModal();
        $ViewLatestBloc->setTitle("Latest lesson on your Website");
        $ViewLatestBloc->setTableHeader([
            1 => "Title",
            2 => "Create at",
            4 => "Action"
        ]);
        $ViewLatestBloc->setColSizeBloc($colSize);
        $ViewLatestBloc->setActionButtonStatus(0, [
            "color" => "green",
            "text" => "Publish",
            "type" => "href",
            "target" => $routes["class/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["class/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonEdit("Edit");

        $ViewLatestBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            4 => "td-content-action"
        ]);
        $ViewLatestBloc->setTableBodyContent($this->getLastLesson(), true);
        $ViewLatestBloc->setActionTargetButton("Chapters", $routes['dashboard_chapter']);
        $ViewLatestBloc->setArrayHref("edit", $routes["class/edit"]);
        return $ViewLatestBloc->getArrayData();
    }

    public function getModalLastChapterByLesson($_urlLesson)
    {
        $routes = Access::getSlugsById();
        $this->getLessonByUrl($_urlLesson);
        $ViewLatestBloc = new DashboardBlocModal();
        $ViewLatestBloc->setTitle("Chapter of your lesson : ".$this->getTitle());
        $ViewLatestBloc->setTableHeader([
            1 => "Order",
            2 => "Title",
            3 => "Create at",
            4 => "Action"
        ]);
        $ViewLatestBloc->setColSizeBloc(12);
        $ViewLatestBloc->setActionButtonStatus(0, [
            "color" => "green",
            "text" => "Publish",
            "type" => "href",
            "target" => $routes["chapter/status"]."/".$this->getUrl().'/'
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["chapter/status"]."/".$this->getUrl().'/'
        ]);
        $ViewLatestBloc->setActionButtonEdit("Edit");

        $ViewLatestBloc->setTableBodyClass([
            1 => "td-content-order",
            2 => "td-content-text",
            3 => "td-content-date",
            4 => "td-content-action"
        ]);
        $ViewLatestBloc->setTableBodyContent($this->getChapterByUrlLesson($_urlLesson), true);
        $ViewLatestBloc->setArrayHref("edit", $routes["chapter/edit"]);
        $ViewLatestBloc->setActionButtonOrder($routes["chapter/order"]."/".$this->getUrl());
        return $ViewLatestBloc->getArrayData();
    }

    /**
     * @param int $_number
     * @return array|string
     * Retourne les articles d'une lesson
     */
    public function getChapterByUrlLesson($_urlLesson)
    {
        $Chapter = new ChapterRepository();
        if(!empty($this->getId())){
            $target = [
                'id',
                'title',
                'content',
                'datecreate',
                'status',
                'type',
                'url',
                "fileid",
                "_lessonchapter_id"
            ];

            $joinParameter = [
                "lessonchapter" => [
                    "chapter_id"
                ]
            ];
            $whereParameter = [
                "lessonchapter" => [
                    "lesson_id" => $this->getId()
                ]
            ];
            $Chapter->setLeftJoin($joinParameter, $whereParameter);
            $Chapter->setOrderByParameter(["_lessonchapter_order" => "ASC"]);
            return $Chapter->getData($target);
        } else {
            return ["error" => "URL de lesson inconnue"];
        }
    }

    /**
     * @param int $_number
     * @return array
     * Retourne les dernières lessons, le nombre dépend du paramètre qui par défaut est à 5
     */
    public function getLastLesson($_number = 5)
    {
        $target = [
            'id',
            'title',
            'description',
            'url',
            'status',
            'color',
            'datecreate'
        ];
        $this->setOrderByParameter(["id" => "DESC"]);
        $this->setLimitParameter($_number);
        return $this->getData($target);
    }

    /**
     * @param array $_post
     * @param int|null $_idLesson
     * @return array|int
     */
    public function addLesson($_post, $_idLesson = null)
    {

        $errors = Form::checkForm($this->configFormAddLesson(), $_post);
        $_post = Form::secureData($_post);
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

    /**
     * @param $_idArticle
     * @return array|int
     * Cette fonction retourne les éléments nécessaires à l'affichage des formulaires pour editer un article
     */
    public function editLesson($_idLesson)
    {
        $this->getLessonById($_idLesson);
        if(!empty($this->id)){
            $category = new CategoryRepository();
            $categoryFounded = $category->getCategoryByIdentifier('lesson', $this->id);
            return $arrayObject = [
                "lesson" => $this,
                "selectedOption" => $categoryFounded,
                "configForm" => $this->configFormAddLesson()
            ];
        } else {
            return 0;
        }
    }

    public function getLessonById($_id)
    {
        $parameter = [
            "LIKE" => [
                "id" => $_id
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["id", "title", "description", "color"]);
        if(!isset($this->id)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param string $_url
     * @return bool
     * Récupère le contenu d'un cours en fonction d'un url
     */
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


    /**
     * @return array
     * Generateur de configuration pour la selection d'un cours
     */
    public function getSelectLesson()
    {
        $target = [
            'id',
            'title'
        ];
        $array = $this->getData($target);
        $option['_forbidden'] = "Pas de cours sélectionné";
        foreach($array as $lesson){
            $option[$lesson->getId()] = $lesson->getTitle();
        }
        return [
            "select_lesson" => [
                "label" => "Selection du cours",
                "description" => "Vous pourrez toujours le modifier plus tard",
                "multiple" => false,
                "required" => true,
                "options" => $option
            ],
        ];
    }

    public function addChapter($_idLesson, $_idChapter)
    {
        $LessonChapter = new LessonChapter();
        $LessonChapter->setOrder(1);
        $LessonChapter->setChapterId($_idChapter);
        $LessonChapter->setLessonId($_idLesson);
        $LessonChapter->save();
    }
}