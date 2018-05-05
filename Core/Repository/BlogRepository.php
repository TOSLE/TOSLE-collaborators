<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 29/04/2018
 * Time: 23:19
 */

class BlogRepository extends Blog
{
    public function __construct()
    {
        parent::__construct();
    }

    public function countNumberOfBlog($target, $parameter = null)
    {
        return $this->countData($target, $parameter)[0];
    }
}