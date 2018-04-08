<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 16:25
 */

class BlogMark extends CoreSql
{
    protected $id;
    protected $markid;
    protected $userid;
    protected $blogid;

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

    public function getUserId()
    {
        return $this->userid;
    }
    public function setUserId($userid)
    {
        $this->userid = $userid;
    }

    public function getBlogId()
    {
        return $this->blogid;
    }
    public function setBlogId($blogid)
    {
        $this->blogid = $blogid;
    }
}