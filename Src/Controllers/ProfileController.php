<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 17/02/2018
 * Time: 12:10
 */

class ProfileController extends CoreController
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
                $Lesson = new LessonRepository();
                $View = new View("default", "Profile/profile");
                $ArrayInfoUser = $Profile->getInfoUser($_SESSION['token'], $_SESSION['email']);

                $idUser = $this->Auth->getId();
                $ArrayCommentsUser = $Profile->getCommentUser($idUser);

                $user = $this->Auth;
                $ArrayLessonUser = $Lesson->getLessonsUser($user->getId());

                $View->setData("profile_info", $ArrayInfoUser);
                $View->setData("comments_user", $ArrayCommentsUser);
                $View->setData("lessons_user", $ArrayLessonUser);
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
        if (!array_key_exists('token', $_SESSION) && !array_key_exists('email', $_SESSION)) {
            $View = new View("default", "Profile/notconnect");
        } else {
            if (is_null($_SESSION['token']) && is_null($_SESSION['email'])) {
                $View = new View("default", "Profile/notconnect");
            } else {
                $routes = Access::getSlugsById();
                $View = new View("default", "Profile/edit");
                $Profile = new ProfileRepository();
                $User = new UserRepository();
                $errors = [];
                $User->getUser();
                $configFormEditUser = $Profile->editProfile($User->getId());

                if(isset($params["POST"]) && !empty($params["POST"])){
                    $errors = $User->addUser($params["POST"], $User->getId(), $_FILES);
                    if($errors == 1){
                        header('Location:'.$routes['profilehome']);
                    }
                }

                if($this->Auth->getStatus() > 1){
                    $View->setData('controller', 'DashboardController');
                }
                /**
                 * Errors and succes from edit password
                 */
                if(isset($params['GET']['errors']) && $params['GET']['errors']==1){
                    $View->setData('errorsFormEditPassword', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR1);
                }
                if(isset($params['GET']['errors']) && $params['GET']['errors']==2){
                    $View->setData('errorsFormEditPassword', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR2);
                }
                if(isset($params['GET']['errors']) && $params['GET']['errors']==3){
                    $View->setData('errorsFormEditPassword', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR3);
                }
                if(isset($params['GET']['success']) && $params['GET']['success']==1){
                    $View->setData('errorsFormEditPassword', USER_PROFILE_CONFIRM_MESSAGE_PASSWORD_CHANGE);
                }

                /**
                 * Errors and succes from edit account
                 */
                if(isset($params['GET']['errors']) && $params['GET']['errors']==4){
                    $View->setData('errorsFormEditAccount', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR4);
                }
                if(isset($params['GET']['errors']) && $params['GET']['errors']==5){
                    $View->setData('errorsFormEditAccount', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR3);
                }
                if(isset($params['GET']['errors']) && $params['GET']['errors']==6){
                    $View->setData('errorsFormEditAccount', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR6);
                }
                if(isset($params['GET']['errors']) && $params['GET']['errors']==7){
                    $View->setData('errorsFormEditAccount', USER_PROFILE_ERROR_MESSAGE_EDIT_PASSWORD_ERROR6);
                }
                if(isset($params['GET']['success']) && $params['GET']['success']==2){
                    $View->setData('errorsFormEditAccount', USER_PROFILE_CONFIRM_MESSAGE_ACCOUNT_CHANGE);
                }

                $View->setData('configEditPassword', $User->configFormEditPassword());
                $View->setData("config", $configFormEditUser);
                $View->setData("errors", $errors);
            }
        }
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