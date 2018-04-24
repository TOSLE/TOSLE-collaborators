<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class BlogController
{
    /**
     * @Route("/en/blog(/index)")
     * @param array $params
     * Default action of BlogController
     */
    function indexAction($params)
    {
        /*
         * $User = new User();
        $form = $User->configFormConnect();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $User->setPassword($params["POST"]["pwd"]);
                $target = [
                    "password"
                ];
                $parameter = [
                    "email" => $params["POST"]["email"]
                ];
                $User->selectSimpleResponse($target, $parameter);
                if(password_verify($params["POST"]["pwd"], $User->getPassword())){
                    $target = [
                        "email",
                        "token"
                    ];
                    $parameter = [
                        "email" => $params["POST"]["email"],
                        "password" => $User->getPassword()
                    ];
                    $User->selectSimpleResponse($target, $parameter);
                    if(!(empty($User->getToken()) && empty($User->getEmail()))){
                        $_SESSION['token'] = $User->getToken();
                        $_SESSION['email'] = $User->getEmail();
                        header("Location:".DIRNAME);
                    }

                }
            }
        }
        $View = new View("user", "UserTPL/connect");
        $View->setData("config", $form);
        $View->setData("errors", $errors);
         */
        $View = new View("default", "Blog/home");
        $Blog = new Blog();
        $errors = [];
        if(!empty($params["GET"])){
            echo "Il y a une recherche";
        } else {
            $target = [
                "title",
                "content",
                "datecreate",
                "id"
            ];
            $parameter = [
                "status" => 1
            ];
            $response = $Blog->selectAnd($target, $parameter);
            $data = [];
            foreach($response as $key => $value){
                $date = new DateTime($value["blog_datecreate"]);
                $value["blog_datecreate"] = $date->format("l jS \of F Y H:i");
                $data[] = $value;
            }
            $View->setData("data", $data);
            $View->setData("col", "6");
        }

    }

    /**
     * @Route("/en/view/{idArticle}")
     * @param array $params
     * View article action
     */
    function viewAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/search/{params}")
     * @param array $params
     * View filtered article action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/add/{params}")
     * @param array $params
     * Add article
     */
    function addAction()
    {
        $Blog = new Blog();
        $Blog->setTitle('Test');
        $Blog->setContent('lorem ipj jgjhg hjg jg jfgf fhgf gf gjhgjhg jg f fgfd hgf hfgghfhg dhgf hfsum');
        $Blog->setStatus(1);
        $Blog->setType(1);
        $Blog->save();
    }
}