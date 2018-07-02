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

    public function __construct()
    {
        parent::__construct();
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
                "save" => "Sauvegarder en brouillon",
                "submit" => "Enregistrer le nouveau cours",
                "form_file" => false,
            ],
            "input" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Intitulé du cours",
                    "required" => true,
                    "maxString" => 100,
                    "label" => "Renseignez le titre de votre cours"
                ]
            ],
            "textarea" => [
                "label" => "Lesson description",
                "name" => "textarea_lesson",
                "description" => "Un maximum de 500 caractères",
                "placeholder" => "Maximum 500 caractères"
            ],
            'select_multiple' => [
                $category->configFormCategory(2),
                $group->configFormGroup(),
            ],
            'select' => [
                'select_color' => [
                    'label' => 'Choisissez la couleur de votre cours',
                    'required' => false,
                    'options' => [
                        '#1A5CCB' => 'Couleur de base',
                        '#FFFFFF' => 'Blanc',
                        '#F43C3E' => 'Rouge',
                        '#28A745' => 'Vert',
                        '#FA690E' => 'Orange'
                    ],
                    'description' => 'Couleur d\'arrière plan'
                ],
                'select_type' => [
                    'label' => 'Choisissez le type de cours',
                    'required' => true,
                    'options' => [
                        0 => 'Public',
                        1 => 'Privé',
                    ],
                    'description' => 'Cours privé ou Cours public'
                ],
                'select_difficulty' => [
                    'label' => 'Choisissez la difficulté de votre cours',
                    'required' => true,
                    'options' => [
                        0 => 'Facile',
                        1 => 'Normal',
                        2 => 'Difficile',
                    ],
                    'description' => 'Difficulté estimé du cours'
                ],
            ],
            "exit" => $slugs["dashboard_lesson"]
        ];
    }

}