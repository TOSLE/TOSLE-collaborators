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
        $View = new View("default");
    }
    function lessonsAction($params){
        $View = new View("default");
    }
    /**
     * @Route("/en/admin/chat")
     * @param array $params
     * View back office messaging action
     */
    function chatAction($params)
    {
        $View = new View("default", "Admin/chat");
    }
}