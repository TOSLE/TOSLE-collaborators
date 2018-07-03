<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 17/02/2018
 * Time: 12:10
 */

class ProfileController
{
    /**
     * @Route("/en/profile(/index)")
     * @param array $params
     * Default action of DashboardController
     */
    function indexAction($params)
    {
        $routes = Access::getSlugsById();
        $View = new View("default", "Profile/profile");
        $Profile = new ProfileRepository();
        if(is_null($_SESSION['token']) && is_null($_SESSION['email'])){
            //header('Location:'.$routes['signin']);
        }
        else {
            echo'<pre>';
            print_r($Profile->getInfoUser($_SESSION['token'], $_SESSION['email']));
            echo '</pre>';
            $ArrayInfoUser = $Profile->getInfoUser($_SESSION['token'], $_SESSION['email']);

            $View->setData("profile_info", $ArrayInfoUser);
        }
    }

    /**
     * @Route("/en/profile/view")
     * @param array $params
     * View user profile action
     */
    function viewAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/profile/edit")
     * @param array $params
     * Edit user profile action
     */
    function editAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/profile/homework")
     * @param array $params
     * View homework profile action
     */
    function homeworkAction($params)
    {
        $View = new View("default");
    }
}