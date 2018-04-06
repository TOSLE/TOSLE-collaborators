<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 14:46
 */

class CategoryBlog extends BaseSql
{
    protected $id;
    protected $categoryid;
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

    public function getCategoryId()
    {
        return $this->categoryid;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryid = $categoryId;
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