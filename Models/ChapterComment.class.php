<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 20:13
 */

class ChapterComment extends BaseSql
{
    protected $id;
    protected $userid;
    protected $commentid;
    protected $chapterid;

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
    public function getCommentid()
    {
        return $this->commentid;
    }

    /**
     * @param mixed $commentid
     */
    public function setCommentid($commentid)
    {
        $this->commentid = $commentid;
    }

    /**
     * @return mixed
     */
    public function getChapterid()
    {
        return $this->chapterid;
    }

    /**
     * @param mixed $chapterid
     */
    public function setChapterid($chapterid)
    {
        $this->chapterid = $chapterid;
    }


}