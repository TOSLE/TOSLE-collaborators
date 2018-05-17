<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 17:59
 */

class UserLesson extends CoreSql
{
    protected $id;
    protected $userid;
    protected $lessonid;

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
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getLessonid()
    {
        return $this->lessonid;
    }

    /**
     * @param mixed $lessonid
     */
    public function setLessonid($lessonid)
    {
        $this->lessonid = $lessonid;
    }


}