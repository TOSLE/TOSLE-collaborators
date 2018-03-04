<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 11/02/2018
 * Time: 23:44
 */

class ChatController
{
    function indexAction($params)
    {
        $View = new View("messaging", "chat");
        $View->setData("PageName", GLOBAL_HOME_TEXT." ".NAVBAR_CHAT);
    }
}