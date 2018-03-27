<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 16/02/2018
 * Time: 11:22
 */

class AdminController
{
    function indexAction($params)
    {
        $View = new View("dashboard", "dashboard");
    }
    function lessonsAction($params){
        $View = new View("dashboard");
    }
    /**
     * @Route("/en/admin/chat")
     * @param array $params
     * View back office messaging action
     */
    function chatAction($params)
    {
        $View = new View("dashboard", "Admin/chat");
    }
    /**
     * @Route("/en/admin/blog")
     * @param array $params
     * View back office messaging action
     */
    function blogAction($params)
    {
        $View = new View("dashboard", "Admin/blog");
    }
}