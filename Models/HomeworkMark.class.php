<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 15:47
 */

class HomeworkMark extends BaseSql
{
    protected $id;
    protected $userid;
    protected $homeworkid;
    protected $markid;

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

    public function getUserId()
    {
        return $this->userid;
    }
    public function setUserId($userid)
    {
        $this->userid = $userid;
    }

    public function getHomeworkId()
    {
        return $this->homeworkid;
    }
    public function setHomeworkId($homeworkid)
    {
        $this->homeworkid = $homeworkid;
    }

    public function getMarkId()
    {
        return $this->markid;
    }
    public function setMarkId($markid)
    {
        $this->markid = $markid;
    }


}