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
        if(!array_key_exists('token',$_SESSION) && !array_key_exists('email', $_SESSION)){
            $View = new View("default", "Profile/notconnect");
        }
        else {
            if(is_null($_SESSION['token']) && is_null($_SESSION['email'])){
                $View = new View("default", "Profile/notconnect");
            }
            else {
                $Profile = new ProfileRepository();
                $View = new View("default", "Profile/profile");
                $ArrayInfoUser = $Profile->getInfoUser($_SESSION['token'], $_SESSION['email']);

                $CurrentUser = Authentification::getUser($_SESSION['token'], $_SESSION['email']);
                $idUser = $CurrentUser->getId();
                $ArrayCommentsUser = $Profile->getCommentUser($idUser);

                $View->setData("profile_info", $ArrayInfoUser);
                $View->setData("comments_user", $ArrayCommentsUser);
            }

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
        $Profile = new ProfileRepository();

        $Profile->editProfile();
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