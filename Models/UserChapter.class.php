<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 17:07
 */

class UserChapter extends BaseSql
{
    protected $id;
    protected $userid;
    protected $chapterid;

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

    public function getChapterId()
    {
        return $this->chapterid;
    }
    public function setChapterId($chapterid)
    {
        $this->chapterid = $chapterid;
    }
}