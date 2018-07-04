<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 09/04/2018
 * Time: 22:09
 */

class LessonChapter extends CoreSql
{
    protected $id;
    protected $order;
    protected $lessonid;
    protected $chapterid;

    public function __construct($_id = null)
    {
        parent::__construct();
        if(isset($_id)){
            $target = [
                'id',
                'lessonid',
                'chapterid',
                'order',
            ];
            $parameter = [
                'LIKE' => [
                    'id' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData($target);
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
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getLessonId()
    {
        return $this->lessonid;
    }

    /**
     * @param mixed $lessonid
     */
    public function setLessonId($lessonid)
    {
        $this->lessonid = $lessonid;
    }

    /**
     * @return mixed
     */
    public function getChapterId()
    {
        return $this->chapterid;
    }

    /**
     * @param mixed $chapterid
     */
    public function setChapterId($chapterid)
    {
        $this->chapterid = $chapterid;
    }

    /**
     * @param string $column
     * @param mixed $value
     * Detruit une ligne en fonction d'une colonne et d'une valeur
     */
    public function deleteJoin($column, $value)
    {
        $parameter = [
            'LIKE' => [
                $column => $value
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->delete();
    }

    public function getLessonChapterByIdentifier($_identifier, $_value)
    {
        switch($_identifier){
            case 'lesson': $opposite = 'chapter';
                $this->setOrderByParameter(["order" => "ASC"]);
                break;
            case 'chapter':
                $opposite = 'lesson';
                break;
            default:
                return 0;
                break;
        }
        $target = ["id", "lessonid", "chapterid"];
        $parameter = [
            "LIKE" => [
                $_identifier.'id' => $_value
            ]
        ];
        $this->setWhereParameter($parameter);
        $array = $this->getData($target);
        $returnArrayId= [];
        foreach($array as $category) {
            $tmpString = 'get'.ucfirst(strtolower($opposite)).'Id';
            $returnArrayId[] = $category->$tmpString();
        }
        return $returnArrayId;
    }

}