<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 16:12
 */

class ChapterMark extends BaseSql
{
    protected $id;
    protected $markid;
    protected $chapterid;
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

    public function getChapterId()
    {
        return $this->chapterid;
    }
    public function setChapterId($chapterid)
    {
        $this->chapterid = $chapterid;
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