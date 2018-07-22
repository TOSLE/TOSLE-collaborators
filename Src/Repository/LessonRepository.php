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
                2 => $this->countLesson()
            ],
            1 => [
                1 => "Nombre de chapitre",
                2 => $this->countChapter()
            ],
        ]);
        return $StatsBlog->getArrayData();
    }

    /**
     * @return int
     * Retourne le nombre de lesson
     */
    public function countLesson()
    {
        return  $this->countData(['id']);
    }

    /**
     * @return int
     */
    public function countChapter()
    {
        $Chapter = new ChapterRepository();
        return $Chapter->countData(['id']);
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
        $ViewLatestBloc->setArrayHref("edit", $routes["chapter/edit"]."/".$this->getUrl());
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
     * @return array
     * Retourne les dernières lessons, le nombre dépend du paramètre qui par défaut est à 5
     */
    public function getLastLesson()
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
            $this->setType($tmpPostArray["select_type"]);
            $this->setLevel($tmpPostArray["select_difficulty"]);
            $this->save();
            $this->getLessonByUrl($this->getUrl());
            $LessonGroup = new LessonGroup();
            $parameter = [
                'LIKE' => [
                    'lessonid' => $this->id
                ]
            ];
            $LessonGroup->setWhereParameter($parameter);
            $LessonGroup->delete();
            if(isset($tmpPostArray["category_select"]) && !empty($tmpPostArray["category_select"]))
            {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryBySelect($tmpPostArray["category_select"], 'lesson', $this->getId());
            }
            if(isset($tmpPostArray["group_select"]) && !empty($tmpPostArray["group_select"]))
            {
                foreach($tmpPostArray["group_select"] as $id){
                    $LessonGroup->addLessonGroup($this->getId(), $id);
                }
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
            $this->generateXml();
            return 1;
        } else {
            return $errors;
        }
    }

    /**
     * Génére le flux RSS pour les cours
     */
    public function generateXml()
    {
        $GeneratorXML = new GeneratorXML('lessonfeed');
        $GeneratorXML->setLessonFeed($this->getXmlLesson());
    }

    /**
     * @param $_idLesson
     * @return array|int
     * Cette fonction retourne les éléments nécessaires à l'affichage des formulaires pour editer un article
     */
    public function editLesson($_idLesson)
    {
        $this->getLessonById($_idLesson);
        if(!empty($this->id)){
            $LessonGroup = new LessonGroup();
            $category = new CategoryRepository();
            $categoryFounded = $category->getCategoryByIdentifier('lesson', $this->id);
            $groupFounded = $LessonGroup->getGroupsLesson($this->id);
            return $arrayObject = [
                "lesson" => $this,
                "selectedOption" => [
                    "category_select" => $categoryFounded,
                    "group_select" => $groupFounded
                ],
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
        $this->getOneData(["id", "title", "description", "color", "type", "level"]);
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

    /**
     * @param $_idLesson
     * @param $_idChapter
     * Ajout d'une jointure entre lesson et chapitre
     */
    public function addChapter($_idLesson, $_idChapter)
    {
        $LessonChapter = new LessonChapter();
        $LessonChapter->setOrder(1);
        $LessonChapter->setChapterId($_idChapter);
        $LessonChapter->setLessonId($_idLesson);
        $LessonChapter->save();
        // On régénère le XML si besoin
        $this->generateXml();
    }

    /**
     * @param null $_limit
     * @param null $_offset
     * @return array
     * Permet de retourner les lessons dans un tableau d'objet. Il n'est pas nécessaire de spécifier les paramètres
     */
    public function getLessons($Auth, $_limit = null, $_offset = null)
    {
        $target = [
            "id", "title", "description", "datecreate",
            "status", "url", "color", "type", "level"
        ];
        if(isset($Auth)){
            $parameter = [
                'LIKE' => [
                    'status' => 1
                ]
            ];
            foreach($Auth->getGroups() as $group){
                $userGroups[$group->getId()] = $group->getName();
            }
        } else {
            $parameter = [
                'LIKE' => [
                    'status' => 1,
                    'type' => 1
                ]
            ];
        }
        if(isset($_limit)){
            $this->setLimitParameter($_limit, $_offset);
        }
        $this->setWhereParameter($parameter);
        $this->setOrderByParameter(["id" => "DESC"]);
        $arrayReturn = $this->getData($target);
        $arrayUnset = [];
        foreach($arrayReturn as $key => $lesson){
            $Category = new CategoryRepository();
            $LessonChapter = new LessonChapter();
            $Chapter = new ChapterRepository();
            $Groups = new LessonGroup();
            $arrayGroups = $Groups->getGroupsLesson($lesson->getId());
            if(is_array($arrayGroups) && isset($userGroups) && $lesson->getType() == 2){
                $temporaryTab = array_diff_key($arrayGroups,$userGroups);
                if(isset($temporaryTab) && is_array($temporaryTab)){
                    if(sizeof($arrayGroups) == sizeof($temporaryTab)){
                        $arrayUnset[] = $key;
                    }
                }
            }
            $arrayChapter = $LessonChapter->getLessonChapterByIdentifier('lesson', $lesson->getId());
            $arrayCategory = $Category->getCategoryByIdentifier('lesson', $lesson->getId());
            foreach ($arrayChapter as $id){
                $lesson->setNumberComment(sizeof($Chapter->getComments($id)));
            }
            if(isset($arrayGroups) && !empty($arrayGroups)){
                foreach ($arrayGroups as $idGroup => $value) {
                    $lesson->setGroups($idGroup);
                }
            }
            $lesson->setCategorylesson($arrayCategory);
            $lesson->setChapter($arrayChapter);
        }
        if(isset($arrayUnset) && !empty($arrayUnset)){
            foreach($arrayUnset as $keyToUnset){
                unset($arrayReturn[$keyToUnset]);
            }
        }
        return $arrayReturn;
    }

    /**
     * @return array
     * Permet de retourner les lessons pour les XML dans un tableau d'objet. Il n'est pas nécessaire de spécifier les paramètres
     */
    public function getXmlLesson()
    {
        $Lesson = new Lesson();
        $target = [
            "id",
            "title",
            "description",
            "datecreate",
            "status",
            "url",
            "type",
            "level"
        ];
        $parameter = [
            'LIKE' => [
                'status' => 1,
                'type' => 1,
            ]
        ];
        $Lesson->setWhereParameter($parameter);
        $arrayReturn = $Lesson->getData($target);
        foreach($arrayReturn as $lesson){
            $LessonChapter = new LessonChapter();
            $arrayChapter = $LessonChapter->getLessonChapterByIdentifier('lesson', $lesson->getId());
            $lesson->setChapter($arrayChapter);
        }

        return $arrayReturn;
    }

    /**
     * @param string|int $_identifier
     * @return boolean
     * Fonction qui va récupérer une lesson
     * Plusieurs vérifications :
     * 1. on regarde le type de l'ienditifer, s'il est numérique c'est un ID, si c'est une string, un URL sinon une
     * erreur
     * 2. Si après la raquête SELECT on a aucun ID, c'est une erreur
     * 3. Si les deux premieres vérifications passe, c'est un cours valide, on va chercher les chapitres qui
     * correspondent
     */
    public function getLesson($_identifier)
    {
        $LessonChapter = new LessonChapter();
        if(is_numeric($_identifier)){
            $params = ['id' => $_identifier];
        } elseif(is_string($_identifier)){
            $params = ['url' => $_identifier];
        } else {
            return 0;
        }
        // Rajout du status qui vaut 1, permet d'éviter qu'un étudiant ayant gardé l'url accède à un cours finalement
        // remis en brouillon
        $params['status'] = 1;
        $target = [
            "id",
            "title",
            "description",
            "datecreate",
            "status",
            "url",
            "color",
            "type",
            "level"
        ];
        $parameter = [
            'LIKE' => $params
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
        if(empty($this->getId())){
           return 0;
        }
        $chapters = $LessonChapter->getLessonChapterByIdentifier('lesson', $this->getId());
        $this->setChapter($chapters);
        return 1;
    }

    /**
     * @return int
     * Compte le nombre de lesson possédant un chapitre
     */
    public function countNumberOfLesson($Auth)
    {
        $lessons = $this->getLessons($Auth);
        $returnValue = 0;
        foreach($lessons as $lesson)
        {
            if(!empty($lesson->getChapter())){
                $returnValue++;
            }
        }
        return $returnValue;
    }

    /**
     * @param int $_numberLesson
     * @param array $_get
     * @return array|int
     * Cette fonction retourne une pagination pour les blogs en fonction d'un tableau envoyé
     */
    public function getPagination($_numberLesson, $_get, $Auth)
    {
        $pagination = [];
        $numberTotalOfLesson = $this->countNumberOfLesson($Auth);
        $totalPage = ($numberTotalOfLesson != $_numberLesson)?(int)($numberTotalOfLesson / $_numberLesson):1;
        if($totalPage < $numberTotalOfLesson / $_numberLesson){
            $totalPage++;
        }
        if($totalPage <= 1) {
            return 0;
        }
        $position = (isset($_get['page']) && ($_get['page'] <= $totalPage && $_get['page'] >= 1))?$_get['page']:1;
        unset($_get['page']);
        $href = "";
        $arrayHref=[];
        foreach ($_get as $key => $value){
            $arrayHref[] = $key.'='.$value;
        }
        if(isset($_get) && !empty($_get)){
            $href = implode('&amp;', $arrayHref);
        }
        if($position != 1){
            if(!empty($href)){
                $pagination['first_page'] = Access::getSlugsById()['homepage'].'?'.$href;
            } else {
                $pagination['first_page'] = Access::getSlugsById()['homepage'];
            }
        }
        for($i=1; $i <= $totalPage; $i++){
            if($i > 1){
                if(!empty($href)){
                    $pagination[$i] = Access::getSlugsById()['homepage'].'?page='.$i.'&amp;'.$href;
                } else {
                    $pagination[$i] = Access::getSlugsById()['homepage'].'?page='.$i;
                }
            } else {
                if(!empty($href)){
                    $pagination[$i] = Access::getSlugsById()['homepage'].'?'.$href;
                } else {
                    $pagination[$i] = Access::getSlugsById()['homepage'].$href;
                }
            }
        }
        if($position != $totalPage){
            if(!empty($href)){
                $pagination['last_page'] = Access::getSlugsById()['homepage'].'?page='.$totalPage.'&amp;'.$href;
            } else {
                $pagination['last_page'] = Access::getSlugsById()['homepage'].'?page='.$totalPage;
            }
        }
        return $pagination;
    }

    public function getAllLesson()
    {
        $target = [
            "id"
        ];
        $arrayAllLesson = $this->getData();
        return count($arrayAllLesson);
    }

    public function getLessonOfChapter($_idChapter)
    {
        $LessonChapter = new LessonChapter();
        $parameter = [
            'LIKE' => [
                'chapterid' => $_idChapter
            ]
        ];
        $LessonChapter->getOneData(['lessonid']);
        return $LessonChapter->getLessonId();
    }
}