<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 18:28
 */

class BlogComment extends CoreSql
{
    protected $id;
    protected $userid;
    protected $commentid;
    protected $blogid;

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
    public function getUserid($_idComment)
    {
        $parameter = [
            'LIKE' => [
                'commentid' => $_idComment
            ]
        ];
        $this->getOneData(['userid']);
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
    public function getBlogid()
    {
        return $this->blogid;
    }

    /**
     * @param mixed $blogid
     */
    public function setBlogid($blogid)
    {
        $this->blogid = $blogid;
    }


}