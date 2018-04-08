<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 16:12
 */

class LessonMark extends CoreSql
{
    protected $id;
    protected $markid;
    protected $lessonid;
    protected $userid;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMarkId()
    {
        return $this->markid;
    }
    public function setMarkId($markid)
    {
        $this->markid = $markid;
    }

    public function getLessonId()
    {
        return $this->lessonid;
    }
    public function setLessonId($lessonid)
    {
        $this->lessonid = $lessonid;
    }

    public function getUserId()
    {
        return $this->userid;
    }
    public function setUserId($userid)
    {
        $this->userid = $userid;
    }
}