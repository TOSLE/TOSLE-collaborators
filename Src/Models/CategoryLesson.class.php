<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 14:33
 */

class CategoryLesson extends CoreSql
{
    protected $id;
    protected $categoryid;
    protected $lessonid;

    public function __construct($_id = null)
    {
        parent::__construct();
        if(isset($_id)){
            $target = [
                'id',
                'categoryid',
                'lessonid'
            ];
            $parameter = [
                'LIKE' => [
                    'categoryid' => $_id
                ]
            ];
            $this->setWhereParameter($parameter);
            $this->getOneData($target);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCategoryId()
    {
        return $this->categoryid;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryid = new Category($categoryId);
    }

    public function getLessonId()
    {
        return $this->lessonid;
    }

    public function setLessonId($lessonid)
    {
        $this->lessonid = $lessonid;
    }




    /**
     * @param $column
     * @param $value
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
}