<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 09/04/2018
 * Time: 22:06
 */

class SubscriptionBlog extends CoreSql
{
    protected $id;
    protected $userid;
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
    public function getUserId()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserId($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getBlogId()
    {
        return $this->blogid;
    }

    /**
     * @param mixed $blogid
     */
    public function setBlogId($blogid)
    {
        $this->blogid = $blogid;
    }


}