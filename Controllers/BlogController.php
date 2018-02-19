<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class BlogController
{
    function indexAction($params)
    {
        $View = new View("default", "blog");
    }
    function articleAction($params)
    {
        $View = new View("default", "blog/article");
    }
}