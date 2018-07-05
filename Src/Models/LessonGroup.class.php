<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 04/07/2018
 * Time: 21:50
 */

class LessonGroup extends CoreSql
{
    protected $id;
    protected $lessonid;
    protected $groupid;

    /**
     * LessonGroup constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getLessonid()
    {
        return $this->lessonid;
    }

    /**
     * @param int $lessonid
     */
    public function setLessonid($lessonid)
    {
        $this->lessonid = $lessonid;
    }

    /**
     * @return int
     */
    public function getGroupid()
    {
        return $this->groupid;
    }

    /**
     * @param int $groupid
     */
    public function setGroupid($groupid)
    {
        $this->groupid = $groupid;
    }


}