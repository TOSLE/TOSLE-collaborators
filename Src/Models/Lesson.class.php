<?php

/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 05/04/2018
 * Time: 23:27
 */
class Lesson extends CoreSql
{

    protected $id;
    protected $title;
    protected $description;
    protected $datecreate;
    protected $status;
    protected $url;
    protected $color;
    protected $type;
    protected $level;

    private $chapter;
    private $categorylesson = [];
    private $numberComment = 0;
    private $groups = [];

    public function __construct($_id = null)
    {
        parent::__construct();
        if(isset($_id) && is_numeric($_id)){
            $parameter = [
                'LIKE' => [
                    'id' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData();
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        $date = new DateTime($this->datecreate);
        return $date->format("F j, Y");
    }

    /**
     * @return mixed
     */
    public function getDatecreatefeed()
    {
        $date = new DateTime($this->datecreate);
        return $date->format("D, d M Y H:i:s O");
    }

    /**
     * @param mixed $datecreate
     */
    public function setDateCreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return array LessonChapter
     * Retourne un objet avec les valeurs de Lessonchapter
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @param array $_idForeinKey
     * Permet de créer l'attribut avec l'id de la clé primaire de la table correspondante
     */
    public function setChapter($_idForeinKey)
    {
        foreach($_idForeinKey as $content){
            $Chapter = new Chapter($content);
            if($Chapter->getStatus() == 1) {
                $this->chapter[] = $Chapter;
            }
        }
    }

    /**
     * @return array
     */
    public function getCategorylesson()
    {
        return $this->categorylesson;
    }

    /**
     * @param array $categorylesson
     * Le tableau envoyé doit avoir comme clé l'id de la catégorie. Le contenu n'est pas obligatoire !
     */
    public function setCategorylesson($categorylesson)
    {
        foreach($categorylesson as $key => $content){
            $this->categorylesson[] = new Category($key);
        }
    }

    /**
     * @return int
     */
    public function getNumberComment()
    {
        return $this->numberComment;
    }

    /**
     * @param int $numberComment
     */
    public function setNumberComment($numberComment)
    {
        $this->numberComment += $numberComment;
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param int $groupId
     * Nécessite l'id du groupe à ajouter
     */
    public function setGroups($groupId)
    {
        if(isset($groupId) && is_numeric($groupId)){
            $this->groups[] = new Group($groupId);
        } else {
            $this->groups = null;
        }
    }



    /**
     * @return array
     * Formulaire d'ajout d'une lesson
     */
    public function configFormAddLesson()
    {
        $slugs = Access::getSlugsById();
        $category = new CategoryRepository;
        $group = new GroupRepository;
        return [
            "config" => [
                "method" => "post",
                "action" => "",
                "save" => DASHBOARD_BLOC_LESSONS_ADD_SAVE_DRAFT,
                "submit" => DASHBOARD_BLOC_LESSONS_ADD_SAVE,
                "form_file" => false,
            ],
            "input" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => DASHBOARD_BLOC_LESSONS_ADD_TITLE2,
                    "required" => true,
                    "maxString" => 100,
                    "label" => DASHBOARD_BLOC_LESSONS_ADD_TITLE
                ]
            ],
            "textarea" => [
                "label" => DASHBOARD_BLOC_LESSONS_ADD_DESCRIPTION,
                "name" => "textarea_lesson",
                "description" => DASHBOARD_BLOC_LESSONS_ADD_MAX_CHARACTERS2,
                "placeholder" => DASHBOARD_BLOC_LESSONS_ADD_MAX_CHARACTERS
            ],
            'select_multiple' => [
                $category->configFormCategory(2),
                $group->configFormGroup(),
            ],
            'select' => [
                'select_color' => [
                    'label' => DASHBOARD_BLOC_LESSONS_ADD_COLOR,
                    'required' => false,
                    'options' => [
                        '#1A5CCB' => DASHBOARD_BLOC_LESSONS_ADD_COLOR_BASE,
                        '#7a76ff' => DASHBOARD_BLOC_LESSONS_ADD_COLOR1,
                        '#ff8383' => DASHBOARD_BLOC_LESSONS_ADD_COLOR2,
                        '#97ca74' => DASHBOARD_BLOC_LESSONS_ADD_COLOR3,
                        '#f1c97c' => DASHBOARD_BLOC_LESSONS_ADD_COLOR4,
                        '#61c0bf' => DASHBOARD_BLOC_LESSONS_ADD_COLOR5,
                        '#f8a3d3' => DASHBOARD_BLOC_LESSONS_ADD_COLOR6,
                    ],
                    'description' => DASHBOARD_BLOC_LESSONS_ADD_COLOR_BACKGROUND
                ],
                'select_type' => [
                    'label' => DASHBOARD_BLOC_LESSONS_ADD_TYPE,
                    'required' => true,
                    'options' => [
                        1 => DASHBOARD_BLOC_LESSONS_ADD_TYPE1,
                        2 => DASHBOARD_BLOC_LESSONS_ADD_TYPE2,
                    ],
                    'description' => DASHBOARD_BLOC_LESSONS_ADD_TYPE_OPTIONS
                ],
                'select_difficulty' => [
                    'label' => DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY,
                    'required' => true,
                    'options' => [
                        1 => DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY1,
                        2 => DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY2,
                        3 => DASHBOARD_BLOC_LESSONS_ADD_DIFFICULTY3,
                    ],
                    'description' => DASHBOARD_BLOC_LESSONS_ADD
                ],
            ],
            "exit" => $slugs["dashboard_lesson"]
        ];
    }

    public function getSubscribe($_auth)
    {
        if(isset($this->id)){
            if(isset($_auth) && !empty($_auth->getId())){
                $UserLesson = new UserLesson();
                $parameter = [
                    'LIKE' => [
                        'userid' => $_auth->getId(),
                        'lessonid' => $this->id
                    ]
                ];
                $UserLesson->setWhereParameter($parameter);
                if($UserLesson->countData(['id']) > 0){
                    return true;
                } else {
                    return null;
                }
            }
        }
        return false;
    }

}