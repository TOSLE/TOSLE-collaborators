<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 06/02/2018
 * Time: 21:41
 */


/**
 * Class IndexController
 * Controller not use
 */
class IndexController extends CoreController
{
    /**
     * @Route("/en/index(/index)")
     * @param array $params
     * Default action of IndexController
     */
    function indexAction($params)
    {
        $View = new View();
    }

    function accessAction($params)
    {
        $View = new View('default', 'error_access');
    }
    function notfoundAction($params)
    {
        new View("default", "accessnotfound");
    }

    function installAction($params)
    {
        $View = new View('installer', 'installer');
        $Installer = new Installer();
        $config = $Installer->configFormInstaller();
        $errorsParameter = $Installer->alertHtaccess();
        $errors = "";
        if(isset($params["POST"]) && !empty($params["POST"])) {
            $errors = Form::checkForm($config, $params["POST"]);
            if(empty($errors)){
                $data = Form::secureData($params["POST"]);
                $status = $Installer->testConnectionBDD($data);
                if(!$status) {
                    $errors['BDD Connexion'] = "Il semble que la connexion à la BDD est échouée.";
                } else {
                    $status = $Installer->setParameterFile($data);
                    if(!$status) {
                        $errors['Parameter'] = "Il semble que la création du fichier a échoué.";
                    } else {
                        $Routes = Access::getSlugsById();
                        header('Location:'.$Routes['index/config']);
                    }
                }
            }
        }
        $View->setData('config', $config);
        $View->setData('errors', $errors);
        $View->setData('errorsParameter', $errorsParameter);
    }

    /**
     * @param $params
     * Configuration du CMS
     */
    function configAction($params)
    {
        $View = new View('installer', 'installer');
        $Installer = new Installer();
        $errors = "";
        $config = $Installer->configFormConfiguration();

        if(isset($params["POST"]) && !empty($params["POST"])) {
            $errors = Form::checkForm($config, $params["POST"]);
            if(empty($errors)){
                $data = Form::secureData($params["POST"]);
                $errors = $Installer->setConfiguration($data);
                if(empty($errors)){
                    header('Location:'.Access::getSlugsById()['signin']);
                }
            }
        }

        $View->setData('config', $config);
        $View->setData('errors', $errors);
        $View->setData('stepInstall', 2);
    }


    /**
     * @param $params
     * Signalement d'un commentaire
     */
    function signalementAction($params)
    {
        if(isset($params['URI'][0]) && is_numeric($params['URI'][0])){
            $comment = new CommentRepository($params['URI'][0]);
            $Object = $comment->getInfoAboutComment($comment->getId());
            if($Object['type'] == 'chapter'){
                $data['url'] = $_SERVER['SERVER_NAME'].$this->Routes['view_lesson'].'/'.$Object['object']->getLesson()->getUrl().'/'.$Object['object']->getUrl();
                $data['content'] = $comment->getContent();
                $data['user'] = $comment->getUser()->getFirstname().' '.$comment->getUser()->getLastname();
                $data['sendBy'] = 'visitor';
                if($this->Auth){
                    $data['sendBy'] = $this->Auth->getFirstname().' '.$this->Auth->getLastname();
                }
            } else {
                $data['url'] = $_SERVER['SERVER_NAME'].$this->Routes['view_blog_article'].'/'.$Object['object']->getUrl();
                $data['content'] = $comment->getContent();
                $data['user'] = $comment->getUser()->getFirstname().' '.$comment->getUser()->getLastname();
                $data['sendBy'] = 'visitor';
                if($this->Auth){
                    $data['sendBy'] = $this->Auth->getFirstname().' '.$this->Auth->getLastname();
                }
            }
            Mail::sendMailSignalement($data);
        }
        header('Location:'.$this->Routes['homepage']);
    }

    function deletecomAction($params)
    {
        if(isset($this->Auth) && isset($params['URI'][0]) && is_numeric($params['URI'][0])){
            $comment = new CommentRepository($params['URI'][0]);
            $Object = $comment->getInfoAboutComment($comment->getId());
            if(($this->Auth->getStatus() > 1 || ($this->Auth->getId() == $comment->getUser()->getId()))){
                $parameterJoin = [
                    'LIKE' => [
                        'commentid' => $comment->getId()
                    ]
                ];
                $parameter = [
                    'LIKE' => [
                        'id' => $comment->getId()
                    ]
                ];
                if($Object['type'] == 'chapter'){
                    $ChapterComment = new ChapterComment();
                    $ChapterComment->setWhereParameter($parameterJoin);
                    $ChapterComment->delete();
                    $comment->setWhereParameter($parameter);
                    $comment->delete();
                } else {
                    $BlogComment = new BlogComment();
                    $BlogComment->setWhereParameter($parameterJoin);
                    $BlogComment->delete();
                    $comment->setWhereParameter($parameter);
                    $comment->delete();
                }
            }
        }
        header('Location:'.$this->Routes['homepage']);
    }

    function legalAction($params)
    {
        $View = new View('default', 'Others/legalnotice');
    }
}